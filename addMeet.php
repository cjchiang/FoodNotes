<?php include("include/header.php"); ?>
    <!-- main body will go here, body tags are already distributed to header and footer-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="script/addfood.js"></script>

<div class="container">
	<div class="row">
<!-- for the icon arrow -->
		<div class="col s12">
			<h4><a href="addFood.php"><i class="small material-icons">arrow_left</i> Back </a> </h4>
		</div>
<!-- for the heading "Add meat" and its image-->		
		<div class="col s12 center-align">
			<h4> Add meat </h4>
		</div>
		<div class="col s12 center-align">
			<img src="/images/meet.png">
		</div>
	</div>
	
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
<!-- List the items of meat for the users to choose and enter the price-->	
	<div class="row">
		<form action="#" class="col s12 orange" id="form_add_meat_items">
			<div class="row">
				<div class="input-field col s6">
					<input type="checkbox" id="check_round_steak"/>		
					<label for="check_round_steak">Round steak</label> 
				</div>
				<div class="input-field col s6">
					<input type="text" id="round_steak_bought" placeholder="$00.00"/>
				</div>			   
			</div>
			
			<div class="row">
				<div class="input-field col s6">
					<input type="checkbox" id="check_sirloin_steak"/>		
					<label for="check_sirloin_steak">Sirloin steak</label> 
				</div>
				<div class="input-field col s6">
					<input type="text" id="sirloin_steak_bought" placeholder="$00.00"/>
				</div>			   
			</div>
			
			<div class="row">
				<div class="input-field col s6">
					<input type="checkbox" id="check_prime_rib_roast"/>		
					<label for="check_prime_rib_roast">Prime rib roast</label> 
				</div>
				<div class="input-field col s6">
					<input type="text" id="check_prime_rib_roast" placeholder="$00.00"/>
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
