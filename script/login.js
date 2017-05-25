var config = {
	apiKey: "AIzaSyBLFamIM2JEo2ESjIEn1PIhbkuKyaXF9Ds",
	authDomain: "food-notes-test.firebaseapp.com",
	databaseURL: "https://food-notes-test.firebaseio.com",
	projectId: "food-notes-test",
	storageBucket: "food-notes-test.appspot.com",
	messagingSenderId: "106608811518"
};

firebase.initializeApp(config);

//main function: runs onload
$(function(){

	firebase.auth().onAuthStateChanged(function(user) {
      if (user != null) {
        console.log("logged in");

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
      }
	});

	firebase.auth().onAuthStateChanged(function(user) {
      if (user != null) {
    $("#navButtons").css("display", "none");
		$("#specialNavi").css("display","block");
		$("#allbtn").css("display","block");
      } else {
		$("#navButtons").css("display", "block");
		$("#specialNavi").css("display","none");
		$("#allbtn").css("display","none");
      }
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

	$("#forgotPWBtn").click(function(){
		var email = $("#email").val()
		if (email == "") {
			alert("Please enter the email you signed up with, then try again")
			return;
		}
		// var promise = firebase.auth().signInWithEmailAndPassword("admin", "admin1");
		// promise.catch(function(e){ alert(e.message); });
		// 	firebase.database().ref("users")
		var auth = firebase.auth();
		auth.sendPasswordResetEmail(email).then(function() {
			alert("A password reset email has been sent to above address.")
		}, function(e) {
		  //tried to use try block, caught nothing
		  alert(e.message);
		});
        // firebase.auth().signOut();
	});

	$("#loginBtnSubmit").click(function(){
		attempted = true;
		var email = $("#email").val()
		var password = $("#password").val()

		var promise = firebase.auth().signInWithEmailAndPassword(email, password);
		promise.catch(function(e){ alert(e.message); });
	});

	$("#cancelBtn").click(function(){
		location.replace("index.php");
	});

});
