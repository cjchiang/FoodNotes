<<<<<<< HEAD
<?php include("include/header.php");?>
<!-- main body will go here, body tags are already distributed to header and footer-->
=======
<?php include("include/header.php"); ?>
    <!-- main body will go here, body tags are already distributed to header and footer-->
>>>>>>> 7dad581f0226bdd8e606429f8e1f191ad96b5759
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
<script src="script/addItemsForMeat.js" type="text/javascript"></script>
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

	/*When search bar is loaded, populate page with a list of meats
	Also make search bar responsive to dynamic keyboard input. */
	$("#search").ready(function(){
		$(document).keyup(function(key){
			filterProducts($("#search").val(), "Meat" );
		});
		populateList("Meat");
	});

</script>
	<div class="row">
	<!-- for the icon arrow -->
		<div class="col s12">
			<h4><a href="addFood.php"><i class="small material-icons">arrow_left</i> Back </a> </h4>
		</div>
	<!-- for the heading "Add Veggies" and its image-->
		<div class="col s12 center-align">
			<h4> Add Meats </h4>
		</div>
<!-- 		<div class="col s12 center-align">
			<img src="/images/veggie.png">
		</div>
 -->	</div>

	<!-- Search bar -->
	<div class="row">
		<form action="#" class="col s12">
			<div class="row">
				<div class="input-field col s12">
					<label for="search"><i class="material-icons">search</i></label>
					<input id="search" type="search">
				</div>
				<div class="col s12 center-align">
					<a class="btn waves-effect waves-light green" onclick="logAllItems()">Add Items</a>
				</div>
			</div>
		</form>
	</div>
<!-- List the items of veggies for the users to choose and enter the price-->
	<div class="row">
<<<<<<< HEAD
		<form action="processFood.php" method="POST" class="col s12" id="anchor_head">
						<div class="row center-align">
	            <input type="submit"  value="Add" class="btn waves-effect waves-light green"/>
							<br/>
						</div>
=======
		<form action="#" class="col s12" id="anchor_head">
			<input type="submit" value="Add" id="submitBtn" hidden/>
>>>>>>> 7dad581f0226bdd8e606429f8e1f191ad96b5759
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
<<<<<<< HEAD
		</form>
	</div>
=======
   		</form>
	</div>
</div>

</script>

>>>>>>> 7dad581f0226bdd8e606429f8e1f191ad96b5759
<?php include("include/footer.php"); ?>
