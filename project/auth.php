<?php
//Chenking if user is logged
if(!isset($_SESSION["email"])){
  echo("<script>location.href = '"."login.php';</script>");
  exit;
}
?>
