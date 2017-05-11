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
  <h1 style="text-align: center"><strong>CONTACT US</strong></h1>
  <div class="container green lighten-1 ">
    <form>
      <label for="firstname">First Name</label>
      <input type="text" id="fname" name="first_name" placeholder="First Name..">
      <label for="lastname">Last Name</label>
      <input type="text" id="lname" name="last_name" placeholder="Last Name..">
      <label for="email">Email</label>
      <input type="text" id="email" name="email" placeholder="email">
      <label for="subject">Subject</label>
      <textarea id="subject" name="subject" placeholder="Comment/Question" style="height:200px"></textarea>
      <div class="center-align">
      <a class="waves-effect waves-light btn green lighten-3">
        <input type="submit" id="submit1" value="Submit">
      </a>
    </div>
    </form>
  </div>
  </div>
  <?php include("include/footer.php"); ?>
