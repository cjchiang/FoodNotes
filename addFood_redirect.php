<?php include("include/header.php");
	// session_start();
?>
<link rel="stylesheet" href="/styles/addFood.css"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="script/addfood.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
<script type="text/javascript">
	/**
	  Firebase setup, don't change
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
	const users = database.ref("users");

	// runs main function once logged-in user loaded onto page
	firebase.auth().onAuthStateChanged(function(user) {
	  if (user != null) {
	    console.log("logged in");
	    main();
	  } else 
	    console.log("not logged in");
	});

	// bad conventions my foot, would've made them const but JS doesn't allow undefined const
	var currentUser;
	var currentUserNode;
	var currentCycleCount;
	var currentCycleNode;

	function main(){
		// initializing above variables
		currentUser = firebase.auth().currentUser;
		currentUserNode = users.child(currentUser.uid);		
		currentUserNode.once("value", function(snap){
			currentCycleCount = snap.val().cycleCount; 
			currentCycleNode = currentUserNode.child("cycle" + currentCycleCount);

			//call other functions here if u add them
			addStuffToPage("anchor_head_fruit");
			
			$("#eventCalled").ready( addFoodsToCurrentCycle() );
		});
	}	
	/**
	TODO: quincy,
		> consider adding foods in this format, or w.e u want, ur pretty familiar w. jquery selectors
	*/
	function addStuffToPage(elemId) {
		$("#" + elemId).append("<div class='foodItem'>" + 
									"<p>food_name_1</p>"+
									"<span>$_price_1</span>"+
									"<div>food_category_1</div>"+
								"</div>");
		$("#" + elemId).append("<div class='foodItem'>" + 
									"<p>food_name_2</p>"+
									"<span>$_price_2</span>"+
									"<div>food_category_2</div>"+
								"</div>");
		$("#" + elemId).append("<div id='eventCalled'>eventCalled</div>");
	}
	/**
	TODO: quincy, 
		> echo / print / append ur foods with className .foodItem
	    > after u echo ur foods, echo an elem with id="eventCalled"
	*/
	function addFoodsToCurrentCycle() {
		// function called for each .foodItem on page
		$(".foodItem").each(function(){

			// edit this part according to ur addStuff function
			var foodName = $(this).children("p").text();
			var price = $(this).children("span").text();
			var foodCategory = $(this).children("div").text();

			var newKey = currentCycleNode.push().key;
			currentCycleNode.child(newKey).set({
				"foodName" : foodName,
				"price" : price,
				"category" : foodCategory
			});
		});
	}
</script>

<?php
    if (isset($_SESSION['OnOffHolder']) && !is_null($_SESSION['OnOffHolder'][0])) {
        $counter = 0;
        foreach($_SESSION['OnOffHolder'] as $nameMe) {
        foreach($_SESSION['storeMyPrices'] as $nameTwo) {
            if(strcmp($nameMe, $nameTwo) == 0) {
            echo
            '<div class="row"><div class="col s8"><span>' . $nameMe . '</span>
                </div>
                <div class="col s4">
                    <span>' ."$". $_SESSION['storeMyValues'][$counter] . '</span>
                </div>
            </div>';
        }
        $counter = $counter + 1;
        }
        $counter = 0;
    }
}
?>
	<div id="anchor_head_fruit" >
		<span>Fruits go here</span>
	</div>

	<div id="anchor_head_veg" >
		<span>Vegs go here</span>
	</div>

	<div id="anchor_head_diary">
		<span>Diary go here</span>
	</div> 

	<div id="anchor_head_meat">
		<span>Meats go here</span>
	</div>

<?php include("include/footer.php"); ?>
