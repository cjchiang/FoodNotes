<?php include("include/header.php"); ?>
    <!-- main body will go here, body tags are already distributed to header and footer-->
    <div class="row">
        <div class="col-sm-4 col-xs-12">
            <a href="../index.php"><img id="logo" src="images/logo.png" alt="Apple"/></a> 
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <p>Your potential savings: $__________</p>
        </div>
    </div>
      <div class="container-fluid meats">
        <div data-toggle="collapse" data-target="#meatNavBar" href="#">
            <div class="row" class="toggleMe" aria-expanded="false">
                <div class="col-xs-6"><h2>Meat</h2></div>
                <div class="col-xs-6 costs"><h2>$10.00</h2></div>
            </div>
        </div>
        <div class="collapse" id="meatNavBar" >
            <div class="row">
                <div class="col-xs-6">
                    <p>Moist Juicy Steak</p>
                </div>
                <div class="col-xs-6 costs">
                    <p>$6.00</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <p>Amazing Salami</p>
                </div>
                <div class="col-xs-6 costs">
                    <p>$6.00</p>
                </div>
            </div>
        </div>
      </div>
      <div class="container-fluid veggies">
        <div data-toggle="collapse" data-target="#veggieNavBar" href="#" class="toggleMe" aria-expanded="false">
            <div class="row">
                <div class="col-xs-6"><h2>Veggie</h2></div>
                <div class="col-xs-6 costs"><h2>$10.00</h2></div>
            </div>
        </div>
        <div class="collapse" id="veggieNavBar">
          <ul>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
          </ul>
        </div>
      </div>
      <div class="container-fluid fruits">
        <div data-toggle="collapse" data-target="#fruitNavBar" href="#"  class="toggleMe" aria-expanded="false">
            <h2>Fruits</h2>
        </div>
        <div class="collapse" id="fruitNavBar">
          <ul>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
          </ul>
        </div>
      </div>
      <div class="container-fluid dairies">
        <div data-toggle="collapse" data-target="#dairyNavBar" href="#"  class="toggleMe" aria-expanded="false">
            <h2>Dairy</h2>
        </div>
        <div class="collapse" id="dairyNavBar">
          <ul>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
          </ul>
        </div>
      </div>
      <div class="container-fluid grains">
        <div data-toggle="collapse" data-target="#grainNavBar" href="#"  class="toggleMe" aria-expanded="false">
            <h2>Grains</h2>
        </div>
        <div class="collapse" id="grainNavBar">
          <ul>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
          </ul>
        </div>
      </div>
    <script type="text/javascript" src="script/dropDown.js"></script>
<?php include("include/footer.php"); ?>