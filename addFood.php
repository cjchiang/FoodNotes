<?php include("include/header.php"); ?>
<!-- main body will go here, body tags are already distributed to header and footer-->
<link rel="stylesheet" href="/styles/addFood.css"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- Add 4 categories -->
<div class="container white-text green lighten-1">
	<div class="row">
		<!-- For cancelling purchase -->
		<div class="col s6 left-align">
			<a href="notes.php" class="btn waves-effect waves-light green">Cancel</a>
		</div>
		<!-- For submitting -->
		<div class="col s6 right-align">
			<a href="notes.php" class="btn waves-effect waves-light green">Finalize</a>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<h4>Select a food category</h4>
		</div>
	</div>
	<div class="row">
		<div class="col s6 food_group">
			<a href="addMeat.php" class="btn waves-effect waves-light green">
				Meat
			</a>
		</div>
		<div class="col s6 food_group">
			<a href="addFruits.php" class="btn waves-effect waves-light green">
				Fruits
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col s6 food_group">
			<a href="addVeggies.php" class="btn waves-effect waves-light green">
				Veggies
			</a>
		</div>
		<div class="col s6 food_group">
			<a class="btn waves-effect waves-light green">
				Dairy
			</a>
		</div>
	</div>
	<!-- Added items -->
	<div class="row">
		<div class="col s12 center-align">
			<h4>Added items</h4>
		</div>
	</div>
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
			<div class="collapsible-body note_body center-align">
				<div class="row">
					<div class="col s8">
						<span>Chicken</span>
					</div>
					<div class="col s4">
						<span>$__ </span>
					</div>
				</div>
				<div class="row">
					<div class="col s8">
						<span>Ham</span>
					</div>
					<div class="col s4">
						<span>$__ </span>
					</div>
				</div>
				<div class="row">
					<div class="col s8">
						<span>Steak</span>
					</div>
					<div class="col s4">
						<span>$__ </span>
					</div>
				</div>
			</div>
		</li>
		<li>
			<div class="collapsible-header">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 55px">keyboard_arrow_down</i>
					</div>
					<div class="col s4">
						<span>Fruit</span>
					</div>
					<div class="col s6 alt-right">
						<span class="alt-right" > $ __ </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body center-align">
				<div class="row">
					<div class="col s8">
						<span>Peach</span>
					</div>
					<div class="col s4">
						<span>$__ </span>
					</div>
				</div>
				<div class="row">
					<div class="col s8">
						<span>Banana</span>
					</div>
					<div class="col s4">
						<span>$__ </span>
					</div>
				</div>
				<div class="row">
					<div class="col s8">
						<span>Apple</span>
					</div>
					<div class="col s4">
						<span>$__ </span>
					</div>
				</div>
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
			<div class="collapsible-body note_body center-align">
				<div class="row">
					<div class="col s8">
						<span>Asparagus</span>
					</div>
					<div class="col s4">
						<span>$__ </span>
					</div>
				</div>
				<div class="row">
					<div class="col s8">
						<span>Broccoli</span>
					</div>
					<div class="col s4">
						<span>$__ </span>
					</div>
				</div>
				<div class="row">
					<div class="col s8">
						<span>Eggplant</span>
					</div>
					<div class="col s4">
						<span>$__ </span>
					</div>
				</div>
			</div>
		</li>
		<li>
			<div class="collapsible-header">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 55px">keyboard_arrow_down</i>
					</div>
					<div class="col s4">
						<span>Dairy</span>
					</div>
					<div class="col s6 alt-right">
						<span class="right-align" > $ __ </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body center-align">
				<div class="row">
					<div class="col s8">
						<span >Milk</span>
					</div>
					<div class="col s4">
						<span>$__ </span>
					</div>
				</div>
				<div class="row">
					<div class="col s8">
						<span>Eggs</span>
					</div>
					<div class="col s4">
						<span>$__ </span>
					</div>
				</div>
				<div class="row">
					<div class="col s8">
						<span>Cheese</span>
					</div>
					<div class="col s4">
						<span>$__ </span>
					</div>
				</div>
			</div>
		</li>
	</ul>
</div>
<?php include("include/footer.php"); ?>
