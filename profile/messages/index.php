<?php
	$config = require("../../../../config.php");
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
	$messages = $conn->query("SELECT * FROM Messages");

	$userquery = $conn->query("SELECT firstname, lastname, picture FROM Profiles where username='$tempusername'");
	$userResults = $userquery->fetch_assoc();
	$userPicture = $userResults["picture"];
?>

<html lang="en">
<head>
	<title>Messages - Get Out!</title>
	<link rel="shortcut icon" href="../../img/logo.ico">

	<link rel="stylesheet" href="../../css/bootstrap.min.css" />
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
		.userpic {
			width:50px;
			height:50px;
			border: 0px solid white;
			border-radius: 25px;
			margin:5px;
			float:left;
		}

		.messagescontainer {
			padding-top: 50px;
		}

		.convoinfo {
  			display: inline-block;
			font-family: "liberationBold";
		}

		.recipientname {
			margin:5px;
			font-weight:bold;
			font-family: "Open Sans", sans-serif;
		}

		.recipientRecentMessage {
			margin:5px;
			font-family: "Open Sans", sans-serif;
			color:gray;
			font-family: "liberationRegular";
		}

		.chatrow {
			background-color:lightblue;
			padding:5px;
			border: 0px solid white;
			border-radius: 10px;
			margin:10px 0;
			cursor:pointer;
		}
	</style>

	<meta charset="utf-8" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<script type="text/javascript" src="../../js/jquery-1.11.1.min.js"></script>
	<script>
		function goToConvo(username){ 
			$.post("setConvo.php",{username: username}, function (response) {
		            window.location.href = "conversation";
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
				<a class="navbar-brand" style="padding:8px" href="../"><div class="glyphicon glyphicon-chevron-left"></div><img src="../../img/logo.png" width="100px"; height="30px"; /></a>
			</div>
		</div>
	</nav>
	<div class="container messagescontainer">
		<div clas="row">
			<div class="col-md-12">
				<h1 style="text-align:center; font-family:'cocomatLight'">Messages</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php 
					$activeRecipients = array();
					$recentMessage = array();
					if ($messages->num_rows > 0) {
					    while($row = $messages->fetch_assoc()) {
					    	if($row["username"] === $_SESSION["username"]){
					    		$recipientUsername = $row["username2"];
					    		array_unshift($activeRecipients, $recipientUsername);
					    		$recentMessage[$recipientUsername] = $row["message"];
					    	}
					    	else if($row["username2"] === $_SESSION["username"]){
					    		$recipientUsername = $row["username"];
					    		array_unshift($activeRecipients, $recipientUsername);
					    		$recentMessage[$recipientUsername] = $row["message"];
					    	}
					    }

					    $activeRecipients = array_unique($activeRecipients);

					    foreach($activeRecipients as $recipientUsername){
				    		$recipientQuery = $conn->query("SELECT firstname, lastname, picture FROM Profiles where username='$recipientUsername'");
							$recipientResults = $recipientQuery->fetch_assoc();
							$recipientPicture = $recipientResults["picture"];
							$recipientFullName = $recipientResults["firstname"] . " " . $recipientResults["lastname"];
				    		echo "<div class='row'>
				    			<div class='col-md-12 chatrow' onClick='goToConvo(\"" . $recipientUsername . "\")' >
				    				<div class='userpic' style='background: url(\"../" . $recipientPicture . "\") no-repeat center;
										background-size: cover;'>
									</div>
									<div class='convoinfo'>
					    				<h2 class='recipientname'>
					    					" . $recipientFullName . "
					    				</h2>
					    				<p class='recipientRecentMessage'>
					    					" .  $recentMessage[$recipientUsername] . "
					    				</p>
					    			</div>
				    			</div>
				    		</div>";
					    }
					}

				?>
			</div>
		</div>
	</div>
</body>
</html>