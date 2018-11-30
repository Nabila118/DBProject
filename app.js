$(document).ready(function(){
	//alert("dsad");
	$.ajax({
		url: "http://localhost/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var item = [];
			var quantity = [];

			for(var i in data) {
				item.push("Item " + data[i].ITEM_ID);
				quantity.push(data[i].Quantity);
			}

			var chartdata = {
				labels: Item,
				datasets : [
					{
						label: 'Item Sale',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: score
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});