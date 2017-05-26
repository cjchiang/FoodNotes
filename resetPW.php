<!DOCTYPE html>
<html>
<head>
<!-- Page where users who've forgotten their passwords come. Sends a confirmation to user email for them to reset password to their account; all JS code involved is in login.js-->
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
        <h5>Please enter the email linked with your account</h5>
        <!-- <form class="col s12" method="post"> -->
          <div class='row'>
            <div class='input-field col s12'>
              <input class='validate' type='email' name='email' id='email' />
              <label for='email'>Enter your email</label>
            </div>
          </div>
          <br />
          <center>
            <div class='row'>
              <a id="forgotPWBtn" class='col s12 btn btn-large waves-effect green accent-4'>Reset Password</a>
          </center>
        <!-- </form> -->
      </div>
    </div>
  </div>
</body>
</html>
