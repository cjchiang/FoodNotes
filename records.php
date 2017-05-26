<?php include("include/header.php"); ?>
<!-- Record.php is the archive page of all past records.
The current cycle does not show up here, but all non-100%
used items from the past show up here. Items here are added to
the running count of total items wasted
-->
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

  // Set up page for loading cycles, but if user not logged in,
  // redirect them to home page
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

  /*Make sure user child in firebase has user ID as key,
  instead of default random Hash */
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

  /* Checks firebase for previous cycles, or displays an empty page container if none found*/
  function checkIfCyclesExist (){
    if ( lastCycleCount - 1 < 0) {
      displayEmptyRecord();
      return;
    }
    var lastCycleKey = "cycle" + (lastCycleCount-1);
    currentUserNode.orderByKey().endAt(lastCycleKey).on("child_added", function(snap){  
     var snapData = snap.val()
        cycle = currentUserNode.child(snap.key);
      createCycleHeaderOnPage(snap.key);  
      console.log("started:" + snap.key);    
      populateCycleCategory("Fruit", cycle);
      populateCycleCategory("Vegetable", cycle);
      populateCycleCategory("Dairy", cycle);
      populateCycleCategory("Meat", cycle);
    });
  }

  /* Display an empty records container on page.*/
  function displayEmptyRecord() {
    $("#cycle_anchor_head").append(
      '<div class="container white grey-text">'+
      '<h4 class="center-align">No previous records found</h4>' +
      '</div>'
      );
  }

  /* Appends a new empty cycle to page. Apologies for ungodly string, materialize 
     doesn't like dynamically generated pages very much. */
  function createCycleHeaderOnPage(CycleKey) {
    $("#cycle_anchor_head").append(
    '<ul class="collapsible" data-collapsible="expandable" id="'+ CycleKey+ '">'+
     // head portion
     '<li>'+
      '<div class="collapsible-header">'+
        '<div class="row">' +
          '<div class="col s1">'+ 
            '<i class="material-icons" style="font-size: 35px">add_circle</i>' +
          '</div>' +

          '<div class ="col s8 push-s1">' +
            '<span style="font-size: 6vw">% of $ wasted: </span>'+
          '</div>' +
        
          '<div class ="col s1">' +
            '<span id="percent_wasted" style="font-size: 6vw"> 0 % </span>'+
          '</div>' +
        
          '<div class ="col s6 left">' +
            '<span id="cycleStartDate" style="font-size: 6vw">Cycle_Start_Date</span>'+
          '</div>' +
          // CANT FIT 
          // '<div class ="col s1 offset-s1">' +
          //   '<span style="font-size: 6vw">-</span>'+
          // '</div>' +

          '<div class ="col s6 pull-s1">' +
            '<span id="cycleEndDate" style="font-size: 6vw">Cycle_End_Date</span>'+
          '</div>' +

        '</div>' +
      '</div>' +
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

  /* Fill in a newly created with a specific food category*/
  function createCycleCategoryHeaderOnPage(CycleKey, foodCategory) {
    var foodCategoryName = foodCategory;
    // vegetable as a string can't fit on line, so replaced with veggies instead
    if (foodCategory == "Vegetable")
      foodCategoryName = "Veggies"
    $('.collapsible').collapsible();
     $("#" + CycleKey).find("#" +foodCategory+"_anchor_head").append(
          '<div class="row">' +
            '<div class="col s2">' +
              '<i class="material-icons" style="font-size: 27px">add_circle</i>' +
            '</div>' +
            '<div class="col s4">' +
              '<span style="font-size:8vw">' + foodCategoryName + '</span>'+
            '</div>' +
            '<div class="col s6 alt-right">' +
              '<span class="alt-right" id="' + foodCategory +'_percent" >0%</span>'+
            '</div>' +
          '</div>' 
          );
  }
  
  /* returns string as float, used to make finalizeStat for readable*/ 
  function roundStringAsFloat(str) {
     return parseFloat(str) ;
   } 

  /* Populates a food category of a newly created cycle with foods from that cycle and category, as
  well as percents and dates of that cycle*/
  function populateCycleCategory(foodCategory, cycleRef) {
    var cycleKey = cycleRef.key;
    cycleRef.once("value", function(snap){
      var snapData = snap.val();
      var percent_wasted = roundStringAsFloat( snapData.percent_wasted );
        if ( isNaN(percent_wasted))
          percent_wasted = 0;

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

      var enddate;
      var startdate;
      try {
        enddate = snapData.cycleEndDate;
        startdate = snapData.cycleStartDate;
      } catch(e){}

      if (typeof enddate === "undefined") {
        enddate = "End date unset"
        startdate = "Start date unset"
      } else {
        enddate = formatDate(enddate);
        startdate = formatDate(startdate);
      }
      console.log("#" +foodCategory+"_percent:" + foodCategory_percent)
     $("#" + cycleKey).find("#percent_wasted").text( percent_wasted + "%");
     $("#" + cycleKey).find("#" +foodCategory+"_percent").text( foodCategory_percent + "%");      
     $("#" + cycleKey).find("#cycleStartDate").text( startdate);      
     $("#" + cycleKey).find("#cycleEndDate").text( "-> " + enddate );      
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

  /* formats a time object and returns a displayable string representing it*/
  function formatDate(timeObj) {
    var deadline = new Date(timeObj);
    var dd = deadline.getDate();
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var mm = monthNames[ deadline.getMonth() ];
    // var yyyy = deadline.getFullYear();
    var weekDays = ["Sun","Mon","Tues","Wed","Thur","Fri","Sat"];
    var ww = weekDays[ deadline.getDay() ];
    return ww + ', ' + mm + ' ' + dd; 
  }

  var tempNode;
  var lastCycle;

  /* A gateway function for getting javascript to access last cycle from firebase */
  function setUpLastCycle(userNode) {
    userNode.orderByKey().once("value", function(snap){
      console.log("set: " + snap.val().cycleCount);
      lastCycleCount = snap.val().cycleCount;
      checkIfCyclesExist();
    });
  }

  </script>
  <h4 class="center-align">Previous Cycles</h4>
  <div id="cycle_anchor_head">
    
  </div>
  
    <?php include("include/footer.php"); ?>
