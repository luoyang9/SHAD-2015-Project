<?php
	$config = require("../../../config.php");
	session_start();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    $username = $_POST["username"];
	    $password = $_POST["password"];
	}

	//hashing and salting passwords
	$salt = "temporarysalt";
	$hashpassword = crypt($password, $salt);

	$servername = $config["name"];
	$serverusername = $config["username"];
	$serverpassword = $config["password"];
	$database = $config["database"];

	// Create connection
	$conn = new mysqli($servername, $serverusername, $serverpassword, $database);

	$data = "SELECT id, firstname, lastname, username, password FROM Profiles";
	$result = $conn->query($data);

	if ($result->num_rows > 0) {
	    // output data of each row;

	    while($row = $result->fetch_assoc()) {
	       if($row["password"] === $hashpassword && $row["username"] === $username)
	       {
				$_SESSION['username'] = $row["username"];
				$_SESSION['name'] = $row["firstname"] . " " . $row["lastname"];
				$_SESSION['lastactivity'] = time();
				echo 1;
				die();
	       }
	    }
	    echo 2;
	    die();
	}
	else {
		echo 0;
		die();
	}

?>