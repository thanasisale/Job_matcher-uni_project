<?php include 'head.php';?>
    <?php
    //getting id from url
    $id = $_GET['id'];
    //selecting data associated with this particular id
    $result = mysqli_query($mysqli, "SELECT * FROM usertab WHERE ID=$id");


    while($res = mysqli_fetch_array($result)){
      $pass = $res['pass'];
      $email = $res['email'];
      $type = $res['type'];
    }

    mysqli_free_result($result);

    //if there is no record in the DB fo this id and the type is worker/company we create one
    if( $type == 'worker'){
      $resultwork = mysqli_query($mysqli, "SELECT * FROM worker WHERE wid=$id") or die(mysqli_error());

      if(empty($resultwork)){
        mysqli_free_result($resultwork);
        //$resultworkin = mysqli_query($mysqli, "INSERT INTO worker(wid) VALUES('$id')");
        $stmt = $mysqli->prepare("INSERT INTO worker (wid) VALUES (:id)");
        $stmt->bindParam(':id', $wid);
        $wid = $id;
        $stmt->execute();

        //mysqli_free_result($resultworkin);
      }else{
        while($reswork = mysqli_fetch_array($resultwork)){
          $wfname = $reswork['wfname'];
          $wlname = $reswork['wlname'];
          $wage = $reswork['wage'];
          $waddress = $reswork['waddress'];
          $wtel = $reswork['wtel'];
          $wgradlvl = $reswork['wgradlvl'];
          $wexp = $reswork['wexp'];
          $winfo = $reswork['winfo'];
          //making the strings to arrays using "," as a delimeter using explode
          //$skills = explode(" ", $reswork['wskills']);
          $skills = $reswork['wskills'];
          $skill = explode(",", $skills);
          $langs = $reswork['wlang'];
          $lang = explode(",", $langs);
        }
        mysqli_free_result($resultwork);
      }
    }elseif( $type == 'company'){
      $resultcomp = mysqli_query($mysqli, "SELECT * FROM comptab WHERE cid=$id") or die(mysqli_error());
      
      if(empty($resultcomp)){

        mysqli_free_result($resultcomp);
        //$resultcompin = mysqli_query($mysqli, "INSERT INTO comptab(cid) VALUES('$id')");
        $stmt = $mysqli->prepare("INSERT INTO comptab (cid) VALUES (:id)");
        $stmt->bindParam(':id', $cid);
        $cid = $id;
        $stmt->execute();
        //mysqli_free_result($resultcompin);

      }else{
        while($rescomp = mysqli_fetch_array($resultcomp)){
          $cname = $rescomp['cname'];
          $cabout = $rescomp['cabout'];
          $caddress = $rescomp['caddress'];
          $ctel = $rescomp['ctel'];
        }
        mysqli_free_result($resultcomp);
      }
    }
    echo $cname;
    ?>

    <title>Edit Data</title>

    <div class="edit">

      <div class="title"><h3>Here You can edit Your Profile!</h3></div>

      <form name="form1" method="post" action="edit.php">
        <table border="0">

          <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?php echo $email;?>"></td>
          </tr>

          <tr>
            <td>Password</td>
            <td><input type="password" name="pass" value="<?php echo $pass;?>"></td>
          </tr>

          <tr>
            <td>Type</td>
            <td>
              <input type="radio" name="type" value="company" <?php if (isset($type) && $type=="company") echo "checked";?> >Company
              <input type="radio" name="type" value="worker" <?php if (isset($type) && $type=="worker") echo "checked";?> >Worker
            </td>
          </tr>

          <?php
          if($type == "worker"){ ?>

            <tr>
              <td>First Name</td>
              <td><input type="text" name="wfname" value="<?php echo $wfname;?>"></td>
            </tr>

            <tr>
              <td>Last Name</td>
              <td><input type="text" name="wlname" value="<?php echo $wlname;?>"></td>
            </tr>

            <tr>
              <td>Graduation Level</td>
              <td>
                <input type="radio" name="wgradlvl" value=1 <?php if (isset($wgradlvl) && $wgradlvl=="under") echo "checked";?> >Undergraduate
                <input type="radio" name="wgradlvl" value=2 <?php if (isset($wgradlvl) && $wgradlvl=="bachelor") echo "checked";?> >Bachelor
                <input type="radio" name="wgradlvl" value=3 <?php if (isset($wgradlvl) && $wgradlvl=="master") echo "checked";?> >Master
              </td>
            </tr>

            <tr>
              <td>Basic info</td>
              <td>
                <textarea name="winfo" rows="5" cols="30" value=" <?php echo $winfo; ?> "></textarea>
              </td>
            </tr>

            <tr>
              <td>Age</td>
              <td><input type="date" name="wage" value="<?php echo $wage;?>"></td>
            </tr>

            <tr>
              <td>Address</td>
              <td><input type="text" name="waddress" value="<?php echo $waddress;?>"></td>
            </tr>

            <tr>
              <td>Phone</td>
              <td><input type="text" name="wtel" value="<?php echo $wtel;?>"></td>
            </tr>

            <tr>
              <td>Your work Experience</td>
              <td><input type="number" name="wexp" value="<?php echo $wexp;?>"> Months</td>
            </tr>

            <tr>
              <td>Skills</td>
              <td id="inputs">
                <?php $s = 0;
                while($skill){?>
                  <input type="text" name="skills[]" value="<?php echo $skill[$s];?>">
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
                  <input type="text" name="languages[]" value="<?php echo $lang[$l];?>" >
                  <?php $l = $l + 1;
                } ?>
              </td>
              <td style="width:5%;border:none;">
                <a class="btn" id="adderlang" href="#"><i class="fa fa-plus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#0000a5;"></i></a>
                <a class="btn" id="removelang" href="#"><i class="fa fa-minus-circle fa-2x" aria-hidden="true" style="vertical-align: middle;color:#c30000;"></i></a>
              </td>
            </tr>
          <?php }elseif($type == 'company'){ ?>
            <tr>
              <td>Company Name</td>

              <td><input type="text" name="cname" value="<?php echo $cname;?>"></td>
            </tr>

            <tr>
              <td>About the Company</td>
              <td>
                <textarea name="cabout" rows="5" cols="30" value=" <?php echo $cabout; ?> "></textarea>
              </td>
            </tr>

            <tr>
              <td>Address</td>
              <td><input type="text" name="caddress" value="<?php echo $caddress;?>"></td>
            </tr>

            <tr>
              <td>Phone Number</td>
              <td><input type="text" name="ctel" value="<?php echo $ctel;?>"></td>
            </tr>

          <?php }else{ echo("<td>Something went wrong refresh and try again later!</td>"); } ?>

            <tr>
              <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
              <td class="btn"><input type="submit" name="update" value="Update"></td>
            </tr>

          </table>
        </form>
      </div>

      <?php

      if(isset($_POST['update'])) {

        $id = $_POST['id'];

        //making sure for the content,by removing slashes,preventing sqlinjections

        $email = stripslashes($_POST['email']);
        $email = mysqli_real_escape_string($mysqli,$email);

        //Not hashing the password for convenience
        $pass = stripslashes($_POST['pass']);
        $pass = mysqli_real_escape_string($mysqli,$pass);

        $type = $_POST['type'];

        // checking empty fields
        if(empty($pass) || empty($email) || empty($type)) {

          if(empty($pass)) {
            echo "<font color='red'>Password field is empty.</font><br/>";
          }

          if(empty($email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
          }

          if(empty($type)) {
            echo "<font color='red'>Type field is empty.</font><br/>";
          }

         }else{
          //updating the main user table
          $result = mysqli_query($mysqli, "UPDATE usertab SET email='$email',pass='$pass',type='$type' WHERE ID=$id");

        }
        if($type == 'worker') {

          //making sure of the content,by removing slashes
          $wfname = stripslashes($_POST['wfname']);
          $wfname = mysqli_real_escape_string($mysqli,$wfname);

          $wlname = stripslashes($_POST['wlname']);
          $wlname = mysqli_real_escape_string($mysqli,$wlname);

          $wgradlvl = stripslashes($_POST['wgradlvl']);
          $wgradlvl = mysqli_real_escape_string($mysqli,$wgradlvl);

          $winfo = stripslashes($_POST['winfo']);
          $winfo = mysqli_real_escape_string($mysqli,$winfo);

          $wage = stripslashes($_POST['wage']);
          $wage = mysqli_real_escape_string($mysqli,$wage);

          $waddress = stripslashes($_POST['waddress']);
          $waddress = mysqli_real_escape_string($mysqli,$waddress);

          $wtel = stripslashes($_POST['wtel']);
          $wtel = mysqli_real_escape_string($mysqli,$wtel);

          $wexp = stripslashes($_POST['wexp']);
          $wexp = mysqli_real_escape_string($mysqli,$wexp);

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

          //updating the worker table
          $resultwork = mysqli_query($mysqli, "UPDATE worker SET wfname='$wfname',wlname='$wlname',wgradlvl='$wgradlvl',winfo='$winfo',wskills='$skills',wage='$wage',waddress='$waddress',wtel='$wtel',wexp='$wexp',wlang='$langs' WHERE wid=$id");

          if($resultwork && $result){
            //redirectig to the display page.
            echo "<th><font color='green'>Success, Worker profile completed</th>";
            echo "<td><a href=\"profile.php\">Go to Profile</a></td>";
          }else{
              echo "<div class='title' style='color:red;'><h3>Error!</h3></div>";
          }

        }elseif ($type == 'company') {

          $cname = stripslashes($_POST['cname']);
          $cname = mysqli_real_escape_string($mysqli,$cname);

          $cabout = stripslashes($_POST['cabout']);
          $cabout = mysqli_real_escape_string($mysqli,$cabout);

          $caddress = stripslashes($_POST['caddress']);
          $caddress = mysqli_real_escape_string($mysqli,$caddress);

          $ctel = stripslashes($_POST['ctel']);
          $ctel = mysqli_real_escape_string($mysqli,$ctel);

          $resultcomp = mysqli_query($mysqli, "UPDATE comptab SET cname='$cname',cabout='$cabout',caddress='$caddress',ctel='$ctel' WHERE cid=$id");
          if($resultcomp && $result ){
            //redirectig to the display page.
            echo "<th><font color='green'>Success, Company profile completed</th>";
            echo "<td><a href=\"profile.php\">Go to Profile</a></td>";
          }else{
              echo "<div class='title' style='color:red;'><h3>Error!</h3></div>";
          }

        }else{

          if($result){
            //redirectig to the display page.
            echo "<th><font color='green'>Success, but your Profile is not Full yet</th>";
            echo "<td><a href=\"profile.php\">Go to Profile</a></td>";
          }else{
              echo "<div class='title' style='color:red;'><h3>Error!</h3></div>";
          }
        }
      } ?>

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
