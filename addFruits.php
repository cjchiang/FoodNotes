<?php include("include/header.php"); ?>
    <!-- main body will go here, body tags are already distributed to header and footer-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
<script src="script/addItems.js" type="text/javascript"></script>
<script type="text/javascript">
	var currentUser;
	var currentUserNode;
	firebase.auth().onAuthStateChanged(function(user) {
	if (user != null) {
		currentUser = firebase.auth().currentUser;
		currentUserNode = users.child(currentUser.uid);

		if ( noCyclesFound() ) {
			console.log("creating cycle");
			setUpCycleCount();
		} else {
			console.log("cycle exists");
		}
	} 
	});


	$("#search").ready(function(){
		$(document).keyup( function(key) {
			filterProducts($("#search").val(), "Fruit");
		});
		populateList("Fruit");
	});

	//add new item to temporary list
	function addItem(foodName, refKey){
		var foodName = foodNameID.split("_").join(" ");
		var price;

		var priceStr = $("#" + foodNameID + "_bought").attr("placeholder");
		var price_default = priceStr.replace("$", "");	
		
		var price_set = $("#" + foodNameID + "_bought").val();
		// use default price if set price is empty string or not numeric
		if (price_set == "" || !isNumeric(price_set) ) {
			price = parseFloat(price_default) ;
		} else {
			price = parseFloat(price_set) ;
		}

		currentUserNode.once("value", function(){
			var tempCycle = currentUserNode.child("temp");
			tempCycle.once("value", function(){
				var item = foods.child(refKey);
				item.once("value", function(snap){
					var newKey = tempCycle.push( snap.val() ).key;

					tempCycle.child(newKey).update({"your_price" : price});
				});
			});
		});
	}

	//add more of an existing item to temporary list
	function appendItem(foodNameID, refKey){
		var foodName = foodNameID.split("_").join(" ");
		var price;

		var priceStr = $("#" + foodNameID + "_bought").attr("placeholder");
		var price_default = priceStr.replace("$", "");	
		
		var price_set = $("#" + foodNameID + "_bought").val();
		// use default price if set price is empty string or not numeric
		if (price_set == "" || !isNumeric(price_set) ) {
			price = parseFloat(price_default) ;
		} else {
			price = parseFloat(price_set) ;
		}

		currentUserNode.once("value", function(){
			var tempCycle = currentUserNode.child("temp");
			tempCycle.orderByChild("product").equalTo( foodName ).on("child_added", function(snap){
				var snapData = snap.val();
				var appendTarget = tempCycle.child(snap.key);
				var old_price = parseFloat( snapData.your_price ) ;

				price = (price + old_price).toFixed(2);

				appendTarget.update({"your_price" : price });
			});
		});
	}

	// function i pulled from stack overflow(not mine):
	// https://stackoverflow.com/questions/18082/validate-decimal-numbers-in-javascript-isnumeric
	function isNumeric(n) {
	  return !isNaN(parseFloat(n)) && isFinite(n);
	}

	function noCyclesFound(){
		var count;
		currentUserNode.on("value", function(snap){
			count = snap.val().cycleCount;
		});
		console.log(count);
		return count;
	}
	function setUpCycleCount() {
		currentUserNode.once("value", function(snap){
			userNode.child("cycleCount").set(1);
		});
	}

</script>
	<div class="row">
		<!-- for the icon arrow -->
		<div class="col s6 left-align">
			<a href="addFood.php" class="btn waves-effect waves-light green">Back</a>
		</div>
		<div class="col s6 right-align">
			<a class="btn waves-effect waves-light green" onclick="logAllItems()">Add Items</a>
		</div>
	</div>
	<div class="row">
	<!-- for the heading "Add Fruits" and its image-->
		<div class="col s12 center-align">
			<h4> Add Fruits </h4>
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
<!-- List the items of fruits for the users to choose and enter the price-->
	<div class="row">
		<form action="#" class="col s12" id="anchor_head">
			<!-- <input type="submit" value="Add" id="submitBtn" hidden/> -->
            <div class="row center">
                <div class="col s6">
                    Product Name
                </div>
                <div class="col s6">
                    Price $ 
                </div>
            </div>
   		</form>
	</div>

<?php include("include/footer.php"); ?>
