	// Load google charts
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart1);
	google.charts.setOnLoadCallback(drawChart2);
	google.charts.setOnLoadCallback(drawChart3);


	// Draw the chart and set the chart values
	function drawChart1() {
	  var data = google.visualization.arrayToDataTable(calChartData);

	  // Optional; add a title and set the width and height of the chart
	  var options = {'title':'Calories Burnt By Date/Time', 'width':450, 'height':300};

	  // Display the chart inside the <div> element with id="piechart"
	  var chart = new google.visualization.PieChart(document.getElementById('calorieChart'));
	  chart.draw(data, options);
	}
		function drawChart2() {
	  var data = google.visualization.arrayToDataTable(disChartData);

	  // Optional; add a title and set the width and height of the chart
	  var options = {'title':'Distance By Date/Time', 'width':450, 'height':300};

	  // Display the chart inside the <div> element with id="piechart"
	  var chart = new google.visualization.PieChart(document.getElementById('distanceChart'));
	  chart.draw(data, options);
	}
		function drawChart3() {
	  var data = google.visualization.arrayToDataTable(speedChartData);

	  // Optional; add a title and set the width and height of the chart
	  var options = {'title':'Speed By Date/Time', 'width':450, 'height':300};

	  // Display the chart inside the <div> element with id="piechart"
	  var chart = new google.visualization.PieChart(document.getElementById('speedChart'));
	  chart.draw(data, options);
	}