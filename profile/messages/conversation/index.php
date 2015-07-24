<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		header('Location: ../../../login');
		die();
	}

	if(isset($_SESSION['lastactivity'])){
		$secondsInactive = time() - $_SESSION['lastactivity'];
		if($secondsInactive >= 600){ //10 minutes for each session before expiring
	        session_unset();
	        session_destroy();
			header('Location: ../../../login');
			die();
		}
		$_SESSION["lastactivity"] = time();
	}

	if(!isset($_POST["recipient"])){
		header('Location: ../');
		die();
	}

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

	$messages = $conn->query("SELECT * FROM Messages");

	$tempusername = $_SESSION["username"];
	$userquery = $conn->query("SELECT firstname, lastname, picture FROM Profiles where username='$tempusername'");
	$userResults = $userquery->fetch_assoc();
	$userPicture = $userResults["picture"];
	$userFullName = $userResults["firstname"] . " " . $userResults["lastname"];

	$recipient = $_POST["recipient"];
	$recipientQuery = $conn->query("SELECT firstname, lastname, picture FROM Profiles where username='$recipient'");
	$recipientResults = $recipientQuery->fetch_assoc();
	$recipientPicture = $recipientResults["picture"];
	$recipientFullName = $recipientResults["firstname"] . " " . $recipientResults["lastname"];
	
?>

<html lang="en">
<head>
	<title>Messages - Get Out!</title>
	<link rel="shortcut icon" href="../../../img/logo.ico">

	<link rel="stylesheet" href="../../../css/bootstrap.min.css" />
	<style>
		.userpic {
			width:50px;
			height:50px;
			border: 0px solid white;
			border-radius: 25px;
			margin:5px;
		}

		.messagescontainer {
			padding-top: 50px;
			height: 100%;
		}

		.ownmessage {
			float:right;
			width:70%;
			background-color:lightblue;
			padding:10px;
			border: 0px solid white;
			border-radius: 10px;
			margin:10px 0;
		}

		.othermessage {
			float:left;
			width:70%;
			background-color:lightgreen;
			padding:10px;
			border: 0px solid white;
			border-radius: 10px;
		}

		#viewmessagescontainer {
			border-top: 1px solid gray;
			border-bottom: 1px solid gray;
			height: 70%;
			overflow-y:auto;	
			overflow-x:hidden;	
		}

		#newmessage{
			margin-top:20px;
			resize:vertical;
		}
	</style>

	<meta charset="utf-8" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<script type="text/javascript" src="../../../js/jquery-1.11.1.min.js"></script>
	<script>

	function newMessage(message, sender, recipient){

		$.post("newmessage.php", {message: message, sender: sender, recipient: recipient}, function (response) {
			if(response != 0){
				var container = document.getElementById("viewmessagescontainer");
			    var sentmessage = document.createElement('div');

			    $("#newmessage").val("");

			    var userPicture = "<?php echo $userPicture; ?>";
			    sentmessage.innerHTML = "<div class='row'><div class='col-md-12'><div class='userpic' style='float:right;background:url(\"../../" + userPicture + "\") no-repeat center;background-size: cover;'></div><div class='ownmessage'>" + response + "</div></div></div>";

			    while (sentmessage.firstChild) {
			        container.appendChild(sentmessage.firstChild);
			    }
			}
			else{
				alert("Message failed to send. Please try again later.");
			}


		});
	}

	function addBuddy(username){
		$.post("addBuddy.php", {username:username}, function (response) {
			if(response == 1)
				window.location.href = "../../";
			else if(response == 0)
				alert("Failed to add buddy. Please try again later.");
			else if(response == 2)
				alert("You already added this person!");
		});
	}

	</script>

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" style="margin:0" id="mainNavBar" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="../"><div class="glyphicon glyphicon-cloud"></div> Back to Messages</a>
			</div>
		</div>
	</nav>
	<div class="container messagescontainer">
		<div clas="row">
			<div class="col-md-12">
				<h1 style="text-align:center">Message with <?php echo $recipientFullName; ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="viewmessagescontainer">
					<?php 
						if ($messages->num_rows > 0) {
						    while($row = $messages->fetch_assoc()) {
						    	if($row["username"] === $_SESSION["username"] && $row["username2"] === $recipient){
						    		echo "<div class='row' style='margin:5px 0'>
						    			<div class='col-md-12'>
						    				<div class='userpic' style='float:right;background: url(\"../../" . $userPicture . "\") no-repeat center;
												background-size: cover;'>
											</div>
						    				<div class='ownmessage'>
						    					" . $row["message"] . "
						    				</div>
						    			</div>
						    		</div>";
						    	}
						    	else if($row["username2"] === $_SESSION["username"] && $row["username"] === $recipient){
						    		echo "<div class='row' style='margin:5px 0'>
						    			<div class='col-md-12'>
						    				<div class='userpic' style='float:left;background: url(\"../../" . $recipientPicture . "\") no-repeat center;
												background-size: cover;'>
											</div>
						    				<div class='othermessage'>
						    					" . $row["message"] . "
						    				</div>
						    			</div>
						    		</div>";
						    	}
						    }
						}

					?>
				</div>
				<form class="form-horizontal">
					<div class="form-group">
						<textarea class="form-control" id="newmessage" placeholder="Type here" name="message"></textarea>
					</div>
					<div class="form-group">
						<?php
							echo '<button type="button" 
							onClick="newMessage(message.value, \'' . $_SESSION["username"] . '\', \'' . $recipient . '\')" class="btn btn-info">Send</button>';
						?>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>