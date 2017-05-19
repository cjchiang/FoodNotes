<?php include("include/header.php"); ?>
<!-- Notes.php is the record page for the current cycle.
	After user added their items, those items will show up here.
	Before the current cycle ends, user can document how much of a specified item
-->
<div class="container white-text green lighten-1">
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
	function findCurrentList(){
		// lastCycle = database.ref("users/"+user.uid+"/" + lastCycleNode.key);
		if (lastCycle)
			populateCurrentList("fruits", lastCycleNode);
		else
			console.log("no cycles in record");
	}


	function populateCurrentList(foodCategory) {

		lastCycleNode.once("value", function(snap){
			var snapData = snap.val();
			var cycleFoods = lastCycleNode.child(foodCategory);

			cycleFoods.on("child_added", function(childSnap){

				console.log(49)
				var childSnapData = childSnap.val();
				var foodName = childSnapData.foodName;
				var price = childSnapData.price;
				console.log("some st: " + childSnapData.foodName);

				// console.log("found something");
				$("#" + foodCategory + "_body").append( '<div class="row">' +
						'<div class="col s8 center-align">' +
							'<span>' + foodName + '</span>' +
						'</div>'+
						'<div class="col s4">'+
							'<span id="' + foodName + '_price">$' + price + '</span>' +
						'</div>' +
						'<div class="col s10 offset-s1">' +
							'<form action="#">' +
								'<p class="range-field">' +
									'<input class="nodeSlider" onchange="moveMe(this)" type="range" id="slider_'+ foodName + '" min="0" max="100" value="0" step="10"/>' +
								'</p>' +
							'</form>' +
						'</div>'+
					'</div>'
				);
			});
		});
	}

		function moveMe(src) {
			$(this).trigger('change');
	    	console.log( $(src).val() );
	    	console.log( src.id );
	    	var leftPercent = $(src).val() * 0.01;
	    	var foodName = src.id.replace("slider_", "");
	    	// var price = $("#" + foodName + "_price" ).val();
	    	var price = $("#Apples_price").val();

	    	console.log("l%: " + leftPercent );
	    	console.log("fn: " + foodName);
	    	console.log("p$: " + price);
	    	$("#" + foodName + "_price" ).val( price - (leftPercent * price) );
	    	// var leftPercent = $(this).val() * 0.01;
	    	// var foodName = $(this).id.replace("slider_", "");
	    	// var price = $( foodName + "_price" ).val();

	    	// $( foodName + "_price" ).val( price - (leftPercent * price) );
		}
	// });
</script>

<div class="white-text green lighten-1">
	<div id="notes">
		<div class="row center-align">
			<h3>Total Waste:</h3>
		</div>
		<div class="row center-align">
			<h3>%___</h3>
		</div>
	<h4 class ="center-align">Current Cycle</h4>
	<ul class="collapsible" data-collapsible="expandable">
		<li class= "red accent-4">
			<div class="collapsible-header red accent-4">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 55px">keyboard_arrow_down</i>
					</div>
					<div class="col s4">
						<span>Meat</span>
					</div>
					<div class="col s6 alt-right">
						<span class="alt-right" > $ __ </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body" id="meats_body">
					<div class="row">
						<div class="col s8 center-align">
							<span>Chicken</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider_Chicken" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col s8 center-align">
							<span>Steak</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col s8 center-align">
							<span>Pork</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
			</div>
		</li>
		<li class= "orange accent-4">
			<div class="collapsible-header orange accent-4">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 55px">keyboard_arrow_down</i>
					</div>
					<div class="col s4">
						<span>Fruits</span>
					</div>
					<div class="col s6 alt-right">
						<span class="alt-right" > $ __ </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body" id="fruits_body">
			</div>
		</li>
		<li class= "light-green accent-4">
			<div class="collapsible-header light-green accent-4">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 55px">keyboard_arrow_down</i>
					</div>
					<div class="col s4">
						<span>Veggies</span>
					</div>
					<div class="col s6 alt-right">
						<span class="alt-right" > $ __ </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body" id="dairy_body">
					<div class="row">
						<div class="col s8 center-align">
							<span>Asparagus</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col s8 center-align">
							<span>Celery</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col s8 center-align">
							<span>Potato</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
			</div>
		</li>
		<li class= "yellow accent-4">
			<div class="collapsible-header yellow accent-4">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 55px">keyboard_arrow_down</i>
					</div>
					<div class="col s4">
						<span>Dairy</span>
					</div>
					<div class="col s6 alt-right">
						<span class="alt-right" > $ __ </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body">
					<div class="row">
						<div class="col s8 center-align">
							<span>Cheese</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col s8 center-align">
							<span>Milk</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col s8 center-align">
							<span>Yogurt</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
			</div>
		</li>
	</ul>
	</div>
</div>
</div>
<?php include("include/footer.php");?>
<!-- </body>
</html> -->
