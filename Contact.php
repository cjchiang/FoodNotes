<!-- This page is about Contact us. Users can enter their First Name, Last Name, email and subject. After they finish everything, they can press submit button -->

<?php include("include/menuHeader.php"); ?>
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
      <div class="center-align">
        <a class="waves-effect waves-light btn green lighten-3">
          <input type="submit" id="submit1" value="Submit">
        </a>
      </div>
    </form>
  </div>
</div>
<?php include("include/footer.php"); ?>
