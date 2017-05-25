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
      currentUser = user;
      currentUserNode = users.child(user.uid);
      confirmUserAccountReadyForCycles(currentUser);

      setUpLastCycle(currentUserNode);  
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
    if ( lastCycleCount - 1 <= 0) {
      displayEmptyRecord();
      return;
    }
    var lastCycleKey = "cycle" + (lastCycleCount-1);
    // currentUserNode.orderByKey().endAt(lastCycleKey).orderByChild("cycle").equalTo(true).on("child_added", function(snap){  
    currentUserNode.orderByKey().endAt(lastCycleKey).on("child_added", function(snap){  
     var snapData = snap.val()
        cycle = currentUserNode.child(snap.key);
      // populateCyclesList(cycle)
      createCycleHeaderOnPage(snap.key);  
      console.log("started:" + snap.key);    
      populateCycleCategory("Fruit", cycle);
      populateCycleCategory("Vegetable", cycle);
      populateCycleCategory("Dairy", cycle);
      populateCycleCategory("Meat", cycle);
     // });
    });
      // populateTempList("Fruit", userNode.child("temp"));
      // populateTempList("Vegetable", userNode.child("temp"));
      // populateTempList("Dairy", userNode.child("temp"));
      // populateTempList("Meat", userNode.child("temp"));
    // }
    // });
  }

  function displayEmptyRecord() {
    $("#cycle_anchor_head").append(
      '<div class="container white grey-text">'+
      '<h4 class="center-align">No previous records found</h4>' +
      '</div>'
      );
  }
  function createCycleHeaderOnPage(CycleKey) {
    $("#cycle_anchor_head").append(
    '<ul class="collapsible" data-collapsible="expandable" id="'+ CycleKey+ '">'+
     // head portion
     '<li>'+
      '<div class="collapsible-header">'+
        '<div class="row">' +
          '<div class="col s2">'+ 
          '<i class="material-icons" style="font-size: 35px">add_circle</i>' +
          '</div>' +
          '<div class ="col s8">' +
            '<span id="cycleEndDate" style="font-size: 6vw">Cycle_End_Date</span>'+
          '</div>' +
          '<div class ="col s2 pull-s1">' +
            '<span id="percent_wasted" style="font-size: 6vw"> 0% </span>'+
          '</div>' +
        '</div>' +
      '</div>' +
      //body portion
       '<div class="collapsible-body">' +
          '<ul class="collapsible" data-collapsible="expandable" id="cycle_anchor_body">' +
        
          '<li class="red" accent-4">' +
            '<div class="collapsible-header red accent-4" id="Meat_anchor_head"></div>' +
            '<div class="collapsible-body note_body center-align" id="Meat_anchor_body"></div>' +
           '</li>' +
          '<li class="orange" accent-4">' +
            '<div class="collapsible-header orange accent-4" id="Fruit_anchor_head"></div>' +
            '<div class="collapsible-body note_body center-align" id="Fruit_anchor_body"></div>' +
           '</li>' +
          '<li class="light-green" accent-4">' +
            '<div class="collapsible-header light-green accent-4" id="Vegetable_anchor_head"></div>' +
            '<div class="collapsible-body note_body center-align" id="Vegetable_anchor_body"></div>' +
           '</li>' +
          '<li class="yellow" accent-4">' +
            '<div class="collapsible-header yellow accent-4" id="Dairy_anchor_head"></div>' +
            '<div class="collapsible-body note_body center-align" id="Dairy_anchor_body"></div>' +
          '</li>' +

          '</ul>' +
        '</div>' +
     '</li>'+
    '</ul> ' );
    createCycleCategoryHeaderOnPage(CycleKey, "Meat");
    createCycleCategoryHeaderOnPage(CycleKey, "Fruit");
    createCycleCategoryHeaderOnPage(CycleKey, "Vegetable");
    createCycleCategoryHeaderOnPage(CycleKey, "Dairy");
  }

  function createCycleCategoryHeaderOnPage(CycleKey, foodCategory) {
    var foodCategoryName = foodCategory;
    if (foodCategory == "Vegetable")
      foodCategoryName = "Veggies"
    $('.collapsible').collapsible();
     $("#" + CycleKey).find("#" +foodCategory+"_anchor_head").append(
          '<div class="row">' +
            '<div class="col s2">' +
              '<i class="material-icons" style="font-size: 35px">add_circle</i>' +
            '</div>' +
            '<div class="col s4">' +
              '<span>' + foodCategoryName + '</span>'+
            '</div>' +
            '<div class="col s6 alt-right">' +
              '<span class="alt-right" id="' + foodCategory +'_percent" >0%</span>'+
            '</div>' +
          '</div>' 
          );
  }
 
  function roundStringAsFloat(str) {
     return Math.round( parseFloat(str) );
   } 
  function populateCycleCategory(foodCategory, cycleRef) {
    var cycleKey = cycleRef.key;
    cycleRef.once("value", function(snap){
      var snapData = snap.val();
      var percent_wasted = roundStringAsFloat( snapData.percent_wasted );
        if ( isNaN(percent_wasted))
          percent_wasted = 0;
      // var foodCategory_percentStr = foodCategory + "_percent";
      // var foodCategory_percent = snapData.foodCategory_percentStr;
        // if ( isNaN(foodCategory_percent))
          // foodCategory_percent = 0;

      var foodCategory_percent;
      switch(foodCategory) {
        case "Meat" : foodCategory_percent = roundStringAsFloat( snapData.Meat_percent);
            break;
        case "Fruit" : foodCategory_percent = roundStringAsFloat( snapData.Fruit_percent);
            break;
        case "Vegetable" : foodCategory_percent = roundStringAsFloat( snapData.Vegetable_percent);
            break;
        case "Dairy" : foodCategory_percent = roundStringAsFloat( snapData.Dairy_percent);
            break;
      }
      if ( isNaN(foodCategory_percent))
        foodCategory_percent = 0;

      var deadline = snapData.cycleEndDate;
      if (typeof deadline === "undefined")
        deadline = "End date unset"
     $("#" + cycleKey).find("#percent_wasted").text( percent_wasted + "%");
     $("#" + cycleKey).find("#" +foodCategory+"_percent").text( foodCategory_percent + "%");      
     $("#" + cycleKey).find("#cycleEndDate").text( deadline );      

    });

    // var total = 0;
    // tempcycleRef.orderByChild("category").equalTo(foodCategory).once("child_added", function(snap){
    cycleRef.orderByChild("category").equalTo(foodCategory).on("child_added", function(snap){
      var snapData = snap.val();
      var foodName = snapData.product;
      var foodNameID = foodName.split(' ').join('_');;
      var wastedPercent = snapData.wasted;
     $("#" + cycleKey).find("#" +foodCategory+"_anchor_body").append(
        '<div class="row" id="'+ foodNameID +'">' +
          '<div class="col s8">' +
            '<span>' + foodName + '</span>' +
          '</div>' +
          '<div class="col s4">' +
            '<span>' + wastedPercent + '% </span>' +
          '</div>' +
        '</div> '
      );
    });
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
    // console.log(userNode.key)
    userNode.orderByKey().once("value", function(snap){
      console.log("set: " + snap.val().cycleCount);
      lastCycleCount = snap.val().cycleCount;
      findTemp();
    });
  }

  </script>
  <h4 class="center-align">Previous Cycles</h4>
  <div id="cycle_anchor_head">
    
  </div>
  
    <?php include("include/footer.php"); ?>
