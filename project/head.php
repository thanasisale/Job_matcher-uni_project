<?php
//establishing a session
session_start();
//including the connection file
include_once "config.php";

?>
<html>
	<head>
        <?php //including a google font, fontawesome icons, jquery and bootstrap ?>
				<link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
				<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-WuViQmTamrPyvMFZjf8te7HpKtdxuzV/HX1yG26a0d8yieIBr+beDf1ME99iX1cM" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700&amp;subset=greek" rel="stylesheet">
        <script src="https://use.fontawesome.com/1b697ddbac.js"></script>
				<title>Πτυχιακή</title>
				<link rel="shortcut icon" href="favicon1.ico">
	</head>
	<body style="padding-top : 120px;">

		<!-- Script to remove divs -->
		<script type="text/javascript">

			function removeJunk(div){
				div.remove();
			}

		</script>

		<!-- Navigation Bar -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
			<div class="container">

				<a class="navbar-brand" href="#">Project</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarColor01">
					<ul class="navbar-nav mr-auto">


						<?php if(!isset($_SESSION["email"])){ ?>
							<li class="nav-item">
								<a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="add.php">Register</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="login.php">Log In</a>
							</li>
						<?php }else{ ?>
							<li class="nav-item">
								<a class="nav-link" href="profile.php">Profile</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="logout.php">Log Out</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div><!-- Closing container div -->
		</nav><!-- End Of navigation bar-->
