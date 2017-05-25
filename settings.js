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
        window.alert("you choose Biweekly option");
        // duration = new Date(+new Date + 12096e5); // 12096e5 is 12 days 
        duration = "biweekly";
        canLeave = true;
        // document.getElementById("test").innerHTML = "2 week is" + " " + duration.getDate();
    } else if (dateOption.value === "weekly") {
        window.alert("you choose Weekly option");
        // duration = new Date(+new Date + 6048e5); // 6048e5 is 7 days
        duration = "weekly";
        canLeave = true;
        // document.getElementById("test").innerHTML = "1 week is" + " " + duration.getDate();
    } else if (dateOption.value === "monthly") {
        window.alert("you choose Monthly option");
        // duration = new Date(+new Date + (12096e5*2) );
        duration = "monthly";
        canLeave = true;
        // document.getElementById("test").innerHTML = "1 month is" + " " + duration.getDate();
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

function requestFinalize() {
    var userConfirmation = confirm("Are you sure\nCurrent cycle will early");
    if (userConfirmation)
        finalize();
}
    function finalize() {
        alert("Ending current cycle");
        // finalizeStats();
        // addCycle();
        // location.replace("notes.php");
    }

    function finalizeStats() {
        var old_meat_total = parseFloat ( $("#Meat_body_total").text().replace("$", "") );
        var old_fruit_total = parseFloat ( $("#Fruit_body_total").text().replace("$", "") );
        var old_veg_total = parseFloat ( $("#Vegetable_body_total").text().replace("$", "") );
        var old_dairy_total = parseFloat ( $("#Dairy_body_total").text().replace("$", "") );

        var current_meat_total = parseFloat ( $("#Meat_body_total").attr("name") );
        var current_fruit_total = parseFloat ( $("#Fruit_body_total").attr("name") );
        var current_veg_total = parseFloat ( $("#Vegetable_body_total").attr("name") );
        var current_dairy_total = parseFloat ( $("#Dairy_body_total").attr("name") );

        var Meat_percent = current_meat_total / old_meat_total;
            if ( isNaN(Meat_percent) ) {
                Meat_percent = 0
            }
        var Fruit_percent = current_fruit_total / old_fruit_total;
            if ( isNaN(Fruit_percent) )
                Fruit_percent = 0
        var Vegetable_percent = current_veg_total / old_fruit_total;
            if ( isNaN(Vegetable_percent) )
                Vegetable_percent = 0
        var Dairy_percent = current_dairy_total / old_dairy_total;
            if ( isNaN(Dairy_percent) )
                Dairy_percent = 0

        // var curr_sum = $("#curr_total").text().replace("$", "")
        // var orig_sum = $("#orig_total").text().replace("$", "")
        var percent_wasted = $("#total_waste_percent").text().replace("%", "");

        lastCycle.update({"percent_wasted" : percent_wasted });
        lastCycle.update({"Meat_percent" : Meat_percent.toFixed(2) });
        lastCycle.update({"Fruit_percent" : Fruit_percent.toFixed(2) });
        lastCycle.update({"Vegetable_percent" : Vegetable_percent.toFixed(2) });
        lastCycle.update({"Dairy_percent" : Dairy_percent.toFixed(2) });
    }
   
    function addCycle() {
        var user = firebase.auth().currentUser;
        var userNode = users.child(user.uid);

        userNode.once("value", function(snap){
            var count = snap.val().cycleCount;
            var cycleIndex = "cycle" + count;
            count++;
            userNode.child("cycleCount").set(count);
        });
    }