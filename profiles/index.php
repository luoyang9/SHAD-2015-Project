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
?>

<html lang="en">
<head>
	<title>Profiles - SHAD Project</title>
	<link rel="shortcut icon" href="img/logo.ico">

	<link rel="stylesheet" href="../css/bootstrap.min.css" />

	<style>
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
				<a class="navbar-brand" href="../"><div class="glyphicon glyphicon-cloud"></div> Ultra</a>
			</div>
		</div>
	</nav>
	<div class="container" id="profilesContainer">
		<div class="row">
			<div class="col-md-12 center">
				<h1>Profiles</h1>
			</div>
		</div>
		<div class="row">
			<table class="table" align="center">
				<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Birthday</th>
					<th>Uni Year</th>
					<th>Interests</th>
				</tr>

				<?php
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

					$allProfiles = "SELECT id, firstname, lastname, email, birthday, year, interests FROM Profiles";
					$result = $conn->query($allProfiles);

					if ($result->num_rows > 0) {
					    // output data of each row;

					    while($row = $result->fetch_assoc()) {
					        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["firstname"]. "</td><td>" . $row["lastname"] . 
					        "</td><td>". $row["email"] . "</td><td>" . $row["birthday"] . "</td><td>" . $row["year"] . "</td><td>" .
					        $row["interests"] . "</td></tr>";
					    }
					} else {
					    echo '<tr><td colspan="5" style="text-align:center;">0 results</td></tr>';
					}

					$conn->close();

				?>

			</table>
		</div>
	</div>
</body>

</html>