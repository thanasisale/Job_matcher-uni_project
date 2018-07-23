<?php
//including the database connection and authentication files
include 'head.php';
include("auth.php");

//fetching data from the URL
$linkid = $_GET['id'];

//checking if the viewer is a visitor or the owner
if (isset($linkid)) {

  $sec=0;
  $result = mysqli_query($mysqli, "SELECT * FROM usertab WHERE id='$linkid'") or die(mysqli_error());

}else{

  $sec = 1;
  $email = $_SESSION["email"];
  $result = mysqli_query($mysqli, "SELECT * FROM usertab WHERE email='$email'") or die(mysqli_error());
}

?>
      <title>Profile</title>

      <div class="profile container">

        <div class="title"><h3>Your Profile</h3></div>

        <table class="table table-hover cstmtable">

          <?php
          while($res = mysqli_fetch_array($result)) {
            $id = $res['id'];
            $email = $res['email'];
            $pass = $res['pass'];
            $type = $res['type'];
          }
          mysqli_free_result($result);?>

          <tr>
            <th>Email</th>
            <?php echo "<td>".$email."</td>"; ?>
          </tr>

          <tr>
            <th>User Type</th>
            <?php echo "<td>".$type."</td>"; ?>
          </tr>


          <?php
          //checking if the user is Worker or Company
          if( $type == 'worker'){
            $resultwork = mysqli_query($mysqli, "SELECT * FROM worker WHERE wid = '$id'") or die(mysqli_error());

            while($reswork = mysqli_fetch_array($resultwork)){ ?>

              <tr>
                <th>First Name</th>
                <?php echo "<td>".$reswork['wname']."</td>"; ?>
              </tr>

              <tr>
                <th>Last Name</th>
                <?php echo "<td>".$reswork['wlname']."</td>"; ?>
              </tr>

              <tr>
                <th>Age</th>
                <?php echo "<td>".$reswork['wAge']."</td>"; ?>
              </tr>

              <tr>
                <th>Address</th>
                <?php echo "<td>".$reswork['waddress']."</td>"; ?>
              </tr>

              <tr>
                <th>Phone</th>
                <?php echo "<td>".$reswork['wtel']."</td>"; ?>
              </tr>

              <tr>
                <th>Graduation Level</th>
                <?php echo "<td>".$reswork['wgradlvl']."</td>"; ?>
              </tr>

              <tr>
                <th>Your work Experience</th>
                <?php echo "<td>".$reswork['wexp']." Months</td>"; ?>
              </tr>

              <tr>
                <th>Known Languages</th>
                <?php echo "<td>".$reswork['wlang']."</td>"; ?>
              </tr>

              <tr>
                <th>Your work skills</th>
                <?php echo "<td>".$reswork['wskills']."</td>"; ?>
              </tr>

              <tr>
                <th>Basic info</th>
                <?php echo "<td>".$reswork['winfo']."</td>"; ?>
              </tr>

            <?php }
            mysqli_free_result($resultwork);

            //checking if the user is the owner or a visitor
            if (!isset($linkid)) { ?>

              <tr>
                <th>Update</th>
                <?php echo "<td><a href=\"edit.php?id=$id\">Edit</a> | <a href=\"delete.php?id=$id\" onClick=\"return confirm('Are you sure you want to delete this?')\">Delete</a></td>"; ?>
              </tr>



            <a  class="btn costbtn btn-outline-primary" href="automach.php?id=<?php echo $id; ?>">Show Me Job Offers</a>

          <?php } ?>

        <?php }elseif( $type =='company'){

          $resultcomp = mysqli_query($mysqli, "SELECT * FROM comptab WHERE cid = '$id'") or die(mysqli_error());

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

            <?php if(!isset($linkid)) { ?>

              <tr>
                <th>Add Job Offer</th>
                <?php echo "<td><a href=\"createjob.php?id=$id\">New Job Offer</a></td>"; ?>
              </tr>

            <?php }

          }
          mysqli_free_result($resultcomp); ?>

          <?php
          //checking if the user is the owner or a visitor
          if(!isset($linkid)) { ?>

            <tr>
              <th>Update</th>
              <?php echo "<td><a href=\"edit.php?id=$id\">Edit</a> | <a href=\"delete.php?id=$id\" onClick=\"return confirm('Are you sure you want to delete this?')\">Delete</a></td>"; ?>
            </tr>
          <?php } ?>

        </table><!-- Closing Profile table if user is Company-->

        <?php
        //checking if the user is the owner or a visitor
        if (!isset($linkid)) {?>
          <a  class="btn costbtn btn-outline-primary" href="automach.php?id=<?php echo $id; ?>">Show Me Workers</a>
        <?php }


        //if the user is the owner, presenting their Offers
        $offers = mysqli_query($mysqli, "SELECT * FROM jobOffer WHERE cid = '$id' ORDER BY jid DESC");

        $rowcount = mysqli_num_rows($offers); ?>

        <table class="oftab table table-secondary table-hover">

          <div class="title"style="margin-top: 5%;"><h3>Job Offers</h3></div>

          <?php
          //setting the correct id
          $uid = (!isset($linkid)) ? $id : $linkid ;

          if($rowcount > 0){
            //Showing the db records
            while($offer = mysqli_fetch_array($offers)) {
              echo "<tr>";
              echo "<th>".$offer['jtittle']."</th>";
              echo "<th>".$offer['jloc']."</th>";
              echo "<td><a href=\"joboffer.php?jid=$offer[jid]&id=$uid&sec=$sec\">View</a></td>";
            }
            mysqli_free_result($offers);

          }else{echo"<th>No Offers Available.</th>";} ?>
        </table><!-- End offers table -->

      <?php }//End worker/company if ?>

    </table><!-- Closing Profile Table if it didn't close at Company -->

      <?php //If the user is a visitor showing the contact form
      if (isset($linkid)) {?>

        <div class="container contForm">

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

                  </form><!-- End of Contact Form -->

                </div><!-- Closing the panel-body div -->

              </div><!-- Closing the panel-collapse div -->

            </div><!-- Closing the secondary panel div -->

          </div><!-- End of Panel -->

        </div><!-- End of contact form -->

      <?php }//End of if visitor ?>

    </div><!-- End of container -->

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

        if($toEmail == $email ){

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

    }//End of Contact form Handler

    include 'footer.php';?>
