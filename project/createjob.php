<?php
//including the header and the authenticator files
include 'head.php';
include("auth.php");
?>

    <?php
    //Getting the id from the URL
    $cid = $_GET['id'];  ?>

    <title>Create New Job Offer</title>

        <div class="add container">

          <div class="customform">

            <form action="createjob.php" method="post" name="form1">

              <fieldset>
                <legend class="text-center">Add a new job Here!</legend>

                <div class="form-group">
                  <label for="Jobtittle">Job title</label>
                  <input type="text" name="jtittle" class="form-control" id="Jobtittle" placeholder="Enter the title" required>
                </div>

                <div class="form-group">
                  <label for="Textarea">Job infomation</label>
                  <textarea name="jinfo" class="form-control" id="Textarea" rows="3"></textarea>
                </div>

                <label for="radio">Graduation Level Needed</label>
                <fieldset class="form-group" id="radio">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="jgradlvl" id="option1" value="under">Undergraduate
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="jgradlvl" id="option2" value="bachelor">Bachelor
                    </label>
                  </div>

                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="jgradlvl" id="option2" value="master">Master
                    </label>
                  </div>

                </fieldset>

                <div class="form-group">
                  <label for="Jobexp">Needed job Experience</label>
                  <input type="number" name="jexp" class="form-control" id="Jobexp" placeholder="Months" required>
                </div>

                <label for="Jobskills">Job Skills</label>
                <div class="form-group">

                  <div id="inputs">
                    <input type="text" name="skills[]" class="form-control" id="Jobskills" placeholder="Enter a skill" required>
                    <?php foreach ($skills as $sk): ?>
                      <input type="text" name="skills[]" class="form-control" id="Jobskills" placeholder="Enter a skill">
                    <?php endforeach; ?>

                  </div>

                  <div class="plusminus">
                    <a class="btn" id="adder" href="#"><i class="fa fa-plus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#0000a5;"></i></a>
                    <a class="btn" id="remove" href="#"><i class="fa fa-minus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#c30000;"></i></a>
                  </div>

                </div>

                <label for="Joblang">Known Languages</label>
                <div class="form-group">

                  <div id="inputslang">
                    <input type="text" name="languages[]" class="form-control" id="Joblang" placeholder="Enter a language" required>
                    <?php foreach ($lang as $la): ?>
                      <input type="text" name="languages[]" class="form-control" id="Joblang" placeholder="Enter a language">
                    <?php endforeach; ?>
                  </div>

                  <div class="plusminus">
                    <a class="btn" id="adderlang" href="#"><i class="fa fa-plus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#0000a5;"></i></a>
                    <a class="btn" id="removelang" href="#"><i class="fa fa-minus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#c30000;"></i></a>
                  </div>

                </div>

                <div class="form-group">
                  <label for="Jobloc">Job location</label>
                  <input type="text" name="jloc" class="form-control" id="Jobloc" placeholder="Enter the location" required>
                </div>


                <!-- Store cid in form -->
                <input type="hidden" name="cid" value="<?php echo $cid ?>">

                <button type="submit" name="Submit" class="btn btn-outline-primary custombtn">Submit</button>

              </fieldset>

            </form><!-- Closing the Form -->

            </div><!-- Closing the customform div -->


        <?php

        // Checking if the Form is Submitted
        if(isset($_POST['Submit'])) {

          //Escaping hazardous symbols for the db and preparing to insert to the db
          $jtittle = stripslashes($_POST['jtittle']);
          $jtittle = mysqli_real_escape_string($mysqli,$jtittle);

          $jgradlvl = stripslashes($_POST['jgradlvl']);
          $jgradlvl = mysqli_real_escape_string($mysqli,$jgradlvl);

          $jinfo = stripslashes($_POST['jinfo']);
          $jinfo = mysqli_real_escape_string($mysqli,$jinfo);

          $jloc = stripslashes($_POST['jloc']);
          $jloc = mysqli_real_escape_string($mysqli,$jloc);

          $jexp = stripslashes($_POST['jexp']);
          $jexp = mysqli_real_escape_string($mysqli,$jexp);

          $cid = stripslashes($_POST['cid']);
          $cid = mysqli_real_escape_string($mysqli,$cid);

          $skills = implode("*", $_POST['skills']);
          $skills = stripslashes($skills);
          $skills = mysqli_real_escape_string($mysqli,$skills);

          $langs = implode("*", $_POST['languages']);
          $langs = stripslashes($langs);
          $langs = mysqli_real_escape_string($mysqli,$langs);

          //Inserting the data to the db
          $result = $mysqli->query("INSERT INTO jobOffer (jtittle, jinfo, jskills, jgradlvl, jexp, jlang, jloc, cid) VALUES ('$jtittle','$jinfo','$skills','$jgradlvl','$jexp','$langs','$jloc','$cid')");

          //Checking if the data were inserted and displaing success message
          if($result){?>

            <div class="alert alert-dismissible alert-success customalert">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Offer created successfully.</strong> <a href="profile.php" class="alert-link">Go to your profile</a>
            </div>

            <!-- Script to remove the form after it is Submitted -->
            <script>
            var element = document.querySelector('.customform');
                removeJunk(element);
            </script>

          <?php }else{ ?>

            <!-- //Checking if the data were not inserted and displaing warning message -->
            <div class="alert alert-dismissible alert-success customalert">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>DataBaseError!Try again later.</strong> <a href="profile.php" class="alert-link">Go to your profile</a>
            </div>

            <!-- Script to remove the form after it is Submitted -->
            <script>
            var element = document.querySelector('.customform');
                removeJunk(element);
            </script>

        <?php  }

      }//Closing the form Handler
      mysqli_free_result($result);
      ?>

    </div><!-- Closing the Container -->
    <?php include 'footer.php';?>
