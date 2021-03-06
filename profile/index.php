<?php
	session_start();
	$config = require("../../../config.php");

	if (!isset($_SESSION['username'])) {
		header('Location: ../login');
		die();
	}

	if(isset($_SESSION['lastactivity'])){
		$secondsInactive = time() - $_SESSION['lastactivity'];
		if($secondsInactive >= 600){ //10 minutes for each session before expiring
	        session_unset();
	        session_destroy();
			header('Location: ../login');
			die();
		}
		$_SESSION["lastactivity"] = time();
	}

	$servername = $config["name"];
	$serverusername = $config["username"];
	$serverpassword = $config["password"];
	$database = $config["database"];

	// Create connection
	$conn = new mysqli($servername, $serverusername, $serverpassword, $database);

	// Check connection
	if ($conn->connect_error) {
	    die('<span style="color:red;">Connection failed: " . $conn->connect_error . "     " . $conn->connect_errno . " </span>');
	} 

	$tempusername = $_SESSION["username"];
	$query = $conn->query("SELECT interests, picture, birthday, year, buddies FROM Profiles WHERE  username='$tempusername'");
	$results = $query->fetch_assoc();
	$userInterests = explode(",", $results["interests"]);
	$picture = $results["picture"];
	$birthday = $results["birthday"];
	$year = $results["year"];
	$buddies = explode(",", $results["buddies"]);

	function convertYear($year){
		switch($year){
			case 1 : return "First";
			case 2 : return "Second";
			case 3 : return "Third";
			case 4 : return "Fourth";
			case 5 : return "Fifth";
		}
	}

	function convertBirthday($birthday){
		$exploded = explode("-", $birthday);
		$realbirthday = "";
		switch($exploded[1]){
			case 1 : $realbirthday .= "January"; break;
			case 2 : $realbirthday .= "February"; break;
			case 3 : $realbirthday .= "March"; break;
			case 4 : $realbirthday .= "April"; break;
			case 5 : $realbirthday .= "May"; break;
			case 6 : $realbirthday .= "June"; break;
			case 7 : $realbirthday .= "July"; break;
			case 8 : $realbirthday .= "August"; break;
			case 9 : $realbirthday .= "September"; break;
			case 10 : $realbirthday .= "October"; break;
			case 11 : $realbirthday .= "November"; break;
			case 12 : $realbirthday .= "December"; break;
			default : $realbirthday .= "Error"; 
		}
		$realbirthday .= " " . $exploded[2] . ", " . $exploded[0];
		return $realbirthday;
	}

?>


