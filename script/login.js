var config = {
apiKey: "AIzaSyBLFamIM2JEo2ESjIEn1PIhbkuKyaXF9Ds",
authDomain: "food-notes-test.firebaseapp.com",
databaseURL: "https://food-notes-test.firebaseio.com",
projectId: "food-notes-test",
storageBucket: "food-notes-test.appspot.com",
messagingSenderId: "106608811518"
};

firebase.initializeApp(config);

$("#logoutBtn").ready(function(){
	$("#logoutBtn").click(function(){
		firebase.auth().signOut();
		console.log("signed out");
	});
});


$(document).ready(function() {
    firebase.auth().onAuthStateChanged(function(firebaseUser){
	   	if (firebaseUser) {
			$("#navButtons").css("display", "none");
			$("#specialNavi").css("display","block");
			$("#allbtn").css("display","block");

			console.log("user signed in");
			//queries to makes sure user key is same as user ID,
			//if not, replaces it with one
			var db = firebase.database();
    		db.ref("users").orderByChild("email").equalTo(firebaseUser.email).on('child_added', function(snap){
			   	var childKey = snap.key;
			   	var userID = firebaseUser.uid;
				if( childKey != userID) {
					var child = db.ref("users").child(childKey);
				  	db.ref("users").child(userID).set(snap.val());
				  	child.remove();
				}
			});
	   	} else {
          $("#navButtons").css("display", "block");
          $("#specialNavi").css("display","none");
          $("#allbtn").css("display","none");

		  console.log(firebaseUser + " is not a valid user");
	   }
    });
});
