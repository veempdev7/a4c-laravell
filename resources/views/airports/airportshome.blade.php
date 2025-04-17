@extends('layouts.app')

@section('content')
<div id="container">
    <table width="100%" border="0">
        <tr>
            <td>
                @include('includes.header')
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" bgcolor="#F1F1F1">
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
                                                    <td align="center" class="emmahelveticaa16darkgreybold">Airports 1500 Overview</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="10"></td>
                                                    <td height="10"></td>
                                                    <td height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td align="center" class="emmahelveticaa15darkgreylight">Fast track the latest monthly actuals as they come in.</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td align="center" class="emmahelveticaa15darkgreylight">Access a complete forecast update for every airport, every month.</td>
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
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" border="0" bgcolor="#F7ECC1">
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td align="center" class="emmahelveticaa17whitebold"><a href="
                  
                  
                  .php" class="emmahelveticaa17greybold">Quick Summaries</a></td>
                                                    <td>&nbsp;</td>
                                                    <td class="emmahelveticaa14white"><a href="airportsquicksum.php" class="emmahelveticaa14grey">Use this link to see quick, easy Airport and Airline summaries you can download instantly.</a></td>
                                                    <td>&nbsp;</td>
                                                    <td><a href="airportsquicksum.php"><img src="../clientconvertgraphics2016/mailerarrowgreysm.png" width="11" height="20" /></a></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="6%">&nbsp;</td>
                                                    <td width="20%">&nbsp;</td>
                                                    <td width="2%">&nbsp;</td>
                                                    <td width="64">&nbsp;</td>
                                                    <td width="2%">&nbsp;</td>
                                                    <td width="3%">&nbsp;</td>
                                                    <td width="6%">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td width="5%">&nbsp;</td>
                                                    <td width="90%">
                                                        <table width="100%" border="0">
                                                            <tr>
                                                                <td align="center" valign="top">&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="35%" align="center" valign="top">
                                                                    <table width="300" height="521" background="../clientconvertgraphics2016/airportsflag.png">
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td class="emmahelveticaa18whitebold">&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td class="emmahelveticaa15whitebold">&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td align="center" class="emmahelveticaa18whitebold">Airports 1500</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td class="emmahelveticaa15whitebold">&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td align="center" class="emmahelveticaa15whitelight">The Airports 1500 module presents a unique database of global airport actuals and forecasts; international, domestic and total. Updated daily as airports declare their figures, there is nothing to match our scientific approach to Travel Retail.</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td class="emmahelveticaa15whitebold">&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td align="center" class="emmahelveticaa15whitelight">For more information, read on.</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td class="emmahelveticaa15whitebold">&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td class="emmahelveticaa15whitebold">&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td class="emmahelveticaa15whitebold">&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td class="emmahelveticaa15whitebold">&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td class="emmahelveticaa15whitebold">&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td class="emmahelveticaa15whitebold">&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="20%">&nbsp;</td>
                                                                            <td width="60%" class="emmahelveticaa15whitebold">&nbsp;</td>
                                                                            <td width="20%">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td width="3%">&nbsp;</td>
                                                                <td width="62%" valign="top">
                                                                    <table width="100%" border="0">
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreybold">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreybold">Airports Data</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="10" class="emmahelveticaa15darkgreylight"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreylight">Monthly international, domestic and total airport passenger actuals are collected from over 1500 global airports on a daily basis as they declare their figures.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreylight">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreylight">Forecasts are produced using custom software and analysed by a dedicated team each month.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreylight">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreybold">Contents</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="10" class="emmahelveticaa15darkgreylight"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreylight">The Airports 1500 moduleis divided into Actuals and Forecasts. </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreylight">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreylight">In the Actuals section, you have the most up to date actual passenger numbers for 1500 airports in over 970 cities and more than 140 countries. This profile accounts for 97% of global traffic. </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreylight">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreylight">Actuals can be viewed from various perspectives and don’t forget to check our Airline actuals.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreylight">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreylight">In the Forecasts section, monthly, quarterly and annual forecasts are presented, based on our extensive actuals collection, by airport, city, country and region.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreylight">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreylight">Air4casts produces these forecasts out to 2040. Monthly and quarterly forecasts have a shorter horizon.</td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="5%">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" border="0" bgcolor="#E1E1E1">
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
                                                    <td width="5%">&nbsp;</td>
                                                    <td width="90%">
                                                        <table width="100%" border="0">
                                                            <tr>
                                                                <td width="28%" valign="top">
                                                                    <table width="100%" border="0" bgcolor="#DEB780">
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td align="center" class="emmahelveticaa18whitelight">Actuals Updated</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td align="center" class="emmahelveticaa18whitebold">Every Day</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td align="center" class="emmahelveticaa18whitelight">Forecasts Updated</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td align="center" class="emmahelveticaa18whitebold">
                                                                                <p>Every Month</p>
                                                                            </td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="5%">&nbsp;</td>
                                                                            <td width="90%">&nbsp;</td>
                                                                            <td width="5%">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td width="8%">&nbsp;</td>
                                                                <td width="28%" valign="top">
                                                                    <table width="100%" border="0" bgcolor="#94684D">
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td align="center" class="emmahelveticaa18whitebold">Browse, Search &amp; Download</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td align="center" class="emmahelveticaa18whitelight">&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td align="center" class="emmahelveticaa18whitelight">or ask the Support Team</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="5%">&nbsp;</td>
                                                                            <td width="90%">&nbsp;</td>
                                                                            <td width="5%">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td width="8%">&nbsp;</td>
                                                                <td width="28%" valign="top">
                                                                    <table width="100%" border="0" bgcolor="#5D8098">
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td align="center" class="emmahelveticaa18whitebold">
                                                                                <p>And don’t </p>
                                                                                <p>forget:</p>
                                                                            </td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td align="center" class="emmahelveticaa18whitelight">&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td align="center" class="emmahelveticaa18whitelight">
                                                                                <p>the <a href="airportsquicksum.php" class="emmahelveticaa18whitelight">Quick Summaries</a></p>
                                                                            </td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="5%">&nbsp;</td>
                                                                            <td width="90%">&nbsp;</td>
                                                                            <td width="5%">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="5%">&nbsp;</td>
                                                </tr>
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