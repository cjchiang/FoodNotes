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
	    getLastCycle();
	  } else {
	    console.log("not logged in");
		alert("You're not logged in you hacker! Go home!");
		location.replace("index.php");
	  }
	});

	var user;
	var userNode;
	var lastCycle;
	var lastCycleNode;
	function getLastCycle() {
		user = firebase.auth().currentUser;
		userNode = users.child(user.uid);
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
		//bug here
		if (typeof lastCycle !== "undefined") {
			populateCurrentList("Fruit");
			populateCurrentList("Meat");
			populateCurrentList("Vegetable");
			populateCurrentList("Dairy");
			once = false;
	    	setDate();
		} else {
			console.log("no cycles in record");
		}
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
			var price = parseFloat( snapData.your_price);
			var wasted = parseInt( snapData.wasted);
			var wastedPrice = price * (wasted * 0.01)

			console.log("foodNameID:" + foodNameID);
			console.log("val wasted" + wasted);
			$("#" + foodCategory + "_body").append(
				'<div class="row">' +
					'<div class="col s4 push-s1">' +
						'<span>' + foodName + '</span>' +
					'</div>'+
					'<div class="col s3 push-s2">'+
						'<span>price:</span>' + 
					'</div>' +
					'<div class="col s4 push-s2">'+ 
						'<span id="' + foodNameID + '_price" name="' + wastedPrice +'" >' + price + '</span>' +
					'</div>' +
					'<div class="col s2 push-s1">'+
						'<span>0%</span>' +
					'</div>' +
					'<div class="col s6 push-s2">'+
						'<span>Waste</span>' +
					'</div>' +
					'<div class="col s1">'+
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
		// update foodCategory total in db
		// lastCycleNode.child(foodCategory + "_total").set(sum);

		// update text of foodCategory total on page
		$("#" + foodCategory + "_body_total").text("$ " + sum.toFixed(2) );
		updateTotal(foodCategory + "_body");
	}

	function setDate() {
		lastCycleNode.once("value", function(snap){
			var deadline = snap.val().cycleEndDate;
			if (typeof deadline !== "undefined") {
				var todayIsTheDeadline = checkDeadline(deadline);
				if (todayIsTheDeadline)
					finalize();
				if (!todayIsTheDeadline)
					displayDate(deadline);				
			}
		});
	}

	function checkDeadline(timeObj) {
		var today = new Date();
		var deadline = new Date(timeObj);
		var deadline_dd = deadline.getDate();
		var deadline_mm = deadline.getMonth(); 
		var deadline_yyyy = deadline.getFullYear();
		var deadline_str = deadline_dd + "," + deadline_mm + "," + deadline_yyyy;
		
		var today_dd = today.getDate();
		var today_mm = today.getMonth(); 
		var today_yyyy = today.getFullYear();
		var today_str = today_dd + "," + today_mm + "," + today_yyyy;
		console.log("todayStr:" + today_str)
		console.log("deadlineStr:" + deadline_str) 
		if ( today_str == deadline_str)
			return true;
		return false;
	}

	function displayDate(timeObj) {
		var deadline = new Date(timeObj);
		var dd = deadline.getDate();
		var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var mm = monthNames[ deadline.getMonth() ]; 
		var yyyy = deadline.getFullYear();
		// var weekDays = ["Sun","Mon","Tues","Wed","Thur","Fri","Sat"];
		// var ww = weekDays[ deadline.getDay() ];
		$("#cycle_end_date").text( mm + ' ' + dd + ' ' + yyyy);		
	}
	function moveMe(src) {
    	console.log("moved:" + $(src).val() );
    	console.log("moved:" + src.id );
    	// convert slider into % value
    	var leftPercent = $(src).val() * 0.01;
    	var foodName = src.id.replace("slider_", "");
    	var foodKey;
    	var pl;
    	lastCycle.orderByChild("product").equalTo(foodName).on("child_added", function(snap){
    		foodKey = snap.key;
    	})
    	// update wasted % in db for food item
    	lastCycle.child(foodKey).update({ "wasted" : $(src).val() });

    	var origPriceStr = $("#" + foodName + "_price").text().replace("$", "");
    	var origPrice = parseFloat( origPriceStr );
    	// $ of paid price thrown away
    	var wastedPrice = leftPercent * origPrice;
    	// store wastedPrice in hidden name attribute
    	$("#" + foodName + "_price").attr("name", wastedPrice.toFixed(2) );
    	console.log(foodName + " updated w. waste: $" + wastedPrice.toFixed(2))

    	var parentID = $(src).parents(".row").parent().attr("id");
    	console.log("food group of item:" + $(src).parents(".row").parent().attr("id") );
    	updateTotal(parentID)
	}

	// updates total wasted price of 1 food group, and stores in hidden field
	// note:  total spent price is only updated once, in populateCurrentList
	function updateTotal(foodGroupID) {
		var sum = 0;
		$("#"+foodGroupID).find("[id$='_price']").each(function(){				
			var itemPriceStr = $(this).attr("name");
			console.log(itemPriceStr)
			var itemPrice = parseFloat(itemPriceStr); 
			sum += itemPrice;
		});
		console.log(foodGroupID + " foodGroup wasted sum: " + sum);
		$("#" + foodGroupID + "_total").attr("name", sum.toFixed(2) );
		updatePercent();
	}

	function updatePercent() {
		var old_meat_total = parseFloat ( $("#Meat_body_total").text().replace("$", "") ); 
		var old_fruit_total = parseFloat ( $("#Fruit_body_total").text().replace("$", "") );
		var old_veg_total = parseFloat ( $("#Vegetable_body_total").text().replace("$", "") );
		var old_dairy_total = parseFloat ( $("#Dairy_body_total").text().replace("$", "") );

		var current_meat_total = parseFloat ( $("#Meat_body_total").attr("name") ); 
		var current_fruit_total = parseFloat ( $("#Fruit_body_total").attr("name") );
		var current_veg_total = parseFloat ( $("#Vegetable_body_total").attr("name") );
		var current_dairy_total = parseFloat ( $("#Dairy_body_total").attr("name") );
		
		var curr_sum = current_meat_total  + current_fruit_total + current_veg_total + current_dairy_total
		var orig_sum = old_meat_total + old_fruit_total + old_veg_total + old_dairy_total
		var percent = (curr_sum / orig_sum) * 100
		if (isNaN(percent))
			percent = 0
		$("#total_waste_percent").text( percent.toFixed(2) + " %" )	
		$("#orig_total").text( "$" + orig_sum );
		$("#curr_total").text( "$" + curr_sum );
	}	

	function finalize() {
		finalizeStats();
		addCycle();
		location.replace("records.php");
	}

	function finalizeStats() {
		var old_meat_total = parseFloat ( $("#Meat_body_total").text().replace("$", "") ); 
		var old_fruit_total = parseFloat ( $("#Fruit_body_total").text().replace("$", "") );
		var old_veg_total = parseFloat ( $("#Vegetable_body_total").text().replace("$", "") );
		var old_dairy_total = parseFloat ( $("#Dairy_body_total").text().replace("$", "") );

		var current_meat_total = parseFloat ( $("#Meat_body_total").attr("name") ); 
		var current_fruit_total = parseFloat ( $("#Fruit_body_total").attr("name") );
		var current_veg_total = parseFloat ( $("#Vegetable_body_total").attr("name") );
		var current_dairy_total = parseFloat ( $("#Dairy_body_total").attr("name") );

		var Meat_percent = current_meat_total / old_meat_total;
			if ( isNaN(Meat_percent) ) {
				Meat_percent = 0
			}
		var Fruit_percent = current_fruit_total / old_fruit_total;
			if ( isNaN(Fruit_percent) )
				Fruit_percent = 0			
		var Vegetable_percent = current_veg_total / old_fruit_total;
			if ( isNaN(Vegetable_percent) )
				Vegetable_percent = 0
		var Dairy_percent = current_dairy_total / old_dairy_total;
			if ( isNaN(Dairy_percent) )
				Dairy_percent = 0

		// var curr_sum = $("#curr_total").text().replace("$", "")
		// var orig_sum = $("#orig_total").text().replace("$", "")
		var percent_wasted = $("#total_waste_percent").text().replace("%", "");

    	lastCycle.update({"percent_wasted" : percent_wasted });
    	lastCycle.update({"Meat_percent" : Meat_percent.toFixed(2) });
    	lastCycle.update({"Fruit_percent" : Fruit_percent.toFixed(2) });
    	lastCycle.update({"Vegetable_percent" : Vegetable_percent.toFixed(2) });
    	lastCycle.update({"Dairy_percent" : Dairy_percent.toFixed(2) });
	}
	function addCycle() {
		var user = firebase.auth().currentUser;
		var userNode = users.child(user.uid);

		userNode.once("value", function(snap){
			var count = snap.val().cycleCount;
			var cycleIndex = "cycle" + count;
			count++;
			userNode.child("cycleCount").set(count);
		});
	}
</script>

	<div id="notes">
		<div class="row center-align">
			<button onclick="finalize()">End cycle test</button>
		</div>
		<div class="row center-align">
			<h3>Waste this cycle:</h3>
			<h3 id="total_waste_percent">0 %</h3>
		</div>
	<h4 class ="row center-align">Cycle items</h4>
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
						<span id="Meat_body_total" class="alt-right" name="0"> $ 0.00 </span>
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
						<span id="Fruit_body_total" class="alt-right" name="0"> $ 0.00 </span>
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
						<span id="Vegetable_body_total" class="alt-right" name="0"> $ 0.00 </span>
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
						<span id="Dairy_body_total" class="alt-right" name="0"> $ 0.00 </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body" id="Dairy_body">
			</div>
		</li>
	</ul>
	<div class="row center-align">
		<h4 class="col s6">Spent</h4>
		<h4 class="col s6">Wasted</h4>
		<h5 class="col s6" id="orig_total">$100</h5>
		<h5 class="col s6" id="curr_total">$0</h5>
		<h5 class="col s6" style="font-size: 5vw">This cycle ends on:</h5>
		<h5 class="col s6" id="cycle_end_date"> NOT SET </h5>
	</div>

	</div>
<?php include("include/footer.php");?>
