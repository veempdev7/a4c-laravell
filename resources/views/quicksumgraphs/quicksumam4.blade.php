<!DOCTYPE html>
<html>
<head>
    <title>Air4Casts</title>
    <script src="https://www.air4casts.com/air4castapi/air4castapi_latest/amchart/amcharts.js"></script>
    <script src="https://air4casts.com/air4castapi/newamcharts/glance/serial.js"></script>
</head>
<body style="margin:0; padding:0;">
    <div id="glanceamchartsdiv" style="width: 400px; height: 250px;"></div>

    <script>
        var chartData7 = @json($chartData);

        AmCharts.makeChart("glanceamchartsdiv", {
            theme: "none",
            type: "serial",
            startDuration: 1,
            dataProvider: chartData7,
            categoryField: "country",
            angle: 30,
            categoryAxis: {
                labelRotation: 45,
                gridPosition: "start",
                gridCount: 50,
                fontSize: 8,
                axisColor: "#808080",
                boldLabels: true,
                color: "#808080",
                autoGridCount: false,
                gridAlpha: 0
            },
            valueAxes: [{
                title: "% change",
                gridColor: "#FFFF",
                color: "#808080",
                gridAlpha: 0,
                dashLength: 0,
                fontSize: 8,
                titleColor: "#808080",
                axisColor: "#808080",
                boldLabels: true,
            }],
            gridAboveGraph: false,
            graphs: [{
                valueField: "visits",
                colorField: "color",
                type: "column",
                lineAlpha: 0.1,
                fillAlphas: 1
            }],
            chartCursor: {
                cursorAlpha: 0,
                zoomable: false,
                categoryBalloonEnabled: false
            },
            pathToImages: "https://www.amcharts.com/lib/3/images/",
            amExport: {
                top: 21,
                right: 20,
                exportJPG: true,
                exportPNG: true,
                exportSVG: true,
                exportPDF: true
            }
        });
    </script>
</body>
</html>
