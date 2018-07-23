<?php
//including the database connection and authentication files
include 'head.php';
include("auth.php");

//colecting data from the URL
$jid = $_GET['jid'];
$id = $_GET['id'];
$sec = $_GET['sec'];



//fetching the data from th db for the id
$result = mysqli_query($mysqli, "SELECT * FROM usertab WHERE id='$id'") or die(mysql_error());
?>

        <title>Job Offer</title>

        <div class="profile container">

          <div class="title"><h3>Job Offer</h3></div>

          <table class="table table-hover cstmtable">

            <?php

            while($res = mysqli_fetch_array($result)) {
              $email = $res['email'];
              $pass = $res['pass'];
              $type = $res['type'];
            } ?>

            <?php $resultoffer = mysqli_query($mysqli, "SELECT * FROM jobOffer WHERE jid = '$jid'") or die(mysqli_error());


            while($resoffer = mysqli_fetch_array($resultoffer)){ ?>

              <tr>
                <th>Job Tittle</th>
                <?php echo "<td>".$resoffer['jtittle']."</td>"; ?>
              </tr>

              <tr>
                <th>Basic info</th>
                <?php echo "<td>".$resoffer['jinfo']."</td>"; ?>
              </tr>

              <tr>
                <th>Job Location</th>
                <?php echo "<td>".$resoffer['jloc']."</td>"; ?>
              </tr>

              <tr>
                <th>Graduation Level Needed</th>
                <?php echo "<td>".$resoffer['jgradlvl']."</td>"; ?>
              </tr>

              <tr>
                <th>Work Experience Needed</th>
                <?php echo "<td>".$resoffer['jexp']." Months</td>"; ?>
              </tr>

              <tr>
                <th>Required Languages</th>
                <?php echo "<td>".$resoffer['jlang']."</td>"; ?>
              </tr>

              <tr>
                <th>Skills Required</th>
                <?php echo "<td>".$resoffer['jskills']."</td>"; ?>
              </tr>

              <?php $cid = $resoffer['cid'];
            } ?>

                  <?php
                  $companymail = mysqli_query($mysqli, "SELECT email FROM usertab WHERE ID = '$cid'") or die(mysqli_error());
                  while($cmail = mysqli_fetch_array($companymail)){
                    $mail = $cmail['email'];
                  }
                  $resultcomp = mysqli_query($mysqli, "SELECT * FROM comptab WHERE cid = '$cid'") or die(mysqli_error());
                  while($rescomp = mysqli_fetch_array($resultcomp)){ ?>

                    <tr>
                      <th>Company Name</th>
                      <?php echo "<td>".$rescomp['cname']."</td>"; ?>
                    </tr>

                    <tr>
                      <th>About the Company</th>
                      <?php echo "<td>".$rescomp['cabout']."</td>"; ?>
                    </tr>

                    <tr>
                      <th>Address</th>
                      <?php echo "<td>".$rescomp['caddress']."</td>"; ?>
                    </tr>

                    <tr>
                      <th>Phone</th>
                      <?php echo "<td>".$rescomp['ctel']."</td>"; ?>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <?php echo "<td>".$mail."</td>"; ?>
                    </tr>


                    <?php
                  }
                  if( ($type ==='company') && ($cid === $id) && ($sec != 0)){?>

                    <tr>
                      <th>Edit the offer</th>
                      <?php echo "<td><a href=\"editoffer.php?jid=$jid\">Edit</a> | <a href=\"delete.php?jid=$jid\" onClick=\"return confirm('Are you sure you want to delete this?')\">Delete</a></td>"; ?>
                    </tr>

                  <?php }else {
                    echo "<td> </td>";
                    echo "<td><a href=\"profile.php?id=$cid\">Visit The Company</a></td>";
                  }
                  mysqli_free_result($result);
                  mysqli_free_result($resultcomp);
                  mysqli_free_result($companymail);

                  ?>

                </table>

                <?php
                //Checking if the user is owner or visitor
                if( ($type ==='company') && ($cid === $id) && ($sec != 0)){?>
                  <a  class="btn costbtn btn-outline-primary" href="automach.php?jid=<?php echo $jid; ?>">Show Me Workers</a>

                <?php }else{ ?>

                  <div class="container contForm" id="contForm">

                    <div class="panel-group">

                      <div class="panel panel-default">

                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" class="btn btn-primary btn-lg btn-block" href="#collapse1">Contact</a>
                          </h4>
                        </div>

                        <div id="collapse1" class="panel-collapse collapse">
                          <div class="panel-body">

                            <?php if($msg != ''): ?>
                              <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
                            <?php endif; ?>

                            <form method="post" class="contForm" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                              <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
                              </div>

                              <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $senderEmail : ''; ?>">
                              </div>

                              <div class="form-group">
                                <label>Message</label>
                                <textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
                              </div>

                              <button type="submit" name="submit" class="btn btn-primary">Submit</button>

                            </form><!-- End of contact form -->

                          </div><!-- Closing the panel body div -->

                        </div><!-- Closing the panel-collapse div -->

                      </div><!-- Closing the panel -->

                    </div><!-- End of Panel -->

                  </div><!-- End of contact form -->

                <?php }//End if visitor//owner ?>

              </div><!-- End of container div -->

              <?php
              //Contact form Handler

              // Message Vars
              $msg = '';
              $msgClass = '';

              // Check For Submit
              if(isset($_POST['submit'])){
              	// Get Form Data
              	$name = htmlspecialchars($_POST['name']);
              	$senderEmail = htmlspecialchars($_POST['email']);
              	$message = htmlspecialchars($_POST['message']);

              	// Check Required Fields
              	if(!empty($senderEmail) && !empty($name) && !empty($message)){

                  $toEmail = $email;
              		$subject = 'Contact Request From '.$name;
              		$body = '<h2>Contact Request</h2>
              			<h4>Name</h4><p>'.$name.'</p>
              			<h4>Email</h4><p>'.$senderEmail.'</p>
              			<h4>Message</h4><p>'.$message.'</p>
              		';

                  // Email Headers
                  $headers = "MIME-Version: 1.0" ."\r\n";
                  $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

                  // Additional Headers
                  $headers .= "From: " .$name. "<".$senderEmail.">". "\r\n";

                  /*
                  * It Should be like that:
                  * if(mail($toEmail, $subject, $body, $headers)){
                  *    $msg = 'Your email has been sent';
                  *   $msgClass = 'alert-success';
                  * }
                  * But because we don't have a mail service in place, we are bypassing this step
                  */
                  
                  if($toEmail == $email){

                    $msg = 'Your email has been sent';
                    $msgClass = 'alert-success';

                  } else {

                    $msg = 'Your email was not sent';
                    $msgClass = 'alert-danger';
                  }
                } else {
                  $msg = 'Please fill in all fields';
              		$msgClass = 'alert-danger';
                }
              }//End of Contact From Handler

              include 'footer.php';?>
