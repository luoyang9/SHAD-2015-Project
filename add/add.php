<?php
	session_start();	
	$config = require("../../../config.php");
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    $fname = test_input($_POST["fname"]);
	    $lname = test_input($_POST["lname"]);
	    $email = test_input($_POST["email"]);
	    $birthday = test_input($_POST["birthday"]);
	    $year = test_input($_POST["year"]);
	    $interests = test_input($_POST["interests"]);
	    $username = $_POST["username"];
	    $password = $_POST["password"];
			
		$target_dir = "../uploads/";
		$target_file = $target_dir . $username . "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		
	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  //$data = htmlspecialchars($data);
	  return $data;
	}

	function clean_string($string) {

	  $bad = array("SELECT","DELETE");

	  return str_replace($bad,"",$string);

	}
	 
	     
	$fname = clean_string($fname);
	$lname = clean_string($lname);
	$email = clean_string($email);
	$birthday = clean_string($birthday);
	$year = clean_string($year);
	$interests = clean_string($interests);
	$interests = strtolower($interests);

	//hashing and salting passwords
	$salt = "temporarysalt";
	$hashpassword = crypt($password, $salt);

	$servername = $config["name"];
	$serverusername = $config["username"];
	$serverpassword = $config["password"];
	$database = $config["database"];

	// Create connection
	$conn = new mysqli($servername, $serverusername, $serverpassword, $database);

	$duplicate = "SELECT username FROM Profiles";
	$duplicatecheck = $conn->query($duplicate);

	if ($duplicatecheck->num_rows > 0) {
	    while($row = $duplicatecheck->fetch_assoc()) {
	    	if($username === $row["username"]){
	    		echo 2;
	    		return;
	    	}
	    }
	}

	$data = "INSERT INTO Profiles (firstname, lastname, email, birthday, year, interests, username, password, picture)
	VALUES ('$fname', '$lname', '$email', '$birthday', '$year', '$interests', '$username', '$hashpassword', '$target_file')";

	if ($conn->query($data) === TRUE) {
		move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
		$_SESSION['username'] = $username;
		$_SESSION['name'] = $fname . " " . $lname;
		$_SESSION['lastactivity'] = time();
		echo 1;
	} else {
		echo 0;
	}
?>