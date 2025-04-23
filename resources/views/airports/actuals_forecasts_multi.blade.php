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
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
           <tr>
              <td align="center" class="emmahelveticaa26darkgrey">Airport Forecasts | Multi-Selector</td>
            </tr>
            <tr>
              <td height="10" align="center" class="emmahelveticaa18darkgreylight"></td>
            </tr>
            <tr>
              <td align="center" class="emmahelveticaa18darkgreylight"><table width="100%" border="0">
                <tr>
                  <td width="5%">&nbsp;</td>
                  <td width="90%" align="center" class="emmahelveticaa16darkgreylight">Use the panel below to make easy multi-selections, using an airport as a basis. You can use this tool to select multiple airports, and then decide the years you want to profile for forecasts</td>
                  <td width="5%">&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
				<div class="emmahelveticaa16darkgreylight" style="text-align:center;">Give it a go!</div>  
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
				<div class="emmahelveticaa16darkgreylight" style="text-align:center;">SELECT UP TO 10 AIRPORTS:</div>  
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            
			<tr>
			  <td align="center"><div class="pageCompare pageMulti" style="padding-top:0;">
				  <div class="compare_cont_left">
					<div class="search_drop"> 
					  <input type="search" name="search" placeholder="Search airport list" id="search">
					  <div id="suggesstion-box"></div>
					</div>
					<select class="comp_multi_select" id="airport_list" size="17">
              @foreach($airports as $airport)
                  <option value="{{ $airport->apname }}; {{ $airport->id_ap }}">{{ $airport->apname }}</option>
              @endforeach
          </select>
				  </div>
				  <div class="compare_cont_right">
					<div class="emmahelveticaa16darkgreybold" style="text-align: left;">SELECTED</div>
					<div class="compare_selected_airport" id="menu" style="height: 311px;">
					  <ul id="selectedlist">
					  </ul>
					</div>
					<div class="emmahelveticaa15darkgrey no_airp">No. of Airports: <span id="nmbr">0</span></div>
				  </div>
				</div>
				<div class="pageCompare pageMulti" style="padding-top:0;">
				  <div class="emmahelveticaa16darkgrey" style="margin-bottom:20px;">SELECT ONE/MORE YEARS:</div>
                    @php
              $current_y = date('Y');
          @endphp

          <label class="btn btn-default yearsel">
              <input type="checkbox" id="{{ $current_y }}" class="check_airport" value="{{ $current_y }}">
              {{ $current_y }}
          </label>

          @for($i = 1; $i <= 15; $i++)
              <label class="btn btn-default yearsel">
                  <input type="checkbox" id="{{ $current_y + $i }}" class="check_airport" value="{{ $current_y + $i }}">
                  {{ $current_y + $i }}
              </label>
          @endfor

          <div class="row">
              <form id="formdown1" name="formdown1" method="post" action="compareairports_forecasts.php">
                  <input class="btn_download" id="btnCrtDownload" style="width: 260px;" type="button" value="CREATE DOWNLOAD"  disabled="disabled">
                  <input type="hidden" id="airportlist" name="airportlist" value="">
                  <input type="hidden" id="airportlistsendto" name="airportlistsendto" value="">
                  <input type="hidden" id="dataset" name="dataset" value="">                        
                  <input type="hidden" name="viewname" id="viewname" value="Airport Forecasts View">
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
            </table>
        </div></td>
        </tr>
      </table></td>
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
  <script src="https://www.air4casts.com/air4castapi/air4castapi_latest/amchart/amcharts.js" type="text/javascript"></script>
  <script src="https://www.air4casts.com/air4castapi/air4castapi_latest/amchart/serial.js" type="text/javascript"></script>

  <script type="text/javascript">
    var latest_apgraph = <?php echo json_encode($latest_ap_array); ?>;

    var chart1 = AmCharts.makeChart("latestapgraphdiv", {
      theme: "none",
      type: "serial",
      startDuration: 1,
      dataProvider: latest_apgraph,
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
        text: "% Change on previous Year",
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

    // Second chart initialization
    var latest_apgraph280 = <?php echo json_encode($latest_apann280_arr); ?>;

    var chart2 = AmCharts.makeChart("latestapgraphdiv280", {
      theme: "none",
      type: "serial",
      startDuration: 1,
      dataProvider: latest_apgraph280,
      autoMargins: false,
      marginLeft: 40,
      marginBottom: 30,
      marginRight: 0,
      marginTop: 0,
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
        text: "000 pax",
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

    //Third chart initialization

    var chartapann280 = <?php echo json_encode($latest_apgraphline_arr); ?>;

    var chart3 = AmCharts.makeChart("chartdivairportsactualstot", {
      theme: "none",
      type: "serial",
      startDuration: 1,
      dataProvider: chartapann280,
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
        text: "000 pax",
        size: 12,
        color: "#7d8085",
        bold: false,
      }],



      valueAxes: [{
        //title: "Visitors",
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