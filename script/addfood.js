var foodItems = [];
$(document).ready(function(){
	$.getJSON("FoodList.json", function(data){
		//console.log(data);
		foodItems = data;
		meatItems = foodItems.filter(function(record) {
			return record.Category == "Meat"
		});
		//console.log(foodItems);
		generate_add_meat_form(meatItems);

	$("#link_finalize").click(function(){
		/* add to database before cleaning. */
		localStorage.removeItem(localStorage.meatItems);
	});

	$(".checkbox").on("change", function(){
		console.log("clicked");
		var input ="#" + this.id.replace("check", "input");
		console.log(input);
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
			if (meatItems[i]['Products'] == product) {
			meatItems[i]['My Subtotal'] = spent;
			break;
			}
		}
		//localStorage.setItem("meatItems",JSON.stringify(meatItems));
		console.log(meatItems);
	});
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
	var id= item.Products;
	id = id.replace(new RegExp(' ','g'), '_');
	//console.log(id);

	var element ='<div class="row">'
				+ '<div class="input-field col s6">'
			    + '<input type="checkbox" class="checkbox" id="check_' + id + '"/>'
				+ '<label for="check_' + id +'">' + item.Products + '</label>' 
				+ '</div>'
				+ '<div class="input-field col s6">'
			    + '<input type="text" id="input_' + id  + '" disabled placeholder="$00.00"/>'
				+ '</div></div>'
	return element; 
}



