<?php
include 'head.php';
include("auth.php");
?>
    <?php
    //getting id from url
    $jid = $_GET['jid'];

    //selecting data associated with this id
    $resultoffer = mysqli_query($mysqli, "SELECT * FROM jobOffer WHERE jid=$jid");

    while($resoffer = mysqli_fetch_array($resultoffer)){
      $jtittle = $resoffer['jtittle'];
      $jloc = $resoffer['jloc'];
      $jgradlvl = $resoffer['jgradlvl'];
      $jexp = $resoffer['jexp'];
      $jinfo = $resoffer['jinfo'];
      //making the strings to arrays using "*" as a delimeter using explode
      $skills = $resoffer['jskills'];
      $skill = explode("*", $skills);
      $langs = $resoffer['jlang'];
      $lang = explode("*", $langs);
      $cid = $resoffer['cid'];
    }
    //freeing the var
    mysqli_free_result($resultoffer);
    ?>


    <title>Edit Work Data</title>

    <div class="edit container">

      <div class="customform">

        <form name="form1" method="post" action="editoffer.php">
          <fieldset>
            <legend class="text-center">Here You can edit Your Job Offer!</legend>

            <div class="form-group">
              <label for="Jobtittle">Job title</label>
              <input type="text" name="jtittle" class="form-control" id="Jobtittle" placeholder="Enter the title" value="<?php echo $jtittle; ?>" required>
            </div>

            <div class="form-group">
              <label for="Textarea">Job infomation</label>
              <textarea name="jinfo" class="form-control" id="Textarea" rows="3"><?php echo $jinfo; ?></textarea>
            </div>

            <label for="radio">Graduation Level Needed</label>
            <fieldset class="form-group" id="radio">

              <div class="form-check">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="jgradlvl" id="option1" value="under" <?php if (isset($jgradlvl) && $jgradlvl== 'under') echo "checked";?>>Undergraduate
                </label>
              </div>

              <div class="form-check">
              <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="jgradlvl" id="option2" value="bachelor" <?php if (isset($jgradlvl) && $jgradlvl== 'bachelor') echo "checked";?>>Bachelor
                </label>
              </div>

              <div class="form-check">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="jgradlvl" id="option2" value="master" <?php if (isset($jgradlvl) && $jgradlvl== 'master') echo "checked";?>>Master
                </label>
              </div>

            </fieldset>

            <div class="form-group">
              <label for="Jobexp">Needed job Experience</label>
              <input type="number" name="jexp" class="form-control" id="Jobexp" placeholder="Months" value="<?php echo $jexp;?>" required>
            </div>

            <label for="Jobskills">Job Skills</label>
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

            <div class="form-group">
              <label for="Jobloc">Job location</label>
              <input type="text" name="jloc" class="form-control" id="Jobloc" placeholder="Enter the location" value="<?php echo $jloc;?>" required>
            </div>

            <!-- Store cid and jid in form -->
            <input type="hidden" name="cid" value="<?php echo $cid ?>">
            <input type="hidden" name="jid" value=<?php echo $_GET['jid'];?>>

            <button type="update" name="update" class="btn btn-outline-primary custombtn">Submit</button>

          </fieldset>

        </form><!-- End of Form -->


      </div><!-- Closing customform div -->

      <?php
      //Form Handler
      if(isset($_POST['update'])) {

        //making sure for the content,by removing slashes,preventing sqlinjections and preparing the statements
        $jid = $_POST['jid'];

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

        //making the arrays to a string seperated by "*" using implode
        $skills = implode("*", $_POST['skills']);
        $skills = stripslashes($skills);
        $skills = mysqli_real_escape_string($mysqli,$skills);

        $langs = implode("*", $_POST['languages']);
        $langs = stripslashes($langs);
        $langs = mysqli_real_escape_string($mysqli,$langs);

        $resultoffer = mysqli_query($mysqli,"UPDATE `jobOffer` SET `jtittle`='$jtittle',`jinfo`='$jinfo',`jskills`='$skills',`jgradlvl`='$jgradlvl',`jexp`='$jexp',
          `jlang`='$langs',`jloc`='$jloc' WHERE `jid` = '$jid'");

        if($resultoffer){
          //if the data were inserted to the db display success message ?>
          <div class="alert alert-dismissible alert-success customalert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Offer updated successfully.</strong> <a href="joboffer.php?jid=<?php echo $jid;?>&id=<?php echo $cid;?>" class="alert-link">View job Offer</a>
          </div>

          <!--Script to remove the form after submission -->
          <script>
          var element = document.querySelector('.customform');
              removeJunk(element);
          </script>
        <?php }else { ?>

          <div class="alert alert-dismissible alert-success customalert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>DataBaseError!</strong> <a href="javascript:self.history.back();" class="alert-link">Try again.</a>
          </div>

          <!--Script to remove the form after submission -->
          <script>
            var element = document.querySelector('.customform');
              removeJunk(element);
          </script>
        <?php }
      }//End of form Handler
      mysqli_free_result($resultoffer);
      ?>

    </div><!-- Closing the Container -->
    <?php include 'footer.php';?>
