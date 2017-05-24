var config = {
apiKey: "AIzaSyBLFamIM2JEo2ESjIEn1PIhbkuKyaXF9Ds",
authDomain: "food-notes-test.firebaseapp.com",
databaseURL: "https://food-notes-test.firebaseio.com",
projectId: "food-notes-test",
storageBucket: "food-notes-test.appspot.com",
messagingSenderId: "106608811518"
};

firebase.initializeApp(config);
firebase.auth().onAuthStateChanged(function(user) {
      if (user != null) {
        console.log("logged in");
        $("#navButtons").css("display", "none");
		$("#specialNavi").css("display","block");
		$("#allbtn").css("display","block");
		
		var db = firebase.database()	;
		db.ref("users").orderByChild("email").equalTo(user.email).on('child_added', function(snap){
		   	var childKey = snap.key;
		   	var userID = user.uid;
			if( childKey != userID) {
				var child = db.ref("users").child(childKey);
			  	db.ref("users").child(userID).set(snap.val());
			  	child.remove();
			}
		});	
      } else {
        console.log("not logged in");
		$("#navButtons").css("display", "block");
		$("#specialNavi").css("display","none");
		$("#allbtn").css("display","none");
      }
});

$(function(){
//main function: runs onload
	
	$("#logoutBtn").click(function(){
		firebase.auth().signOut();
		console.log("signed out");
	});

	$("#registerBtn").click(function(){
		var email = $("#email").val()
		var password = $("#password").val()
		var valid = true
		var promise = firebase.auth().createUserWithEmailAndPassword(email, password);
		promise.catch(function(e){ alert(e.message); valid = false; });

		if ( valid ) {		
			firebase.database().ref("users").push({
				"email" : email,
				"cycleCount" : 0
			});
		}
	});


	$("#loginBtn").click(function(){
		attempted = true;
		firebase.auth().signInWithEmailAndPassword($("#email").val(), $("#password").val());
	});

	$("#cancelBtn").click(function(){
		location.replace("index.php");
	});

});
