<?php include 'head.php'; ?>
    <title>Register</title>

        <div class="add container">

            <div class="customform">

              <form action="add.php" method="post" name="form1">
                  <fieldset>
                    <legend class="text-center">Add a new Entry Here!</legend>

                    <div class="form-group">
                      <label for="Email">Email address</label>
                      <input type="email" name="email" class="form-control" id="Email"  placeholder="Enter email">
                    </div>

                    <div class="form-group">
                      <label for="Password">Password</label>
                      <input type="password" name="pass" class="form-control" id="Password" placeholder="Password">
                    </div>

                    <label for="radio">Type</label>
                    <fieldset class="form-group" id="radio">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="type" id="option1" value="company">Company
                        </label>
                      </div>
                      <div class="form-check">
                      <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="type" id="option2" value="worker">Worker
                        </label>
                      </div>
                    </fieldset>
                    <button type="submit" name="Submit" class="btn btn-outline-primary custombtn">Submit</button>
                  </fieldset>
                </form>
              </div><!-- Closing the Form -->

              <?php
              // Ceching if the Form is Submitted
              if(isset($_POST['Submit'])) {

                //Striping hazardous symbols for the db and preparing to insert to the db
                $email = stripslashes($_POST['email']);
                $email = mysqli_real_escape_string($mysqli,$email);

                $pass = stripslashes($_POST['pass']);
                $pass = mysqli_real_escape_string($mysqli,$pass);

                $type = $_POST["type"];

                // checking for empty fields
                if(empty($email) || empty($pass)|| empty($type)) {

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
                } else {

                  // if all the fields are filled (not empty)
                  //insert data to database
                  $result = mysqli_query($mysqli, "INSERT INTO usertab(email,pass,type) VALUES('$email','$pass','$type')");

                  //display success message if the data were inserted
                  if($result){?>
                    <div class="alert alert-dismissible alert-success customalert">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Your profile is created!Log in to see it.</strong>
                    </div>

                    <!-- Script to remove the form after it is Submitted -->
                    <script>
                      var element = document.querySelector('.customform');
                      removeJunk(element);
                    </script>

                  <?php }else{ ?>
                    <div class="alert alert-dismissible alert-danger customalert">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>SQL Error!</strong><p>Reload your page and try again!</p>
                    </div>
                  <?php }

                }
              } //Closing the form Handler
              mysqli_free_result($resutlt); ?>

            </div><!-- Closing Container -->
            <?php include 'footer.php';?>
