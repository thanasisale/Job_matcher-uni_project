<?php
include 'head.php';
// Destroying All Sessions
session_unset();
if(session_destroy()){
    // Redirecting to login page
    echo("<script>location.href = '"."login.php';</script>");
  }
  ?>
