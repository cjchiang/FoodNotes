var config = {
    apiKey: "AIzaSyBLFamIM2JEo2ESjIEn1PIhbkuKyaXF9Ds",
    authDomain: "food-notes-test.firebaseapp.com",
    databaseURL: "https://food-notes-test.firebaseio.com",
    projectId: "food-notes-test",
    storageBucket: "food-notes-test.appspot.com",
    messagingSenderId: "106608811518"
  };
firebase.initializeApp(config);

// Once user signed out or if user came via typing in url, brings them back home
firebase.auth().onAuthStateChanged(function(firebaseUser){
    if (!firebaseUser) {
        console.log("not logged in");
        location.replace("index.php");
   } 
});

// onclick function for logout btn, doesn't work unless i put it into document ready
$(function(){ 
    $("#logoutBtn").click(function(){
        firebase.auth().signOut();
        alert("signed out");
    });
});

/*Check the drop down list and act on their value;
  Changes the cycle duration settings for the user. */
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
        firebase.database().ref("users/" + firebase.auth().currentUser.uid).child("cycleDuration").set(duration);    
        // 750 ms is fastest firebase updates its value(w. my wifi) before we can leave (duration var destroyed)
        setTimeout(leaveAfterCount, 750);
    } else {
        alert("Must choose a valid cycle duration!")
    }
}

/*Leave for homepage about a count down. Should be called with a timeOut*/
function leaveAfterCount(duration) {
    location.replace("index.php");        
}



