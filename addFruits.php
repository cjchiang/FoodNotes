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

	function logMe(elem) {
		var input = elem.id.replace("check", "input");
		var foodName = input.split("_").join(" ") ;
		console.log("logged: " + input);
		if ($(elem).is(':checked')) {
			// $(input).prop("disabled", false);
			appendItem(foodName);
		} else {
			// $(input).prop("disabled", true);
		}
	}

	//append item to temporary list
	function appendItem(foodName){
		var currentUser = firebase.auth().currentUser;
		var currentUserNode = users.child(currentUser.uid);

		currentUserNode.once("value", function(snap){

			var tempCycle = currentUserNode.child("temp");

			tempCycle.once("value", function(snap){
				var price = $("#" + foodName + "_bought").val();

				tempCycle.child("cycle").set(true);
				tempCycle.child("fruits").push({
					foodName,
					"price" : 3.5 
				});
			});
		});
	}

	firebase.auth().onAuthStateChanged(function(user) {
	  if (user != null) {
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
		var user = firebase.auth().currentUser;
		var userNode = users.child(user.uid);
		
		var count;
		userNode.on("value", function(snap){
			var count = snap.val().cycleCount;
		});
		console.log(count);
		return count;
	}
	function setUpCycleCount() {
		var user = firebase.auth().currentUser;
		var userNode = users.child(user.uid);

		userNode.once("value", function(snap){
			// var count = snap.val().cycleCount;
			userNode.child("cycleCount").set(1);
			// userNode.child(cycleIndex).update({
			// 	"cycle" : true,
			// 	"fruits" : "placeholder",
			// 	"vegetables" : "placeholder",
			// 	"meats" : "placeholder"
			// });
		});
	}


	$("submitBtn").click(function(){
		$()
	});
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
			<input type="submit" value="Add" id="submitBtn"/>
            <div class="row center">
                <div class="col s6">
                    Product Name
                </div>
                <div class="col s6">
                    ($)
                </div>
            </div>
   		</form>
	</div>
</div>
    <!--<div class="container-fluid ourContent">
        <div id="canvasSelect col-xs-12">
            <canvas id="canvasSelection" width="500px" height="500px" style="border:1px solid black"></canvas>
        </div>
    </div>-->

<?php include("include/footer.php"); ?>