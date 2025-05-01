@extends('layouts.app')

@section('content')
<div id="container">
    <table width="100%" border="0"> <!-- global table -->
        <tr>
            <td>
                @include('includes.header')
            </td>
        </tr>
        @include('includes.airports.header')
        <!-- central fixed table -->
        <tr>
            <td bgcolor="#53585f">
                <table width="86%" border="0" style="margin:40px 7%;">
                    <tbody>
                        <tr>
                            <td valign="top">
                                <h4 class="emmahelveticaa15whitebold">ACTUALS</h4><br />
                                <p><a href="{{ url('airportsquicksum') }}" class="emmahelveticaa15white">International Actuals by Region</a></p><br />
                                <p><a href="{{ url('airportsquicksumTotalregion') }}" class="emmahelveticaa15white">Total Actuals by Region</a></p><br />
                                <p>
                                    <a href="{{ url('airportsquicksumairportrecentgrowth') }}" class="emmahelveticaa15white">
                                        <strong>Top 200 Airports</strong><br />
                                        Recent International Growth
                                    </a>
                                </p><br />
                                <p id="ris_thebigdownload"><a href="javascript:void(0)" class="emmahelveticaa15white">The Big Downloads</a></p><br />
                                <p>
                                    <a href="{{ url('airportsquicktoptwentyairportbyregion') }}" class="emmahelveticaa15white">
                                        <strong>Top 20 Airports by Region</strong><br>
                                        {{ date('Y') - 1 }} and {{ date('Y') - 2 }} with % changes
                                    </a>
                                </p>
                            </td>
                            <td>
                                <h4 class="emmahelveticaa15whitebold">FORECASTS</h4><br />
                                <p>
                                    <a href="{{ url('airportsquicksumairpchanges') }}" class="emmahelveticaa15white">
                                        <strong>Top 200 Airports</strong><br />
                                        {{ date('Y') + 1 }} and % changes on {{ date('Y') }}
                                    </a>
                                </p><br />
                                <p>
                                    <a href="{{ url('airportsquicksumtermichanges') }}" class="emmahelveticaa15white">
                                        <strong>Top 200 Terminals</strong><br />
                                        {{ date('Y') + 1 }} and % changes on {{ date('Y') }}
                                    </a>
                                </p><br />
                                <!-- Optional: Uncomment if enabling spreadsheet download in future
            <p>
              <form id="formdown1" name="formdown1" method="post" action="{{ url('csvpages/quick_addtionalpage_csv') }}">
                @csrf
                <button type="submit" style="background: none; border: 0; padding: 0; margin: 0;">
                  <a class="emmahelveticaa15white"><strong>Top 20 Airports by Country</strong><br/>{{ date('Y') + 1 }} and % changes on {{ date('Y') }}</a>
                </button>
              </form>
            </p>
            -->
                                <p>
                                    <a href="{{ url('airportsquicktopairportbyregion') }}" class="emmahelveticaa15white">
                                        <strong>Top Airports by Region</strong><br />
                                        {{ date('Y') + 1 }} and % changes on {{ date('Y') }}
                                    </a>
                                </p>
                            </td>
                            <td width="30%">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- ..... -->
        <tr>
            <td style="padding:30px 0; text-align:center;">
                <p class="emmahelveticaa28darkgreylight">International Actuals | by Region</p>
            </td>
        </tr>
        <tr>
            <td valign="top">
                <table width="100%" height="386" border="0" bgcolor="#3B6288">
                    <tr>
                        <td height="10"></td>
                        <td height="10"></td>
                        <td height="10"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td valign="top" style="padding-left:10px;">
                            <table width="100%" border="0">
                                <tr>
                                    <td width="55%" align="center" valign="top">
                                        <p class="emmahelveticaa28whitelight" style="margin:90px 0 60px;">World Summary</p>
                                        <table width="100%" border="0">
                                            <tr class="emmahelveticaa30white">
                                                <td align="center">{{ $row_rst_inttot->aportno }}</td>
                                                <td>&nbsp;</td>
                                                <td align="center">{{ $row_rst_inttot->trafficprop }}%</td>
                                                <td>&nbsp;</td>
                                                <td align="center">{{ number_format($row_rst_inttot->paxch, 1, '.', ',') }}%</td>
                                            </tr>
                                            <tr class="emmahelveticaa20whitelight">
                                                <td height="7" align="center"></td>
                                                <td></td>
                                                <td align="center"></td>
                                                <td></td>
                                                <td align="center"></td>
                                            </tr>
                                            <tr class="emmahelveticaa18whitelight">
                                                <td width="38%" align="center">{{ $row_rst_monname->dlup_fullmontxt }} airports</td>
                                                <td width="4%">&nbsp;</td>
                                                <td width="27%" align="center">% of traffic</td>
                                                <td width="4%">&nbsp;</td>
                                                <td width="26%" align="center">% change</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="45%" align="center" valign="middle">
                                        <img src="{{ asset('clientconvertgraphics2016/quicksummap.png') }}" height="275" style="margin:50px 0;" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="center" class="emmahelveticaa17darkgrey">
                <table width="100%" border="0">
                    <tr>
                        <td width="10%">&nbsp;</td>
                        <td width="80%" align="center" class="emmahelveticaa16darkgreylight">
                            So far this month there is international passenger data to hand for {{ $row_rst_inttot->aportno }} airports which represent some {{ $row_rst_inttot->trafficprop }}% of the traffic expected for the month. The year on year change recorded is {{ number_format($row_rst_inttot->paxch, 1, '.', ',') }}%.
                        </td>
                        <td width="10%">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0">
                    <tr>
                        <td>&nbsp;</td>
                        <td align="center" class="emmahelveticaa26darkgreylight">
                            <span class="emmahelveticaa26darkgrey">Global International Passengers | {{ $latestMonths['global'] }}</span>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="5%">&nbsp;</td>
                        <td width="90%" align="center" class="emmahelveticaa18darkgreylight">% change on previous year</td>
                        <td width="5%">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0">
                    <tr>
                        <td width="5%">&nbsp;</td>
                        <td width="90%" align="center"><iframe id="apg" name="apg" width="800px" height="350px" align="center" frameborder="no" scrolling="No" src="{{ url('airports/quicksumgraphs/quicksumam1') }}" style="margin-left: -10px;"></iframe></td>
                        <td width="5%">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
            <tr>
              <td><table width="100%" border="0">
                <tr>
                  <td width="5%">&nbsp;</td>
                  <td width="90%"><table width="100%" border="0">
                    <tr>
                      <td width="49%"><table width="100%" border="0">
                        <tr>
                          <td align="center" class="emmahelveticaa15darkgrey">Africa International Passengers</td>
                        </tr>
                        <tr>
                          <td align="center" class="emmahelveticaa13darkgreylight"> {{ $latestMonths['africa'] }} | % change on previous year</td>
                        </tr>
                        <tr>
                          <td align="center"><iframe id="apg" name="apg" width="400px" height="250px" align="center" frameborder="no" scrolling="No" src="{{ url('airports/quicksumgraphs/quicksumam2') }}" style="margin-left: -20px;"></iframe></td>
                        </tr>
                      </table></td>
                      <td width="2%">&nbsp;</td>
                      <td width="49%"><table width="100%" border="0">
                        <tr>
                          <td align="center" class="emmahelveticaa15darkgrey">Asia/Pacific International Passengers</td>
                        </tr>
                        <tr>
                          <td align="center" class="emmahelveticaa13darkgreylight"> {{ $latestMonths['asia'] }} | % change on previous year</td>
                        </tr>
                        <tr>
                          <td align="center"><iframe id="apg" name="apg" width="400px" height="250px" align="center" frameborder="no" scrolling="No" src="{{ url('airports/quicksumgraphs/quicksumam3') }}" style="margin-left: -20px;"></iframe></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="5%">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0">
                <tr>
                  <td width="5%">&nbsp;</td>
                  <td width="90%"><table width="100%" border="0">
                    <tr>
                      <td width="49%"><table width="100%" border="0">
                        <tr>
                          <td align="center" class="emmahelveticaa15darkgrey">Europe International Passengers</td>
                        </tr>
                        <tr>
                          <td align="center" class="emmahelveticaa13darkgreylight"> {{ $latestMonths['europe'] }}  | % change on previous year</td>
                        </tr>
                        <tr>
                          <td align="center"><iframe id="apg" name="apg" width="400px" height="250px" align="center" frameborder="no" scrolling="No" src="{{ url('airports/quicksumgraphs/quicksumam4') }}" style="margin-left: -20px;"></iframe></td>
                        </tr>
                      </table></td>
                      <td width="2%">&nbsp;</td>
                      <td width="49%"><table width="100%" border="0">
                        <tr>
                          <td align="center" class="emmahelveticaa15darkgrey">Latin America International Passengers</td>
                        </tr>
                        <tr>
                          <td align="center" class="emmahelveticaa13darkgreylight"> {{ $latestMonths['latamerica'] }}  | % change on previous year</td>
                        </tr>
                        <tr>
                          <td align="center"><iframe id="apg" name="apg" width="400px" height="250px" align="center" frameborder="no" scrolling="No" src="{{ url('airports/quicksumgraphs/quicksumam5') }}" style="margin-left: -20px;"></iframe></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="5%">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0">
                <tr>
                  <td width="5%">&nbsp;</td>
                  <td width="90%"><table width="100%" border="0">
                    <tr>
                      <td width="49%"><table width="100%" border="0">
                        <tr>
                          <td align="center" class="emmahelveticaa15darkgrey">North America International Passengers</td>
                        </tr>
                        <tr>
                          <td align="center" class="emmahelveticaa13darkgreylight"> {{ $latestMonths['northamerica'] }} | % change on previous year</td>
                        </tr>
                        <tr>
                          <td align="center"><iframe id="apg" name="apg" width="400px" height="250px" align="center" frameborder="no" scrolling="No" src="{{ url('airports/quicksumgraphs/quicksumam6') }}" style="margin-left: -20px;"></iframe></td>
                        </tr>
                      </table></td>
                      <td width="2%">&nbsp;</td>
                      <td width="49%"><table width="100%" border="0">
                        <tr>
                          <td align="center" class="emmahelveticaa15darkgrey">Middle East International Passengers</td>
                        </tr>
                        <tr>
                          <td align="center" class="emmahelveticaa13darkgreylight"> {{ $latestMonths['middleeast'] }} | % change on previous year</td>
                        </tr>
                        <tr>
                          <td align="center"><iframe id="apg" name="apg" width="400px" height="250px" align="center" frameborder="no" scrolling="No" src="{{ url('airports/quicksumgraphs/quicksumam7') }}" style="margin-left: -20px;"></iframe></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  <td width="5%">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0">
                <tr>
                  <td width="5%">&nbsp;</td>
                  <td width="90%"><table width="100%" border="0" bgcolor="#F1F1F1">
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
                      <td class="emmahelveticaa15darkgreylight">By clicking on the button below you will be able to download the selected data directly to your spreadsheet software.</td>
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
                      <form id="formdown1" name="formdown1" method="POST" action="{{ route('airports.csvpages.quicksum_worldsummary_csv') }}">
                            @csrf
                            <input name="export" type="submit" class="whit_btn" id="export" value="Spreadsheet Download">
                        </form>
                      </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td class="emmahelveticaa18darkgrey">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="5%">&nbsp;</td>
                      <td width="90%" class="emmahelveticaa18darkgrey">&nbsp;</td>
                      <td width="5%">&nbsp;</td>
                    </tr>
                  </table></td>
                  <td width="5%">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
    </table>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>
</div>
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

@endsection