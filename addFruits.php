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


	// $(document).ready(function(){
	// 	setInterval(filterProducts, 250);
	// });

	// scroll to element, scrollSpeed in ms
	function scroll_to_elem(elemID, scrollSpeed) {
	    $('html, body').animate({
	        // scrollTop: $("#" +  elemID).offset().top
	        scrollTop: $("#click_Apples").offset().top
	    }, scrollSpeed);
	}	
		
	$("#search").ready(function(){
		$(document).keypress( function(key){
			console.log("key pressed value:" + $("#search").val());
			filterProducts($("#search").val() );
		});
	});

	function filterProducts( searchTerm) {
		// console.log("im running outside");
		foods.orderByChild("category").equalTo("Fruit").once("child_added", function(snap){
			var snapData = snap.val();
			var foodItem = document.getElementById(snap.key);
			// var searchQuery = $("#search").val();
			// console.log("im running");
			console.log("foodItem elem: " + foodItem);
			console.log("query result: " + contains(searchTerm, snapData.product));
			if( foodItem && contains(searchTerm, snapData.product) ) {
				console.log("im stopped");
				scroll_to_elem(removeSpaces(snapData.product), 250);
				// foods.orderByChild("category").equalTo("Fruit").off("child_added");
			} else {
				console.log("i cant");
			}	
		});
	}

	function contains( queryStr, targetStr) {
		console.log("qu: " + queryStr + " | target: " + targetStr);
		if ( targetStr.search(queryStr) != -1)
			return true;
		return false;
	}

	function removeSpaces(str){
		var newStr = str.split(' ').join('_');
		return newStr;
	}
</script>

<div class="container">
	<div class="row">
	<!-- for the icon arrow -->
		<div class="col s12">
			<h4><a href="addFood.php"><i class="small material-icons">arrow_left</i> Back </a> </h4>
		</div>
<!-- for the heading "Add Fruits" and its image-->		
		<div class="col s12 center-align">
			<h4> Add Fruits </h4>
		</div>
		<div class="col s12 center-align">
			<img src="/images/fruits.png">
		</div>
	</div>
	
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
<!-- List the items of fruits for the users to choose and enter the price-->		
	<div class="row">
		<form action="#" class="col s12" id="anchor_head">
			
			<script type="text/javascript">
						foods.orderByChild("category").equalTo("Fruit").on("child_added", function(snap){
							var snapData = snap.val();
							var foodName = removeSpaces(snapData.product);
							var newFoodBlock = document.getElementById(snap.key);
							console.log(foodName);
						    if (!newFoodBlock) {
						      $("#anchor_head").append(
							'<div class="row" id ="' + snap.key + '">' +
								'<a href="#' + foodName + '" id="click_' + foodName +'"></a>'+
								'<a name="' + foodName + '"></a>'+
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

<?php include("include/footer.php"); ?>