<!DOCTYPE html>
<html>
<head>
	<title>FoodNotes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles/bootstrap.min.css"/>
    <link rel="stylesheet" href="../styles/styles.css" />
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
</head>
    <body>
        <div class="container-fluid topHeader hidden-xs">
            <div class="row menuBar">
                <div class="col-xs-4">
                    <p><a href="../index.php"><button class="btn btn-warning topMenu" id="goBackHome">Home</button></a></p>
                </div> 
				<div class="col-xs-4">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><button class="btn btn-warning topMenu">Menu</button></a>
                        <ul class="dropdown-menu">
                            <a href="../summary.php"><li>Summary</li></a>
                            <a href="../addFood.php"><li>Add Food</li></a>
                            <a href="../login.php"><li>Log In</li></a>
                            <a href="../signup.php"><li>Sign Up</li></a>
                        </ul>
                </div>
                <div class="col-xs-4">
                    <p><a href="../aboutUs.php"><button class="btn btn-warning topMenu" id="aboutUs">About Us</button></a></p>
                </div>
            </div>
        </div>
