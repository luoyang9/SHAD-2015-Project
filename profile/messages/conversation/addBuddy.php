<?php
	session_start();

	if(!isset($_POST["username"])){
		echo 0;
		die();
	}

	$tempusername = $_SESSION["username"];
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

	$duplicate = "SELECT buddies FROM Profiles WHERE username='$tempusername'";
	$duplicatecheck = $conn->query($duplicate);

	if ($duplicatecheck->num_rows > 0) {
	    while($row = $duplicatecheck->fetch_assoc()) {
	    	$newbuddies = "";
	    	$explodedBuddies = explode(",", $row["buddies"]);
	    	if(count($explodedBuddies) == 1 && $explodedBuddies[0] == "") break;
	    	foreach($explodedBuddies as $checkBuddy)
	    	{
	    		$newbuddies .= $checkBuddy . ",";
	    		if($username === $checkBuddy){
		    		echo 2;
		    		return;
	    		}
	    	}
	    }
	}

	$duplicate2 = "SELECT buddies FROM Profiles WHERE username='$username'";
	$duplicatecheck2 = $conn->query($duplicate2);

	if ($duplicatecheck2->num_rows > 0) {
	    while($row = $duplicatecheck2->fetch_assoc()) {
	    	$newbuddies2 = "";
	    	$explodedBuddies = explode(",", $row["buddies"]);
	    	if(count($explodedBuddies) == 1 && $explodedBuddies[0] == "") break;
	    	foreach($explodedBuddies as $checkBuddy)
	    	{
	    		$newbuddies2 .= $checkBuddy . ",";
	    		if($tempusername === $checkBuddy){
		    		echo 2;
		    		die();
	    		}
	    	}
	    }
	}


	$newbuddies .= $username;

	$newbuddies2 .= $tempusername;

	$data = "UPDATE Profiles SET buddies='$newbuddies' WHERE username='$tempusername'";
	$data2 = "UPDATE Profiles SET buddies='$newbuddies2' WHERE username='$username'";
	if ($conn->query($data) === TRUE) {
		if($conn->query($data2) === TRUE) {
			echo 1;
		}
		else
		{
			echo 0;
		}
	} else {
		echo 0;
	}

?>
