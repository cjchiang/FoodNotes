<?php include("include/header.php"); ?>
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
                <select>
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">Weekly</option>
                    <option value="2">Biweekly</option>
                    <option value="3">Monthly</option>
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
                <input type="submit">
              </a>
            </div>
            <div class="col s6">
              <a class="waves-effect waves-light btn green lighten-3">
                <input value="LogOut" type="submit">
              </a>
            </div>
        </div>
    </div>
   <script>
    $(document).ready(function() {
        $('select').material_select();
        });
    </script>
<?php include("include/footer.php"); ?>
