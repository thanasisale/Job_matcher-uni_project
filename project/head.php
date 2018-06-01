<?php
//establishing a session
session_start();
//including the connection file
include_once "config.php";
?>
<html>
	<head>
        <?php //including fonts and fontawesome to use for icons ?>
				<link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700&amp;subset=greek" rel="stylesheet">
        <script src="path/to/jquery.js"></script>
        <script src="path/to/jquery.repeater/jquery.repeater.js"></script>
        <script src="https://use.fontawesome.com/1b697ddbac.js"></script>
	</head>
	<body>

        <?php //making the menu ?>
        <div class="topnav" id="myTopnav">
            <a href="home.php">Home</a>
						<?php if(!isset($_SESSION["email"])){ ?>
            <a href="add.php">Register</a>
            <a href="login.php">Log In</a>
            <?php }else{ ?>
            <a href="profile.php" class="navprof">Profile</a>
            <a href="logout.php">Log Out</a>
            <?php } ?>
					</div>
