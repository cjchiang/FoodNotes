$(document).ready(function(){
	$.ajax({
		type: "POST",
		url: "/querydata.php",
		data: {QueryData: 'allContries'},
		dataType: 'JSON',
		success: function(respond_data){
			console.log(respond_data);
		},
		error: function(respond_data){
			console.log("ERROR");
			console.log(respond_data);
		}
	});
});


