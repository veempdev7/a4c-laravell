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
        <tr>
    <td align="center" class="emmahelveticaa26darkgrey">
    World Forecast {{ $startmonthyear }} {{ $monthlastyear }}
    </td>
</tr>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
    <td align="center" class="emmahelveticaa16darkgrey"><strong>Data is updated on a regular basis</strong></td>
</tr>
<tr><td height="10"></td></tr>
<tr>
    <td align="center" class="emmahelveticaa16darkgreylight">This forecast: {{ $mailHead->mhead_thisfc }}</td>
</tr>
<tr>
    <td align="center" class="emmahelveticaa16darkgreylight">Latest Data: See airports</td>
</tr>
<tr>
    <td align="center" class="emmahelveticaa16darkgreylight">Next forecast: {{ $mailHead->mhead_lastfc }}</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>

<tr id="annualdiv">
    <td>
        <div class="mlr_6_per">
            <div class="row">
                <div class="emmahelveticaa24darkgrey">Annual Forecasts</div>
                <div class="wd_50">
                    <div class="contentnn demo-yx" id="scroll">
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
                                @foreach ($regAnnChange  as $row)
                                    <tr class="emmahelveticaa14darkgreylight">
                                        <td>{{ $row->year_fcm }}</td>
                                        <td>
                                            @if ($row->International != 0)
                                                {{ number_format($row->International, 1, '.', ',') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->Domestic != 0)
                                                {{ number_format($row->Domestic, 1, '.', ',') }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($row->Total, 1, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="amchart">
                    <div id="annual_regionchange_chart" style="width:100%; height: 367px;align:center; margin-top:15px;">
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
                                    <td>MN pax</td>
                                </tr>
                                <tr style="background:#3a618a !important;">
                                    <td>Year</td>
                                    <td>International</td>
                                    <td>Domestic</td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($regAnn as $row)
                                    <tr class="emmahelveticaa14darkgreylight">
                                        <td>{{ $row->year_fcm }}</td>
                                        <td>
                                            @if ($row->International != 0)
                                                {{ number_format($row->International, 0, '.', ',') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->Domestic != 0)
                                                {{ number_format($row->Domestic, 0, '.', ',') }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($row->Total, 0, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="amchart">
                    <div id="annual_region_chart" style="width:100%; height: 367px;align:center; margin-top:15px;">
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>

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
                                    <td colspan="2">% change</td>
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
                                @foreach ($ctryMonChange as $row)
                                    <tr class="emmahelveticaa14darkgreylight">
                                        <td>{{ $row->Year }}</td>
                                        <td>{{ $row->Month }}</td>
                                        <td>
                                            @if ($row->International != 0)
                                                {{ number_format($row->International, 1, '.', ',') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->Domestic != 0)
                                                {{ number_format($row->Domestic, 1, '.', ',') }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($row->Total, 1, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="amchart">
                    <div id="regionrollinchange_chart" style="width:100%; height: 367px;align:center; margin-top:15px;">
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
                                @foreach ($ctryMon as $row)
                                    <tr class="emmahelveticaa14darkgreylight">
                                        <td>{{ $row->Year }}</td>
                                        <td>{{ $row->Month }}</td>
                                        <td>
                                            @if ($row->International != 0)
                                                {{ number_format($row->International, 0, '.', ',') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->Domestic != 0)
                                                {{ number_format($row->Domestic, 0, '.', ',') }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($row->Total, 0, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="amchart">
                    <div id="regionrollingmothly_chart" style="width:100%; height: 367px;align:center; margin-top:15px;">
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
                                        Use this section to see the detail within the world forecast and download specific data series directly to excel. Click the buttons below to get your data.
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td height="10"></td>
                                    <td height="10" class="emmahelveticaa18darkgrey"></td>
                                    <td height="10"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <form id="formdown1" name="formdown1" method="post" action="{{ route('airports.csvpages.airportsforecastsworld_annual') }}">
                                            @csrf
                                            <input name="export" type="submit" class="whit_btn" id="export" value="Annual Passengers | {{ $startmonthyear }} {{ $monthlastyear }}" />
                                        </form>

                                        <form id="formdown12" name="formdown12" method="post" action="{{ route('airports.csvpages.airportsforecastsworld_monthly') }}">
                                            @csrf
                                            <input name="export" type="submit" class="whit_btn" id="export" value="Monthly Passengers | {{ $startmonthyear }} {{ isset($monthlastyear) ? ' - ' . $monthlastyear : '' }}" />
                                        </form>	

                                        <form id="formdown13" name="formdown13" method="post" action="{{ route('airports.csvpages.airportsforecastsworld_singlemonthly') }}">
                                            @csrf
                                            <input name="export" type="submit" class="whit_btn" id="export" value="Monthly Passengers | {{ $startmonthyear }}" />
                                        </form>					

                                        <form id="formdown2" name="formdown2" method="post" action="{{ route('airports.csvpages.airportsforecastsworld_quaterly') }}">
                                            @csrf
                                            <input name="exportQuarterly" type="submit" class="whit_btn" id="exportQuarterly" value="Quarterly Passengers | {{ $startmonthyear }} - {{ $startmonthyear + 4 }}" />
                                        </form>
                                    </td>
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
    <td>&nbsp;</td>
</tr>
<tr>
    <td>&nbsp;</td>
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
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
});
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
<script type="text/javascript">
    var chartDataChange = @json($fetchAnnualRegionForecasts);

    var chart = AmCharts.makeChart("annual_region_chart", {
            theme: "none",
            type: "serial",
            startDuration: 1,
            dataProvider: chartDataChange,
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
                text: "MN Passengers: Total",
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
        var chartData4 = @json($fetchRegionForecasts); // Pass chart data from the controller to JavaScript

        var chart = AmCharts.makeChart("annual_regionchange_chart", {
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
                text: "% Change : Total",
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
<script>
    var chartData4 = @json($regionrollinchange_chart);

    var chart = AmCharts.makeChart("regionrollinchange_chart", {
				 theme:"none",
                type: "serial",
				startDuration:1,
                dataProvider: chartData4,
                categoryField: "country",
                angle: 30,
                categoryAxis: {
                     labelRotation: 45,
					 color: "#7d8085",
					 fontSize:12,
                    gridPosition: "start",
					gridCount:50,
		   		    autoGridCount:false,
					axisThickness:1,
					axisColor:"#51585e",
					gridAlpha:0
                },
		titles: [{
			text: "% Change : total",
			size: 12,
			color: "#7d8085",
			bold:false,
			}],
	

		
                valueAxes: [{
                    //title: "Visitors",
					color: "#7d8085",
					 fontSize:12,
					axisThickness:0,
					gridColor:"#FFFF",
					gridAlpha: 0,
					tickLength:0,
					dashLength:0
                }],
				gridAboveGraph:false,
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
                  pathToImages:"http://www.amcharts.com/lib/3/images/",
                  amExport:{
                  top:21,
                  right:20,
                  exportJPG:true,
                  exportPNG:true,
                  exportSVG:true,
				  exportPDF:true
                }
            });

        </script>
<script type="text/javascript">
        var chartData4 = @json($airportRegionRollingMonthlyForecastGraph);
        var chart = AmCharts.makeChart("regionrollingmothly_chart", {
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
@endsection