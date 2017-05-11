<?php include("include/header.php"); ?>
<div class="row">
  <div class="col s12 center-align">
    <a href="index.php"><img id="logo" src="images/horizontalLogo.png" alt="Apple"/></a>
  </div>
</div>
<div class="row">
  <div class="col s6 left-align">
    <a class="btn waves-effect waves-light green">Login</a>
  </div>
  <div class="col s6 right-align">
    <a class="btn waves-effect waves-light green">Sign Up</a>
  </div>
</div>
<nav class="green">
  <div class="nav-wrapper">
    <ul id="nav-mobile" class="left">
      <li><a href="index.php">Home</a><li>
        <li><a href="aboutUs.php">About Us</a></li>
        <li><a href="Contact.php">Contact Us</a></li>
        <li><a href="RelatedApps.php">Related Apps</a></li>
      </ul>
    </div>
  </nav>

  <div class="container green lighten-1 ">
    <div class="row white-text center-align">
      <h2><strong>CONTACT US</strong></h2>
    </div>
    <div class="row">
      <form class ="col s12">
        <div class="row">
          <div class="input-field col s6">
            <input type="text" id="first_name" class="validate">
            <label for="first_name">First Name</label>
          </div>
          <div class="input-field col s6">
            <input id="last_name" class="validate">
            <label for="last_name">Last Name</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="email" type="email" class="validate">
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <textarea id="textarea1" class="materialize-textarea"></textarea>
            <label for="textarea1">Subject</label>
          </div>
        </div>
        <div class="left-align">
          <a class="waves-effect waves-light btn green lighten-3">
            <input type="submit" id="submit1" value="Submit">
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include("include/footer.php"); ?>
