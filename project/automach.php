<?php

$id = $_GET['id'];
$jid = $_GET['jid']

function count_array_values($my_array, $match)
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
}

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

  $result = mysqli_query($mysqli, "SELECT * FROM worker");
  while($res = mysqli_fetch_array($result)){
    $wid = $res['wid'];
    $wskills = $reswork['wskills'];
    $wskill[$wid] = explode(",", $wskills);
    $wlangs = $reswork['wlang'];
    $wlang[$wid] = explode(",", $wlangs);
    $waddress = $reswork['waddress'];
    $wgradlvl = $reswork['wgradlvl'];
    $wexp = $reswork['wexp'];
  }
  
$point = array_keys ( $wlang, $jlang);
$p = count($pont);
$hit = 0;
foreach ($wskill as $skill) {
  $h = count_array_values($jskill, $skill);
  $hit = $hit + $h;
  }
}

foreach ($wlang as $lang) {
  $h = count_array_values($jlang, $lang);
  $hit = $hit + $h;
  }
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
