<?php include("include/header.php"); ?>
    <!-- main body will go here, body tags are already distributed to header and footer-->
    <p>you're on settings</p>
        <div class="container-fluid">
            <div class="row">
                <!--can use a php statement to see if user is already logged in or not and display stuff-->
                <div class="col-sm-6">
                    <a href="../login.php"><button class="btn btn-warning" id="login">Login</button></a>
                </div>
                <div class="col-sm-6">
                    <a href="../signup.php"><button class="btn btn-success" id="signUp">Sign Up</button></a>
                </div>
            </div>
        </div>
<?php include("include/footer.php"); ?>