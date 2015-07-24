<?php
	session_start();

	if(!isset($_POST["username"])){
		die();
	}

	$_SESSION["recipient"] = $_POST["username"];
?>
