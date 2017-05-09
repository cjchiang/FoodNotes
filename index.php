<?php include("include/header.php"); ?>
    <!-- main body will go here, body tags are already distributed to header and footer-->
<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase-auth.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBLFamIM2JEo2ESjIEn1PIhbkuKyaXF9Ds",
    authDomain: "food-notes-test.firebaseapp.com",
    databaseURL: "https://food-notes-test.firebaseio.com",
    projectId: "food-notes-test",
    storageBucket: "food-notes-test.appspot.com",
    messagingSenderId: "106608811518"
  };
  firebase.initializeApp(config);
</script>

<div style="background-color: lightgreen;">
    <p>I am home</p>
    <p>I am home</p>
    <p>I am home</p>
    <p>I am home</p>
    <p>I am home</p>
    <p>I am home</p>
    <p>I am home</p>
</div>

<?php include("include/footer.php"); ?>