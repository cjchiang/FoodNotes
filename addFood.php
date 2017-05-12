<?php include("include/header.php"); ?>
    <!--Filters food categories for users and finalize-->
<link rel="stylesheet" href="/styles/addFood.css"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<div class="container">
        <div class="row">
            <div class="col s12">
                <h4><a href="notes.php"><i class="small material-icons">arrow_left</i> Cancel</a> </h4>
            </div>
            <div class="col s12">
                <h4>Select a food category</h4>
            </div>

        </div>

        <div class="row">
            <div class="col s6 m2">
                <div id="div_meat" class="food-category center-align">
                    <a href="addMeet.php">
                        <h4> Meat </h4>
                    </a>
                </div>
            </div>
            <div class="col s6 m2">
                <div id="div_dairy" class="food-category center-align">
                    <a href="addDairy.php">
                        <h4> Dairy </h4>
                    </a>
                </div>
            </div>
            <div class="col s6 m2">
                <div id="div_veggies" class="food-category center-align">
                    <a href="addVeggies.php">
                        <h4> Veggies </h4>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 center-align">
                <button>Finalize</button>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <h4>Added items</h4>
            </div>

            <div class="col s12">
                <ul class="collection">
                    <li class="collection-item avatar">

                        <div class="row">
                            <div class="col s12">
                                <h5>May 9 2017</h5>
                            </div>
                            <div class="col s12">
                                <h5>Meat</h5>
                            </div>
                            <div class="col s6">
                                <p>beef</p>
                            </div>
                            <div class="col s6">
                                <p>$23.90</p>
                            </div>
                            <div class="col s6">
                                <p>round stick</p>
                            </div>
                            <div class="col s6">
                                <p>$30.90</p>
                            </div>
                            <div class="col s12">
                                <h5>Dairy</h5>
                            </div>
                            <div class="col s6">
                                <p>Butter</p>
                            </div>
                            <div class="col s6">
                                <p>$23.90</p>
                            </div>
                            <div class="col s6">
                                <p>Homogenized milk</p>
                            </div>
                            <div class="col s6">
                                <p>$20.90</p>
                            </div>
                            <div class="col s12">
                                <h5>Veggies</h5>
                            </div>
                            <div class="col s6">
                                <p>Onions</p>
                            </div>
                            <div class="col s6">
                                <p>$23.90</p>
                            </div>
                            <div class="col s6">
                                <p>Tomatoes</p>
                            </div>
                            <div class="col s6">
                                <p>$20.90</p>
                            </div>
                        </div>
                    </li>

              </ul>
        </div>
    </div>

        <!--<div class="container-fluid ourContent">
            <div id="canvasSelect col-xs-12">
                <canvas id="canvasSelection" width="500px" height="500px" style="border:1px solid black"></canvas>
            </div>
        </div>-->
    </div>
<?php include("include/footer.php"); ?>
