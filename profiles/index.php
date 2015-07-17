<html lang="en">
<head>
	<title>Profiles - SHAD Project</title>
	<link rel="shortcut icon" href="img/logo.ico">

	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../css/profiles.css" />

	<meta charset="utf-8" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
	<a href="../">Go Back</a>
	<div class="container" id="about">
		<div class="row">
			<div class="col-md-12">
				<h1>Profiles</h1>
			</div>
		</div>
		<div class="row">
			<table style="width:100%;" border="1">
				<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Birthday</th>
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

					$allProfiles = "SELECT id, firstname, lastname, email, birthday FROM Profiles";
					$result = $conn->query($allProfiles);

					if ($result->num_rows > 0) {
					    // output data of each row;

					    while($row = $result->fetch_assoc()) {
					        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["firstname"]. "</td><td>" . $row["lastname"] . "</td><td>". $row["email"] . "</td><td>" . $row["birthday"] . "</td></tr>";
					    }
					} else {
					    echo '<tr><td colspan="5" style="text-align:center;">0 results</td></tr>';
					}

					$conn->close();

				?>

			</table>
		</div>
	</div>
	<a href="../add">Create Profile</a>
</body>

</html>