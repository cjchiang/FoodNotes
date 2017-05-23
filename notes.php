<?php include("include/header.php"); ?>
<!-- Notes.php is the record page for the current cycle.
	After user added their items, those items will show up here.
	Before the current cycle ends, user can document how much of a specified item
-->
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
	const users = database.ref("users");

	firebase.auth().onAuthStateChanged(function(user) {
	  if (user != null) {
	    console.log("logged in");
	    setUpNodes();
	  } else {
	    console.log("not logged in");
		// alert("You're not logged in you hacker! Go home!");
		// location.replace("index.php");
	  }
	});

	var user;
	var userNode;
	var lastCycle;
	var lastCycleNode;
	function setUpNodes(){
		user = firebase.auth().currentUser;
		userNode = users.child(user.uid);

		getLastCycle(userNode);
		// lastCycleNode = getLastCycle(userNode);
		// setTimeout(findCurrentList, 500);
	}

	function getLastCycle(userNode) {
		var count;
		userNode.on("value", function(snap){
			console.log("inner cycleIndex: " + snap.val().cycleCount);
			count = snap.val().cycleCount;

			var cycleIndex = "cycle" + count;
			lastCycleNode = userNode.child(cycleIndex);
			lastCycle = database.ref("users/"+user.uid+"/" + lastCycleNode.key);
			findCurrentList();
		});
	}
	var once = true;
	function findCurrentList(){
		// lastCycle = database.ref("users/"+user.uid+"/" + lastCycleNode.key);
		if (lastCycle) {
			populateCurrentList("Fruit");
			once = false;
			// populateCurrentList("Meat");
			// populateCurrentList("Vegetable");
			// populateCurrentList("Dairy");
		} else
			console.log("no cycles in record");
	}

	function populateCurrentList(foodCategory) {
		if (!once)
			return;
		var sum = 0;
		lastCycleNode.orderByChild("category").on("child_added", function(snap){
			var snapData = snap.val();
			if ( !(snapData.category != null && once && snapData.category == foodCategory ))
				return;

			var foodName = snapData.product;
			var foodNameID = foodName.split(' ').join('_');
			var price = snapData.your_price;
			var wasted = snapData.wasted;
			console.log("foodNameID:" + foodNameID);
			console.log("val wasted" + wasted);
			$("#" + foodCategory + "_body").append(
				'<div class="row">' +
					'<div class="col s8 center-align">' +
						'<span>' + foodName + '</span>' +
					'</div>'+
					'<div class="col s4">'+
						'<span id="' + foodNameID + '_price" name="' + price +'" >' + price + '</span>' +
					'</div>' +
					'<div class="col s1 push-s1">'+
						'<span>0%</span>' +
					'</div>' +
					'<div class="col s6 push-s2">'+
						'<span>Amt. used</span>' +
					'</div>' +
					'<div class="col s1 push-s1">'+
						'<span>100%</span>' +
					'</div>' +
					'<div class="col s10 offset-s1">' +
						'<form action="#">' +
							'<span class="range-field">' +
								'<input class="nodeSlider" onchange="moveMe(this)" type="range" id="slider_'+ foodNameID + '" min="0" max="100" value="0" step="10"/>' +
							'</span>' +
						'</form>' +
					'</div>' +
				'</div>'
				);
				sum += parseFloat( price);
				$("#slider_" + foodNameID).val( parseInt(wasted) );
			});
		lastCycleNode.child(foodCategory + "_total").set(sum);
		$("#" + foodCategory + "_body_total").text("$ " + sum.toFixed(2) );
		updatePercent();
	}

	function updatePercent() {
		lastCycle.on("value", updatePercentOnPage);
		lastCycle.off("value", updatePercentOnPage);
		setTimeout(updatePercentInDB, 10000);
	}

	function updatePercentInDB() {
		lastCycle.update({ "total_waste" : $("#total_waste_percent").text().replace("%", "") });
	}
	function updatePercentOnPage(snap) {
		var snapData = snap.val();
		var old_meat_total = snapData.Meat_total
			if (typeof old_meat_total === "undefined")
				old_meat_total = 0
		var old_fruit_total = snapData.Fruit_total
			if (typeof old_fruit_total === "undefined")
				old_fruit_total = 0
		var old_veg_total = snapData.Vegetable_total
			if (typeof old_veg_total === "undefined")
				old_veg_total = 0
		var old_dairy_total = snapData.Dairy_total
			if (typeof old_dairy_total === "undefined")
				old_dairy_total = 0
		var current_meat_total = parseFloat ( $("#Meat_body_total").text().replace("$", "") );
		var current_fruit_total = parseFloat ( $("#Fruit_body_total").text().replace("$", "") );
		var current_veg_total = parseFloat ( $("#Vegetable_body_total").text().replace("$", "") );
		var current_dairy_total = parseFloat ( $("#Dairy_body_total").text().replace("$", "") );
		console.log("old" + old_fruit_total)
		console.log("current" + current_fruit_total)
		var curr_sum = current_meat_total  + current_fruit_total + current_veg_total + current_dairy_total
		var orig_sum = old_meat_total + old_fruit_total + old_veg_total + old_dairy_total
		var percent = (curr_sum / orig_sum) * 100

		$("#total_waste_percent").text( percent.toFixed(2) + "%" )
		// lastCycle.child("total_waste").set($("#total_waste_percent").text().replace("%", ""))
	}

	function moveMe(src) {
    	console.log("moved:" + $(src).val() );
    	console.log("moved:" + src.id );
    	var leftPercent = $(src).val() * 0.01;
    	var foodName = src.id.replace("slider_", "");
    	var foodKey;
    	var pl;
    	console.log(foodName)

    	lastCycle.orderByChild("product").equalTo(foodName).on("child_added", function(snap){
    		foodKey = snap.key;
    	})
    	lastCycle.child(foodKey).update({ "wasted" : $(src).val() });

    	var origPrice = $("#" + foodName + "_price").attr("name");
    	var newPrice = (1 -leftPercent ) * origPrice;
    	$("#" + foodName + "_price" ).text( ( newPrice ).toFixed(2) );
    	// updateTotal();

    	var parentID = $(src).parents(".row").parent().attr("id");
    	console.log("me:" + $(src).parents(".row").parent().attr("id") );
    	updateTotal(parentID)
	}

	function updateTotal(foodGroupID) {
		var sum = 0;
		// $("#"+foodGroupID).children("[id$='_price']").each(function(){
		$("#"+foodGroupID).ready(function(){
			$("[id$='_price']").each(function() {
				var itemPriceStr = $("#" + this.id).text();
				var itemPrice = parseFloat(itemPriceStr);
				sum += itemPrice;
			})
		});
		// // lastCycle.once("value", function(snap){
  // //   		 = snap.key;
  // //   	})
  // 		var foodGroupKey = foodGroupID.replace("_", " ");
  //   	lastCycle.child( foodGroupKey ).update({ "wasted" : sum });

		console.log("foodGroupID:" +  foodGroupID)
		console.log("sum: " + sum);
		$("#" + foodGroupID + "_total").text( "$" + sum.toFixed(2) );
		updatePercent()
	}
