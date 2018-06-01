<?php include 'head.php'; ?>

    <?php $cid = $_GET['id']; ?>

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
                          <?php $s = 0;
                          while($skill){?>
                            <input type="text" name="skills[]" value="<?php //echo $skill[$s];?>" required>
                            <?php $s = $s + 1;
                          } ?>
                        </td>
                        <td style="width:5%;border:none;">
                          <a class="btn" id="adder" href="#"><i class="fa fa-plus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#0000a5;"></i></a>
                          <a class="btn" id="remove" href="#"><i class="fa fa-minus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#c30000;"></i></a>
                        </td>
                      </tr>

                      <tr>
                        <td style="border-top: 1px solid #999;">Known Languages</td>
                        <td id="inputslang" style="border-top: 1px solid #999;">
                          <?php $l = 0;
                          while($lang){?>
                            <input type="text" name="languages[]" value="<?php //echo $lang[$l];?>" required>
                            <?php $l = $l + 1;
                          } ?>
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

          $cid = $_POST['id'];

          $s2 = 0;
          while($s2 <= $s){
            $skill[$s2] = stripslashes($_POST['skills']);
            $s2 = $s2 + 1;
          }
          //making the arrays to a string seperated by "," using implode
          $skills = implode(",", $skill);
          $skills = mysqli_real_escape_string($mysqli,$skills);

          $l2 = 0;
          while($l2 <= $l){
            $lang[$l2] = stripslashes($_POST['languages']);
            $l2 = $l2 + 1;
          }
          $langs = implode(",", $lang);
          $langs = mysqli_real_escape_string($mysqli,$langs);

          $result = mysqli_query($mysqli, "INSERT INTO jobOffer(jtittle,jinfo,jskills,jgradlvl,jexp,jlang,jloc,cid) VALUES('$jtittle','$jinfo','$skills','$jgradlvl','$jexp','$langs','$jloc','$cid')");

          if($result){
            echo "<font color='green'>Data added successfully.";
            echo "<br/><a href='profile.php'>Go to Profile</a>";
          }else{
            echo "<div class='title' style='color:red;'><h3>Error!Try again later.</h3></div>";
          }
        }

        ?>
        <script type="text/javascript">
        // Input adding function
        function addInput() {
          $('#inputs').append('<input type="text" name="skills[]">');
        }
        function addInputlang() {
          $('#inputslang').append('<input type="text" name="languages[]">');
        }
        function removeskillInput() {
          $('#inputs input').remove('input:last-child');
        }
        function removelangInput() {
          $('#inputslang input').remove('input:last-child');
        }

        // Event handler and the first input
        $(document).ready(function () {
          $('#adder').click(addInput);
          //addInput();
          $('#adderlang').click(addInputlang);
          //addInputlang();
          $('#remove').click(removeskillInput);
          $('#removelang').click(removelangInput);
        });

      </script>
        <?php include 'footer.php';?>
