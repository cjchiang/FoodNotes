<<<<<<< HEAD
var config = {
apiKey: "AIzaSyBLFamIM2JEo2ESjIEn1PIhbkuKyaXF9Ds",
authDomain: "food-notes-test.firebaseapp.com",
databaseURL: "https://food-notes-test.firebaseio.com",
projectId: "food-notes-test",
storageBucket: "food-notes-test.appspot.com",
messagingSenderId: "106608811518"
};

firebase.initializeApp(config);
firebase.auth().onAuthStateChanged(function(firebaseUser){
    if (!firebaseUser) {
        alert("Not logged in");
        location.replace("index.php");
   } 
});

=======
var config = {
apiKey: "AIzaSyBLFamIM2JEo2ESjIEn1PIhbkuKyaXF9Ds",
authDomain: "food-notes-test.firebaseapp.com",
databaseURL: "https://food-notes-test.firebaseio.com",
projectId: "food-notes-test",
storageBucket: "food-notes-test.appspot.com",
messagingSenderId: "106608811518"
};

firebase.initializeApp(config);
firebase.auth().onAuthStateChanged(function(firebaseUser){
    if (!firebaseUser) {
        alert("Not logged in");
        location.replace("index.php");
   } 
});

>>>>>>> 7dad581f0226bdd8e606429f8e1f191ad96b5759
