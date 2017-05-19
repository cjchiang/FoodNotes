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

	/*Populates a drop down with fruit food itemns, based on text inside search bar*/
	function populateList(foodCategory) {

		foods.orderByChild("category").equalTo(foodCategory).on("child_added", function(snap){
			var snapData = snap.val();
			var foodName = removeSpaces(snapData.product);
			var newFoodBlock = document.getElementById(snap.key);
			console.log(foodName);

		    if (!newFoodBlock) {
	      		$("#anchor_head").append(
				'<div class="row" id ="' + snap.key + '">' +
					'<a id="click_' + foodName +'"></a>'+
				'<div class="input-field col s6 ">' +
					'<input id="' + foodName + '" type="checkbox" '+
					'onchange="logMe(this);"'
					+'name="checkbox"/>' +		
					'<label for="' + foodName+ '">' + snapData.product + '</label>' +
				'</div>' +
				'<div class="input-field col s6">' +
					'<input type="text" id="' + foodName + '_bought" placeholder="$' + snapData.price + 
					'"/>' +
				'</div>' +		
				'</div> '
				); 
		    }

		    $("#"+foodName+"_bought").val(snapData.price);
		});
	}

	// queries for a specific product, based on search term (name) and category
	// then hides everything else
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

	// hide or display an element with animation
	function hideme(elemID, toggle){
		if( toggle)
			$("#" + elemID).fadeOut(500);
		else
			$("#" + elemID).fadeIn(1000);
	}

	// returns true if target contains query string, strings are case insensitive
	function contains( queryStr, targetStr) {
		queryStr = queryStr.toLowerCase();
		targetStr = targetStr.toLowerCase();
		if ( targetStr.search(queryStr) != -1)
			return true;
		return false;
	}

	// replace strings in item with underscores, used to create css IDs
	function removeSpaces(str){
		var newStr = str.split(' ').join('_');
		return newStr;
	}

	// ununsed function, scrolls to an element
	function scroll_to_elem(elemID, scrollSpeed) {
	    $('html, body').animate({
	        scrollTop: $("#click_" + elemID).offset().top
	    }, scrollSpeed);
	}

	