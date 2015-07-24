<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		header('Location: ../../login');
		die();
	}

	if(isset($_SESSION['lastactivity'])){
		$secondsInactive = time() - $_SESSION['lastactivity'];
		if($secondsInactive >= 600){ //10 minutes for each session before expiring
	        session_unset();
	        session_destroy();
			header('Location: ../../login');
			die();
		}
		$_SESSION["lastactivity"] = time();
	}
?>

<html lang="en">
<head>
	<title>Events - Get Out!</title>
	<link rel="shortcut icon" href="../../img/logo.ico">

	<link rel="stylesheet" href="../../css/bootstrap.min.css" />

	<meta charset="utf-8" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<style>
		@font-face {
		    font-family: 'cocomatLight';
		    src: url('../../fonts/Cocomat Light.ttf');
		}
		@font-face {
		    font-family: 'liberationBold';
		    src: url('../../fonts/LiberationSans-Bold.ttf');
		}
		@font-face {
		    font-family: 'liberationRegular';
		    src: url('../../fonts/LiberationSans-Regular.ttf');
		}

		.navbar-default .navbar-nav > li > a {
			color:#525252;
			font-family: "liberationBold", sans-serif;
			font-weight: 600;
		}

		.navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-header a:hover,
		.navbar-default .navbar-header a:focus, .navbar .navbar-brand {
			color:black;
			font-family: "liberationBold", sans-serif;
			font-weight: 600;
		}

		.eventsContainer {
			padding-top: 50px;
		}

		#darkBackground {
			position: fixed;
			top: 0%; 
			width: 0%; 
			z-index: 199;
			background: rgba(0, 0, 0, 0.5);
			width: 100%;
			height: 100%;
			visibility: hidden;
		}

		#contactAlert {
			background-color: white;
			top: 40%; 
			width: 30%; 
			min-width: 200px;
			height: 25%; 
			min-height:150px;
			z-index: 200; 
			position: relative; 
			margin-right: auto;
			margin-left: auto; 
			visibility: hidden;
			text-align: center;
		}

		#alertButton {
			position: absolute;
			bottom: 5px;
		}
	</style>

	<script type="text/javascript" src="../../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){  
			//smooth scroll
			$("a[href*=#]").click(function(){
		     	$('html, body').animate({
		        	scrollTop: $( $.attr(this, 'href') ).offset().top
		      	}, 500);
		      	return false;
	  		});

  			if($(document).width() < 800){
		  		//collapse navbar toggle
			    $(".navbar-nav li a").click(function(event) {
			      $(".navbar-collapse").collapse('hide');
			    });
			    $(".navbar-toggle").blur(function(event) {
			      $(".navbar-collapse").collapse('hide');
			    });
			}
		});

		function closeAlert()
		{
			alertMessage.innerHTML = "";
			contactAlert.style.visibility = "hidden";
			darkBackground.style.visibility = "hidden";
		}s
	</script>
	
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" style="margin:0" id="mainNavBar" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" style="padding:8px" href="../"><div class="glyphicon glyphicon-chevron-left"></div><img src="../../img/logo.png" width="100px"; height="30px"; /></a>
			</div>

			<div class="navbar-collapse collapse" id="mainNav">
				<ul class="nav navbar-nav navbar-right">
					<li><a id="nav-about" href="#create"><div class="glyphicon glyphicon-send"></div> CREATE EVENT</a></li>
					<li><a id="nav-about" href="#all"><div class="glyphicon glyphicon-menu-hamburger"></div> ALL EVENTS</a></li>
					<li><a id="nav-about" href="#past"><div class="glyphicon glyphicon-hourglass"></div> PAST EVENTS</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="eventsContainer">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 style="font-family:'cocomatLight';color:lightgray;text-align:center;">This feature is under development and will be released soon.</h1>
				</div>
			</div>
		</div>
	</div>
	
	<div id="darkBackground">
		<div id="contactAlert">
			<p id="alertMessage"></p>
			<button id="alertButton" onClick="closeAlert()">OK</button>
		</div>
	</div>
</body>

</html>

