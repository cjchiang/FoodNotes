<?php include("include/header.php"); ?>
<!-- Notes.php is the record page for the current cycle.
	After user added their items, those items will show up here.
	Before the current cycle ends, user can document how much of a specified item
	is left over.
	Currently has hardcoded placeholder items.
-->
<div class="container white-text green lighten-1">
	<div id="notes">
		<div class="row center-align">
			<h3>Total Waste:</h3>
		</div>
		<div class="row center-align">
			<h3>%___</h3>
		</div>
	<h4 class ="center-align">Current Cycle</h4>
	<ul class="collapsible" data-collapsible="expandable">
		<li class= "red accent-4">
			<div class="collapsible-header red accent-4">
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
			<div class="collapsible-body note_body">
					<div class="row">
						<div class="col s8 center-align">
							<span>Chicken</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col s8 center-align">
							<span>Steak</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col s8 center-align">
							<span>Pork</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
			</div>
		</li>
		<li class= "orange accent-4">
			<div class="collapsible-header orange accent-4">
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
			<div class="collapsible-body note_body">
					<div class="row">
						<div class="col s8 center-align">
							<span>Apple</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col s8 center-align">
							<span>Pear</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col s8 center-align">
							<span>Watermelon</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
			</div>
		</li>
		<li class= "light-green accent-4">
			<div class="collapsible-header light-green accent-4">
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
			<div class="collapsible-body note_body">
					<div class="row">
						<div class="col s8 center-align">
							<span>Asparagus</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col s8 center-align">
							<span>Celery</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col s8 center-align">
							<span>Potato</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
			</div>
		</li>
		<li class= "yellow accent-4">
			<div class="collapsible-header yellow accent-4">
				<div class="row">
					<div class="col s2">
						<i class="material-icons" style="font-size: 55px">keyboard_arrow_down</i>
					</div>
					<div class="col s4">
						<span>Dairy</span>
					</div>
					<div class="col s6 alt-right">
						<span class="alt-right" > $ __ </span>
					</div>
				</div>
			</div>
			<div class="collapsible-body note_body">
					<div class="row">
						<div class="col s8 center-align">
							<span>Cheese</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col s8 center-align">
							<span>Milk</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col s8 center-align">
							<span>Yogurt</span>
						</div>
						<div class="col s4">
							<span>$__ </span>
						</div>
						<div class="col s10 offset-s1">
							<form action="#">
								<p class="range-field">
									<input type="range" id="slider" min="0" max="100" value="0" step="10"/>
								</p>
							</form>
						</div>
					</div>
			</div>
		</li>
	</ul>
	</div>
</div>
<?php include("include/footer.php");?>
<!-- </body>
</html> -->
