@extends('layouts.app')

@section('styles')
<link href="{{ asset('style/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('terminal-forecasts/css/custom.css?v=' . now()->hour) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('terminal-forecasts/css/terminal-custom.css?v=' . now()->hour) }}" rel="stylesheet" type="text/css" />    
<link rel="stylesheet" href="{{ asset('css/one-airport-at-a-time.css') }}">
    
@endsection

@section('content')
<div id="container">

    <table width="100%" border="0"> <!-- global table -->
        <tr>
            <td>
                @include('includes.header')
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" bgcolor="#F1F1F1"> <!-- central elastic table -->
                    <tr>
                        <td valign="top">
                            <div align="center">
                                <table width="1000" border="0" bgcolor="#FFFFFF">
                                    <tr>
                                        <td>
                                            <table width="100%" height="350" background="../clientconvertgraphics2016/skyplane1000.png">
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table width="100%" border="0">
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td width="97%" class="emmahelveticaa25whitebold">Airport Actuals and</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="3%">&nbsp;</td>
                                                                <td class="emmahelveticaa25whitebold">Forecasts</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="10">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- central fixed table -->
                                    <tr>
                                        <td>
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td valign="middle">
                                                        <div id="AirportsMenuSimple_container" class="FM2_AirportsMenuSimple_container" style="display:block">
                                                            <ul id="AirportsMenuSimple" class="FM2_AirportsMenuSimple">
                                                                <li> <a href="airportshome.php" target="_self">
                                                                        <font class="leaf">Airports&nbsp;Home</font>
                                                                    </a></li>
                                                                <li> <a href="airportsactualairports.php" target="_self"><span class="branch">Airports </span></a>
                                                                </li>
                                                                <li> <a href="#" target="_self"><span class="branch">Recovery Forecasts <i class="fa fa-angle-down"></i></span></a>
                                                                    <ul>
                                                                        <li> <a href="airportsforecasts.php" target="_self">
                                                                                <font class="leaf">One at a Time</font>
                                                                            </a></li>
                                                                        <li> <a href="airportforecasts_multiselector.php" target="_self">
                                                                                <font class="leaf">Multi-Selectors</font>
                                                                            </a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                            <script type="text/javascript">
                                                                registerFlexiCSSMenu("AirportsMenuSimple", {
                                                                    "menuType": "tabbed",
                                                                    "effectSub": {
                                                                        "name": "slide",
                                                                        "direction": "up",
                                                                        "duration": 250,
                                                                        "easing": "swing",
                                                                        "useFade": true
                                                                    },
                                                                    "effectRest": {
                                                                        "name": "slide",
                                                                        "direction": "up",
                                                                        "duration": 250,
                                                                        "easing": "swing",
                                                                        "useFade": true
                                                                    },
                                                                    "effectSubTwo": {
                                                                        "name": "slide",
                                                                        "direction": "left",
                                                                        "duration": 250,
                                                                        "easing": "swing",
                                                                        "useFade": true
                                                                    },
                                                                    "options": {
                                                                        "preset": "fixed",
                                                                        "enableTablet": false,
                                                                        "enableMobile": false,
                                                                        "mobileMaxWidth": 640,
                                                                        "tabletMaxWidth": 1023,
                                                                        "tabletCloseBtnLabel": "Close",
                                                                        "tabletCloseBtnEnable": false,
                                                                        "align": "center"
                                                                    }
                                                                });
                                                            </script>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <table width="100%" border="0" bgcolor="#E1E1E1">
                                                <tbody>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td align="center" class="emmahelveticaa26darkgrey">Choose One Airport At a Time</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td height="10"></td>
                                                        <td height="10"></td>
                                                        <td height="10"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td align="center" class="emmahelveticaa15darkgreylight">Select one terminal at a time and see full data for multiple years by month in table and graph format and use your download button to pull it down to Excel.</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="10%">&nbsp;</td>
                                                        <td width="80%">&nbsp;</td>
                                                        <td width="10%">&nbsp;</td>
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
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="mlr_6_per">
                                                <div class="blueForm">
                                                    <form action="" id="consumernameget" name="airport" method="post">
                                                        <input type="text" id="selinfog" name="selinfog" placeholder="Type an airport code" class="ui-autocomplete-input" autocomplete="off">
                                                        <button class="getairportname"><img src="../clientconvertgraphics2016/ic_arrow_right.png"></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                            <td align="center" class="emmahelveticaa26darkgrey" id="hiddenconsumervalue"> {{ $mergevalues }} | Airport Passenger Actuals</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td align="center" class="emmahelveticaa17darkgreylight" style="padding:0 6%;">
                                            <p>Arriving + Departing | Pax 000</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr id="ajaxTable">
                                        <td>
                                            <div class="">
                                                <table width="100%" id="example_unique" class="table-style-two datatable">
                                                    <thead>
                                                        <tr class="emmahelveticaa14white">
                                                            <!-- <th>Nationality</th> -->
                                                            <th>Year</th>
                                                            <th>Month</th>
                                                            <th>International</th>
                                                            <th>Domestic</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($arrValArr as $resKey => $rst_natinality)
                                                        <tr class="emmahelveticaa14darkgreylight">
                                                            <td>{{ $rst_natinality['year'] }}</td>
                                                            <td>{{ $rst_natinality['month'] }}</td>
                                                            <td>{{ $rst_natinality['int'] }}</td>
                                                            <td>{{ $rst_natinality['dom'] }}</td>
                                                            <td>{{ $rst_natinality['tot'] }}</td>
                                                        </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>



                                    <!-- graph -->
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="mlr_6_per">
                                                <div class="row row-list">
                                                    <div class="col-xs-4"></div>
                                                    <div class="col-xs-7 ">
                                                        <div class="col-xs-3 chart_selector_div">
                                                            <span>INT</span> <input type="checkbox" class="ternimal_data_opt" id="int_ternimal_data" name="int_ternimal_data" value="int" checked>
                                                        </div>
                                                        <div class="col-xs-3 chart_selector_div">
                                                            <span>DOM</span> <input type="checkbox" class="ternimal_data_opt" id="dom_ternimal_data" name="dom_ternimal_data" value="dom">
                                                        </div>
                                                        <div class="col-xs-3 chart_selector_div">
                                                            <span>TOT</span> <input type="checkbox" class="ternimal_data_opt" id="tot_ternimal_data" name="tot_ternimal_data" value="tot">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-1 "></div>
                                                </div>
                                            </div>
                                        </td>
                                    <tr>

                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr id="acapChart">
                                        <!-- <div id="acapChart"></div> -->
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <!-- graph ends-->


                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td width="5%">&nbsp;</td>
                                                    <td width="90%">
                                                        <table width="100%" border="0" bgcolor="#F1F1F1">
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td class="emmahelveticaa18darkgrey">&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td class="emmahelveticaa20darkgrey">Data Download</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"></td>
                                                                <td height="10" class="emmahelveticaa18darkgrey"></td>
                                                                <td height="10"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td class="emmahelveticaa15darkgreylight">By clicking on the button below you will be able to download the selected airport directly to your spreadsheet software.</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td class="emmahelveticaa18darkgrey">&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td class="emmahelveticaa18darkgrey">
                                                                    <form id="formdown1" name="formdown1" method="post" action="{{route('airports.csvpages.one_airport_at_a_time_csv')}}">
                                                                        @csrf
                                                                        <!--  <input name="export" type="submit" class="whit_btn" id="export" value="Spreadsheet Download" /> -->
                                                                        <input name="export" type="submit" class="whit_btn" id="export" value="Airport Download">
                                                                    </form>
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td class="emmahelveticaa18darkgrey"></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="5%"></td>
                                                                <td width="90%" class="emmahelveticaa18darkgrey"></td>
                                                                <td width="5%"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="5%"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
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
    @endsection
    @section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

