<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ $title }}</title>

  <script src="https://www.air4casts.com/air4castapi/air4castapi_latest/amchart/amcharts.js"></script>
  <script src="https://air4casts.com/air4castapi/newamcharts/glance/serial.js"></script>
</head>
<body style="margin:0; padding:0;">

  <div id="glanceamchartsdiv" style="width: 400px; height: 250px;"></div>

  <script>
    // pass the PHP array into JS
    var chartData7 = @json($chartData);

    var chart = AmCharts.makeChart("glanceamchartsdiv", {
      theme: "none",
      type: "serial",
      startDuration: 1,
      dataProvider: chartData7,
      categoryField: "country",
      angle: 30,
      categoryAxis: {
        labelRotation: 45,
        gridPosition: "start",
        fontSize: 8,
        axisColor: "#808080",
        color: "#808080",
        autoGridCount: false,
        gridAlpha: 0
      },
      valueAxes: [{
        title: "% change",
        color: "#808080",
        gridAlpha: 0,
        dashLength: 0,
        fontSize: 8,
      }],
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
