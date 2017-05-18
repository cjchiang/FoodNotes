<?php include("include/header.php"); ?>
<!-- main body will go here, body tags are already distributed to header and footer-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
<script type="text/javascript">
	var config = {
	    apiKey: "AIzaSyBLFamIM2JEo2ESjIEn1PIhbkuKyaXF9Ds",
	    authDomain: "food-notes-test.firebaseapp.com",
	    databaseURL: "https://food-notes-test.firebaseio.com",
	    projectId: "food-notes-test",
	    storageBucket: "food-notes-test.appspot.com",
	    messagingSenderId: "106608811518"
	  };
	  firebase.initializeApp(config);
	const database = firebase.database();
	const foods = database.ref("foods");

	$("#search").ready(function(){
		// ! incl. backspace & del keys
		// $(document).keypress( function(key){

		// incl. delete keys, but 1 char beind input
		// $(document).keydown( function(key){

		// incl. delete keys, and updates in perfect sync with keyboard
		$(document).keyup(function(key){
			// console.log("input field value:" + $("#search").val());
			filterProducts($("#search").val() );
		});
	});

	function filterProducts( searchTerm ) {
		foods.orderByChild("category").equalTo("Meat").on("child_added", function(snap){
			var snapData = snap.val();
			var foodItem = document.getElementById(snap.key);
			if( foodItem != null && !contains(searchTerm, snapData.product) ) {
				hideme(snap.key, true);
				// scroll_to_elem(removeSpaces(snapData.product), 250)
			}
		});
	}

	// hide or display an element with animation
	function hideme(elemID, toggle){
		if( toggle)
			$("#" + elemID).fadeOut(500);
		else
			$("#" + elemID).fadeIn(1000);
	}

	// returns true if target contains query string, strings are case insensitive
	function contains( queryStr, targetStr) {
		queryStr = queryStr.toLowerCase();
		targetStr = targetStr.toLowerCase();
		if ( targetStr.search(queryStr) != -1)
			return true;
		return false;
	}

	// replace strings in item with underscores, used to create css IDs
	function removeSpaces(str){
		var newStr = str.split(' ').join('_');
		return newStr;
	}

	// ununsed function, scrolls to an element
	function scroll_to_elem(elemID, scrollSpeed) {
	    $('html, body').animate({
	        scrollTop: $("#" + elemID).offset().top
	    }, scrollSpeed);
	}

</script>
<div class="container white-text green lighten-1">
	<div class="row">
		<!-- for the icon arrow -->
		<div class="col s6 left-align">
			<a href="addFood.php" class="btn waves-effect waves-light green">Back</a>
		</div>
	</div>
	<!-- for the heading "Add meat" and its image-->
	<div class ="row">
		<div class="col s12 center-align">
			<h3> Add Meats </h3>
		</div>
	</div>
	<!-- Search bar -->
	<div class="row">
		<form action="#" class="col s12">
			<div class="row">
				<div class="input-field col s12">
					<label for="search"><i class="material-icons">search</i></label>
					<input id="search" type="search">
				</div>
			</div>
		</form>
	</div>
	<!-- List the items of meat for the users to choose and enter the price-->
	<div class="row">
		<form action="processFood.php" method="POST" class="col s12" id="anchor_head">
            <input type="submit"  value="Add"/>
            <div class="row center">
                <div class="col s6">
                    Product Name
                </div>
                <div class="col s6">
                    ($)
                </div>
            </div>
		<form action="#" class="col s12" id="anchor_head">
			<script type="text/javascript">

				/*Populates a drop down with meat food itemns, based on text inside search bar*/
				foods.orderByChild("category").equalTo("Meat").on("child_added", function(snap){
					var snapData = snap.val();
					var foodName = removeSpaces(snapData.product);
					var newFoodBlock = document.getElementById(snap.key);
					console.log(foodName);
				    if (!newFoodBlock) {
				      $("#anchor_head").append(
					'<div class="row" id ="' + snap.key + '">' +
					'<div class="input-field col s6">' +
						'<input type="checkbox" id="check_' + foodName + '"/>' +
						'<label for="check_' + foodName+ '"">' + snapData.product + '</label>' +
					'</div>' +
					'<div class="input-field col s6">' +
						'<input type="text" id="' + foodName + '_bought" placeholder="$' + snapData.price +
						'"/>' +
					'</div>' +
					'</div> ');
				    }
				});
			</script>
		</form>

	</div>



</div>
<!--<div class="container-fluid ourContent">
<div id="canvasSelect col-xs-12">
<canvas id="canvasSelection" width="500px" height="500px" style="border:1px solid black"></canvas>
</div>
</div>-->

<<<<<<< HEAD
<?php include("include/footer.php"); ?>
=======
<?php include("include/footer.php"); ?>
>>>>>>> develop
