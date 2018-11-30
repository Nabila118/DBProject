$(document).ready(function(){
	//alert("dsad");
	$.ajax({
		url: "http://localhost/DBProject/data.php",
		method: "GET",
	success: function(data) {
			console.log(data);
			var item = [];
			var quantity = [];

			for(var i in data) {
				item.push(data[i].ITEM_ID);
				quantity.push(data[i].Quantity);
			}

			var chartdata = {
				labels: item,
				datasets : [
					{
						label: 'Item Sale',
						backgroundColor: ['yellow','PURPLE','ORANGE'],
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'purple',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: quantity
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata,
				options: {
  					scales: {
    					yAxes: [{
      						scaleLabel: {
        						display: true,
        						labelString: 'QUANTITY'
      						}
    					}],
    					xAxes: [{
    						scaleLabel: {
        						display: true,
        						labelString: 'ITEMS SOLD'
      						}
    					}]
  					}     
				}
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
