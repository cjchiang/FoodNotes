<?php include("include/header.php"); ?>
    <!-- main body will go here, body tags are already distributed to header and footer-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
<script src="script/addItems.js" type="text/javascript"></script>
<script type="text/javascript">

	$("#search").ready(function(){
		$(document).keyup( function(key) {
			filterProducts($("#search").val(), "Fruit");
		});
		populateList("Fruit");
	});

	var currentUser;
	var currentUserNode;
	//append item to temporary list
	function appendItem(foodName, refKey){
		
		var quantity;
		var quantity_set = $("#" + foodName + "_quantity").val();
		var quantity_default = $("#" + foodName + "_quantity").attr("placeholder");
		var price;
		var unit_price = $("#" + foodName + "_bought").val();
		
		if (quantity_set == "") {
			price = (parseFloat(quantity_default) * unit_price ).toFixed(2);
			quantity = quantity_default;
		} else {
			price = (parseFloat(quantity_set) * unit_price ).toFixed(2);
			quantity = quantity_default
		}

		currentUserNode.once("value", function(){
			var tempCycle = currentUserNode.child("temp");
			tempCycle.once("value", function(){
				var item = foods.child(refKey);
				item.once("value", function(snap){
					var newKey = tempCycle.push( snap.val() ).key;
					tempCycle.child(newKey).update({"your_price" : price});
					tempCycle.child(newKey).update({"price" : unit_price});
					tempCycle.child(newKey).update({"default_quantity" : quantity});
				});
			});
		});
	}

	firebase.auth().onAuthStateChanged(function(user) {
	  if (user != null) {
	  	currentUser = firebase.auth().currentUser;
		currentUserNode = users.child(currentUser.uid);

	    console.log("logged in");
	    if ( noCyclesFound() ) {
	    	console.log("creating cycle");
	    	setUpCycleCount();
	    } else {
	    	console.log("cycle exists");
	    }
	  } else {
	    console.log("not logged in");
	    // TODO: before pushing to gitHub, uncomment below:
		// alert("You're not logged in you hacker! Go home!");
		// location.replace("index.php");
	  }
	});

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
			<!-- <a href="addFood.php" class="btn waves-effect waves-light green" onclick="logAllItems()">Back</a> -->
			<a class="btn waves-effect waves-light green" onclick="logAllItems()">Back</a>
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
                <div class="col s4">
                    Product Name
                </div>
                <div class="col s4">
                    Quantity
                </div>
                <div class="col s4">
                    Unit Price $ 
                </div>
            </div>
   		</form>
	</div>

<?php include("include/footer.php"); ?>
