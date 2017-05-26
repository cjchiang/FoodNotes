	/** 
	Support code for all add<foodCategory>.php files, where foodCategory is Fruit, Vegetable, Meat, and Dairy
	@written mostly by Alex....
	*/
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
	const foods = database.ref("foods");
	const users = database.ref("users");
	
	// If a user arrived at this page via URL(not logged in), they must leave
	// Page will break if user tried to use it without loggin in
	firebase.auth().onAuthStateChanged(function(firebaseUser){
    if (!firebaseUser) {
		alert("You're not logged in you hacker! Go home!");
        location.replace("index.php");
   		} 
	});

	/*Populates a drop down with fruit food itemns, based on text inside search bar*/
	function populateList(foodCategory) {

		foods.orderByChild("category").equalTo(foodCategory).on("child_added", function(snap){
			var snapData = snap.val();
			var foodName = removeSpaces(snapData.product);
			var quantity = snapData.default_quantity;
			var unit = snapData.default_unit;
			var newFoodBlock = document.getElementById(snap.key);
			console.log(foodName);

		    if (!newFoodBlock) {
	      		$("#anchor_head").append(
				'<div class="row" id ="' + snap.key + '">' +
					'<div class="input-field col s8 ">' +
						'<input class="check_tick" id="' + foodName + '" type="checkbox" '+
						'name="checkbox"/>' +
						'<label for="' + foodName+ '">' + snapData.product + '</label>' +
					'</div>' +
					'<div class="input-field col s4">' +
						'<input type="text" id="' + foodName + '_bought" placeholder="$' + snapData.price +
						'"/>' +
					'</div>' +
				'</div> '
				); 
		    }
		});
	}

	/* queries for a specific product, based on search term (name) and category
	   then hides everything else */
	function filterProducts( searchTerm, searchCategory ) {
		foods.orderByChild("category").equalTo(searchCategory).on("child_added", function(snap){
			var snapData = snap.val();
			var foodItem = document.getElementById(snap.key);
			if( foodItem != null && !contains(searchTerm, snapData.product) ) {
				hideme(snap.key, true);
			} else {
				hideme(snap.key, false);
			}
		});
	}

 	/* hide or display an element with animation */
	function hideme(elemID, toggle){
		if( toggle)
			$("#" + elemID).fadeOut(500);
		else
			$("#" + elemID).fadeIn(1000);
	}

	/* returns true if target contains query string, strings are case insensitive */
	function contains( queryStr, targetStr) {
		queryStr = queryStr.toLowerCase();
		targetStr = targetStr.toLowerCase();
		if ( targetStr.search(queryStr) != -1)
			return true;
		return false;
	}

	// replace spaces in string with underscores, used to create css IDs
	function removeSpaces(str){
		var newStr = str.split(' ').join('_');
		return newStr;
	}

	// replace spaces in string with spaces, used for names that will be displayed
	function readdSpaces(str){
		var newStr = str.split('_').join(' ');
		return newStr;
	}

	// ununsed function, scrolls to an element
	function scroll_to_elem(elemID, scrollSpeed) {
	    $('html, body').animate({
	        scrollTop: $("#click_" + elemID).offset().top
	    }, scrollSpeed);
	}

	function logMe(foodName) {
		var ancestorKey = $("#" + foodName).parents(".row").attr("id");

		if (!alreadyInCycle(foodName) ) {
			console.log("logged:" + foodName);
			addItem(foodName, ancestorKey);
		} else {
			console.log("already logged, appending");
			appendItem(foodName, ancestorKey);
		}
	}

	function logAllItems() {
		$(":checked").each(function(){
			logMe(this.id);
		});
		location.replace("addFood.php");
	}
	function alreadyInCycle(foodName) {
		var currentUser = firebase.auth().currentUser;
		var tempCycle = database.ref("users/" + currentUser.uid + "/temp");
		return queryForItem(tempCycle, foodName);
	}

	function queryForItem(cycle, foodName) {
		if (typeof cycle === "undefined")
			return false;
		var bool = false;
		cycle.orderByChild("product").equalTo(foodName).on("child_added", function(snap){
			bool = true;
		});
		return bool;
	}
		//add new item to temporary list
	function addItem(foodNameID, refKey){
		var foodName = foodNameID.split("_").join(" ");
		var price;

		var priceStr = $("#" + foodNameID + "_bought").attr("placeholder");
		var price_default = priceStr.replace("$", "");	
		
		var price_set = $("#" + foodNameID + "_bought").val();
		// use default price if set price is empty string or not numeric
		if (price_set == "" || !isNumeric(price_set) ) {
			price = parseFloat(price_default) ;
		} else {
			price = parseFloat(price_set) ;
		}

		currentUserNode.once("value", function(){
			var tempCycle = currentUserNode.child("temp");
			tempCycle.update({ "cycle": true });

			tempCycle.once("value", function(){
				var item = foods.child(refKey);
				item.once("value", function(snap){
					var newKey = tempCycle.push( snap.val() ).key;

					tempCycle.child(newKey).update({"your_price" : price});
				});
			});
		});
	}

	//add more of an existing item to temporary list
	function appendItem(foodNameID, refKey){

		var foodName = foodNameID.split("_").join(" ");
		var price;

		var priceStr = $("#" + foodNameID + "_bought").attr("placeholder");
		var price_default = priceStr.replace("$", "");	
		
		var price_set = $("#" + foodNameID + "_bought").val();
		// use default price if set price is empty string or not numeric
		if (price_set == "" || !isNumeric(price_set) ) {
			price = parseFloat(price_default) ;
		} else {
			price = parseFloat(price_set) ;
		}

		currentUserNode.once("value", function(){
			var tempCycle = currentUserNode.child("temp");
			tempCycle.update({ "cycle": true });
			
			tempCycle.orderByChild("product").equalTo( foodName ).on("child_added", function(snap){
				var snapData = snap.val();
				var appendTarget = tempCycle.child(snap.key);
				var old_price = parseFloat( snapData.your_price ) ;

				price = (price + old_price).toFixed(2);
				console.log("newprice:" + price);
				appendTarget.update({"your_price" : price });
			});
		});
	}

	// function i pulled from stack overflow(not mine):
	// https://stackoverflow.com/questions/18082/validate-decimal-numbers-in-javascript-isnumeric
	function isNumeric(n) {
	  return !isNaN(parseFloat(n)) && isFinite(n);
	}

	function noCyclesFound(){
		var count;
		currentUserNode.on("value", function(snap){
			count = snap.val().cycleCount;
		});
		console.log(count);
		return count;
	}
	function setUpCycleCount() {
		currentUserNode.once("value", function(snap){
			userNode.child("cycleCount").set(1);
		});
	}
