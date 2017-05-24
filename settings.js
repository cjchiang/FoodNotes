// var config = {
//     apiKey: "AIzaSyBLFamIM2JEo2ESjIEn1PIhbkuKyaXF9Ds",
//     authDomain: "food-notes-test.firebaseapp.com",
//     databaseURL: "https://food-notes-test.firebaseio.com",
//     projectId: "food-notes-test",
//     storageBucket: "food-notes-test.appspot.com",
//     messagingSenderId: "106608811518"
//   };
//   firebase.initializeApp(config);
const database = firebase.database();
const foods = database.ref("foods");
var currentUser;

firebase.auth().onAuthStateChanged(function(user) {
      if (user != null) {
        currentUser = firebase.auth().currentUser;
        console.log("logged in");
      } else {
        console.log("not logged in");
        // TODO: before pushing to gitHub, uncomment below:
        // alert("You're not logged in you hacker! Go home!");
        // location.replace("index.php");
      }
});

function checkOption() {
    var duration;
    var canLeave = false;
    var dateOption = document.getElementById("myCalendarChoice");
    if (dateOption.value === "biweekly") {
        window.alert("you choose Biweekly option");
        duration = new Date(+new Date + 12096e5); // 12096e5 is 12 days 
        canLeave = true;
        document.getElementById("test").innerHTML = "2 week is" + " " + duration.getDate();
    } else if (dateOption.value === "weekly") {
        window.alert("you choose Weekly option");
        duration = new Date(+new Date + 6048e5); // 6048e5 is 7 days
        canLeave = true;
        document.getElementById("test").innerHTML = "1 week is" + " " + duration.getDate();
    } else if (dateOption.value === "monthly") {
        window.alert("you choose Monthly option");
        duration = new Date(+new Date + (12096e5*2) );
        canLeave = true;
        document.getElementById("test").innerHTML = "1 month is" + " " + duration.getDate();
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