<?php include("include/header.php");
	// session_start();
?>
<!-- main body will go here, body tags are already distributed to header and footer-->

<link rel="stylesheet" href="/styles/addFood.css"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="script/addfood.js"></script>
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
	const users = database.ref("users");
	var tempCycle;

	firebase.auth().onAuthStateChanged(function(user) {
	  if (user != null) {
	    console.log("logged in");
	    confirmUserAccountReadyForCycles(user);
	    findTemp();
	  } else {
	    console.log("not logged in");
		alert("You're not logged in you hacker! Go home!");
		location.replace("index.php");
	  }
	});

	function confirmUserAccountReadyForCycles(user) {
		users.orderByChild("email").equalTo(user.email).on('child_added', function(snap){
		   	var childKey = snap.key;
		   	var userID = user.uid;
			if( childKey != userID) {
				var child = db.ref("users").child(childKey);
			  	db.ref("users").child(userID).set(snap.val());
			  	child.remove();
			}
		});
	}

	function findTemp(){
		var user = firebase.auth().currentUser;
		var userNode = users.child(user.uid);

		userNode.on("child_added", function(snap){
		if (snap.key == "temp") {
			tempCycle = userNode.child("temp");
			// bug here, if fruit isn't first, it repeats 4x, idk y

			populateTempList("Dairy", userNode.child("temp"));
			populateTempList("Fruit", userNode.child("temp"));
			populateTempList("Vegetable", userNode.child("temp"));
			populateTempList("Meat", userNode.child("temp"));
		}
		});
	}

	function populateTempList(foodCategory, tempCycleRef) {
		var total = 0;
		// tempCycleRef.orderByChild("category").equalTo(foodCategory).once("child_added", function(snap){
		tempCycleRef.orderByChild("category").equalTo(foodCategory).on("child_added", function(snap){
			var snapData = snap.val();
			var foodName = snapData.product;
			var foodNameID = foodName.split(' ').join('_');;
			var price = snapData.your_price;

			$("#anchor_head_"+ foodCategory).append(
				'<div class="row" id="'+ foodNameID +'">' +
					'<div class="col s6">' +
						'<span class="truncate" style="font-size: responsive">' + foodName + '</span>' +
					'</div>' +
					'<div class="col s3">' +
						'<span id="' + foodNameID + '_price">' + price + '</span>' +
					'</div>' +
					'<div class="col s2">' +
						'<i class="medium material-icons" id="delete_' +
						foodNameID +'" onclick="deleteMe(this)">delete_forever</i>' +
					'</div>' +
				'</div>	'
			);
			total += parseFloat( price) ;
		});
		$("#"+foodCategory+"_total").text("$ " + total.toFixed(2));
	}

	function finalize() {
		addCycle();
		ctrl_x_temp();
		location.replace("notes.php");
	}

	var tempNode;
	var lastCycle;
	function ctrl_x_temp() {
		var user = firebase.auth().currentUser;
		var userNode = users.child(user.uid);
		lastCycle = getLastCycle(userNode);
		tempNode = database.ref("users/"+user.uid+"/temp");

		tempNode.on("value", copyMe);
		tempNode.off("value", copyMe);
		tempNode.remove();
	}

	function copyMe(snap){
		lastCycle.update(snap.val());
	}

	//delete a food item from temp list
	function deleteMe(src) {
		var foodKey = src.id.replace("delete_", "");
		var foodName = foodKey.split("_").join(" ");
		var ancestorKey = $("#" + src.id).parents("[id^='anchor_head_']").attr("id");
		console.log("deleted: " + foodKey);
		console.log("deleted: " + foodName);
		//delete entry from page, animation breaks code so removed it
		$("#" + foodKey).remove();

		updateTotal(ancestorKey, foodName);
		//delete entry from db as well
		tempCycle.orderByChild("product").equalTo(foodName).on("child_added", function(snap){
				tempCycle.child(snap.key).remove();
				updateTotal(ancestorKey, foodName);
			}
		);
	}

	function updateTotal(foodGroupID, childID) {
		var sum = 0;
		var foodGroupPriceKey = foodGroupID.replace("anchor_head_", "");
		$("#"+foodGroupID).find("[id$='_price']").each(function(){
			var itemPriceStr = $(this).text();
			var itemPrice = parseFloat( itemPriceStr.replace("$", "") );
			sum += itemPrice;
		});
		console.log("foodGroupID:" +  foodGroupID)
		console.log("sum: " + sum);
		$("#" + foodGroupPriceKey + "_total").text("$ " + sum.toFixed(2) );
	}

	function getLastCycle(userNode) {
		var count;
		userNode.once("value", function(snap){
			console.log("inner cycleIndex: " + snap.val().cycleCount);
			count = snap.val().cycleCount;
		});
		var cycleIndex = "cycle" + count;
		console.log("outter cycleIndex: " + count);
		return userNode.child(cycleIndex);
	}

	function getNewDeadline(duration) {
	    var deadline;
	    if (duration == "biweekly") {
	        deadline = new Date(+new Date + 12096e5); // 12096e5 is 12 days
	    } else if (duration == "weekly") {
	        deadline = new Date(+new Date + 6048e5); // 6048e5 is 7 days
	    } else {
	    	// implied to be "monthly"
	        deadline = new Date(+new Date + (12096e5*2) );
	    }
	    return deadline;
	}
	function addCycle() {
		var user = firebase.auth().currentUser;
		var userNode = users.child(user.uid);

		userNode.once("value", function(snap){
			var count = snap.val().cycleCount;
			count++;
			var cycleIndex = "cycle" + count;
			var duration = snap.val().cycleDuration;
			if (typeof duration === "undefined")
				duration = "monthly"
			var deadline = getNewDeadline(duration);
			// console.log("deadline in days:" + deadline.getDate())
			// alert("Cycle set to end in: " + deadline.getDate() " days")

			userNode.child(cycleIndex).update({ "cycleEndDate" : deadline})
			userNode.child("cycleDuration").set( duration )
			userNode.child("cycleCount").set(count);
		});
	}

