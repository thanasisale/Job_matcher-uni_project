
<?php
//including the database connection file
include_once("config.php");?>
<?php

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM usertab WHERE id=$id");

//redirecting to the display page (home.php in our case)
//header("Location:home.php");
echo("<script>location.href = '"."login.php';</script>");
?>
