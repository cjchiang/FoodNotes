<?php include("include/header.php"); ?>
    <div class="row green">
        <div class="col s12 center">
            <h1>Settings</h1>
        </div>
    </div>
    <div class="container">
    <!--Settings for the Cycle-->
        <div class="row">
            <label>Cycle Duration</label>
            <div class="input-field col s12  z-depth-2"> 
                <select class="browser-default">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">Weekly</option>
                    <option value="2">Biweekly</option>
                    <option value="3">Monthly</option>
                </select>
            </div>
        </div>
    <!--Settings for Theme-->
        <div class="row">
            <label>Theme</label>
            <div class="input-field col s12  z-depth-2">
            <select class="browser-default">
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
                <label>SUBMIT ME<input type="submit"></label>
            </div>
            <div class="col s6">
                <label>LOGOUT<input type="submit"></label>
            </div>
        </div>
    </div>
   <script>
    $(document).ready(function() {
        $('select').material_select();
        }); 
    </script>
<?php include("include/footer.php"); ?>
