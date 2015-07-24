<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>Get Out!</title>
	<link rel="shortcut icon" href="img/logo.ico">

	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/main.css" />

	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/queryloader2.min.js"></script>
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
				<a class="navbar-brand" href="#home"><img src="img/logo.png" width="100px"; height="30px"; /></a>
			</div>


			<div class="navbar-collapse collapse" id="mainNav">
				<ul class="nav navbar-nav navbar-right">
					<li><a id="nav-about" href="#about"><div class="glyphicon glyphicon-bookmark"></div> ABOUT</a></li>

					<?php 
						session_start();
						if(!isset($_SESSION['username']))
						{
							echo '<li><a href="login"><div class="glyphicon glyphicon-phone"></div> LOG IN</a></li><li><a href="add"><div class="glyphicon glyphicon-camera"></div> SIGN UP</a></li>';
						}
						else{
							echo '<li><a href="profiles"><div class="glyphicon glyphicon-cutlery"></div> PROFILES</a></li><li><a href="profile"><div class="glyphicon glyphicon-camera"></div> MY PROFILE</a></li><li><a href="javascript:logOut()"><div class="glyphicon glyphicon-camera"></div> LOG OUT</a></li>';
						}
					?>


					<li><a href="#contact"><div class="glyphicon glyphicon-earphone"></div> CONTACT</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- JUMBOTRON-->
	<div class="jumbotron">
		<div class="container">	
			<img id="backgroundimage" src="img/logo.png" width="500px"; height="150px"; />
			<p id="caption">Embracing the fun of outside</p>
			<p>
				<?php 
					if(!isset($_SESSION['username']))
					{
						echo'<a class="btn btn-primary btn-lg" href="#about" role="button"><span class="glyphicon glyphicon-bookmark"></span> About Us </a>
						<a class="btn btn-info btn-lg" href="add" role="button"><span class="glyphicon glyphicon-heart"></span> Get Active</a>';
					}
					else {
						echo'<a class="btn btn-primary btn-lg" href="#about" role="button"><span class="glyphicon glyphicon-bookmark"></span> About Us </a>
						<a class="btn btn-info btn-lg" href="profile" role="button"><span class="glyphicon glyphicon-heart"></span> My Profile</a>';
					}
				?>
			</p>
			<?php 
				if(!isset($_SESSION['username']))
				{
					echo '<p><a id="loginText" href="login">Already Active? Log in Here!</a></p>';
				}
			?>
		</div>
	</div>

	<!--ABOUT-->
	<a id="about"></a>
	<div class="container-fluid about">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Let's Get Outdoors</h1>
					<p>GetOut! is a revolutionary blah blah that let's university students get out more. As more and more students fall
						into the trap of unhealthy eating, limited physical activities, and a stressful schedule, they 
						become inactive and blah blah gain weight.</p>
				</div>
			</div>
		</div>
	</div>
	<a id="solution"></a>
	<div class="container-fluid solution">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div style="
						margin:0 auto;
						background:url('img/noimage.jpg') no-repeat center;
						width:200px;
						height:200px;
	  					border: 0px solid white;
	    				border-radius: 100px;
	    				background-size:cover;"></div>
					<h2>Easy and Convenient</h2>
					<p>Access GetOut! anywhere, anytime, with just a browser and internet connection. Find people to exercise with on-the-go, 
						or plan ahead of time and schedule an event. Whatever you need, you can easily get set up.</p>
				</div>
				<div class="col-md-4">
					<div style="
						margin:0 auto;
						background:url('img/noimage.jpg') no-repeat center;
						width:200px;
						height:200px;
	  					border: 0px solid white;
	    				border-radius: 100px;
	    				background-size:cover;"></div>
					<h2>Exercise with Buddies</h2>
					<p>Get motivated and make new connections by exercising with a buddy. GetOut! matches you with students with similar
						interests, so you'll always have a sport or activity in common.</p>
				</div>
				<div class="col-md-4">
					<div style="
						margin:0 auto;
						background:url('img/noimage.jpg') no-repeat center;
						width:200px;
						height:200px;
	  					border: 0px solid white;
	    				border-radius: 100px;
	    				background-size:cover;"></div>
					<h2>Unlock Rewards</h2>
					<p>Earn points by exercising or attending events and cash them in for awesome on-campus coupons. </p>
				</div>
			</div>
		</div>
	</div>
	<a id="contact"></a>
</body>
</html>
