<?php
include 'head.php';
include("auth.php");
?>
    <?php
    //getting id from url
    $id = $_GET['id'];
    //selecting data associated with this id
    $result = mysqli_query($mysqli, "SELECT * FROM usertab WHERE ID=$id");


    while($res = mysqli_fetch_array($result)){
      $pass = $res['pass'];
      $email = $res['email'];
      $type = $res['type'];
    }

    //freeing the var
    mysqli_free_result($result);

    //if there is no record in the DB fo this id and the type is worker/company we create one
    if( $type == 'worker'){
      $resultwork = mysqli_query($mysqli, "SELECT * FROM worker WHERE wid=$id") or die(mysqli_error());
      $rowcount = mysqli_num_rows($resultwork);

      if($rowcount > 0){

        while($reswork = mysqli_fetch_array($resultwork)){
          $wfname = $reswork['wname'];
          $wlname = $reswork['wlname'];
          $wage = $reswork['wAge'];
          $waddress = $reswork['waddress'];
          $wtel = $reswork['wtel'];
          $wgradlvl = $reswork['wgradlvl'];
          $wexp = $reswork['wexp'];
          $winfo = $reswork['winfo'];
          //making the strings to arrays using "*" as a delimeter using explode
          $skills = $reswork['wskills'];
          $skill = explode("*", $skills);
          $langs = $reswork['wlang'];
          $lang = explode("*", $langs);
        }
        mysqli_free_result($resultwork);

      }else{

        $resultworkin = mysqli_query($mysqli, "INSERT INTO worker(wid) VALUES('$id')");
        mysqli_free_result($resultworkin);

      }

    }elseif( $type == 'company'){

      $resultcomp = mysqli_query($mysqli, "SELECT * FROM comptab WHERE comptab.cid = " . $id);
      $rowcount = mysqli_num_rows($resultcomp);

      if($rowcount > 0){

        while($rescomp = mysqli_fetch_array($resultcomp)){
          $cname = $rescomp['cname'];
          $cabout = $rescomp['cabout'];
          $caddress = $rescomp['caddress'];
          $ctel = $rescomp['ctel'];
        }
        mysqli_free_result($resultcomp);

      }else{

        $resultcompin = mysqli_query($mysqli, "INSERT INTO comptab(cid) VALUES('$id')");
        mysqli_free_result($resultcompin);

      }
    }//End user finder
    ?>

    <title>Edit Data</title>

    <div class="edit container">

      <div class="customform">

        <form name="form1" method="POST" action="edit.php">

          <fieldset>

            <legend class="text-center">Here You can edit Your Profile!</legend>
            <div class="form-group">
              <label for="Email">Email address</label>
              <input type="text" name="email" class="form-control" id="Email" placeholder="Enter email" value="<?php echo $email; ?>" required>
            </div>

            <div class="form-group">
              <label for="Password">Password</label>
              <input type="password" name="pass" class="form-control" id="Password" placeholder="Password" value="<?php echo $pass;?>" required>
            </div>

            <label for="radio">Type</label>
            <fieldset class="form-group" id="radio">
              <div class="form-check">
                <label class="form-check-label radio-inline">
                  <input type="radio" class="form-check-input" name="type" id="option1" value="company"<?php if (isset($type) && $type=="company") echo "checked";?>>Company
                </label>
              </div>

              <div class="form-check">
                <label class="form-check-label radio-inline">
                  <input type="radio" class="form-check-input" name="type" id="option2" value="worker" <?php if (isset($type) && $type=="worker") echo "checked";?>>Worker
                </label>
              </div>
            </fieldset>
            <?php
            if($type == "worker"){ ?>

              <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" name="wname" class="form-control" id="name" placeholder="Enter yout First Name" value="<?php echo $wfname; ?>" required>
              </div>

              <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" name="wlname" class="form-control" id="lname" placeholder="Enter yout Last Name" value="<?php echo $wlname; ?>" required>
              </div>

              <label for="radio">Graduation Level</label>

              <fieldset class="form-group" id="radio">

                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="wgradlvl" id="option1" value="under" <?php if (isset($wgradlvl) && $wgradlvl== 'under') echo "checked";?>>Undergraduate
                  </label>
                </div>

                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="wgradlvl" id="option2" value="bachelor" <?php if (isset($wgradlvl) && $wgradlvl== 'bachelor') echo "checked";?>>Bachelor
                  </label>
                </div>

                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="wgradlvl" id="option2" value="master" <?php if (isset($wgradlvl) && $wgradlvl== 'master') echo "checked";?>>Master
                  </label>
                </div>

              </fieldset>

              <div class="form-group">
                <label for="Textarea">Basic info</label>
                <textarea name="winfo" class="form-control" id="Textarea" rows="3"><?php echo $winfo; ?></textarea>
              </div>

              <div class="form-group">

                <label for="wAge">Age</label>

                <?php //fixing the date format to be able to be shown
                $fwage = date("Y-m-d", strtotime($wage));
                $wage = $fwage; ?>

                <input type="date" name="wAge" class="form-control" id="wAge" placeholder="Age" value="<?php echo $wage;?>" required>

              </div>

              <div class="form-group">
                <label for="waddress">Address</label>
                <input type="text" name="waddress" class="form-control" id="waddress" placeholder="Enter your address" value="<?php echo $waddress;?>" required>
              </div>

              <div class="form-group">
                <label for="wtel">Phone</label>
                <input type="number" name="wtel" class="form-control" id="wtel" placeholder="telephone" value="<?php echo $wtel;?>" required>
              </div>

              <div class="form-group">
                <label for="wexp">Your work Experience</label>
                <input type="number" name="wexp" class="form-control" id="wexp" placeholder="Months" value="<?php echo $wexp;?>" required>
              </div>

              <label for="wskills">Your Skills</label>
              <div class="form-group">

                <div id="inputs">

                  <?php foreach ($skill as $sk): ?>
                    <input type="text" name="skills[]" class="form-control" id="skills" placeholder="Enter a skill" value="<?php echo $sk; ?>">
                  <?php endforeach; ?>

                </div>

                <div class="plusminus">
                  <a class="btn" id="adder" href="#"><i class="fa fa-plus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#0000a5;"></i></a>
                  <a class="btn" id="remove" href="#"><i class="fa fa-minus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#c30000;"></i></a>
                </div>

              </div>

              <label for="lang">Known Languages</label>
              <div class="form-group">

                <div id="inputslang">
                  <?php foreach ($lang as $la): ?>
                    <input type="text" name="languages[]" class="form-control" id="lang" placeholder="Enter a language" value="<?php echo $la;?>">
                  <?php endforeach; ?>
                </div>

                <div class="plusminus">
                  <a class="btn" id="adderlang" href="#"><i class="fa fa-plus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#0000a5;"></i></a>
                  <a class="btn" id="removelang" href="#"><i class="fa fa-minus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#c30000;"></i></a>
                </div>

              </div>


            <?php }elseif($type == 'company'){ ?>

              <div class="form-group">
                <label for="cname">Company Name</label>
                <input type="text" name="cname" class="form-control" id="cname" placeholder="Enter the Name of the Company" value="<?php echo $cname; ?>" required>
              </div>

              <div class="form-group">
                <label for="cabout">About the Company</label>
                <textarea name="cabout" class="form-control" id="cabout" rows="3"><?php echo $cabout; ?></textarea>
              </div>

              <div class="form-group">
                <label for="caddress">Address</label>
                <input type="text" name="caddress" class="form-control" id="caddress" placeholder="Enter the Address" value="<?php echo $caddress;?>" required>
              </div>

              <div class="form-group">
                <label for="ctel">Phone Number</label>
                <input type="text" name="ctel" class="form-control" id="ctel" placeholder="telephone" value="<?php echo $ctel;?>" required>
              </div>

            <?php } ?>
            <!-- Saving the id for after the submission-->
            <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>

            <button type="update" name="update" class="btn btn-outline-primary custombtn">Submit</button>

          </fieldset>
        </form><!-- End of Form -->

      </div><!-- End of customform -->

      <?php
      //Form Handler
      if(isset($_POST['update'])) {

          $id = $_POST['id'];

          //making sure for the content,by removing slashes,preventing sqlinjections and preparing the statements
          $email = stripslashes($_POST['email']);
          $email = mysqli_real_escape_string($mysqli,$email);

          //Not hashing the password for convenience
          $pass = stripslashes($_POST['pass']);
          $pass = mysqli_real_escape_string($mysqli,$pass);

          $type = $_POST['type'];

          // checking empty fields
          if(empty($pass) || empty($email) || empty($type)) {

            if(empty($pass)) { ?>
              <div class="alert alert-dismissible alert-danger customalert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Password field is empty.</strong> <a href="javascript:self.history.back();" class="alert-link"> try submitting again.</a>
              </div>
            <?php }

            if(empty($email)) { ?>

                <div class="alert alert-dismissible alert-danger customalert">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Email field is empty.</strong> <a href="javascript:self.history.back();" class="alert-link">try submitting again.</a>
                </div>
              <?php }

            if(empty($type)) { ?>
              <div class="alert alert-dismissible alert-danger customalert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Type field is empty.</strong> <a href="javascript:self.history.back();" class="alert-link">try submitting again.</a>
              </div>
            <?php }

           }else{

            //updating the main user table
            $result = mysqli_query($mysqli, "UPDATE usertab SET email='$email',pass='$pass',type='$type' WHERE ID=$id");

          }

          if($type == 'worker') {

            //making sure of the content,by removing slashes
            $wfname = stripslashes($_POST['wname']);
            $wfname = mysqli_real_escape_string($mysqli,$wfname);

            $wlname = stripslashes($_POST['wlname']);
            $wlname = mysqli_real_escape_string($mysqli,$wlname);

            $wgradlvl = stripslashes($_POST['wgradlvl']);
            $wgradlvl = mysqli_real_escape_string($mysqli,$wgradlvl);

            $winfo = stripslashes($_POST['winfo']);
            $winfo = mysqli_real_escape_string($mysqli,$winfo);

            $wage = stripslashes($_POST['wAge']);
            $wage = mysqli_real_escape_string($mysqli,$wage);

            $waddress = stripslashes($_POST['waddress']);
            $waddress = mysqli_real_escape_string($mysqli,$waddress);

            $wtel = stripslashes($_POST['wtel']);
            $wtel = mysqli_real_escape_string($mysqli,$wtel);

            $wexp = stripslashes($_POST['wexp']);
            $wexp = mysqli_real_escape_string($mysqli,$wexp);


            //making the arrays to a string seperated by "*" using implode
            $skills = implode("*", $_POST['skills']);
            $skills = stripslashes($skills);
            $skills = mysqli_real_escape_string($mysqli,$skills);

            $langs = implode("*", $_POST['languages']);
            $langs = stripslashes($langs);
            $langs = mysqli_real_escape_string($mysqli,$langs);


            //updating the worker table
            $resultwork = mysqli_query($mysqli,"UPDATE `worker` SET `wname`='$wfname',`wlname`='$wlname',`wgradlvl`='$wgradlvl',`winfo`='$winfo',`wAge`='$wage',
              `waddress`='$waddress',`wtel`='$wtel',`wexp`='$wexp',`wskills`='$skills',`wlang`='$langs'  WHERE `wid` = '$id'");


            if($resultwork && $result){ ?>
              <div class="alert alert-dismissible alert-success customalert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success, Worker profile completed</strong><a href="profile.php" class="alert-link">Go to your profile</a>
              </div>

              <!--Script to remove the form after submission -->
              <script>
                var element = document.querySelector('.customform');
                removeJunk(element);
              </script>
            <?php }else{ ?>

              <div class="alert alert-dismissible alert-success customalert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>DataBaseError!Try again later.</strong> <a href="profile.php" class="alert-link">Go to your profile</a>
              </div>

              <!--Script to remove the form after submission -->
              <script>
                var element = document.querySelector('.customform');                    removeJunk(element);
              </script>

            <?php }
            mysqli_free_result($resultwork);

          }elseif ($type == 'company') {

            $cname = stripslashes($_POST['cname']);
            $cname = mysqli_real_escape_string($mysqli,$cname);

            $cabout = stripslashes($_POST['cabout']);
            $cabout = mysqli_real_escape_string($mysqli,$cabout);

            $caddress = stripslashes($_POST['caddress']);
            $caddress = mysqli_real_escape_string($mysqli,$caddress);

            $ctel = stripslashes($_POST['ctel']);
            $ctel = mysqli_real_escape_string($mysqli,$ctel);

            $resultcomp = $mysqli->query("UPDATE comptab SET cname='$cname',cabout='$cabout',caddress='$caddress',ctel='$ctel' WHERE cid=$id");

            if($resultcomp && $result ){ ?>

                <div class="alert alert-dismissible alert-success customalert">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Success, Company profile completed</strong> <a href="profile.php" class="alert-link">Go to your profile</a>
                </div>

                <!--Script to remove the form after submission -->
                <script>
                var element = document.querySelector('.customform');
                    removeJunk(element);
                </script>

              <?php }else{ ?>

                  <div class="alert alert-dismissible alert-success customalert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>DataBaseError!Try again later.</strong> <a href="profile.php" class="alert-link">Go to your profile</a>
                  </div>

                  <!--Script to remove the form after submission -->
                  <script>
                    var element = document.querySelector('.customform');
                    removeJunk(element);
                  </script>

                <?php }
                mysqli_free_result($resultcomp);

              }else{

                if($result){ ?>

                  <div class="alert alert-dismissible alert-success customalert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success, but your Profile is not Full yet</strong> <a href="profile.php" class="alert-link">Go to your profile</a>
                  </div>

                  <!--Script to remove the form after submission -->
                  <script>
                    var element = document.querySelector('.customform');
                    removeJunk(element);
                  </script>

                <?php }else{ ?>

                  <div class="alert alert-dismissible alert-success customalert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>DataBaseError!Try again later.</strong> <a href="profile.php" class="alert-link">Go to your profile</a>
                  </div>

                  <!--Script to remove the form after submission -->
                  <script>
                    var element = document.querySelector('.customform');
                    removeJunk(element);
                  </script>

                <?php }

              }//End Company/Worker if
              mysqli_free_result($result);
            }//End Form Handler ?>

          </div><!-- Closing Container -->
          <?php include 'footer.php';?>
