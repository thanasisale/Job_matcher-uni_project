<?php
include 'head.php';

//Getting the user or job id from the URL
$id = $_GET['id'];
$jid = $_GET['jid'];

?>

<div class="container">

  <?php
  $points[] = 0;

  //Checking what was inserted user or job id
  if(isset($jid)){

    //Collecting the nessessary data from the db
    $resultoffer = mysqli_query($mysqli, "SELECT * FROM jobOffer WHERE jid = '$jid'");
    while ($resoffer = mysqli_fetch_array($resultoffer)) {
      $jskills = str_replace(" ", "", $resoffer['jskills']);
      $jskills = strtolower($jskills);
      $jskills = explode("*", $jskills);

      $jlangs = str_replace(" ", "", $resoffer['jlang']);
      $jlangs = strtolower($jlangs);
      $jlangs = explode("*", $jlangs);

      $jloc = str_replace(" ", "", $resoffer['jloc']);
      $jloc = strtolower($jloc);

      $jgradlvl = str_replace(" ", "", $resoffer['jgradlvl']);
      $jgradlvl = strtolower($jgradlvl);

      $jexp = str_replace(" ", "", $resoffer['jexp']);
      $jexp = strtolower($jexp);


      $cid = $resoffer['cid'];
    }


    //Collecting the nessessary data from the db and putting the in a table
    $j=0;
    $result = mysqli_query($mysqli, "SELECT * FROM worker");
    while($res = mysqli_fetch_array($result)){
      $wid[$j] = $res['wid'];

      //Removing the Spaces and making alla the letters lowercase
      $wskills[$j] = $res['wskills'];
      $wskills[$j] = str_replace(" ", "", $wskills[$j]);
      $wskills[$j] = strtolower($wskills[$j]);

      $wlangs[$j] = $res['wlang'];
      $wlangs[$j] = str_replace(" ", "", $wlangs[$j]);
      $wlangs[$j] = strtolower($wlangs[$j]);

      $waddress[$j] = $res['waddress'];
      $waddress[$j] = str_replace(" ", "", $waddress[$j]);
      $waddress[$j] = strtolower($waddress[$j]);

      $wgradlvl[$j] = $res['wgradlvl'];
      $wgradlvl[$j] = str_replace(" ", "", $wgradlvl[$j]);
      $wgradlvl[$j] = strtolower($wgradlvl[$j]);

      $wexp[$j] = $res['wexp'];
      $wexp[$j] = str_replace(" ", "", $wexp[$j]);
      $wexp[$j] = strtolower($wexp[$j]);

      $wlname[$j] = $res['wlname'];
      $wname[$j] = $res['wname'];

      $j++;
    }

    //Making the comparison and and sorting the other tables based on the table $points[]
    $n = 0;
    while ($n < $j) {

      $wlangs[$n] = explode("*", $wlangs[$n]);
      foreach ($wlangs[$n] as $wlang) {

        if( in_array($wlang , $jlangs)){
          $points[$n]++;

        }
      }

      $wskills[$n] = explode("*", $wskills[$n]);
      foreach ($wskills[$n] as $wskill) {

        if( in_array($wskill , $jskills)){
          $points[$n]++;

        }
      }

      if($waddress[$n] == $jloc){
        $points[$n]++;
      }

      if ($wgradlvl[$n] == $jgradlvl) {
        $points[$n]++;
      }

      if ($wexp[$n] >= $jexp) {
        $points[$n]++;
      }


      $n = $n + 1;
    }


    array_multisort($points,SORT_DESC, $wid, $waddress, $wgradlvl, $wname, $wlname);

    ?>

    <!-- Presenting the results -->
    <table class="table table-light table-hover" style="text-align:center;">
      <div class="title" style="text-align:center;"> <h3>Best Workers for You</h3> </div>
      <?php
      $i = 0;
      while ($i < count($points)) {

        if ($points[$i] > 0) {
          echo "<tr>";
          echo "<th>".$wname[$i]."</th>";
          echo "<td>".$wlname[$i]."</td>";
          echo "<td> Score = ".$points[$i]."</td>";
          echo "<td><a href=\"profile.php?id=$wid[$i]\">View</a></td>";
          echo "</tr>";

        }else {

          echo "<tr>";
          echo "<th> None Available </th>";
          echo "</tr>";
        }


        $i++;
      }
      ?>
    </table>

    <?php
    //End if for the job
    //Checking if user id exists
  }elseif(isset($id)){

    //Collecting the nessessary data from the db
    $result = mysqli_query($mysqli, "SELECT * FROM usertab WHERE id = '$id'");
    while ($res = mysqli_fetch_array($result)) {
      $email = $res['email'];
      $type = $res['type'];
    }

    //Collecting the nessessary data from the db if the user is a worker
    if ($type == 'worker') {

      $resultwork = mysqli_query($mysqli, "SELECT * FROM worker WHERE wid = '$id'");
      while ($reswork = mysqli_fetch_array($resultwork)) {

        //Removing the Spaces and making alla the letters lowercase
        $wskills = str_replace(" ", "", $reswork['wskills']);
        $wskills = strtolower($wskills);
        $wskills = explode("*", $wskills);

        $wlangs = str_replace(" ", "", $reswork['wlang']);
        $wlangs = strtolower($wlangs);
        $wlangs = explode("*", $wlangs);

        $waddress = str_replace(" ", "", $reswork['waddress']);
        $waddress = strtolower($waddress);


        $wgradlvl = str_replace(" ", "", $reswork['wgradlvl']);
        $wgradlvl = strtolower($wgradlvl);


        $wexp = str_replace(" ", "", $reswork['wexp']);
        $wexp = strtolower($wexp);

      }

      //Collecting the nessessary data from the db and putting the in a table
      $j=0;
      $resultoffer = mysqli_query($mysqli, "SELECT * FROM jobOffer");
      while($res = mysqli_fetch_array($resultoffer)){
        $jid[$j] = $res['jid'];

        $jskills[$j] = $res['jskills'];
        $jskills[$j] = str_replace(" ", "", $jskills[$j]);
        $jskills[$j] = strtolower($jskills[$j]);

        $jlangs[$j] = $res['jlang'];
        $jlangs[$j] = str_replace(" ", "", $jlangs[$j]);
        $jlangs[$j] = strtolower($jlangs[$j]);

        $jloc[$j] = $res['jloc'];
        $jloc[$j] = str_replace(" ", "", $jloc[$j]);
        $jloc[$j] = strtolower($jloc[$j]);

        $jgradlvl[$j] = $res['jgradlvl'];
        $jgradlvl[$j] = str_replace(" ", "", $jgradlvl[$j]);
        $jgradlvl[$j] = strtolower($jgradlvl[$j]);

        $jexp[$j] = $res['jexp'];
        $jexp[$j] = str_replace(" ", "", $jexp[$j]);
        $jexp[$j] = strtolower($jexp[$j]);

        $jtittle[$j] = $res['jtittle'];

        $cid[$j] = $resoffer['cid'];

        $j++;

      }


      //Making the comparison and and sorting the other tables based on the table $points[]
      $n = 0;
      while ($n < $j) {

        $jlangs[$n] = explode("*", $jlangs[$n]);
        foreach ($jlangs[$n] as $jlang) {

          if( in_array($jlang , $wlangs)){
            $points[$n]++;

          }
        }

        $jskills[$n] = explode("*", $jskills[$n]);
        foreach ($jskills[$n] as $jskill) {

          if( in_array($jskill , $wskills)){
            $points[$n]++;

          }
        }

        if($jloc[$n] == $waddress){
          $points[$n]++;

        }

        if ($jgradlvl[$n] == $wgradlvl) {
          $points[$n]++;

        }

        if ($jexp[$n] <= $wexp) {
          $points[$n]++;
        }


        $n = $n + 1;
      }


      array_multisort($points,SORT_DESC, $jid, $jskills, $jlangs, $jloc, $jgradlvl, $jexp, $cid);

      ?>

      <!-- Presenting the results -->
      <table class="table table-light table-hover" style="text-align:center;">
        <div class="title" style="text-align:center;"> <h3>Best Job for You</h3> </div>
        <?php
        $i = 0;
        while ($i < count($points)) {

          if ($points[$i] > 0) {
            echo "<tr>";
            echo "<th>".$jtittle[$i]."</th>";
            $jloc[$i] = ucfirst ( $jloc[$i] );
            echo "<td>".$jloc[$i]."</td>";
            echo "<td> Score = ".$points[$i]."</td>";
            echo "<td><a href=\"joboffer.php?jid=$jid[$i]&id=$id\">View</a></td>";
            echo "</tr>";
          }else {
            echo "<tr>";
            echo "<th> None Available </th>";
            echo "</tr>";
          }


          $i++;
        }
        ?>

      </table>

      <?php
      //Collecting the nessessary data from the db if the user is a Company
    }else {

      //searching the all the offers for the current company
      $j=0;
      $resultoffer = mysqli_query($mysqli, "SELECT * FROM jobOffer WHERE cid = '$id'");
      while($res = mysqli_fetch_array($resultoffer)){
        $jid[$j] = $res['jid'];

        //Removing the Spaces and making alla the letters lowercase
        $jskills[$j] = $res['jskills'];
        $jskills[$j] = str_replace(" ", "", $jskills[$j]);
        $jskills[$j] = strtolower($jskills[$j]);

        $jlangs[$j] = $res['jlang'];
        $jlangs[$j] = str_replace(" ", "", $jlangs[$j]);
        $jlangs[$j] = strtolower($jlangs[$j]);

        $jloc[$j] = $res['jloc'];
        $jloc[$j] = str_replace(" ", "", $jloc[$j]);
        $jloc[$j] = strtolower($jloc[$j]);

        $jgradlvl[$j] = $res['jgradlvl'];
        $jgradlvl[$j] = str_replace(" ", "", $jgradlvl[$j]);
        $jgradlvl[$j] = strtolower($jgradlvl[$j]);

        $jexp[$j] = $res['jexp'];
        $jexp[$j] = str_replace(" ", "", $jexp[$j]);
        $jexp[$j] = strtolower($jexp[$j]);

        $j++;

      }

      // Searching all the workers
      $w = 0;
      $result = mysqli_query($mysqli, "SELECT * FROM worker");
      while($res = mysqli_fetch_array($result)){
        $wid[$w] = $res['wid'];

        //Removing the Spaces and making alla the letters lowercase
        $wskills[$w] = $res['wskills'];
        $wskills[$w] = str_replace(" ", "", $wskills[$w]);
        $wskills[$w] = strtolower($wskills[$w]);

        $wlangs[$w] = $res['wlang'];
        $wlangs[$w] = str_replace(" ", "", $wlangs[$w]);
        $wlangs[$w] = strtolower($wlangs[$w]);

        $waddress[$w] = $res['waddress'];
        $waddress[$w] = str_replace(" ", "", $waddress[$w]);
        $waddress[$w] = strtolower($waddress[$w]);

        $wgradlvl[$w] = $res['wgradlvl'];
        $wgradlvl[$w] = str_replace(" ", "", $wgradlvl[$w]);
        $wgradlvl[$w] = strtolower($wgradlvl[$w]);

        $wexp[$w] = $res['wexp'];
        $wexp[$w] = str_replace(" ", "", $wexp[$w]);
        $wexp[$w] = strtolower($wexp[$w]);

        $wlname[$w] = $res['wlname'];
        $wname[$w] = $res['wname'];

        $w++;
      }


      //Making the comparison and and sorting the other tables based on the table $points[]
      $i=0;
      while($i < $j){

        $jlangs[$i] = explode("*", $jlangs[$i]);
        $jskills[$i] = explode("*", $jskills[$i]);

        $n = 0;
        while ($n < $w) {

          $wlangs[$n] = explode("*", $wlangs[$n]);
          foreach ($wlangs[$n] as $wlang) {

            if( in_array($wlang , $jlangs[$i])){
              $points[$n]++;
            }
          }

          $wskills[$n] = explode("*", $wskills[$n]);
          foreach ($wskills[$n] as $wskill) {

            if( in_array($wskill , $jskills[$i])){
              $points[$n]++;
            }
          }

          if($waddress[$n] == $jloc[$i]){
            $points[$n]++;
          }

          if ($wgradlvl[$n] == $jgradlvl[$i]) {
            $points[$n]++;
          }

          if ($wexp[$n] >= $jexp[$i]) {
            $points[$n]++;
          }

          $n++;
        }

        $i++;
      }

      array_multisort($points,SORT_DESC, $wid, $wname, $wlname);

      ?>

      <!-- Presenting the results -->
      <table class="table table-light table-hover" style="text-align:center;">
        <div class="title" style="text-align:center;"> <h3>Best Workers for You</h3> </div>
        <?php
        $i = 0;
        while ($i < count($points)) {

          if ($points[$i] > 0) {
            echo "<tr>";
            echo "<th>".$wname[$i]."</th>";
            echo "<td>".$wlname[$i]."</td>";
            echo "<td> Score = ".$points[$i]."</td>";
            echo "<td><a href=\"profile.php?id=$wid[$i]\">View</a></td>";
            echo "</tr>";
          }else {
            echo "<tr>";
            echo "<th> None Available </th>";
            echo "</tr>";
          }


          $i++;
        }
        ?>

      </table>

    <?php }//end Company if

  }//End the job/user if ?>

</div><!--closing Container-->
<?php
//freing the all the vars
mysqli_free_result($resultwork);
mysqli_free_result($resultcomp);
mysqli_free_result($resultoffer);
mysqli_free_result($result);
include 'footer.php';
?>
