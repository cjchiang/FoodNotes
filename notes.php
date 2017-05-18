<?php include("include/header.php"); ?>
<!-- Notes.php is the record page for the current cycle.
	After user added their items, those items will show up here.
	Before the current cycle ends, user can document how much of a specified item
	is left over. 
	Currently has hardcoded placeholder items.
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
		<li>
			<div class="collapsible-header">
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
			<div class="collapsible-body note_body" id="meat_body">
					<div class="row">
						<div class="col s4"></div>
						<div class="col s2">0%</div>
						<div class="col s2">50%</div>
						<div class="col s2">100%</div>
						<div class="col s2"><i class="material-icons" style="font-size: 55px">monetization_on</i></div>
					</div>
					<script type="text/javascript">
						foods.orderByChild("category").equalTo("Meat").on("child_added", function(snap){
							var snapData = snap.val();

							var newFoodBlock = document.getElementById(snap.key);

						    if (!newFoodBlock) {
						      $("#meat_body").append(
							'<div class="row" id = ' + snap.key + '>' +
							'<div class="col s4"><span>' + snapData.products + '</span></div>' +
							'<div class="col s2"><input id="test4" type="radio" name="group2" checked><label class="largo_svg" for="test4" >&nbsp</label></div>' +
							'<div class="col s2"><input id="test5" type="radio" name="group2"><label class="largo_svg" for="test5" >&nbsp</label></div>' +
							'<div class="col s2"><input id="test6" type="radio" name="group2"><label class="largo_svg" for="test6" >&nbsp</label></div>' +
							'<div class="col s2"><span>$' + snapData.your_price + '</span></div>' +
							'</div> '); 
						    }
						});
					</script>

					
			</div>
		</li>
		<li>
			<div class="collapsible-header">
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
			<div class="collapsible-body note_body" id="fruit_body">
					<div class="row">
						<div class="col s4"></div>
						<div class="col s2">0%</div>
						<div class="col s2">50%</div>
						<div class="col s2">100%</div>
						<div class="col s2"><i class="material-icons" style="font-size: 55px">monetization_on</i></div>
					</div>
					<script type="text/javascript">
						// change equalTo query for other food items 
						foods.orderByChild("category").equalTo("Fruit").on("child_added", function(snap){
							var snapData = snap.val();

							var newFoodBlock = document.getElementById(snap.key);

						    if (!newFoodBlock) {
						    	// Change this id to append to other plannes
						      $("#fruit_body").append(
							'<div class="row" id = ' + snap.key + '>' +
							'<div class="col s4"><span>' + snapData.products + '</span></div>' +
							'<div class="col s2"><input id="test4" type="radio" name="group2" checked><label class="largo_svg" for="test4" >&nbsp</label></div>' +
							'<div class="col s2"><input id="test5" type="radio" name="group2"><label class="largo_svg" for="test5" >&nbsp</label></div>' +
							'<div class="col s2"><input id="test6" type="radio" name="group2"><label class="largo_svg" for="test6" >&nbsp</label></div>' +
							'<div class="col s2"><span>$' + snapData.your_price + '</span></div>' +
							'</div> '); 
						    }
						});
					</script>
					
			</div>
	    </li>
	    <li>
			<div class="collapsible-header">
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
						<div class="col s4"></div>
						<div class="col s2">0%</div>
						<div class="col s2">50%</div>
						<div class="col s2">100%</div>
						<div class="col s2"><i class="material-icons" style="font-size: 55px">monetization_on</i></div>
					</div>
					<script type="text/javascript">
						foods.orderByChild("category").equalTo("Dairy").on("child_added", function(snap){
							var snapData = snap.val();

							var newFoodBlock = document.getElementById(snap.key);

						    if (!newFoodBlock) {
						      $("#dairy_body").append(
							'<div class="row" id = ' + snap.key + '>' +
							'<div class="col s4"><span>' + snapData.products + '</span></div>' +
							'<div class="col s2"><input id="test4" type="radio" name="group2" checked><label class="largo_svg" for="test4" >&nbsp</label></div>' +
							'<div class="col s2"><input id="test5" type="radio" name="group2"><label class="largo_svg" for="test5" >&nbsp</label></div>' +
							'<div class="col s2"><input id="test6" type="radio" name="group2"><label class="largo_svg" for="test6" >&nbsp</label></div>' +
							'<div class="col s2"><span>$' + snapData.your_price + '</span></div>' +
							'</div> '); 
						    }
						});
					</script>
			</div>
    	</li>
	</ul>
	</div>
</div>
<?php include("include/footer.php");?>
<!-- </body>
</html> -->