</script>
<!-- Add 4 categories -->
	<div class="row">
		<!-- For cancelling purchase -->
		<div class="col s6 left-align">
			<a href="notes.php" class="btn waves-effect waves-light red darken-4">Cancel</a>
		</div>
		<!-- For submitting -->
		<div class="col s6 right-align">
			<!-- <a id="link_finalize" href="notes.php" class="btn waves-effect waves-light green">Finalize</a> -->
			<a id="link_finalize" onclick="finalize()" class="btn waves-effect waves-light red darken-4">Finalize</a>
		</div>
	</div>
	<div class="row">
		<div class="col s12 center-align">
			<h4>Select a category</h4>
		</div>
	</div>
	<div class="row">
		<div class="col s6 food_group ">
			<a href="addMeat.php" class="btn waves-effect waves-light red accent-4">
				Meat
			</a>
		</div>
		<div class="col s6 food_group">
			<a href="addFruits.php" class="btn waves-effect waves-light orange accent-4">
				Fruits
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col s6 food_group">
			<a href="addVeggies.php" class="btn waves-effect waves-light light-green accent-4">
				Veggies
			</a>
		</div>
		<div class="col s6 food_group">
			<a href="addDairy.php" class="btn waves-effect waves-light yellow accent-4">
				Dairy
			</a>
		</div>
	</div>
	<!-- Added items -->
	<div class="row">
		<div class="col s12 center-align">
			<h4>Added items</h4>
		</div>
	</div>
	<ul class="collapsible" data-collapsible="expandable">
		<li class="red accent-4">
			<div class="collapsible-header red accent-4">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 40px">add_circle</i>
					</div>
					<div class="col s4">
						<span>Meat</span>
					</div>
					<div class="col s6 alt-right">
						<span class="alt-right" id="total_Meat"> $ 0.00 </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body center-align" id="anchor_head_Meat">
			</div>
		</li>
		<li class="orange accent-4">
			<div class="collapsible-header orange accent-4">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 40px">add_circle</i>
					</div>
					<div class="col s4">
						<span>Fruit</span>
					</div>
					<div class="col s6 alt-right">
						<span class="alt-right" id="Fruit_total"> $ 0.00 </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body center-align" id="anchor_head_Fruit">
			</div>
		</li>
		<li class="light-green accent-4">
			<div class="collapsible-header light-green accent-4">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 40px">add_circle</i>
					</div>
					<div class="col s4">
						<span>Veggies</span>
					</div>
					<div class="col s6 alt-right">
						<span class="alt-right" id="Vegetable_total" > $ 0.00 </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body center-align" id="anchor_head_Vegetable">
			</div>
		</li>
		<li class="yellow accent-4">
			<div class="collapsible-header yellow accent-4">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 40px">add_circle</i>
					</div>
					<div class="col s4">
						<span>Dairy</span>
					</div>
					<div class="col s6 alt-right">
						<span class="right-align" id="Dairy_total"> $ 0.00 </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body center-align" id="anchor_head_Dairy">
			</div>
		</li>
	</ul>
<?php include("include/footer.php"); ?>
