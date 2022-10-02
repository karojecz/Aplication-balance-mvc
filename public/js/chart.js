// Load google c
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawChart2);

// Draw the chart and set the chart values


 

function drawChart() {


	if (Array.isArray(myArr) && myArr.length){
						var data = new google.visualization.DataTable();

						data.addColumn('string', 'Category name');
						data.addColumn('number', 'Sum');

	
								for (var key in myArr) {
							var value = myArr[key];
								var sum=parseFloat(value.sum);
							data.addRow([value.name,sum]);
						}



						  // Optional; add a title and set the width and height of the chart
						  var options = {
							  backgroundColor: 'transparent',
							  legend: {position: 'top', textStyle: {color: 'white', fontSize: 15}},
							  title:"Your expenses" ,titleTextStyle: {color: 'white', fontSize: 19,},

							
								 
							  };

						  // Display the chart inside the <div> element with id="piechart"
						  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
						  chart.draw(data, options);
	}
						  

							
}

	
	
	function drawChart2() {


	if (Array.isArray(myArrIncomes) && myArrIncomes.length){
						var data = new google.visualization.DataTable();

						data.addColumn('string', 'Category name');
						data.addColumn('number', 'Sum');

	
								for (var key in myArrIncomes) {
							var value = myArrIncomes[key];
								var sum=parseFloat(value.sum);
							data.addRow([value.name,sum]);
						}



						  // Optional; add a title and set the width and height of the chart
						  var options = {
							  backgroundColor: 'transparent',
							  legend: {position: 'top', textStyle: {color: 'white', fontSize: 15}},
							  title:"Your income" ,titleTextStyle: {color: 'white', fontSize: 19,},

								 
							  };

						  // Display the chart inside the <div> element with id="piechart"
						  var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
						  chart.draw(data, options);
	}
						  

							
}
	
    $(window).resize(function(){
        drawChart2();
		 drawChart();
    });
	
