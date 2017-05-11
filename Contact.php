<!DOCTYPE html>
<html>
<?php include("include/header.php"); ?>
    
     <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
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
            <div class="submit0">
                <input type="submit" id="submit1" value="Submit">
            </div>
        </form>
    </div>










    <?php include("include/footer.php"); ?>

</html>