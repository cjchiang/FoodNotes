<?php include("include/header.php"); ?>
<!-- Record.php is the archive page of all past records.
The current cycle does not show up here, but all non-100%
used items from the past show up here. Items here are added to
the running count of total items wasted
-->
  <!-- TODO: replace w. inline or dedicated js file -->
  <!-- <script type="text/javascript" src="../script/amIsignedIn.js"></script> -->
  <script type="text/javascript">
  var config = {
      apiKey: "AIzaSyBLFamIM2JEo2ESjIEn1PIhbkuKyaXF9Ds",
      authDomain: "food-notes-test.firebaseapp.com",
      databaseURL: "https://food-notes-test.firebaseio.com",
      projectId: "food-notes-test",
      storageBucket: "food-notes-test.appspot.com",
      messagingSenderId: "106608811518"
    };
    firebase.initializeApp(config);

  const database = firebase.database();
  const users = database.ref("users");
  var currentUser;
  var currentUserNode;
  var lastCycleCount;

  firebase.auth().onAuthStateChanged(function(user) {
    if (user != null) {
      console.log("logged in");
      currentUser = firebase.auth().currentUser;
      currentUserNode = users.child(currenUser.uid);
      confirmUserAccountReadyForCycles(currentUser);
      setUpLastCycle(currentUserNode);

      findTemp();
    } else {
      console.log("not logged in");
        alert("You're not logged in you hacker! Go home!");
        location.replace("index.php");
    }
  });

  function confirmUserAccountReadyForCycles(user) {
    users.orderByChild("email").equalTo(user.email).on('child_added', function(snap){
        var childKey = snap.key;
        var userID = user.uid;
      if( childKey != userID) {
        var child = db.ref("users").child(childKey);
          db.ref("users").child(userID).set(snap.val());
          child.remove();
      }
    });
  }

  function findTemp(){
    console.log("we got it:" + lastCycleCount);
    // if ( )
    // console.log("lc:" + getLastCycleIndex);
    /*find ans = currentNode -1
      return if ans < 0
      child(ans.key) */
    // userNode.orderByKey().endAt(ans.key).on("child_added", populateCyclesList)  
    // if (snap.key == "temp") {
    //   tempCycle = userNode.child("temp");
      // bug here, if fruit isn't first, it repeats 4x, idk y

      // populateTempList("Fruit", userNode.child("temp"));
      // populateTempList("Vegetable", userNode.child("temp"));
      // populateTempList("Diary", userNode.child("temp"));
      // populateTempList("Meat", userNode.child("temp"));
    // }
    // });
  }
  function populateCyclesList(snap) {

  }
  function populateCycleCategory(foodCategory, tempCycleRef) {
    var total = 0;
    // tempCycleRef.orderByChild("category").equalTo(foodCategory).once("child_added", function(snap){
    tempCycleRef.orderByChild("category").equalTo(foodCategory).on("child_added", function(snap){
      var snapData = snap.val();
      var foodName = snapData.product;
      var foodNameID = foodName.split(' ').join('_');;
      // var price = snapData.your_price;
      var wastedPercent = snapData.wasted;

      $("#anchor_head_"+ foodCategory).append(
        '<div class="row" id="'+ foodNameID +'">' +
          '<div class="col s8">' +
            '<span>' + foodName + '</span>' +
          '</div>' +
          '<div class="col s4">' +
            '<span id="' + foodNameID + '_price">' + wastedPercent + '</span>' +
          '</div>' +
        '</div> '
      );
      total += parseFloat( price) ;
    });
    $("#"+foodCategory+"_total").text("$ " + total.toFixed(2));
  }

  var tempNode;
  var lastCycle;

  function updateTotal(foodGroupID, childID) {
    var sum = 0;
    var foodGroupPriceKey = foodGroupID.replace("anchor_head_", "");
    $("#"+foodGroupID).find("[id$='_price']").each(function(){
      var itemPriceStr = $(this).text();
      var itemPrice = parseFloat( itemPriceStr.replace("$", "") );
      sum += itemPrice;
    });
    console.log("foodGroupID:" +  foodGroupID)
    console.log("sum: " + sum);
    $("#" + foodGroupPriceKey + "_total").text("$ " + sum.toFixed(2) );
  }

  function setUpLastCycle(userNode) {
    userNode.orderByKey().once("value", function(snap){
      console.log("set: " + snap.val().cycleCount);
      lastCycleCount = snapData.val().cycleCount;
    });
  }

  </script>
  <h4 class="center-align">Previous Cycles</h4>
  <ul class="collapsible" data-collapsible="expandable">
    <li>
      <div class="collapsible-header">
        <div class="row">
          <div class ="col s2">
            <i class="material-icons" style="font-size: 40px">add_circle</i>
          </div>
          <div class ="col s10">
            <span>Cycle 1 %_<span>
          </div>
        </div>
      </div>
      <div class="collapsible-body">
        <ul class="collapsible" data-collapsible="expandable">
          <li class="red accent-4">
            <div class="collapsible-header red accent-4">
              <div class="row">
                <div class="col s2">
                  <i class="material-icons" style="font-size: 30px">add_circle</i>
                </div>
                <div class="col s4">
                  <span>Meat</span>
                </div>
                <div class="col s6 alt-right">
                  <span class="alt-right" >%_</span>
                </div>
              </div>
            </div>
            <div class="collapsible-body note_body center-align">
              <div class="row">
              </div>
            </div>
          </li>
          <li class="orange accent-4">
            <div class="collapsible-header orange accent-4">
              <div class="row">
                <div class="col s2">
                  <i class="material-icons" style="font-size: 30px">add_circle</i>
                </div>
                <div class="col s4">
                  <span>Fruit</span>
                </div>
                <div class="col s6 alt-right">
                  <span class="alt-right" >%_</span>
                </div>
              </div>
            </div>
            <div class="collapsible-body note_body center-align">
              <div class="row">
                <div class="col s8">
                  <span>Peach</span>
                </div>
                <div class="col s4">
                  <span>%__ </span>
                </div>
              </div>
              <div class="row">
                <div class="col s8">
                  <span>Banana</span>
                </div>
                <div class="col s4">
                  <span>%__ </span>
                </div>
              </div>
              <div class="row">
                <div class="col s8">
                  <span>Apple</span>
                </div>
                <div class="col s4">
                  <span>%__ </span>
                </div>
              </div>
            </div>
          </li>
          <li class="light-green accent-4">
            <div class="collapsible-header light-green accent-4">
              <div class="row">
                <div class="col s2">
                  <i class="material-icons" style="font-size: 30px">add_circle</i>
                </div>
                <div class="col s4">
                  <span>Veggies</span>
                </div>
                <div class="col s6 alt-right">
                  <span class="alt-right" >%_</span>
                </div>
              </div>
            </div>
            <div class="collapsible-body note_body center-align">
              <div class="row">
                <div class="col s8">
                  <span>Asparagus</span>
                </div>
                <div class="col s4">
                  <span>%__ </span>
                </div>
              </div>
              <div class="row">
                <div class="col s8">
                  <span>Broccoli</span>
                </div>
                <div class="col s4">
                  <span>%__ </span>
                </div>
              </div>
              <div class="row">
                <div class="col s8">
                  <span>Eggplant</span>
                </div>
                <div class="col s4">
                  <span>%__ </span>
                </div>
              </div>
            </div>
          </li>
          <li class="yellow accent-4">
            <div class="collapsible-header yellow accent-4">
              <div class="row">
                <div class="col s2">
                  <i class="material-icons" style="font-size: 30px">add_circle</i>
                </div>
                <div class="col s4">
                  <span>Dairy</span>
                </div>
                <div class="col s6 alt-right">
                  <span class="right-align" >%_</span>
                </div>
              </div>
            </div>
            <div class="collapsible-body note_body center-align">
              <div class="row">
                <div class="col s8">
                  <span >Milk</span>
                </div>
                <div class="col s4">
                  <span>%__ </span>
                </div>
              </div>
              <div class="row">
                <div class="col s8">
                  <span>Eggs</span>
                </div>
                <div class="col s4">
                  <span>%__ </span>
                </div>
              </div>
              <div class="row">
                <div class="col s8">
                  <span>Cheese</span>
                </div>
                <div class="col s4">
                  <span>%__ </span>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </ul>
    <?php include("include/footer.php"); ?>
