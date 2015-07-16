<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    $username = $_POST["username"];
	    $password = $_POST["password"];
	}

	//hashing and salting passwords
	$salt = "temporarysalt";
	$hashpassword = crypt($password, $salt);

	$servername = "localhost";
	$serverusername = "cl53-shad2015";
	$serverpassword = "shad";
	$database = "cl53-shad2015";

	// Create connection
	$conn = new mysqli($servername, $serverusername, $serverpassword, $database);

	$data = "SELECT id, firstname, lastname, username, password FROM Profiles";
	$result = $conn->query($data);

	if ($result->num_rows > 0) {
	    // output data of each row;

	    while($row = $result->fetch_assoc()) {
	       if($row["password"] === $hashpassword && $row["username"] === $username)
	       {
	       		echo $row["id"] . " - " . $row["firstname"] . " " . $row["lastname"];
	       }
	    }
	}
	else {
		echo 0;
	}

?>