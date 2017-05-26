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
        console.log("not logged in");
        location.replace("index.php");
   } 
});

$(function(){ 
    $("#logoutBtn").click(function(){
        firebase.auth().signOut();
        alert("signed out");
    });
});


function checkOption() {
    var duration;
    var canLeave = false;
    var dateOption = document.getElementById("myCalendarChoice");
    if (dateOption.value === "biweekly") {
        window.alert("You've chosen the 14 day option");
        duration = "biweekly";
        canLeave = true;
    } else if (dateOption.value === "weekly") {
        window.alert("You've chosen the 7 day option");
        duration = "weekly";
        canLeave = true;
    } else if (dateOption.value === "monthly") {
        window.alert("You've chosen the 30 day option");
        duration = "monthly";
        canLeave = true;
    }
    if (canLeave) {
        logDuration(duration);
        location.replace("index.php")        
    } else {
        alert("Must choose a valid cycle duration!")
    }
}

function logDuration(duration) {
    if (typeof currentUser !== "undefined")
    database.ref("users/" + currentUser.uid).update({"cycleDuration" : duration});    
}



