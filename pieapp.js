$(document).ready(function(){
	//alert("dsad");
	$.ajax({
		url: "piedata.php",
		method: "GET",
	success: function(data) {
			console.log(data);
			var item = [];
			var AMOUNT = [];

			for(var i in data) {
				item.push(data[i].ITEM_ID);
				AMOUNT.push(data[i].AMOUNT);
			}

			var chartdata = {
				labels: item,
				datasets : [
					{
						label: 'MOST-PROFITABLE',
						backgroundColor: ['yellow','PURPLE','ORANGE'],
						borderColor: 'BLACK',
						hoverBackgroundColor: 'purple',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: AMOUNT
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'pie',
				data: chartdata,
				
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});