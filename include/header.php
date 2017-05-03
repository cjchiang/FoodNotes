<!DOCTYPE html>
<html>
<head>
	<title>FoodNotes</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../styles/bootstrap.min.css"/>
    <link rel="stylesheet" href="../styles/styles.css" />
    <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
</head>
    <body>
        <div class="container-fluid">
            <div class="row topMenuBar">
                <div class="col-xs-4">
                    <a href="../index.php"><img id="logo" src="images/apple-158419_960_720.png" alt="Apple"/></a> 
                </div>
                <div class="col-xs-8 logAndSign">
                    <!--can use a php statement to see if user is already logged in or not and display stuff-->
                    <a href="../login.php"><button class="btn btn-warning" id="login">Login</button></a>
                    <a href="../signup.php"><button class="btn btn-success" id="signUp">Sign Up</button></a>
                </div>
            </div>
            <div class="row menuBar">
                <div class="col-xs-4">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><button class="btn btn-warning" id="Menu">Menu</button></a>
                        <ul class="dropdown-menu">
                            <li>Summary</li>
                            <li>Add Food</li>
                        </ul>
                </div>
                <div class="col-xs-4">
                    <p>Nothing Here Yet1</p>
                </div>
                <div class="col-xs-4">
                    <p>Nothing Here Yet2</p>
                </div>
            </div>
        </div>