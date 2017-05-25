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
	<div class="col s6 left-align">
		<a href="addFood.php" class="btn waves-effect waves-light red darken-4">Back</a>
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
					<a class="btn waves-effect waves-light red darken-4" onclick="logAllItems()">Add Items</a>
				</div>
			</div>
		</form>
	</div>
<!-- List the items of veggies for the users to choose and enter the price-->
	<div class="row">
		<form action="#" class="col s12" id="anchor_head">
			<input type="submit" value="Add" id="submitBtn" hidden/>
            <div class="row center">
                <div class="col s6">
                    Product Name
                </div>
                <div class="col s6">
                    Unit Price $
                </div>
            </div>
   		</form>
	</div>
</div>

</script>

<?php include("include/footer.php"); ?>
