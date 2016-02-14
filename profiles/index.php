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
	<title>All Profiles - Get Out!</title>
	<link rel="shortcut icon" img="../href/logo.ico">

	<link rel="stylesheet" href="../css/bootstrap.min.css" />

	<style>	
		@font-face {
		    font-family: 'cocomatLight';
		    src: url('../fonts/Cocomat Light.ttf');
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

		.profilesContainer{
			font-family: 'liberationRegular';
		}

		.center {
			text-align:center;
		}
	</style>

	<meta charset="utf-8" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
	<nav class="navbar navbar-default" id="mainNavBar" role="navigation">
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
					<li><a id="nav-about" href="../profile"><div class="glyphicon glyphicon-user"></div> MY PROFILE</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container" id="profilesContainer">
		<div class="row">
			<div class="col-md-12 center">
				<h1 style="font-family:'cocomatLight'">Profiles</h1>
				<div class="row">
					<?php
						$allProfiles = "SELECT picture, username, firstname, lastname, email, birthday, year, interests FROM Profiles";
						$result = $conn->query($allProfiles);

						if ($result->num_rows > 0) {//there are people
							$colCount = 0;
						    while($row = $result->fetch_assoc()) {
								$colCount++;
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
				    				<p>". $row["email"] . "</p>
				    				</div></div>";
						    }
						} else {
						    echo "<div class='col-md-12'>No Users Founds</div>";
						}

						$conn->close();
					?>
				</div>
			</div>
		</div>
	</div>
</body>

</html>