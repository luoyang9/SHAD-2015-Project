<?php
	session_start();	
?>
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
				<a class="navbar-brand" style="padding:8px" href="#home"><img src="img/logo.png" width="100px"; height="30px"; /></a>
			</div>


			<div class="navbar-collapse collapse" id="mainNav">
				<ul class="nav navbar-nav navbar-right">
					<li><a id="nav-about" href="#about"><div class="glyphicon glyphicon-bookmark"></div> ABOUT</a></li>

					<?php 
						if(!isset($_SESSION['username']))
						{
							echo '<li><a href="login"><div class="glyphicon glyphicon-log-in"></div> LOG IN</a></li><li><a href="add"><div class="glyphicon glyphicon-new-window"></div> SIGN UP</a></li>';
						}
						else{
							echo '<li><a href="profiles"><div class="glyphicon glyphicon-th-list"></div> ALL PROFILES</a></li><li><a href="profile"><div class="glyphicon glyphicon-user"></div> MY PROFILE</a></li><li><a href="javascript:logOut()"><div class="glyphicon glyphicon-log-out"></div> LOG OUT</a></li>';
						}
					?>


					<li><a href="http://fitnessabout.wix.com/getout#!contact/cmk9"><div class="glyphicon glyphicon-earphone"></div> CONTACT</a></li>
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
					<p>GetOut! is comprised of a diverse group of 6 young professionals, from British Columbia all the way to Newfoundland & Labrador. GetOu! was formed in 2015 as part of the SHAD Waterloo program.
We aim to help university students to get outside and exercise more by matching them with a workout accountabilibuddy on campus. Through this, we hope to improve the mental, physical, and emotional health of university students.</p>
					<a href="http://fitnessabout.wix.com/getout" style="color: #FF6600;">For more information, visit our information site</a>
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
						background:url('img/easy.png') no-repeat center;
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
						background-color:lightorange;
						background:url('img/buddy.png') no-repeat center;
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
						background:url('img/lock.png') no-repeat center;
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
	<div class="container-fluid faq">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 style="text-align:center">FAQ</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>What are the benefits of exercising?</h1>
					<p>Many people tend to find excuse to avoid exercising, pushing it off due to workload. However, 
It is beneficial to get up from your desk as exercise helps memory and thinking through both direct and indirect means. Exercise also improves mood and sleep, and reduces stress and anxiety. Exercising regularly could improve your efficiency, allow you to have a healthier lifestyle, and even help you ace tests!</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>Why a fitness buddy?</h1>
					<p>Numerous studies have confirmed that exercise is greatly enhanced when you are with a buddy or in a group setting. Exercising with a buddy allows you to be more accountable, which prevents you from slacking off and making the most out of your experience.  A fitness buddy encourages you to try more new activities, makes exercising more fun, and keeps you motivated.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>How to get started?</h1>
					<p>First, create a profile that tells the world about your favorite fitness activities, why you love to maintain an active lifestyle and what you’re looking for in your activity partners. Next, post some photos, especially ones that highlight your fitness passion. You can even peruse the profiles of other members and “Show Interest” in the ones that seem like a fitness match.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>How does GetOut! match people? </h1>
					<p>As you write your profile, don’t worry about making yourself sound like the next summer Olympics star - just be honest! You’ll get the best results and ensure that you find someone who is at the same level of fitness activity as you. And whether you’re looking for a yoga partner, running partner, bodybuilding partner or any other kind of match, Fitness Singles is the place you want to be.</p>
				</div>
			</div>

		</div>
	</div>
	<div class="container-fluid copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p>© 2015 GetOut!. All Rights Reserved | Designed and developed by the Shad Valley Waterloo 2015 GetOut! team.</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
