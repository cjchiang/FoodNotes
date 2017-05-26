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
        $("#navButtons").css("display", "none");
		$("#specialNavi").css("display","block");
		$("#allbtn").css("display","block");
      } else {
        console.log("not logged in");
		$("#navButtons").css("display", "block");
		$("#specialNavi").css("display","none");
		$("#allbtn").css("display","none");
      }
});


	$("#registerBtn").click(function(){
		var email = $("#email").val()
		var password1 = $("#password1").val()
		var password2 = $("#password2").val()
		
		if (password1 != password2) {
			alert("Password fields do not match. Please try again");
			return;
		}
		var promise = firebase.auth().createUserWithEmailAndPassword(email, password1);
		promise.catch(function(e){ alert(e.message); });

	});

	$("#forgotPWBtn").click(function(){
		var email = $("#email").val()
		if (email == "") {
			alert("Please enter the email you signed up with, then try again")
			return;
		}
		var auth = firebase.auth();
		auth.sendPasswordResetEmail(email).then(function() {
			alert("A password reset email has been sent to above address.")		  
		}, function(e) {
		  //tried to use try block, caught nothing	
		  alert(e.message);
		});        
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
