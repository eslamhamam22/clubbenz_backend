
        <h3 class="box-title"> App Users: </h3><h5>IOS: <span style="color: #FF7676; background-color: #FF7676; font-size: 15px;">--</span>&nbsp; Android: <span style="color: #B4C1D7; background-color: #B4C1D7; font-size: 15px;">--</span>
        <div>
            <canvas id="chart2" height="277" width="555" style="width: 555px; height: 277px;"></canvas>
        </div>
    


<script type="text/javascript">
	$( document ).ready(function() {
		var ctx2 = document.getElementById("chart2").getContext("2d");
    var date= <?php echo $count_user_x?> 
      console.log('date',date)
      var ios= <?php echo $ios_user?> 
        console.log('ios',ios)
         var android= <?php echo $android_user?> 
        console.log('android',android)
    var data2 = {
        labels: date,
        datasets: [
            {
                label: "IOS",
                fillColor: "rgba(255,118,118,0.8)",
                strokeColor: "rgba(255,118,118,0.8)",
                highlightFill: "rgba(255,118,118,1)",
                highlightStroke: "rgba(255,118,118,1)",
                data: ios,
            },
            {
                label: "Android",
                fillColor: "rgba(180,193,215,0.8)",
                strokeColor: "rgba(180,193,215,0.8)",
                highlightFill: "rgba(180,193,215,1)",
                highlightStroke: "rgba(180,193,215,1)",
                data:android, 
            }
        ]
    };
    
    var chart2 = new Chart(ctx2).Bar(data2, {
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
