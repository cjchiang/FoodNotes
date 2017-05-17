
$(document).ready(function(){

	var meatItems = [
	{   
		"category": "Meat",
		"product" : "Round steak",
		"spent": "0"

	 },
	{
		"category": "Meat",
		"product" : "Sirloin steak",
		"spent": "0"
	},
	{
		"category": "Meat",
		"product" : "Prime rib roast",
		"spent": "0"
	},
	{
		"category": "Meat",
		"product" : "Blade roast",
		"spent": "0"
	},
	{
		"category": "Meat",
		"product" : "Stewing beef",
		"spent": "0"
	},
	{
		"category": "Meat",
		"product" : "Ground beef",
		"spent": "0"
	},
	{
		"category": "Meat",
		"product" : "Pork chops",
		"spent": "0"
	},
	{
		"category": "Meat",
		"product" : "Chicken",
		"spent": "0"
	},
	{
		"category": "Meat",
		"product" : "Bacon",
		"spent": "0"
	},
	{
		"category": "Meat",
		"product" : "Wieners",
		"spent": "0"
	},
	{
		"category": "Meat",
		"product" : "Canned sockeye salmon",
		"spent": "0"
	},
	{
		"category": "Meat",
		"product" : "Eggs",
		"spent": "0"
	}

	]

	if (typeof(Storage) !== "undefined") {
		//console.log("ready");
		if (localStorage.meatItems) { 
			//console.log(localStorage.meatItems);
			meatItems = jQuery.parseJSON(localStorage.meatItems);
			//console.log(meatItems);

		} else {
			localStorage.setItem("meatItems",JSON.stringify(meatItems));
		}
	} else {
		alert("Browser does not support");
    }

	generate_add_meat_form(meatItems);

	$("#link_finalize").click(function(){
		/* add to database before cleaning. */
		localStorage.removeItem(localStorage.meatItems);
	});

	$(".checkbox").change(function(){
		var input ="#" + this.id.replace("check", "input");
		//console.log(input);
		if (this.checked) {
			$(input).prop("disabled", false);
		} else {
			$(input).val("");
			$(input).prop("disabled", true);
		}

	});

	$("input[type=text]").change(function(){
		var product = this.id.replace("input_", "");
		//product = product.replace("_", " ");
		product = product.replace(new RegExp('_', 'g'), ' ');

		var spent = $(this).val();
		for (var i = 0; i < meatItems.length; ++i) {
			if (meatItems[i]['product'] == product) {
			meatItems[i]['spent'] = spent;
			break;
			}
		}
		localStorage.setItem("meatItems",JSON.stringify(meatItems));
		console.log(meatItems);
		
	});

});

function generate_add_meat_form(meatItems){
	//console.log(meatItems);

	$("#form_add_meat_items").empty();
	for (item of meatItems) {
		var row = generate_row(item);
		$("#form_add_meat_items").append(row);
	}
}

function generate_row(item){
	var id= item.product;
	id = id.replace(new RegExp(' ','g'), '_');
	console.log(id);

	var element ='<div class="row">'
				+ '<div class="input-field col s6">'
			    + '<input type="checkbox" class="checkbox" id="check_' + id + '"/>'
				+ '<label for="check_' + id +'">' + item.product + '</label>' 
				+ '</div>'
				+ '<div class="input-field col s6">'
			    + '<input type="text" id="input_' + id  + '" disabled placeholder="$00.00"/>'
				+ '</div></div>'
	return element; 
}



