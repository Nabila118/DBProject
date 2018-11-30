<html lang="en">
<head>
    <title id='Description'>jQuery Chart Column Series Example</title>
    <link rel="stylesheet" href="./jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="./scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="./jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="./jqwidgets/jqxchart.core.js"></script>
    <script type="text/javascript" src="./jqwidgets/jqxchart.js"></script>
    <script type="text/javascript" src="./jqwidgets/jqxdraw.js"></script>
    <script type="text/javascript" src="./jqwidgets/jqxdata.js"></script>
    <script type="text/javascript">
      
	//<div id="jqxChart"></div>
	<script type="text/javascript">
	

	$(document).ready(function () {
		var source;
		$.ajax({
        type: "POST",
        url: "data.php",
                
        success: function(data)
        {
        	source = data;  
        }
      });
		
		
		var dataAdapter = new $.jqx.dataAdapter(source,
		{
			autoBind: true,
			async: false,
			downloadComplete: function () { },
			loadComplete: function () { },
			loadError: function () { }
		});

		var settings = {
			title: "SALES",
			showLegend: true,
			padding: { left: 5, top: 5, right: 5, bottom: 5 },
			titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
			source: dataAdapter,
			categoryAxis:
				{
					dataField: 'ITEM_ID',
					showGridLines: false
				},
			colorScheme: 'scheme05',
			seriesGroups:
				[
					{
						type: 'column',
						valueAxis:
						{
							displayValueAxis: true,
							description: 'ITEM',
							//descriptionClass: 'css-class-name',
							axisSize: 'auto',
							tickMarksColor: '#888888',
							unitInterval: 20,
							minValue: 0,
							maxValue: 100
						},
						series: [
								{ dataField: 'Quantity', displayText: 'Quantity' }
						  ]
					}
				]
		};

		// setup the chart
		$('#jqxChart').jqxChart(settings);
	});
</script>
</head>
<body style="background:white;">
	<div id='jqxChart'></div>
</body>
</html>