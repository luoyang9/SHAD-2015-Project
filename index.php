<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>SHAD Project</title>
	<link rel="shortcut icon" href="img/logo.ico">

	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/main.css" />

	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/TweenMax.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>
	<a name="navchange" id="startchange" style="position:absolute; top:10%"></a>
	<a id="home"></a>
	<!-- NAVBAR-->
	<nav class="navbar navbar-default navbar-fixed-top" id="mainNavBar" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#home"><div class="glyphicon glyphicon-cloud"></div> Ultra</a>
			</div>


			<div class="navbar-collapse collapse" id="mainNav">
				<ul class="nav navbar-nav navbar-right">
					<li><a id="nav-about" href="#about"><div class="glyphicon glyphicon-bookmark"></div> About</a></li>

					<?php 
						session_start();
						if(!isset($_SESSION['username']))
						{
							echo '<li><a href="login"><div class="glyphicon glyphicon-phone"></div> Log in</a></li><li><a href="add"><div class="glyphicon glyphicon-camera"></div> Sign Up</a></li>';
						}
						else{
							echo '<li><a href="profiles"><div class="glyphicon glyphicon-cutlery"></div> Profiles</a></li><li><a href="profile"><div class="glyphicon glyphicon-camera"></div> My Profile</a></li><li><a href="javascript:logOut()"><div class="glyphicon glyphicon-camera"></div> Logout</a></li>';
						}
					?>


					<li><a href="#contact"><div class="glyphicon glyphicon-earphone"></div> Contact</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- JUMBOTRON-->
	<div class="jumbotron">
		<div class="container">	
			<h1>Welcome to Team Ultra!</h1>
			<p>We are committed to helping university students make time for exercise and physical activities.</p>
			<p><a class="btn btn-info btn-lg" href="#about" role="button"><span class="glyphicon glyphicon-heart"></span> Get Active</a></p>
			<p><a id="loginText" href="login">Already Active? Log in Here!</a></p>
		</div>
	</div>

	<!--ABOUT-->
	<a id="about"></a>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h1>We are awesome.</h1>
				<p>This is because we have an awesome solution. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
			<div class="col-md-4">
				<h1>We are awesome.</h1>
				<p>This is because we have an awesome solution. Filler sentence Filler sentenceFiller sentenceFiller sentenceFiller sentence
				Filler sentenceFiller sentenceFiller sentenceFiller sentence</p>
			</div>
			<div class="col-md-4">
				<h1>We are awesome.</h1>
				<p>This is because we have an awesome solution. Filler sentence Filler sentenceFiller sentenceFiller sentenceFiller sentence
				Filler sentenceFiller sentenceFiller sentenceFiller sentence</p>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h1>We are awesome.</h1>
				<p>This is because we have an awesome solution. Filler sentence Filler sentenceFiller sentenceFiller sentenceFiller sentence
				Filler sentenceFiller sentenceFiller sentenceFiller sentence</p>
			</div>
			<div class="col-md-4">
				<h1>We are awesome.</h1>
				<p>This is because we have an awesome solution. Filler sentence Filler sentenceFiller sentenceFiller sentenceFiller sentence
				Filler sentenceFiller sentenceFiller sentenceFiller sentence</p>
			</div>
			<div class="col-md-4">
				<h1>We are awesome.</h1>
				<p>This is because we have an awesome solution. Filler sentence Filler sentenceFiller sentenceFiller sentenceFiller sentence
				Filler sentenceFiller sentenceFiller sentenceFiller sentence</p>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h1>We are awesome.</h1>
				<p>This is because we have an awesome solution. Filler sentence Filler sentenceFiller sentenceFiller sentenceFiller sentence
				Filler sentenceFiller sentenceFiller sentenceFiller sentence</p>
			</div>
			<div class="col-md-4">
				<h1>We are awesome.</h1>
				<p>This is because we have an awesome solution. Filler sentence Filler sentenceFiller sentenceFiller sentenceFiller sentence
				Filler sentenceFiller sentenceFiller sentenceFiller sentence</p>
			</div>
			<div class="col-md-4">
				<h1>We are awesome.</h1>
				<p>This is because we have an awesome solution. Filler sentence Filler sentenceFiller sentenceFiller sentenceFiller sentence
				Filler sentenceFiller sentenceFiller sentenceFiller sentence</p>
			</div>
		</div>
	</div>
	<a id="problem"></a>
	<a id="solution"></a>
	<a id="contact"></a>
</body>
</html>