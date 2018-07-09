<?php
//including the database connection and authentication files
include 'head.php';
include("auth.php");

//fetching data
$jid = $_GET['jid'];
$id = $_GET['id'];




$result = mysqli_query($mysqli, "SELECT * FROM usertab WHERE id='$id'") or die(mysql_error());
?>

        <title>Job Offer</title>

        <div class="profile">

            <!--<div class="redirect"><a class="redirect" href="add.php">Add New Data</a></div>-->

            <div class="title"><h3>The Offer</h3></div>
              <table>

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
                  if( ($type ==='company') && ($cid === $id)){?>

                    <tr>
                      <th>Edit the offer</th>
                      <?php echo "<td><a href=\"editoffer.php?jid=$jid\">Edit</a> | <a href=\"delete.php?jid=$jid\" onClick=\"return confirm('Are you sure you want to delete this?')\">Delete</a></td>"; ?>
                    </tr>

                  <?php } ?>

                </div>
              </table>
              <?php include 'footer.php';?>
