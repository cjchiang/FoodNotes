<?php include("include/header.php"); ?>
    <script type="text/javascript"></script>
    <script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
    <script src="script/settings.js"></script>
    <div class="row">
        <div class="col s12 center">
            <h1>Settings</h1>
        </div>
    </div>
    <!--Settings for the Cycle-->
        <div class="row">
            <h5 class="white-text center">Cycle Duration</h5>
            <div class="input-field col s12 z-depth-2">
                <select id="myCalendarChoice">
                    <option value="" disabled selected>Choose your cycle duration</option>
                    <option value="weekly">7 days</option>
                    <option value="biweekly">14 days</option>
                    <option value="monthly">30 days</option>
                </select>
            </div>
        </div>
    <!--Confirm and Logout-->
        <div class="row center-align">
            <div class="col s6">
              <a class="waves-effect waves-light btn red darken-4 reviveMe">
                <input type="submit" onclick="checkOption()">
              </a>
            </div>
            <div class="col s6">
              <a class="waves-effect waves-light btn red darken-4 reviveMe">
                <input value="LogOut" type="submit" id="logoutBtn">
              </a>
            </div>
        </div>
    <div id ="test"></div>
   <script>
    $(document).ready(function() {
        $('select').material_select();
    });

    $("#logoutBtn").click(function(){
        console.log("signed out");
        firebase.auth().signOut();
        location.replace("index.php");
    });
    </script>
<?php include("include/footer.php"); ?>
