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
<<<<<<< HEAD
  <h1 style="text-align: center"><strong>CONTACT US</strong></h1>
  <div class="container green lighten-1">
    <form>
      <label for="firstname" class="active">First Name</label>
      <input type="text" id="fname"  name="first_name" placeholder="First Name..">
      <label for="lastname" style="color :white">Last Name</label>
      <input type="text" id="lname" name="last_name" placeholder="Last Name..">
      <label for="email" style="color :white">Email</label>
      <input type="text" id="email" name="email" placeholder="email">
      <label for="subject" style="color :white">Subject</label>
      <textarea id="subject" name="subject" placeholder="Comment/Question" style="height:200px"></textarea>
      <div class="center-align">
      <a style=" background-color: #4CAF50;">
        <input type="submit" id="submit1" value="Submit" style=" background-color: #4CAF50;">
      </a>
    </div>
    </form>
  </div>

  <?php include("include/footer.php"); ?>
=======

  <div class="container green lighten-1 ">
    <div class="row white-text center-align">
      <h2><strong>Contact Us</strong></h2>
    </div>
    <div class="row">
      <form class ="col s12">
        <div class="row">
          <div class="input-field col s6">
            <input type="text" id="first_name">
            <label for="first_name">First Name</label>
          </div>
          <div class="input-field col s6">
            <input type="text" id="last_name">
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
<?php include("include/footer.php"); ?>
>>>>>>> eba04d0d61509d6dcfa674ed17d39bb3e1dad552
