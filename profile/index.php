
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
	<link rel="stylesheet" href="../css/profiles.css" />

	<meta charset="utf-8" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
	<a href="../">Go Back</a>

	<h1>Welcome, <?php echo $_SESSION['username'] . " - " . $_SESSION['name'];?>!</h1>


</body>

</html>

