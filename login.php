<!-- A temporary login page, based off made to be
	demonstrated during the sprint presentation.
	It's based off the login.php page I derived.

	It has awful styling and conventions, but it works;
	user can connect to firebase after signing in, and will
	return to index.php as a logged-in user.
 -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style type="text/css">

		body {
		padding-top: 15%;
		padding-bottom: 40px;
		background-color: #aaa;
		background-size: 100%;
		transform: scale(2.5);
		}

		.form-signin {
		max-width: 380px;
		padding: 15px 35px 45px;
		margin: 0 auto;
		background-color: #fff;
		border: 1px solid rgba(0,0,0,0.1);
		}
		.form-signin .form-signin-heading,
		.form-signin .checkbox {
		margin-bottom: 10px;
		}
		.form-signin .checkbox {
		font-weight: normal;
		font-size: 23px;
		}
		.form-signin .form-control {
		position: relative;
		height: auto;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		    box-sizing: border-box;
		padding: 10px;
		font-size: 23px;
		}
		.form-signin .form-control:focus {
		z-index: 2;
		}
		.form-signin input[type="username"] {
		margin-bottom: -1px;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;
		}
		.form-signin input[type="password"] {
		margin-bottom: 10px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		}

		.container {
		margin-top: 80px;
		margin-bottom: 80px;
		}

		footer {
		position: fixed;
		bottom: 0;
		width: 100%;
		}
        </style>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
		<script>
		  // Initialize Firebase
		  var config = {
		    apiKey: "AIzaSyBLFamIM2JEo2ESjIEn1PIhbkuKyaXF9Ds",
		    authDomain: "food-notes-test.firebaseapp.com",
		    databaseURL: "https://food-notes-test.firebaseio.com",
		    projectId: "food-notes-test",
		    storageBucket: "food-notes-test.appspot.com",
		    messagingSenderId: "106608811518"
		  };
		  firebase.initializeApp(config);
		 </script>
	</head>
	<body>
    <div class="container">
    <div class="col-sm-3"></div>
    <div class="col-sm-9">

      <div class="form-signin" action="login.php" method="POST">
        <h2 class="form-signin-heading">Please sign in:</h2>

        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>

       	<div class="col-sm-6">
        <button class="btn btn-lg btn-primary btn-block" value="Login" type="submit" id="loginBtn">Sign in</button>
       	</div>

      <div class="col-sm-6">
        <button class="btn btn-lg btn-primary btn-block" value="Login" type="submit" id="cancelBtn">Cancel</button>
       	</div>

      </div>
      <script type="text/javascript">
      	var attempted = false;

		$("#loginBtn").click(function(){
			firebase.auth().signInWithEmailAndPassword($("#inputUsername").val(), $("#inputPassword").val());
			attempted = true;
		});

		$("#cancelBtn").click(function(){
			location.replace("index.php");
		});

		firebase.auth().onAuthStateChanged(function(firebaseUser){
			if (firebaseUser) {
				location.replace("index.php");
			} else if (attempted) {
				alert("Invalid username or password!");
			} else {
				console.log(firebaseUser + " is not a valid user");
			}
		});

	</script>
    </div>
    </div>
    <footer class="navbar-fixed-bottom">Copyright &#9400; 2017 Riolet Corporation</footer>
	</body>
</html>
