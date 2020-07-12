
        <h3 class="box-title"> Cars Classes</h3>
        <div>
            <canvas id="chart4" height="277" width="555" style="width: 555px; height: 277px;"></canvas>
        </div>



<script type="text/javascript">
	$( document ).ready(function() {
		var ctx2 = document.getElementById("chart4").getContext("2d");
	    var date= <?php echo $count_user_x; ?> ;
      	console.log('date',date)
      	var classes= <?php echo $class; ?> ;
        console.log('classes',classes)
	    var data2 = {
	        labels: date,
	        datasets: [
	            {
	                label: "My First dataset",
	                fillColor: "rgba(255,118,118,0.8)",
	                strokeColor: "rgba(255,118,118,0.8)",
	                highlightFill: "rgba(255,118,118,1)",
	                highlightStroke: "rgba(255,118,118,1)",
	                data:classes,
	            },

	        ]
	    };

	    var chart4 = new Chart(ctx2).Bar(data2, {
	        scaleBeginAtZero : true,
	        scaleShowGridLines : true,
	        scaleGridLineColor : "rgba(0,0,0,.005)",
	        scaleGridLineWidth : 0,
	        scaleShowHorizontalLines: true,
	        scaleShowVerticalLines: true,
	        barShowStroke : true,
	        barStrokeWidth : 0,
	        tooltipCornerRadius: 2,
	        barDatasetSpacing : 3,
	        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
	        responsive: true
	    });
});

</script>