</script>

	<div id="notes">
		<div class="row center-align">
			<h3>Potential Savings:</h3>
		</div>
		<div class="row center-align">
			<h3 id="total_waste_percent">0 %</h3>
		</div>
	<h4 class ="center-align">Current Cycle</h4>
	<ul class="collapsible" data-collapsible="expandable">
		<li class= "red accent-4">
			<div class="collapsible-header red accent-4">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 40px">add_circle</i>
					</div>
					<div class="col s4">
						<span>Meat</span>
					</div>
					<div class="col s6 alt-right">
						<span id="Meat_body_total" class="alt-right" > $ 0.00 </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body" id="Meat_body">
			</div>
		</li>
		<li class= "orange accent-4">
			<div class="collapsible-header orange accent-4">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 40px">add_circle</i>
					</div>
					<div class="col s4">
						<span>Fruits</span>
					</div>
					<div class="col s6 alt-right">
						<span id="Fruit_body_total" class="alt-right" > $ 0.00 </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body" id="Fruit_body">
			</div>
		</li>
		<li class= "light-green accent-4">
			<div class="collapsible-header light-green accent-4">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 40px">add_circle</i>
					</div>
					<div class="col s4">
						<span>Veggies</span>
					</div>
					<div class="col s6 alt-right">
						<span id="Vegetable_body_total" class="alt-right"> $ 0.00 </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body" id="Vegetable_body">
			</div>
		</li>
		<li class= "yellow accent-4">
			<div class="collapsible-header yellow accent-4">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 40px">add_circle</i>
					</div>
					<div class="col s4">
						<span>Dairy</span>
					</div>
					<div class="col s6 alt-right">
						<span id="Dairy_body_total" class="alt-right"> $ 0.00 </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body" id="Dairy_body">
			</div>
		</li>
	</ul>
	</div>
<?php include("include/footer.php");?>
