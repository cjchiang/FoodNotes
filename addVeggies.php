<?php include("include/header.php"); ?>
    <!-- main body will go here, body tags are already distributed to header and footer-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>	
<script src="script/addItems.js" type="text/javascript"></script>
<script type="text/javascript">

	/*When search bar is loaded, populate page with a list of veggiess
	Also make search bar responsive to dynamic keyboard input. */
	$("#search").ready(function(){
		$(document).keyup(function(key){
			filterProducts($("#search").val(), "Vegetable" );
		});
		populateList("Vegetable");
	});

</script>
<div class="container">
	<div class="row">
	<!-- for the icon arrow -->
		<div class="col s12">
			<h4><a href="addFood.php"><i class="small material-icons">arrow_left</i> Back </a> </h4>
		</div>
	<!-- for the heading "Add Veggies" and its image-->		
		<div class="col s12 center-align">
			<h4> Add Viggies </h4>
		</div>
		<div class="col s12 center-align">
			<img src="/images/veggie.png">
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
<!-- List the items of veggies for the users to choose and enter the price-->		
	<div class="row">
		<form action="#" class="col s12" id="anchor_head">
   		</form>

	</div>
</div>
<script type="text/javascript">
	
	$(".checkbox").on("change", function(){
		console.log("clicked");
		var input ="#" + this.id.replace("check", "");
		console.log(input);
		// if (this.checked) {
		// 	$(input).prop("disabled", false);
		// } else {
		// 	$(input).val("");
		// 	$(input).prop("disabled", true);
		// }

	});
		// $( "input:checkbox" ).ready(function(){
		// console.log("me weddy");

			// var foodName = this.id.replace("check_", "");
			// console.log(input);
		// if (this.checked) {
		// 	$(input).prop("disabled", false);
		// } else {
		// 	$(input).val("");
		// 	$(input).prop("disabled", true);
		// }
		// });
	// });

</script>
    <!--<div class="container-fluid ourContent">
        <div id="canvasSelect col-xs-12">
            <canvas id="canvasSelection" width="500px" height="500px" style="border:1px solid black"></canvas>
        </div>
    </div>-->

<?php include("include/footer.php"); ?>