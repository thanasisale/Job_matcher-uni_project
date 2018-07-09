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
        <script src="https://use.fontawesome.com/1b697ddbac.js"></script>
				<title>Πτυχιακή</title>
				<link rel="shortcut icon" href="favicon1.ico">
	</head>
	<body>

<script type="text/javascript">

	function removeJunk(div){
		div.remove();
	}

</script>

        <?php //making the menu ?>
        <div class="topnav" id="myTopnav">
            <a href="home.php" style="margin-left:50px;">Home</a>
						<?php if(!isset($_SESSION["email"])){ ?>
            <a href="add.php" style="margin-left:15px;">Register</a>
            <a href="login.php" style="margin-left:15px;">Log In</a>
            <?php }else{ ?>
            <a href="profile.php" class="navprof" style="margin-left:15px;">Profile</a>
            <a href="logout.php" style="margin-left:15px;">Log Out</a>
            <?php } ?>
					</div>
