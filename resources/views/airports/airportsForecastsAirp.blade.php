@extends('layouts.app')

@section('content')
<div id="container">
    <!-- Display success or error message -->
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @elseif(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table width="100%" border="0"> <!-- global table -->
        <tr>
            <td>
                @include('includes.header')
            </td>
        </tr>
        @include('includes.airports.header')

        <tr>
            <td align="center" class="emmahelveticaa26darkgrey">
                Airport Forecast {{ $start1 }} {{ $end }} | {{ $rstApref->aport_apref }}
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="center" class="emmahelveticaa16darkgrey">Data is updated on a regular basis</td>
        </tr>
        <tr>
            <td height="10"></td>
        </tr>
        <tr>
            <td align="center" class="emmahelveticaa16darkgreylight">This forecast: {{ $rstMailHead->mhead_thisfc }}</td>
        </tr>
        <tr>
            <td align="center" class="emmahelveticaa16darkgreylight">
                Latest actuals:
                @if(isset($rstLastDate[0]->dlup_fullmontxt) && isset($rstLastDate[0]->dlup_year))
                {{ $rstLastDate[0]->dlup_fullmontxt }} {{ $rstLastDate[0]->dlup_year }}
                @else
                No data available
                @endif
            </td>
        </tr>
        <tr>
            <td align="center" class="emmahelveticaa16darkgreylight">Next forecast: {{ $rstMailHead->mhead_lastfc }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr id="annualdiv">
            <td>
                <div class="mlr_6_per">
                    <div class="row">
                        <div class="wd_50">
                            <div class="contentnn demo-yx" id="scroll">
                                <table class="table_ip_actual">
                                    <thead>
                                        <tr style="background:#3a618a !important;">
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>000 pax</td>
                                        </tr>
                                        <tr style="background:#3a618a !important;">
                                            <td>Year</td>
                                            <td>International</td>
                                            <td>Domestic</td>
                                            <td>Total</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rstAnnSum as $row_rst_annsum)
                                        <tr>
                                            <td>{{ $row_rst_annsum->Year }}</td>
                                            <td>
                                                @if($row_rst_annsum->International != 0)
                                                {{ number_format($row_rst_annsum->International, 0, '.', ',') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($row_rst_annsum->Domestic != 0)
                                                {{ number_format($row_rst_annsum->Domestic, 0, '.', ',') }}
                                                @endif
                                            </td>
                                            <td>{{ number_format($row_rst_annsum->Total, 0, '.', ',') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="amchart">
                                <div id="passenger_chart" style="width:100%; height: 367px;align:center; margin-top:15px;">
                                </div>
                            </div>
                        </div>
                        <div class="wd_50">
                            <div class="contentnn demo-yx" id="scroll2">
                                <table class="table_ip_actual">
                                    <thead>
                                        <tr style="background:#3a618a !important;">
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>% change</td>
                                        </tr>
                                        <tr style="background:#3a618a !important;">
                                            <td>Year</td>
                                            <td>International</td>
                                            <td>Domestic</td>
                                            <td>Total</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rstAnnSumChange as $row_rst_annsumchange)
                                        <tr>
                                            <td>{{ $row_rst_annsumchange->Year }}</td>
                                            <td>
                                                @if($row_rst_annsumchange->International != 0)
                                                {{ number_format($row_rst_annsumchange->International, 1, '.', ',') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($row_rst_annsumchange->Domestic != 0)
                                                {{ number_format($row_rst_annsumchange->Domestic, 1, '.', ',') }}
                                                @endif
                                            </td>
                                            <td>{{ number_format($row_rst_annsumchange->Total, 1, '.', ',') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="amchart">
                                <div id="passengerchange_chart" style="width:100%; height: 367px;align:center; margin-top:15px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
<!-- Month -->
 <tr id="monthlydiv">
    <td>
        <div class="mlr_6_per">
            <div class="row">
            <div class="emmahelveticaa24darkgrey">Rolling Monthly Forecasts</div>
                <div class="wd_50">
                    <div class="contentnn demo-yx" id="scroll3">
                        <table class="table_ip_actual">
                            <thead>
                                <tr style="background:#3a618a !important;">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>% change</td>
                                </tr>
                                <tr style="background:#3a618a !important;">
                                    <td>Year</td>
                                    <td>Month</td>
                                    <td>International</td>
                                    <td>Domestic</td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rstApmonchange as $row_rst_apmonchange)
                                    <tr>
                                        <td>{{ $row_rst_apmonchange->Year }}</td>
                                        <td>{{ $row_rst_apmonchange->Month }}</td>
                                        <td>
                                            @if($row_rst_apmonchange->International != 0)
                                                {{ number_format($row_rst_apmonchange->International, 1, '.', ',') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($row_rst_apmonchange->Domestic != 0)
                                                {{ number_format($row_rst_apmonchange->Domestic, 1, '.', ',') }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($row_rst_apmonchange->Total, 1, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="amchart">
                                <div id="passengerrollingchange_chart" style="width:100%; height: 367px;align:center; margin-top:15px;">
                                </div>
                            </div>
                </div>
                <div class="wd_50">
                    <div class="contentnn demo-yx" id="scroll4">
                        <table class="table_ip_actual">
                            <thead>
                                <tr style="background:#3a618a !important;">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>000 pax</td>
                                </tr>
                                <tr style="background:#3a618a !important;">
                                    <td>Year</td>
                                    <td>Month</td>
                                    <td>International</td>
                                    <td>Domestic</td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rstApmon as $row_rst_apmon)
                                    <tr>
                                        <td>{{ $row_rst_apmon->Year }}</td>
                                        <td>{{ $row_rst_apmon->Month }}</td>
                                        <td>
                                            @if($row_rst_apmon->International != 0)
                                                {{ number_format($row_rst_apmon->International, 0, '.', ',') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($row_rst_apmon->Domestic != 0)
                                                {{ number_format($row_rst_apmon->Domestic, 0, '.', ',') }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($row_rst_apmon->Total, 0, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="amchart">
                                <div id="passengerrolling_chart" style="width:100%; height: 367px;align:center; margin-top:15px;">
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>

<tr>
    <td>
        <table width="100%" border="0">
            <tbody>
                <tr>
                    <td width="5%">&nbsp;</td>
                    <td width="90%">
                        <table width="100%" border="0" bgcolor="#F1F1F1">
                            <tbody>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="emmahelveticaa18darkgrey">&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="emmahelveticaa20darkgrey">Details and Downloads</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td height="10"></td>
                                    <td height="10" class="emmahelveticaa18darkgrey"></td>
                                    <td height="10"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="emmahelveticaa15darkgreylight">
                                        Use the Section to identify the detail within the airport forecast and to download specific data series directly to spreadsheet. Click the buttons below to get your data.
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td height="30"></td>
                                    <td height="30" class="emmahelveticaa18darkgrey"></td>
                                    <td height="30"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>

                                        <form id="formdown1" name="formdown1" method="post" action="{{ route('airports.csvpages.airportsforecastsair1') }}">
                                            @csrf
                                            <input name="export" type="submit" class="whit_btn" id="export" value="Annual Passengers | {{ $start1 }}{{ $end }}" />
                                        </form>

                                        <form id="formdown12" name="formdown12" method="post" action="{{ route('airports.csvpages.airportsforecastsair_singlemonth') }}">
                                            @csrf
                                            <input name="export" type="submit" class="whit_btn" id="export" value="Monthly Passengers | {{ $start1 }}" />
                                        </form>
<!-- 
                                        <form id="formdown13" name="formdown13" method="post" action="{{ url('csvpages/airportsforecastsair_month.php') }}">
                                            @csrf
                                            <input name="hidbut" type="hidden" class="whit_btn" id="hidbut" value="Monthly" />
                                            <input name="export" type="submit" class="whit_btn" id="export" value="Monthly Passengers | {{ $startmonthyear }}{{ isset($monthlastyear) ? ' - ' . $monthlastyear : '' }}" />
                                        </form> -->

                                        <form id="formdown2" name="formdown2" method="post" action="{{ route('airports.csvpages.airportsforecastsair2') }}">
                                            @csrf
                                            <input name="export" type="submit" class="whit_btn" id="export" value="Quarterly Passengers | {{ $start1 }} - {{ $start1 + 4 }}" />
                                        </form>

                                        <form id="formdown14" name="formdown14" method="post" action="{{ route('airports.csvpages.airportsforecastsair_seasonal') }}">
                                            @csrf
                                            <input name="export" type="submit" class="whit_btn" id="export" value="Seasonal Pattern" />
                                        </form>
<!-- 
                                        <p class="emmahelveticaa15darkgreylight" style="display: inline-block; width: 100%; margin-bottom: 20px;">Historical Trends</p>

                                        <form id="formdown15" name="formdown15" method="post" action="{{ url('csvpages/airportsforecastsair_total.php') }}">
                                            @csrf
                                            <input name="export" type="submit" class="whit_btn" id="export" value="Total Forecasts" />
                                        </form>

                                        <form id="formdown16" name="formdown16" method="post" action="{{ url('csvpages/airportsforecastsair_international.php') }}">
                                            @csrf
                                            <input name="export" type="submit" class="whit_btn" id="export" value="International Forecasts" />
                                        </form>

                                        <form id="formdown17" name="formdown17" method="post" action="{{ url('csvpages/airportsforecastsair_domestic.php') }}">
                                            @csrf
                                            <input name="export" type="submit" class="whit_btn" id="export" value="Domestic Forecasts" />
                                        </form> -->

                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="5%">&nbsp;</td>
                                    <td width="90%" class="emmahelveticaa18darkgrey">&nbsp;</td>
                                    <td width="5%">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="5%">&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
<tr>
            <td>
                <table width="100%" border="0" bgcolor="#E1E1E1"> <!-- footer elastic table -->
                    <tr>
                        <td>
                            <div align="center">
                                <table width="1000" border="0"> <!-- footer fixed table -->
                                    <tr>
                                        <td>
                                            <table width="100%" border="0" bgcolor="#54545E"> <!-- footer extra fixed table -->
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        @include('includes.footer')
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
</div>
@endsection

@section('scripts')
<script src="https://www.air4casts.com/air4castapi/air4castapi_latest/amchart/amcharts.js" type="text/javascript"></script>
<script src="https://www.air4casts.com/air4castapi/air4castapi_latest/amchart/serial.js" type="text/javascript"></script>

<script type="text/javascript">
    var chartData4 = @json($latest_ap_int_arr); // Blade syntax to pass PHP data to JS

    var chart = AmCharts.makeChart("passenger_chart", {
        theme: "none",
        type: "serial",
        startDuration: 1,
        dataProvider: chartData4,
        categoryField: "country",
        angle: 30,
        categoryAxis: {
            labelRotation: 45,
            color: "#7d8085",
            fontSize: 12,
            gridPosition: "start",
            gridCount: 50,
            autoGridCount: false,
            axisThickness: 1,
            axisColor: "#51585e",
            gridAlpha: 0
        },
        titles: [{
            text: "000 Passengers: total",
            size: 12,
            color: "#7d8085",
            bold: false,
        }],
        valueAxes: [{
            color: "#7d8085",
            fontSize: 12,
            axisThickness: 0,
            gridColor: "#FFFF",
            gridAlpha: 0,
            tickLength: 0,
            dashLength: 0
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
        pathToImages: "http://www.amcharts.com/lib/3/images/",
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
<script type="text/javascript">
    var chartData4 = @json($passengerchange_chart);
    var chart = AmCharts.makeChart("passengerchange_chart", {
        theme: "none",
        type: "serial",
        startDuration: 1,
        dataProvider: chartData4,
        categoryField: "country",
        angle: 30,
        categoryAxis: {
            labelRotation: 45,
            color: "#7d8085",
            fontSize: 12,
            gridPosition: "start",
            gridCount: 50,
            autoGridCount: false,
            axisThickness: 1,
            axisColor: "#51585e",
            gridAlpha: 0
        },
        titles: [{
            text: "% Change : total",
            size: 12,
            color: "#7d8085",
            bold: false,
        }],
        valueAxes: [{
            color: "#7d8085",
            fontSize: 12,
            axisThickness: 0,
            gridColor: "#FFFF",
            gridAlpha: 0,
            tickLength: 0,
            dashLength: 0
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
        pathToImages: "http://www.amcharts.com/lib/3/images/",
        amExport: {
            top: 21,
            right: 20,
            exportJPG: true,
            exportPNG: true,
            exportSVG: true,
            exportPDF: true
        }
    });

    var chartData4 = @json($rollingchange_passenger); 

var chart = AmCharts.makeChart("passengerrollingchange_chart", {
    theme: "none",
    type: "serial",
    startDuration: 1,
    dataProvider: chartData4,  // Using the data from Laravel
    categoryField: "country",
    angle: 30,
    categoryAxis: {
        labelRotation: 45,
        color: "#7d8085",
        fontSize: 12,
        gridPosition: "start",
        gridCount: 50,
        autoGridCount: false,
        axisThickness: 1,
        axisColor: "#51585e",
        gridAlpha: 0,
    },
    titles: [{
        text: "% Change : total",
        size: 12,
        color: "#7d8085",
        bold: false,
    }],
    valueAxes: [{
        color: "#858fae",
        fontSize: 12,
        axisThickness: 0,
        gridColor: "#FFFF",
        gridAlpha: 0,
        tickLength: 0,
        dashLength: 0,
    }],
    gridAboveGraph: false,
    graphs: [{
        valueField: "visits",  // Data field to represent on the graph
        colorField: "color",   // Color for the bars
        type: "column",        // Column chart type
        lineAlpha: 0.1,
        fillAlphas: 1,
    }],
    chartCursor: {
        cursorAlpha: 0,
        zoomable: false,
        categoryBalloonEnabled: false,
    },
    pathToImages: "http://www.amcharts.com/lib/3/images/",
    amExport: {
        top: 21,
        right: 20,
        exportJPG: true,
        exportPNG: true,
        exportSVG: true,
        exportPDF: true,
    },
});

// Function to check if the data is empty and display a message if needed
AmCharts.checkEmptyData = function(chart) {
    if (chart.dataProvider.length === 1) {
        chart.valueAxes[0].minimum = 0;
        chart.valueAxes[0].maximum = 100;
        var dataPoint = { dummyValue: 0 };
        dataPoint[chart.categoryField] = 'No data Available';
        chart.dataProvider = [dataPoint];
        chart.addLabel(0, '200%', 'The chart contains no data', 'center');
        chart.validateNow();
    }
};

// Call the function to check if data is empty and apply the check
AmCharts.checkEmptyData(chart);

var chartData4 = @json($rolling_passenger);

        // Create the chart
        var chart = AmCharts.makeChart("passengerrolling_chart", {
            theme: "none",
            type: "serial",
            startDuration: 1,
            dataProvider: chartData4,  // The data passed from the controller
            categoryField: "country",
            angle: 30,
            categoryAxis: {
                labelRotation: 45,
                color: "#7d8085",
                fontSize: 12,
                gridPosition: "start",
                gridCount: 50,
                autoGridCount: false,
                axisThickness: 1,
                axisColor: "#51585e",
                gridAlpha: 0
            },
            titles: [{
                text: "000 Passengers: Total",
                size: 12,
                color: "#7d8085",
                bold: false,
            }],
            valueAxes: [{
                color: "#7d8085",
                fontSize: 12,
                axisThickness: 0,
                gridColor: "#FFFF",
                gridAlpha: 0,
                tickLength: 0,
                dashLength: 0
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
            pathToImages: "http://www.amcharts.com/lib/3/images/",
            amExport: {
                top: 21,
                right: 20,
                exportJPG: true,
                exportPNG: true,
                exportSVG: true,
                exportPDF: true
            }
        });

        // Check if data is empty and show a message
        AmCharts.checkEmptyData = function(chart) {
            if (chart.dataProvider.length === 1) {
                chart.valueAxes[0].minimum = 0;
                chart.valueAxes[0].maximum = 100;
                var dataPoint = { dummyValue: 0 };
                dataPoint[chart.categoryField] = 'No data Available';
                chart.dataProvider = [dataPoint];
                chart.addLabel(0, '200%', 'The chart contains no data', 'center');
                chart.validateNow();
            }
        };

        // Call the function to check empty data
        AmCharts.checkEmptyData(chart);
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var selector = "{{ $selector }}";  // Using Blade to output the $selector variable

        // Check the value of selector and toggle visibility of divs
        if (selector == "Annual") {
            // Show the annual div, hide the monthly div
            $("#annualdiv").show();
            $("#monthlydiv").hide();
        } else if (selector == "Monthly") {
            // Show the monthly div, hide the annual div
            $("#annualdiv").hide();
            $("#monthlydiv").show();
        } else {
            // Default behavior: show annual div, hide monthly div
            $("#annualdiv").show();
            $("#monthlydiv").hide();
        }
    });

    $(document).ready(function() {
        // Check the height of each table and adjust the scroll classes accordingly
        if ($('#scroll table').height() < 650) {
            $("#scroll").removeClass("contentnn demo-yx").addClass("noScroll");
        }
        if ($('#scroll2 table').height() < 650) {
            $("#scroll2").removeClass("contentnn demo-yx").addClass("noScroll");
        }
        if ($('#scroll3 table').height() < 650) {
            $("#scroll3").removeClass("contentnn demo-yx").addClass("noScroll");
        }
        if ($('#scroll4 table').height() < 650) {
            $("#scroll4").removeClass("contentnn demo-yx").addClass("noScroll");
        }
    });
</script>

@endsection