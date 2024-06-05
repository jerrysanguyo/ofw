<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages':['geochart'],
    });
    google.charts.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable({!! $chartDataJson !!});

        var options = {
            colorAxis: {colors: ['#e7711c', '#4374e0']}
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
    }
</script>
<div id="regions_div" style="width: 100%;"></div>
