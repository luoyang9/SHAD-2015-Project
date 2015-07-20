
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

	$pictureQuery = $conn->query("SELECT picture FROM Profiles WHERE username='$tempusername'");
	$pictureAssoc = $pictureQuery->fetch_assoc();
	$picture = $pictureAssoc["picture"];

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
		#profileContainer {
			text-align:center;
		}
	</style>

	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script>
		function logOut(){
			var ajaxurl = 'logout.php';
	        $.post(ajaxurl, "", function (response) {
          		history.go(0);
	        });
		}

		function editInterests(){
			var interestsBox = document.getElementById("interestsBox");

			interestsBox.contentEditable = true;
			interestsBox.style.outline = "blue solid medium";
		    interestsBox.focus();
		}

		function saveInterests(){
			var interestsBox = document.getElementById("interestsBox");

			var ajaxurl = 'editProfile.php';
			var newinterests = interestsBox.innerHTML;
			interestsBox.contentEditable = false;
			interestsBox.style.outline = "none";
	        $.post(ajaxurl,{interests: newinterests}, function (response) {
	            window.location.href = "";
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
				<a class="navbar-brand" href="../"><div class="glyphicon glyphicon-cloud"></div> Get Out!</a>
			</div>
		</div>
	</nav>
	<div class="container-fluid" id="profileContainer">
		<div class="row">
			<div class="col-md-12">
				<h1>Welcome, <?php echo $_SESSION['name'];?>!</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div style="
					margin:0 auto;
					background:url('<?php echo $picture; ?>') no-repeat center;
					width:100px;
					height:100px;
  					border: 1px solid white;
    				border-radius: 50px;
    				background-size:cover;"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<br/>
				<p>Your Interests (click to edit!): </p> 
				<div style="display:inline-block;outline:none;text-align:center;" id="interestsBox" onclick="editInterests()" onBlur="saveInterests()"><?php 
					for($i = 1; $i <= count($userInterests); $i++){
						echo $userInterests[$i-1];
						if($i < count($userInterests)) echo ", ";
					}
				?></div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<h2>Your Matches</h2>
				<table class="table" align="center">
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
						    				if(strcasecmp(trim($interest), trim($userInterest)) == 0){
						    					$match = true;
						    					$similarInterests .= $interest . ", ";
						    				}
						    			}
						    		}
						    	}
						    	if($match){
							        echo "<tr><td>" . $row["firstname"]. " " . $row["lastname"] . 
							        "</td><td>" . $row["year"] . "</td><td>" . substr($similarInterests, 0, -2) . "</td><td>" . 
							        $row["birthday"] . "</td><td>". $row["email"] . "</td></tr>";
							       // echo '<div class="row"><div class="col-md-8"></div></div>';
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

