
<?php
	session_start();

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

	$servername = "localhost";
	$username = "cl53-shad2015";
	$password = "shad";
	$database = "cl53-shad2015";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
	    die('<span style="color:red;">Connection failed: " . $conn->connect_error . "     " . $conn->connect_errno . " </span>');
	} 

	$tempusername = $_SESSION["username"];
	$interestsQuery = $conn->query("SELECT interests FROM Profiles WHERE  username='$tempusername'");
	$interestsAssoc = $interestsQuery->fetch_assoc();
	$userInterests = explode(",", $interestsAssoc["interests"]);

?>


<html lang="en">
<head>
	<title>Profiles - SHAD Project</title>
	<link rel="shortcut icon" href="img/logo.ico">

	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../css/profiles.css" />

	<meta charset="utf-8" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<style>
		#profileContainer {
			text-align:center;
		}
	</style>

	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script>
		function logOut(){
			var ajaxurl = 'logout.php';
	        $.post(ajaxurl, "", function (response) {
	            window.location.href = "../";
	        });
		}
	</script>
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
				<a class="navbar-brand" href="../"><div class="glyphicon glyphicon-cloud"></div> Ultra</a>
			</div>
		</div>
	</nav>
	<div class="container" id="profileContainer">
		<div class="row">
			<div class="col-md-12">
				<h1>Welcome, <?php echo $_SESSION['username'] . " - " . $_SESSION['name'];?>!</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p>Your Interests: <?php foreach($userInterests as $interest){echo $interest . ", ";}?></p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<h2>Your Matches</h2>
				<table align="center" border="1">
					<tr>
						<th>Name</th>
						<th>UniYear</th>
						<th>Similar Interests</th>
						<th>Birthday</th>
						<th>Email</th>
					</tr>

					<?php
						
						$allProfiles = "SELECT username, firstname, lastname, email, birthday, year, interests FROM Profiles";
						$result = $conn->query($allProfiles);

						if ($result->num_rows > 0) {
						    // output data of each row;
						    while($row = $result->fetch_assoc()) {
								$match = false;
								$similarInterests = "";
						    	if($row["username"] !== $_SESSION["username"]){
						    		$interestsArray = explode(",", $row["interests"]);
						    		foreach($interestsArray as $interest){
						    			foreach($userInterests as $userInterest){
						    				if(strcasecmp($interest, $userInterest) == 0){
						    					$match = true;
						    					$similarInterests .= $interest . ", ";
						    				}
						    			}
						    		}
						    	}
						    	if($match){
							        echo "<tr><td>" . $row["firstname"]. " " . $row["lastname"] . 
							        "</td><td>" . $row["year"] . "</td><td>" . $similarInterests . "</td><td>" . 
							        $row["birthday"] . "</td><td>". $row["email"] . "</td></tr>";
						    	}
						    }
						} else {
						    echo '<tr><td colspan="5" style="text-align:center;">0 results</td></tr>';
						}

						$conn->close();

					?>
				</table>
			</div>
		</div>
		<br/>
		<input type="button" value="Log Out" onClick="logOut()" />
	</div>
</body>

</html>

