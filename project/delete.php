
<?php
//including the database connection file
include_once("config.php");?>
<?php

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table with working secondary keyes in db
//$result = mysqli_query($mysqli, "DELETE FROM usertab WHERE id=$id");

//deleting the row from table without secondary keyes in db
$sql = "DELETE FROM usertab WHERE id=$id; ";
$sql.= "DELETE FROM comptab WHERE cid=$id; ";
$sql.= "DELETE FROM worker WHERE wid=$id; ";
$sql.= "DELETE FROM jobOffer WHERE cid=$id; ";
$result = mysqli_multi_query($mysqli, $sql);

//redirecting to the display page (home.php in our case)
//header("Location:home.php");
echo("<script>location.href = '"."login.php';</script>");
?>
