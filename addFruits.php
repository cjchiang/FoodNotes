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
   		</form>
	</div>
</div>
    <!--<div class="container-fluid ourContent">
        <div id="canvasSelect col-xs-12">
            <canvas id="canvasSelection" width="500px" height="500px" style="border:1px solid black"></canvas>
        </div>
    </div>-->

<?php include("include/footer.php"); ?>