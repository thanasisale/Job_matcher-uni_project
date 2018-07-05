<?php include 'head.php';?>
    <?php
    //getting id from url
    $jid = $_GET['jid'];
    //selecting data associated with this particular id
    $resultoffer = mysqli_query($mysqli, "SELECT * FROM jobOffer WHERE id=$jid");

    while($resoffer = mysqli_fetch_array($resultwork)){
      $jtittle = $resoffer['jtittle'];
      $jloc = $resoffer['jloc'];
      $jgradlvl = $resoffer['jgradlvl'];
      $jexp = $resoffer['jexp'];
      $jinfo = $resoffer['jinfo'];
      //making the strings to arrays using "," as a delimeter using explode
      //$skills = explode(" ", $resoffer['jskills']);
      $skills = $resoffer['jskills'];
      $skill = explode(",", $skills);
      $langs = $resoffer['jlang'];
      $lang = explode(",", $langs);
      $cid = $resoffer['cid'];
    }?>


    <title>Edit Work Data</title>

    <div class="edit">

      <div class="title"><h3>Here You can edit Your Job Offer!</h3></div>

      <form name="form1" method="post" action="editoffer.php">
        <table border="0">

          <tr>
              <td>Job title</td>
              <td><input type="text" name="jtittle" value=" <?php echo $jtittle; ?>" required></td>
          </tr>

          <tr>
            <td>Job infomation</td>
            <td>
              <textarea name="jinfo" rows="5" cols="30" value=" <?php echo $jinfo; ?> "></textarea>
            </td>
          </tr>

            <tr>
              <td>Graduation Level Needed</td>
              <td>
                <input type="radio" name="jgradlvl" value=1 <?php if (isset($jgradlvl) && $jgradlvl== 1) echo "checked";?> >Undergraduate
                <input type="radio" name="jgradlvl" value=2 <?php if (isset($jgradlvl) && $jgradlvl== 2) echo "checked";?> >Bachelor
                <input type="radio" name="jgradlvl" value=3 <?php if (isset($jgradlvl) && $jgradlvl== 3) echo "checked";?> >Master
              </td>
            </tr>

            <tr>
              <td>Needed job Experience</td>
              <td><input type="number" name="jexp" value="<?php echo $jexp;?>" required> Months</td>
            </tr>

            <tr>
              <td>Skills</td>
              <td id="inputs">
                <?php $s = 0;
                $ns = count($skill);
                while($ns >= $s){?>
                  <input type="text" name="skills[]" value="<?php echo $skill[$s];?>" required>
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
                $nl = count($lang);
                while($nl >= $l){?>
                  <input type="text" name="languages[]" value="<?php echo $lang[$l];?>" required>
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
              <td><input type="text" name="jloc" value="<?php echo $jloc;?>"required></td>
            </tr>


          <tr>
            <td><input type="hidden" name="id" value=<?php echo $_GET['jid'];?>></td>
            <td class="btn"><input type="submit" name="update" value="Update"></td>
          </tr>

        </table>
      </form>
    </div>

    <?php

    if(isset($_POST['update'])) {

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

      $resultoffer = mysqli_query($mysqli, "UPDATE jobOffer SET jtittle='$jtittle',jinfo='$jinfo',jskills='$skills',jgradlvl='$jgradlvl',jexp='$jexp',jlang='$langs',jloc='$jloc' WHERE jid=$jid");

      if($resultoffer){
        //redirectig to the display page.
        echo "<th><font color='green'>Success, Job offer updated</th>";
        echo "<td><a href=\"joboffer.php?jid=$jid\">View job Offer</a></td>";
      }else {
        echo "<div class='title' style='color:red;'><h3>Error!</h3></div>";
      }
      ?>

    <?php include 'footer.php';?>
