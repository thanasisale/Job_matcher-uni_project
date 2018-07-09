<?php
//including the database connection and authentication files
include 'head.php';
include("auth.php");

//fetching data
$email = $_SESSION["email"];


$result = mysqli_query($mysqli, "SELECT * FROM usertab WHERE email='$email'") or die(mysqli_error());
?>

        <title>Profile</title>

        <div class="profile">

            <div class="title"><h3>Your Profile</h3></div>
              <table>

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
                      <th>Password</th>
                      <?php echo "<td>".'<input type="password" value='.$pass.' disabled>'."</td>"; ?>
                  </tr>
                  <tr>
                      <th>User Type</th>
                      <?php echo "<td>".$type."</td>"; ?>
                  </tr>

                  <?php if( $type == 'worker'){
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
                    //mysqli_free_result($resultwork);?>
                    <tr>
                      <th>Update</th>
                      <?php echo "<td><a href=\"edit.php?id=$id\">Edit</a> | <a href=\"delete.php?id=$id\" onClick=\"return confirm('Are you sure you want to delete this?')\">Delete</a></td>"; ?>
                    </tr>

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
                      <tr>
                        <th>Add Job Offer</th>
                        <?php echo "<td><a href=\"createjob.php?id=$id\">New Job Offer</a></td>"; ?>
                      </tr>

                    <?php }
                  mysqli_free_result($resultcomp); ?>

                  <tr>
                    <th>Update</th>
                    <?php echo "<td><a href=\"edit.php?id=$id\">Edit</a> | <a href=\"delete.php?id=$id\" onClick=\"return confirm('Are you sure you want to delete this?')\">Delete</a></td>"; ?>
                  </tr>

                  <?php $offers = mysqli_query($mysqli, "SELECT * FROM jobOffer WHERE cid = '$id' ORDER BY jid DESC");
                  $rowcount = mysqli_num_rows($offers);
                  ?>
                  <table class="oftab">
                    <div class="title"style="margin-top: 5%;"><h3>Job Offers</h3></div>
                      <?php
                      if($rowcount>0){
                      //Showing the db records
                      while($offer = mysqli_fetch_array($offers)) {
                        echo "<tr>";
                        echo "<th>".$offer['jtittle']."</th>";
                        echo "<th>".$offer['jloc']."</th>";
                        echo "<td><a href=\"joboffer.php?jid=$offer[jid]&id=$id\">View</a></td>";
                      }
                  mysqli_free_result($offers);
                }else{echo"<th>No Offers Available.</th>";}
                    ?>
                  </table>
                <?php }?>
            </div>
          </table>
        </div>
        <?php include 'footer.php';?>
