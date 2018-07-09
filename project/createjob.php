<?php include 'head.php'; ?>

    <?php $cid = $_GET['id'];  ?>

    <title>Create New Job Offer</title>

        <div class="add">

            <!--<div class="redirect"><a href="home.php">Home</a></div>-->

            <form action="createjob.php" method="post" name="form1">
                <div class="title"><h3>Add a new job Here!</h3></div>
                <table border="0">

                    <tr>
                        <td>Job title</td>
                        <td><input type="text" name="jtittle" required></td>
                    </tr>

                    <tr>
                      <td>Job infomation</td>
                      <td>
                        <textarea name="jinfo" rows="5" cols="30" value=" <?php //echo $jinfo; ?> "></textarea>
                      </td>
                    </tr>

                      <tr>
                        <td>Graduation Level Needed</td>
                        <td>
                          <input type="radio" name="jgradlvl" value="under" <?php //if (isset($jgradlvl) && $jgradlvl=="under") echo "checked";?> >Undergraduate
                          <input type="radio" name="jgradlvl" value="bachelor" <?php //if (isset($jgradlvl) && $jgradlvl=="bachelor") echo "checked";?> >Bachelor
                          <input type="radio" name="jgradlvl" value="master" <?php //if (isset($jgradlvl) && $jgradlvl=="master") echo "checked";?> >Master
                        </td>
                      </tr>

                      <tr>
                        <td>Needed job Experience</td>
                        <td><input type="number" name="jexp" value="<?php //echo $jexp;?>" required> Months</td>
                      </tr>

                      <tr>
                        <td>Skills</td>
                        <td id="inputs">
                          <input type="text" name="skills[]" value="" required />
                    <?php foreach ($skills as $sk): ?>
                        <input type="text" name="skills[]" value="<?php //echo $sk;?>" required />
                    <?php endforeach; ?>


                        </td>
                        <td style="width:5%;border:none;">
                          <a class="btn" id="adder" href="#"><i class="fa fa-plus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#0000a5;"></i></a>
                          <a class="btn" id="remove" href="#"><i class="fa fa-minus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#c30000;"></i></a>
                        </td>
                      </tr>

                      <tr>
                        <td style="border-top: 1px solid #999;">Known Languages</td>

                        <td id="inputslang" style="border-top: 1px solid #999;">
                          <input type="text" name="languages[]" value="<?php //echo $la;?>" required />
                          <?php foreach ($lang as $la): ?>
                              <input type="text" name="languages[]" value="<?php //echo $la;?>" required />
                          <?php endforeach; ?>
                        </td>

                        <td style="width:5%;border:none;">
                          <a class="btn" id="adderlang" href="#"><i class="fa fa-plus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#0000a5;"></i></a>
                          <a class="btn" id="removelang" href="#"><i class="fa fa-minus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#c30000;"></i></a>
                        </td>
                      </tr>

                      <tr>
                        <td>Job location</td>
                        <td><input type="text" name="jloc" value="<?php //echo $jloc;?>"required></td>
                      </tr>

                    <tr>
                        <td></td>
                        <td class="btn"><input type="submit" name="Submit" value="Submit"></td>
                    </tr>
                </table>
                <?php // Store cid in form ?>
                <input type="hidden" name="cid" value="<?php echo $cid ?>">
            </form>

        </div>


        <?php

        // establishing some kind of security for the db
        if(isset($_POST['Submit'])) {

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

          $result = $mysqli->query("INSERT INTO jobOffer (jtittle, jinfo, jskills, jgradlvl, jexp, jlang, jloc, cid) VALUES ('$jtittle','$jinfo','$skills','$jgradlvl','$jexp','$langs','$jloc','$cid')");

          if($result){

            echo "<font color='green'>Offer created successfully.";
            echo "<br/><a href='profile.php'>Go to Profile</a>";
            echo "<script>
            var element = document.querySelector('.add');
                removeJunk(element);
            </script>";
          }else{
            echo "<div class='title' style='color:red;'><h3>Error!Try again later.</h3></div>";
            echo "<script>
            var element = document.querySelector('.add');
                removeJunk(element);
            </script>";
          }
        }

        ?>
        <?php include 'footer.php';?>
