<?php
	session_start();
	if(!isset($_POST["username"])){
		echo 0;
		die();
	}
	$username = test_input($_POST["username"]);

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}


	function clean_string($string) {

	  $bad = array("SELECT","DELETE");

	  return str_replace($bad,"",$string);

	}

	$username = clean_string($username);

	$servername = "localhost";
	$serverusername = "cl53-shad2015";
	$serverpassword = "shad";
	$database = "cl53-shad2015";

	// Create connection
	$conn = new mysqli($servername, $serverusername, $serverpassword, $database);

	$tempusername = $_SESSION["username"];
	$data = "INSERT INTO Messages (username, username2, message) VALUES ('$tempusername', '$username', 'Please accept my request to be your buddy! <a href=\"javascript:addBuddy(\'" . $_SESSION["username"] . "\')\">Click Here!</a>')";
	if ($conn->query($data) === TRUE) {
		echo 1;
	} else {
		echo 0;
	}

?>
