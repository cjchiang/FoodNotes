<!DOCTYPE html>
<html>
<head>
	<title>FoodNotes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="../images/HorizontalLogo.png">
    <meta property="og:image:type" content="../images/logo.png">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="styles/materialize.min.css"/>
	<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
	<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
    <link rel="stylesheet" href="../styles/styles.css" />
    <script src="script/login.js" type="text/javascript"></script>
		<script src="script/easterEgg.js" type="text/javascript"></script>
    <link rel="icon" href="../images/favicon.png"/>
	</head>
    <body background="images/lined_paper.png">
		</br>
			<div class="row">
					<div class="col s12 center-align">
							<a href="index.php"><img id="logo" src="images/horizontalLogo.png" alt="Apple" /></a>
					</div>
			</div>
			<div  id="easterEggSearch" class="container white-text green darken-2">
				<div class="row">
					<div class="input-field col s12">
						<label for="easterEgg"><i class="material-icons">search</i></label>
						<input id="easterEgg" type="search"/>
					</div>
				</div>
				<audio id="easterAudio" src="images/9000.wav"></audio>
			</div>
		</br>
			<div class="row" id="navButtons">
					<div id="loginBtn" class="col s5 left-align">
							<a href="login.php" class="btn waves-effect waves-light red darken-4" hidden>Login</a>
					</div>
					<div id="easterEggBtn" class="col s2 center-align">
							<a class="btn waves-effect waves-light green"></a>
					</div>
					<div id="signupBtn" class="col s5 right-align">
							<a href="register.php" class="btn waves-effect waves-light red darken-4" hidden>Sign Up</a>
					</div>
			</div>
			<nav class="green darken-2">
					<div class="nav-wrapper">
							<ul id="nav-mobile" class="left">
									<li><a href="index.php">Home</a><li>
									<li><a href="aboutUsDevs.php">About Us</a></li>
									<li><a href="Contact.php">Contact Us</a></li>
									<li><a href="affiliatedApps.php">Affiliates</a></li>
							</ul>
					</div>
			</nav>
	</br>
	<div class="container green darken-2 white-text">
