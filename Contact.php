<!-- This page is about Contact us. Users can enter their First Name, Last Name, email and subject. After they finish everything, they can press submit button -->

<?php include("include/menuHeader.php"); ?>
<!--Contact Us form for users-->
<<<<<<< HEAD

<?php 

if ($_POST) {
$to = 'foodnote13@gmail.com';
$subject = 'testing';
$firstN = $_POST['first_name'];
$lastN = $_POST['last_name'];
$email = $_POST['email'];
$message = $_POST['message'];
    
$body = <<<EMAIL

Hi, My name is $firstN . $lastN.
    
$message
    
    
From $firstN . $lastN.
Sender's email: $email
    
EMAIL;
    
$header = "From: $email";
        mail($to,$subject,$message,$header);
}
?>
=======
>>>>>>> 7dad581f0226bdd8e606429f8e1f191ad96b5759
  <div class="row white-text center-align">
    <h3><strong>Contact Us</strong></h3>
  </div>
  <div class="row">
    <form class ="col s12" action="?" method="post">
      <div class="row">
        <div class="input-field col s6">
          <label for="first_name">First Name</label>
          <input type="text" id="first_name" name="first_name" />
        </div>
        <div class="input-field col s6">
          <label for="last_name">Last Name</label>
          <input type="text" id="last_name" name="last_name" />
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <label for="email">Email</label>
          <input id="email" type="email" name="email" class="validate" />
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <label for="message">Message</label>
          <textarea id="subject" name="message" class="materialize-textarea"></textarea>
        </div>
      </div>
      <div class="center-align">
        <a class="waves-effect waves-light btn green lighten-3">
          <input type="submit" id="submit" value="Submit">
        </a>
      </div>
    </form>
  </div>
<?php include("include/footer.php"); ?>
