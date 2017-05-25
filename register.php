<!DOCTYPE html>
<html>
<head>
	<title>FoodNotes</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="styles/materialize.min.css"/>
	<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
	<link rel="stylesheet" href="styles/styles.css" />
	<script src="script/login.js" type="text/javascript"></script>
	<script src="script/easterEgg.js" type="text/javascript"></script>
	<link rel="icon" href="../images/favicon.png"/>
	<script type="text/javascript">
	var attempted = false;
	firebase.auth().onAuthStateChanged(function(firebaseUser){
		if (firebaseUser) {
			console.log("signed in")
			location.replace("index.php");
		} else if (attempted) {
			alert("Invalid username or password!");
		} else {
			console.log(firebaseUser + " is not a valid user");
		}
	});

	</script>
</head>
<body style="background-image: url(images/food_background3.jpg); background-size: 100%">
	<br/>
	<div class ="row">
		<div class="col s12 center-align">
			<a href="index.php"><img id="logo" src="images/horizontalLogo.png" alt="Logo"/></a>
		</div>
	</div>
	<div class="container white-text center-align">
		<div id="login_form" class="z-depth-1 green darken-2">
			<div class="row">
				<!-- <form class="col s12" method="post"> -->
				<div class='row'>
					<div class='input-field col s12'>
						<input class='validate' type='email' name='email' id='email' />
						<label for='email'>Enter your email</label>
					</div>
				</div>

				<div class='row'>
					<div class='input-field col s12'>
						<input class='validate' type='password' name='password' id='password' />
						<label for='password'>Enter your password</label>
					</div>
				</div>
				<div class='row'>
					<div class='input-field col s12'>
						<input class='validate' type='password' name='password' id='password' />
						<label for='password'>Confirm your password</label>
					</div>
				</div>
				<br />
				<center>
					<div class='row'>
						<button id="registerBtn" name='btn_register' class='col s12 btn btn-large waves-effect red darken-4'>Sign Up</button>
					</div>
				</center>
				<!-- </form> -->
			</div>
		</div>
	</div>
</body>
</html>
