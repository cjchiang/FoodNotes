<!DOCTYPE html>
<html>
<head>
	<title>FoodNotes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles/bootstrap.min.css"/>
    <link rel="stylesheet" href="../styles/styles.css" />
    <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        //firebase init code, DON'T TOUCH!
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
        <!--<div class="container-fluid topHeader">
            <div class="row topMenuBar">
                <div class="col-xs-4">
                    <a href="../index.php"><img id="logo" src="images/logo.png" alt="Apple"/></a> 
                </div>
                <div class="col-xs-8 logAndSign">
                    can use a php statement to see if user is already logged in or not and display stuff
                    <a href="../login.php"><button class="btn btn-warning" id="login">Login</button></a>
                    <a href="../signup.php"><button class="btn btn-success" id="signUp">Sign Up</button></a>
                </div>
            </div>
            <div class="row menuBar">
                <div class="col-xs-4">
                    <p>Nothing Here Yet1</p>
                </div> 
				<div class="col-xs-4">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><button class="btn btn-warning" id="Menu">Menu</button></a>
                        <ul class="dropdown-menu">
                            <a href="../summary.php"><li>Summary</li></a>
                            <a href="../addFood.php"><li>Add Food</li></a>
                        </ul>
                </div>
                <div class="col-xs-4">
                    <p>Nothing Here Yet2</p>
                </div>
            </div>
        </div>-->
