
<?php 
include_once("config.php");
session_start();
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700&amp;subset=greek" rel="stylesheet">
	</head>
    <body>
        
        <div class="topnav" id="myTopnav">
            <a href="home.php">Home</a>
            <a href="add.php">Register</a>
            <?php if(!isset($_SESSION["email"])) { ?>
            <a href="login.php">Log In</a>
            <?php }else{ ?>
            <a href="logout.php">Log Out</a>
            <?php } ?>
        </div>