<html lang="en">
<head>
	<title>Profile - Get Out!</title>
	<link rel="shortcut icon" href="../img/logo.ico">

	<link rel="stylesheet" href="../css/bootstrap.min.css" />

	<meta charset="utf-8" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<style>
		@font-face {
		    font-family: 'keepCalm';
		    src: url('../fonts/KeepCalm-Medium.ttf');
		}
		@font-face {
		    font-family: 'cocomatLight';
		    src: url('../fonts/Cocomat Light.ttf');
		}
		@font-face {
		    font-family: 'cocomatUltralight';
		    src: url('../fonts/Cocomat Ultralight.ttf');
		}
		@font-face {
		    font-family: 'cocomatUltralight';
		    src: url('../fonts/Cocomat Ultralight.ttf');
		}
		@font-face {
		    font-family: 'liberationBold';
		    src: url('../fonts/LiberationSans-Bold.ttf');
		}
		@font-face {
		    font-family: 'liberationRegular';
		    src: url('../fonts/LiberationSans-Regular.ttf');
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

		#personalinfo {
			border-top:1px solid lightgray;
			border-bottom:1px solid lightgray;
   			font-family: "liberationRegular";
		}

		#personalinfo a {
			color:black;
		}

		#mainHeader{
			background: url('../img/profileback.jpg') no-repeat center center fixed;
			background-size:cover;
   			overflow:hidden;
   			font-family: "cocomatLight";
		}

		#buddiesContainer {
			padding: 10px 0;
			font-family:"liberationRegular";
		}
		
		#matchesContainer {
			font-family:"liberationRegular";
		}

		#buddiesContainer h2 {
   			font-family: "cocomatLight";
		}

		#matchesContainer h2 {
   			font-family: "cocomatLight";
		}

		.statinfo {
   			font-family: "cocomatLight";
		}

		.profileDiv {
			padding:10px 0;
			background-color: white;
			border:0px solid white;
			border-radius: 25px;
		}

		.orange{
			background-color:#FF9966;
		}
		.green{
			background-color:lightgreen;
		}
		#profileContainer {
			text-align:center;
			padding:50px 0 0 0;
			width:100%;

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

		.infoborder{
			display: inline-block;
			padding:0 25px;
			border-right: 1px solid lightgray;
			border-left: 1px solid lightgray;
		 }
	</style>

	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
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
		}
		var oldInterests;

		function logOut(){
			var ajaxurl = 'logout.php';
	        $.post(ajaxurl, "", function (response) {
          		history.go(0);
	        });
		}

		function editInterests(){
			var interestsBox = document.getElementById("interestsBox"); 	
			oldInterests = interestsBox.textContent;

			interestsBox.contentEditable = true;
			interestsBox.style.outline = "lightblue solid medium";
		    interestsBox.focus();
		}

		function saveInterests(){
			var interestsBox = document.getElementById("interestsBox");

			var ajaxurl = 'editProfile.php';
			var newinterests = interestsBox.textContent;
			interestsBox.contentEditable = false;
			interestsBox.style.outline = "#F4FFFF solid medium";
			if(oldInterests != newinterests){
		        $.post(ajaxurl,{interests: newinterests}, function (response) {
		            window.location.href = "";
			    });
			}
		}

		function requestMatch(username){
			$.post("sendRequest.php",{username: username}, function (response) {
		            if(response == 1) {
						alertMessage.innerHTML = "A request has been sent! You will be notified if they accept.";
						contactAlert.style.visibility = "visible";
						darkBackground.style.visibility = "visible";
						$("#btn-" + username).prop("disabled",true);

		            }else{
						alertMessage.innerHTML = "An error occurred while sending your request. Please try again later.";
						contactAlert.style.visibility = "visible";
						darkBackground.style.visibility = "visible";
		            }
			});
		}

		function goToConvo(username){ 
			$.post("messages/setConvo.php",{username: username}, function (response) {
		            window.location.href = "messages/conversation";
			});
		}
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
				<a class="navbar-brand" style="padding:8px" href="../"><div class="glyphicon glyphicon-chevron-left"></div><img src="../img/logo.png" width="100px"; height="30px"; /></a>
			</div>

			<div class="navbar-collapse collapse" id="mainNav">
				<ul class="nav navbar-nav navbar-right">
					<li><a id="nav-about" href="messages"><div class="glyphicon glyphicon-comment"></div> MESSAGES</a></li>
					<li><a id="nav-about" href="#buddies"><div class="glyphicon glyphicon-user"></div> BUDDIES</a></li>
					<li><a id="nav-about" href="#matches"><div class="glyphicon glyphicon-resize-small"></div> MATCHES</a></li>
					<li><a id="nav-about" href="../profiles"><div class="glyphicon glyphicon-th-list"></div> ALL PROFILES</a></li>
					<li><a id="nav-about" href="events"><div class="glyphicon glyphicon-calendar"></div> EVENTS</a></li>
					<li><a id="nav-about" href="rewards"><div class="glyphicon glyphicon-tag"></div> REWARDS</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div id="profileContainer">
		<div id="mainHeader">
			<div class="container-fluid">
				<div class="row lightblue">
					<div class="col-md-12">
						<h1 style="color:white">Welcome, <?php echo $_SESSION['name'];?>!</h1>
					</div>
				</div>
				<div class="row lightblue">
					<div class="col-md-12">
						<div style="
							margin:0 auto;
							background:url('<?php echo $picture; ?>') no-repeat center;
							width:200px;
							height:200px;
		  					border: 0px solid white;
		    				border-radius: 100px;
		    				background-size:cover;"></div>
						<br/>
						<button class="btn btn-danger" type="button" onClick="logOut()">Log Out</button>
						<br/><br/>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div id="personalinfo">
				<a href="rewards">
					<img src="../img/reward.png" height="100px" style="float:left;" />
					<div class="statinfo" style="float:left;">
						<h2 style="font-family:'liberationBold'">0</h2>
						<h3>Fitness Points</h3>
					</div>
				</a>
				<a href="events">
					<img src="../img/events.png" height="100px" style="float:right;"/>
					<div class="statinfo" style="float:right;">
						<h2 style="font-family:'liberationBold'">0</h2>
						<h3>Upcoming Events</h3>
					</div>
				</a>
				<div style="margin:0 auto;">
					<br/>
					<div class="infoborder">
						<span style="font-weight:bold">Your Interests: </span>
						<div style="padding:3px 8px;display:inline-block;outline:#F4FFFF solid medium;text-align:center;" id="interestsBox" onclick="editInterests()" onBlur="saveInterests()"><?php 
								for($i = 1; $i <= count($userInterests); $i++){
									echo $userInterests[$i-1];
									if($i < count($userInterests)) echo ",";
								}
							?></div>
						<br/>
						<span style="color:gray">*Click to edit!</span>
						<br/>
						<br/>
						<?php
							echo "<span style='font-style:italic'>" . convertYear($year) . " Year - " . convertBirthday($birthday) . "</span>";
						?>
					</div>
					<br/>
					<br/>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div id="stats">
				<div class="row">
				</div>
			</div>
		</div>

		<a id="buddies"></a>
		<div class="container-fluid">
			<div class="row green" id="buddiesContainer">
				<div class="col-md-12">
					<h2>Matched Buddies</h2>
					<div class="row">
						<?php
							if(count($buddies) <= 1 && $buddies[0] == ""){
								echo "<div class='col-md-12'>No Buddies Found :(</div>";
							}
							else
							{
								$buddyProfiles = "SELECT picture, username, firstname, lastname, email, birthday, year, interests FROM Profiles";
								$result = $conn->query($buddyProfiles);

								if ($result->num_rows > 0) 
								{//there are people
									$colCount = 0;
								    while($row = $result->fetch_assoc()) 
								    {
										foreach($buddies as $buddy)
										{
											if($buddy == $row["username"])
											{
												$colCount++;
												if($colCount > 4){
													$colCount = 1;
													echo "</div><div class='row'>";
												}
												$similarInterests = "";
												$interestsArray = explode(",", $row["interests"]);
									    		foreach($interestsArray as $interest){
									    			foreach($userInterests as $userInterest){
									    				if(strcasecmp(trim($interest), trim($userInterest)) == 0){
									    					$similarInterests .= $interest . ", ";
									    				}
									    			}
									    		}
												echo "<div class='col-md-3' style='margin:5px 0;'><div class='profileDiv'>
									    				<div style='
											        	background:url(\"" . $row["picture"] . "\") no-repeat center;
														width:100px;
														height:100px;
														margin:0 auto;
									  					border: 0px solid white;
									    				border-radius: 50px;
									    				background-size:cover;'>
									    				</div>
									    				<h3>" . $row["firstname"]. " " . $row["lastname"] . "</h3>
									    				<h5 style='font-style:italic'>" . convertYear($row["year"]) . " Year - " . convertBirthday($row["birthday"]) . "</h5>
									    				<p><span style='font-weight:bold'>Similar Interests: </span>" . substr($similarInterests, 0, -2) . "</p>
									    				<p>". $row["email"] . "</p>
									    				<button type='button' class='btn btn-info' onClick='goToConvo(\"" . $row["username"] . "\")'>Message</button>
						    							</div></div>
									    				";
								    		}
							    		}
									}
								}
							}

						?>
					</div>
				</div>
			</div>
		</div>

		<a id="matches"></a>
		<div class="container-fluid">
			<div class="row orange" id="matchesContainer">
				<div class="col-md-12">
					<h2>New Matches</h2>
					<div class="row">
						<?php
							$allProfiles = "SELECT picture, username, firstname, lastname, email, birthday, year, interests FROM Profiles";
							$result = $conn->query($allProfiles);

							if ($result->num_rows > 0) {//there are people
								$matches = 0;
								$colCount = 0;
							    while($row = $result->fetch_assoc()) {

							    	$duplicateBuddy = false;
						    		foreach($buddies as $buddy)
									{
										if($buddy == $row["username"]) $duplicateBuddy = true;
									}
									if($duplicateBuddy) continue;

									$match = false;
									$similarInterests = "";
							    	if($row["username"] !== $_SESSION["username"]){
							    		$interestsArray = explode(",", $row["interests"]);
							    		foreach($interestsArray as $interest){
							    			foreach($userInterests as $userInterest){
							    				if(strcasecmp(trim($interest), trim($userInterest)) == 0){
							    					$match = true;
							    					$similarInterests .= $interest . ", ";
							    				}
							    			}
							    		}
							    	}
							    	if($match){
										$colCount++;
										$matches++;
							    		if($colCount > 4){
							    			echo "</div><div class='row'>";
							    			$colCount = 1;
							    		} 
						    			echo "<div class='col-md-3' style='margin:5px 0;'><div class='profileDiv'>
						    				<div style='
								        	background:url(\"" . $row["picture"] . "\") no-repeat center;
											width:100px;
											height:100px;
											margin:0 auto;
						  					border: 0px solid white;
						    				border-radius: 50px;
						    				background-size:cover;'>
						    				</div>
						    				<h3>" . $row["firstname"]. " " . $row["lastname"] . "</h3>
						    				<h5 style='font-style:italic'>" . convertYear($row["year"]) . " Year - " . convertBirthday($row["birthday"]) . "</h5>
						    				<p><span style='font-weight:bold'>Similar Interests: </span>" . substr($similarInterests, 0, -2) . "</p>
						    				<p>". $row["email"] . "</p>
						    				<button type='button' id='btn-" . $row["username"] . "' class='btn btn-info' onClick='requestMatch(\"" . $row["username"] . "\")'>Match Me!</button>
						    			</div></div>";
							    		
							    	}
							    }
							    if($matches == 0) echo "<div class='col-md-12'>No Matches Founds</div>";
							} else {
							    echo "<div class='col-md-12'>No Matches Founds</div>";
							}

							$conn->close();
						?>
					</div>
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

