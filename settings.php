<?php include("include/header.php"); ?>
<<<<<<< HEAD
<<<<<<< HEAD
    <script src="settings.js"></script>
=======
    <script type="text/javascript"></script>
    <script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
    <script src="script/login.js" type="text/javascript"></script>
>>>>>>> b0ff1c926620a0166c1cc246ebd7712be06b2237
=======
    <script type="text/javascript"></script>
    <script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
    <script src="script/login.js" type="text/javascript"></script>
    <script src="settings.js"></script>
>>>>>>> 320830130f31d868ffd7854c02a433680d01b155
    <div class="container green lighten-1 white-text">
    <div class="row">
        <div class="col s12 center">
            <h1>Settings</h1>
        </div>
    </div>
    <!--Settings for the Cycle-->
        <div class="row">
            <label class="white-text">Cycle Duration</label>
            <div class="input-field col s12  z-depth-2">
                <select id="myChoice">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="weekly">Weekly</option>
                    <option value="biweekly">Biweekly</option>
                    <option value="monthly">Monthly</option>
                </select>
            </div>
        </div>
    <!--Settings for Theme-->
        <div class="row">
            <label class ="white-text">Theme</label>
            <div class="input-field col s12  z-depth-2">
            <select>
                <option value="" disabled selected>Choose your option</option>
                <option value="1">Gray</option>
                <option value="2">Pink</option>
                <option value="3">Blue</option>
            </select>
            </div>
        </div>
    <!--Confirm and Logout-->
        <div class="row center-align">
            <div class="col s6">
              <a class="waves-effect waves-light btn green lighten-3">
                <input type="submit" onclick="checkOption()">
              </a>
            </div>
            <div class="col s6">
              <a class="waves-effect waves-light btn green lighten-3">
                <input value="LogOut" type="submit" id="logoutBtn">
              </a>
            </div>
        </div>
    </div>
    <div id ="test"></div>
   <script>
    $(document).ready(function() {
        $('select').material_select();
        });

        $(" :submit").click(function(){
            location.replace("index.php");
        });
    </script>
<?php include("include/footer.php"); ?>
