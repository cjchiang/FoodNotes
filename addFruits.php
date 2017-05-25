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

</script>
	<div class="row">
		<!-- for the icon arrow -->
		<div class="col s6 left-align">
			<a href="addFood.php" class="btn waves-effect waves-light green">Back</a>
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
				<div class="col s12 center-align">
					<a class="btn waves-effect waves-light green" onclick="logAllItems()">Add Items</a>
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
