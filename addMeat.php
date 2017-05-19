<?php include("include/header.php"); session_start()?>
<!-- main body will go here, body tags are already distributed to header and footer-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
<script src="script/addItems.js" type="text/javascript"></script>
<script type="text/javascript">

	/*When search bar is loaded, populate page with a list of meats
	Also make search bar responsive to dynamic keyboard input. */
	$("#search").ready(function(){
		$(document).keyup(function(key){
			filterProducts($("#search").val(), "Meat" );
		});
		populateList("Meat");
	});


</script>
<div class="container white-text green lighten-1">
	<div class="row">
		<!-- for the icon arrow -->
		<div class="col s6 left-align">
			<a href="addFood.php" class="btn waves-effect waves-light green">Back</a>
		</div>
	</div>
	<!-- for the heading "Add meat" and its image-->
	<div class ="row">
		<div class="col s12 center-align">
			<h3> Add Meats </h3>
		</div>
	</div>
	<!-- Search bar -->
	<div class="row">
		<form action="#" class="col s12">
			<div class="row">
				<div class="input-field col s12">
					<label for="search"><i class="material-icons">search</i></label>
					<input id="search" type="search"/>
				</div>
			</div>
		</form>
	</div>
	<!-- List the items of meat for the users to choose and enter the price-->
	<div class="row">
		<form action="processFood.php" method="POST" class="col s12" id="anchor_head">
						<div class="row center-align">
	            <input type="submit"  value="Add" class="btn waves-effect waves-light green"/>
							<br/>
						</div>
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
<?php include("include/footer.php"); ?>