<!-- AmCharts -->
<script src="//www.amcharts.com/lib/4/core.js"></script>
<script src="//www.amcharts.com/lib/4/charts.js"></script>
<script src="//www.amcharts.com/lib/4/themes/animated.js"></script>

<script>
   var airportname = "";
   jQuery(document).ready(function(){
      jQuery(".getairportname").click(function(){
         airportname = jQuery("#selinfog").val();
      });

      jQuery('#example_unique').dataTable({
         "order": [[ 0, 'asc' ]]
      });

      jQuery('#consumernameget').on('submit', function(e) {
         e.preventDefault();
         var dataconinalstr = jQuery('#selinfog').val();
         var dataconinal = dataconinalstr.replaceAll(' ', '');
         jQuery('#selinfog_name').val(dataconinal);
         jQuery('#ajaxTable').load("/airports/airport-at-a-time-ajax-data.php?consumerCode=" + dataconinal);
      });

      // Autocomplete
      var getautocomplete = @json($autocompleteData); // e.g., from controller
      jQuery("#selinfog").autocomplete({
         source: getautocomplete
      });

      // Graph setup
      var dataType = ['int'];
      var data = @json($arrAllTerminalData);
      creategraph(data, dataType);

      jQuery('#consumernameget').on('submit', function(e) {
         e.preventDefault();
         var dataconinalstr = jQuery('#selinfog').val();
         var dataconinal = dataconinalstr.replaceAll(' ', '');
         jQuery('#selinfog_name').val(dataconinal);

         jQuery.ajax({
            type: "POST",
            url: "{{ url('/airport-graph-data') }}", // Define this route
            data: { keyword: dataconinal, _token: "{{ csrf_token() }}" },
            dataType: "json",
            success: function(graph_data) {
               data = graph_data;
               creategraph(data, dataType);
            }
         });
      });

      jQuery(document).on("click", "input[type='checkbox']", function () {
         if(jQuery(this).is(":checked")){
            dataType.push(jQuery(this).val());
         } else {
            const index = dataType.indexOf(jQuery(this).val());
            dataType.splice(index, 1);
         }
         creategraph(data, dataType);
      });
   });

   function creategraph(data, dataType) {
      am4core.useTheme(am4themes_animated);
      var chartT = am4core.create("acapChart", am4charts.XYChart);
      chartT.paddingRight = 20;
      chartT.data = data;
      chartT.legend = new am4charts.Legend();

      var categoryAxis1 = chartT.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis1.dataFields.category = "mon";
      categoryAxis1.renderer.labels.template.rotation = 45;
      categoryAxis1.renderer.labels.template.wrap = true;
      categoryAxis1.renderer.labels.template.maxWidth = 100;

      var valueAxis = chartT.yAxes.push(new am4charts.ValueAxis());

      function createSeries(field, name, color) {
         var series = chartT.series.push(new am4charts.LineSeries());
         series.dataFields.valueY = field;
         series.dataFields.categoryX = "mon";
         series.name = name;
         series.stroke = am4core.color(color);
         series.strokeWidth = 3;
         series.tooltipText = "{categoryX}: {valueY}";
         return series;
      }

      if (dataType.includes('int')) {
         createSeries("int_prop", "International", "#405690");
      }
      if (dataType.includes('dom')) {
         createSeries("dom_prop", "Domestic", "#de574e");
      }
      if (dataType.includes('tot')) {
         createSeries("tot_prop", "Total", "#F7A941");
      }

      chartT.cursor = new am4charts.XYCursor();
      chartT.scrollbarX = new am4core.Scrollbar();
   }
</script>
@endsection
