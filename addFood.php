<<<<<<< HEAD
<?php include("include/header.php"); ?>
    <!-- main body will go here, body tags are already distributed to header and footer-->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/styles/addFood.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<a href="summary.php">Cancel</a>
		</div>
		<div class="col-xs-12">
			<label class="h2">Select a food category</label>
		</div>

	</div>

	<div class="row">
		<div class="col-sm-2 col-xs-6">
			<div id="div_meat" class="food-category">
				<label class="h3"> Meet </label>
			</div>
		</div>
		<div class="col-sm-2 col-xs-6">
			<div id="div_dairy" class="food-category">
				<label class="h3"> Dairy </label>
			</div>
		</div>
		<div class="col-sm-2 col-xs-6">
			<div id="div_veggies" class="food-category">
				<label class="h3"> Veggies </label>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<button>Finalize</button>
		</div>
	</div>

	<div class="row">
		<label class="h2">Added items</label>
	</div>
</div>
</body>
</html>
    <p>filler functions</p>
    <!--<div class="container-fluid ourContent">
        <div id="canvasSelect col-xs-12">
            <canvas id="canvasSelection" width="500px" height="500px" style="border:1px solid black"></canvas>
        </div>
    </div>-->

<?php include("include/footer.php"); ?>
