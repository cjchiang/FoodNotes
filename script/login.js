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
		alert("Signed out!");
	});
});

firebase.auth().onAuthStateChanged(function(firebaseUser){
	if (firebaseUser) {
		$("#logoutBtn").css("display", "block");
		$("#loginBtn").css("display", "none");
		$("#signupBtn").css("display", "none");
		alert("Signed in!");
	} else {
		$("#logoutBtn").css("display", "none");
		$("#loginBtn").css("display", "block");
		$("#signupBtn").css("display", "block");

		console.log(firebaseUser + " is not a valid user");
	}
});	
