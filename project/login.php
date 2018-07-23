<?php include 'head.php'; ?>

  <title>Log in</title>

        <div class="login container">

          <div class="customform">

            <form action="login.php" method="post" name="form1">

              <fieldset>
                <legend class="text-center">Log In Here</legend>

                <div class="form-group">
                  <label for="Email">Email address</label>
                  <input type="text" name="email" class="form-control" id="Email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>

                <div class="form-group">
                  <label for="Password">Password</label>
                  <input type="password" name="pass" class="form-control" id="Password" placeholder="Password">
                </div>

                <button type="submit" name="Submit" class="btn btn-outline-primary custombtn">Submit</button>

              </fieldset>

            </form><!-- End of Form -->

            </div><!-- Closing customform div -->

            <?php
              //Form Handler
              if(isset($_POST['Submit'])) {

                //Striping hazardous symbols for the db and preparing to insert to the db
                $email = stripslashes($_POST['email']);
                $email = mysqli_real_escape_string($mysqli,$email);

                $pass = stripslashes($_POST['pass']);
                $pass = mysqli_real_escape_string($mysqli,$pass);


                // checking empty fields
                if(empty($email) || empty($pass)) {

                  if(empty($pass)) { ?>

                    <div class="alert alert-dismissible alert-danger customalert">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Password field is empty.</strong> <a href="javascript:self.history.back();" class="alert-link"> try submitting again.</a>
                    </div>
                  <?php }

                  if(empty($email)) { ?>
                    <div class="alert alert-dismissible alert-danger customalert">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Email field is empty.</strong> <a href="javascript:self.history.back();" class="alert-link"> try submitting again.</a>
                    </div>
                    <?php
                  }
                } else {
                  // if all the fields are filled (not empty) inserting the data
                  $result = mysqli_query($mysqli, "SELECT * FROM usertab WHERE email='$email'and pass='$pass'") or die(mysql_error());

                  $rows = mysqli_num_rows($result);
                  if($rows == 1) {

                    $_SESSION['email'] = $email;
                    echo("<script>location.href = '"."profile.php';</script>");

                  }else { ?>

                    <div class="alert alert-dismissible alert-danger customalert">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Username/Password is incorrect.</strong><a href='login.php'>Try Again Later</a>
                    </div>
                    <!-- Script to remove the form after it is Submitted -->
                    <script>
                      var element = document.querySelector('.customform');
                      removeJunk(element);
                    </script>

                  <?php }
                }
              }//End of form Handler
              mysqli_free_result($result);
              ?>

            </div><!-- Closing Container div -->
            <?php include 'footer.php';?>
