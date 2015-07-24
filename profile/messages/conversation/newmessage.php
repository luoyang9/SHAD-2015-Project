<?php
	session_start();

	$message = test_input($_POST["message"]);
	$sender = test_input($_POST["sender"]);
	$recipient = test_input($_POST["recipient"]);

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

	$message = clean_string($message);
	$sender = clean_string($sender);
	$recipient = clean_string($recipient);

	$servername = "localhost";
	$serverusername = "cl53-shad2015";
	$serverpassword = "shad";
	$database = "cl53-shad2015";

	// Create connection
	$conn = new mysqli($servername, $serverusername, $serverpassword, $database);

	$data = "INSERT INTO Messages (username, username2, message) VALUES ('$sender', '$recipient', '$message')";
	if ($conn->query($data) === TRUE) {
		echo $message;
	} else {
		error_log("something happened lol");
		echo 0;
	}

?>
