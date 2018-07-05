<?php

$id = $_GET['id'];
$jid = $_GET['jid']

/*function count_array_values($my_array, $match)
{
    $count = 0;

    foreach ($my_array as $key => $value)
    {
        if ($value == $match)
        {
            $count++;
        }
    }

    return $count;
} */

if($jid){
  $resultoffer = mysqli_query($mysqli, "SELECT * FROM jobOffer WHERE jid = '$jid'");
  while ($resoffer = mysqli_fetch_array($resoffer)) {
    $jskills = $resoffer['jskills'];
    $jskill = explode(",", $jskills);
    $jlangs = $resoffer['jlang'];
    $jlang = explode(",", $jlangs);
    $jloc = $resoffer['jloc'];
    $jgradlvl = $resoffer['jgradlvl'];
    $jexp = $resoffer['jexp'];
    $cid = $resoffer['cid'];
  }
  $j = 0;

  $result = mysqli_query($mysqli, "SELECT * FROM worker ORDER BY wid ASC");
  while($res = mysqli_fetch_array($result)){
    $wid = $res['wid'];
    $wskills = $reswork['wskills'];
    $wskill[$j] = explode(",", $wskills);
    $wlangs = $reswork['wlang'];
    $wlang[$j] = explode(",", $wlangs);
    $waddress = $reswork['waddress'];
    $wgradlvl = $reswork['wgradlvl'];
    $wexp = $reswork['wexp'];
    $j = $j+1;
  }

  $n = 0;
  while ($n <= $j) {
    $plang = array_keys ( $wlang[$n], $jlang);
    $pskill = array_keys ( $wskill[$n], $jskill);
    if($waddress[$n] === $jloc){
      $ploc = $ploc +1;
    }
    if($wgradlvl[$n] >= $jgradlvl){
      $pgradlvl = $pgradlvl + 1;
    }
    if($wexp[$n] >= $jexp){
      $pexp = $pexp + 1;
    }
    $points[$n] = count($plang) + count($pskill) + $ploc + $pgradlvl + $pexp;
    $n = $n + 1;
  }



}else {
  $resultwork = mysqli_query($mysqli, "SELECT * FROM worker WHERE wid = '$id'");
  while ($reswork = mysqli_fetch_array($resultwork)) {
    $wskills = $reswork['wskills'];
    $wskill = explode(",", $wskills);
    $wlangs = $reswork['wlang'];
    $wlang = explode(",", $wlangs);
  }
  $resultcomp = mysqli_query($mysqli, "SELECT * FROM comptab WHERE wid = '$id'");
}


?>
