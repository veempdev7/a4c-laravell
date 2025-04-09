@extends('layouts.app')

@section('content')
<div id="container">
    <table width="100%" border="0"> <!-- global table -->
        <tr>
            <td>
                <table width="100%" border="0" bgcolor="#E1E1E1"> <!-- header elastic table -->
                    <tr>
                        <td>
                            <div align="center">
                                <table width="1000" border="0" bgcolor="#5082B2"> <!-- header fixed table -->
                                    <tr>
                                        <td height="10"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td width="5%">&nbsp;</td>
                                                    <td width="25%"><a href="../welcome/welcomepage.php"><img src="../clientconvertgraphics2016/a4conlinelogosim.png" width="200" height="54" /></a></td>
                                                    <td width="5%">&nbsp;</td>
                                                    <td width="48%" align="right" class="emmahelveticaa22whitebold">
                                                        {{-- <?php
                                                                echo $title;

                                                                ?> --}}
                                                         Air4casts       
                                                    </td>
                                                    <td width="14%" align="right" class="emmahelveticaa14whitelight">
                                                        <table width="120" border="0">
                                                            <tr>
                                                                <td width="30%" align="center">
                                                                    @if (Auth::guard('loginapp')->check())
                                                                    <!-- Display cog image when logged in -->
                                                                    <img src="{{ asset('clientconvertgraphics2016/cog.png') }}" width="30" height="31" />
                                                                    @else
                                                                    <!-- Optional: Show a different image if not logged in -->
                                                                    <img src="{{ asset('clientconvertgraphics2016/cog.png') }}" width="30" height="31" />
                                                                    @endif
                                                                </td>
                                                                <td width="70%" class="emmahelveticaa14whitelight">
                                                                    @if (Auth::guard('loginapp')->check())
                                                                    <!-- Logout form when logged in -->
                                                                    <form action="{{ route('loginapp.logout') }}" method="POST">
                                                                        @csrf
                                                                        <button type="submit" style="background: none; border: none; color: #fff; text-decoration: none; cursor: pointer;">Log Out</button>
                                                                    </form>
                                                                    @else
                                                                    <!-- Default link when not logged in -->
                                                                    <a href="{{ route('loginapp.show') }}" style="text-decoration: none; color: #fff;">Log In</a>
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </td>
                                                    <td width="3%">&nbsp;</td>
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
                                                    <td width="3%">&nbsp;</td>
                                                    <td width="40%" class="emmahelveticaa20white">
                                                        <table width="100%" border="0">
                                                            <tr>
                                                                <td width="6%">&nbsp;</td>
                                                                <td width="89%" class="emmahelveticaa20whitebold">&nbsp;</td>
                                                                <td width="5%">&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="18%" align="center"><a href="https://help.air4casts.com" target="_blank" class="top_support_menu"><i class="fa fa-user"></i> Support Center</a></td>
                                                    <td width="18%" align="center"><a href="../UserAdministration" class="top_support_menu"><i class="fa fa-gear"></i> Manage Users</a></td>
                                                    <td width="18%" align="center"><a href="https://air4casts.com/newscast.php" target="_blank" class="top_support_menu"><i class="fa fa-cloud"></i> Newscast</a></td>

                                                    <td width="3%">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" height="350" background="../clientconvertgraphics2016/skyplane1000.png">
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table width="100%" border="0">
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td class="emmahelveticaa30whitebold">Big Data, at your fingertips</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"></td>
                                                                <td height="10" class="emmahelveticaa30whitebold"></td>
                                                                <td height="10"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td class="emmahelveticaa18white">The Air4casts website is a portal to Travel Retail data from every angle.</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="3%">&nbsp;</td>
                                                                <td width="94%" class="emmahelveticaa18white">Use this page as a springboard to start your journey.</td>
                                                                <td width="3%">&nbsp;</td>
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
                                                <tr>
                                                    <td height="60">
                                                        <table width="100%" border="0">
                                                            <tr>
                                                                <td width="2%">&nbsp;</td>
                                                                <td width="96%" align="center">&nbsp;

                                                                    <div id="ClientMenu2_container" class="FM2_ClientMenu2_container" style="display:block">
                                                                        <ul id="ClientMenu2" class="FM2_ClientMenu2">
                                                                            <!-- version=@@buildNumber@@;name=ClientMenu2;baseskin=skin15;colorscheme=dark_blue;type=tabbed; -->
                                                                            <li> <a href="../welcome/welcomepage.php" target="_self">
                                                                                    <font class="leaf">Home</font>
                                                                                </a></li>
                                                                            <li id="1"> <a target="_self" class="selected">
                                                                                    <font class="leaf">Airports&nbsp;1500</font>
                                                                                </a></li>
                                                                            <li id="5"> <a target="_self" class="selected">
                                                                                    <font class="leaf">Terminal&nbsp;Forecasts</font>
                                                                                </a></li>
                                                                            <li id="2"> <a target="_self" class="selected">
                                                                                    <font class="leaf">Nationalities&nbsp;1000</font>
                                                                                </a></li>
                                                                            <li id="3"> <a target="_self" class="selected">
                                                                                    <font class="leaf">Routes&nbsp;1000</font>
                                                                                </a></li>
                                                                            <li id="4"> <a target="_self" class="selected">
                                                                                    <font class="leaf">Retail&nbsp;Reach</font>
                                                                                </a></li>
                                                                            <!-- <li id="5"> <a target="_self" class="selected"><font class="leaf">BrandWeb</font></a></li> -->
                                                                            <!-- <li id="6"> <a target="_self" class="selected"><font class="leaf">Tourism</font></a></li> -->
                                                                            <li style="position: relative;"> <a target="_self" class="selected">
                                                                                    <font class="leaf"><span class="branch">Insights <i class="fa fa-angle-down"></i></span></font>
                                                                                </a>
                                                                                <ul class="chinaHover">
                                                                                    <li id='8'><a target="_self" class="selected">
                                                                                            <font class="leaf">ChinaDomestic</font>
                                                                                        </a></li>
                                                                                </ul>
                                                                            </li>
                                                                            <li id="9"> <a target="_self" class="selected">
                                                                                    <font class="leaf">Apps</font>
                                                                                </a></li>
                                                                            <!-- <li id="7" class="coronavirus" style="padding-left: 2px!important; padding-right: 2px!important;"><a target="_self" class="selected"><font class="leaf">Coronavirus</font></a></li>  -->
                                                                        </ul>
                                                                        <script type="text/javascript">
                                                                            registerFlexiCSSMenu("ClientMenu2", {
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
                                                                                    "preset": "push",
                                                                                    "enableTablet": false,
                                                                                    "enableMobile": false,
                                                                                    "mobileMaxWidth": 640,
                                                                                    "tabletMaxWidth": 1023,
                                                                                    "tabletCloseBtnLabel": "Close",
                                                                                    "tabletCloseBtnEnable": false,
                                                                                    "align": "center"
                                                                                },
                                                                                "stickToTop": false,
                                                                                "takeBrowserWidth": true
                                                                            });
                                                                        </script>
                                                                    </div>

                                                                </td>
                                                                <td width="2%">&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
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
                <table width="100%" border="0" bgcolor="#F1F1F1"> <!-- central elastic table -->
                    <tr>
                        <td valign="top">
                            <div align="center">
                                <table width="1000" border="0" bgcolor="#FFFFFF"> <!-- central fixed table -->
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
                                                    <td align="center" class="emmahelveticaa22darkgreybold">The
                                                        {{-- <?php
                                                                echo $title;

                                                                ?> --}} Site from Air4casts
                                                    </td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="10"></td>
                                                    <td width="94%"></td>
                                                    <td width="10"></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td align="center" class="emmahelveticaa15darkgrey">Cross-module resources</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <table width="100%" border="0">
                                                            <tr>
                                                                <td width="3%">&nbsp;</td>
                                                                <td width="35%" valign="top">
                                                                    <table width="100%" border="0">
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="center" class="emmahelveticaa15darkgreybold">
                                                                                <table width="100%" border="0">
                                                                                    <tr>
                                                                                        {{-- <?php
                                                                                                if ($_SESSION['kt_login_company_id'] == 30) {
                                                                                                    $url = "../customdown/customdowndgtr.php";
                                                                                                } else {
                                                                                                    $url = "";
                                                                                                }

                                                                                                ?> -- }}
                                                                                        <td width="85%" align="left">
                                                                                            <!-- option to select -->

                                                                                            <a href="<?php echo $redirectUrl ?>"> {{-- <?php echo $title; ?> --}} Custom Downloads</a>
                                                                                            <!-- option to select -->
                                                                                            <!-- <a class="selectedcustomdownload" href="../customdown/customdowncartierrichemont.php"> -->
                                                                                            <!-- href="<?php //echo $url;
                                                                                                        ?>"> -->
                                                                                            <!-- <?php
                                                                                                    // echo $title;

                                                                                                    ?>
										  Custom Downloads</a> -->
                                                                                        </td>

                                                                                        <td width="15%">

                                                                                            <a class="selectedcustomdownload" href=" {{-- <?php echo $url; ?> --}}">
                                                                                                <img src="../clientconvertgraphics2016/mailerarrowgreysm.png" width="10" height="19" />
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="5"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa14darkgrey">
                                                                                <div align="left">Download all regular, monthly and customized reports requested by your team directly to your desktop.</div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="center">
                                                                                <a class="selectedcustomdownload" href="">
                                                                                    <img src="../clientconvertgraphics2016/cutomdownload320.png" width="320" height="139" />
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td width="8%" align="center" valign="middle"><img src="../clientconvertgraphics2016/homeline280.png" width="11" height="280" /></td>
                                                                <td width="51%" valign="top">
                                                                    <table width="100%" border="0">
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa15darkgreybold">

                                                                                <table width="100%" border="0">

                                                                                    {{-- <?php
                                                                                            $chkcompany = strtolower($_SESSION["kt_login_company"]);
                                                                                            //echo $chkcompany;die;
                                                                                            if ($chkcompany == 'coty') {

                                                                                            ?> --}}
                                                                                    <tr>
                                                                                        <td width="90%">Airport Infographics</td></a>
                                                                                        <td width="10%" class="infographics_id">
                                                                                            <a href="#">
                                                                                                <img src="../clientconvertgraphics2016/mailerarrowgreysm.png" width="10" height="19" />
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>

                                                                                    {{-- <?php
                                                                                            } else {

                                                                                            ?> --}}
                                                                                    <tr>
                                                                                        <td width="90%">Airport Infographics</td></a>
                                                                                        <td width="10%" class="infographics_id">
                                                                                            <a href="#">
                                                                                                <img src="../clientconvertgraphics2016/mailerarrowgreysm.png" width="10" height="19" />
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>

                                                                                    {{-- <?php
                                                                                            }
                                                                                            ?> --}}
                                                                                </table>
                                                                            </td>
                                                                            <td>&nbsp;</td>
                                                                            <td class="emmahelveticaa15darkgreybold">
                                                                                <table width="100%" border="0">
                                                                                    <tr>
                                                                                        <td width="70%">Air4casts Data Maps</td>
                                                                                        <td width="30%" class="selectedjmap">
                                                                                            <a href="#"><img src="../clientconvertgraphics2016/mailerarrowgreysm.png" width="10" height="19" alt="" /></a>
                                                                                            <!--  <img src="../clientconvertgraphics2016/mailerarrowgreysm.png" width="10" height="19" /> -->
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="5"></td>
                                                                            <td height="5"></td>
                                                                            <td height="5"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="emmahelveticaa14darkgrey">
                                                                                <p>See infographics with data from four modules for the Top 200 Global Airports.</p>
                                                                            </td>
                                                                            <td>&nbsp;</td>
                                                                            <td class="emmahelveticaa14darkgrey">Get latest data summaries for every airport on our database from our five biggest modules, all in one place.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" valign="top" class="infographics_id">
                                                                                <a href="#" class="selectInfo"><img src="../clientconvertgraphics2016/infographicbutton210.png" width="160" height="210" /></a>
                                                                            </td>
                                                                            <td>&nbsp;</td>
                                                                            <td align="left" valign="top" class="selectedjmap">
                                                                                <!-- <img src="../clientconvertgraphics2016/javamap240.png" width="240" height="150" /> -->
                                                                                <a href="#" id="javamaps"><img src="../clientconvertgraphics2016/javamap240.png" width="240" height="150" alt="" /></a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%">&nbsp;</td>
                                                                            <td width="3%">&nbsp;</td>
                                                                            <td width="57%">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td width="3%">&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" border="0" bgcolor="#">
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
                                                    <td></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td>&nbsp;</td>

                                                    <td valign="top">
                                                        <h3 class="emmahelveticaa16white text-left" style="font-weight: bold">COVID-19</h3>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td class="emmahelveticaa14white">
                                                        <h3 class="emmahelveticaa16white text-left" style="font-weight:bold">Recovery Forecasts Update</h3></br>

                                                        <p class="emmahelveticaa14white text-left">Latest forecast update: {{-- <?php echo $new_date; ?> --}}</p>
                                                        </br>

                                                        <p class="emmahelveticaa14white text-left">For the immediate future the key Airports 1500 module will, when appropriate, be updated on a weekly basis. The Nationalities and Routes modules will continue to be updated at the end of each month. This heightened frequency will be called whenever the input data demands it which would very well be the case were recovery in specific sectors accelerates.</p></br>

                                                        <p class="emmahelveticaa14white text-left">A reminder to subscribers that, as the industry recovers from Covid and some countries still have a way to go, it is now more important than ever that the forecasting software has the most up-to-date airport actuals. Because some key airports are slow to declare, the routine updates which would normally take place at the end of the first week of the month, January excepted when declarations from many airports are seasonally late, may be delayed by a day or so.</p>
                                                        </br>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td style="display: flex;"><a href="javascript:void(0);" class="cls_recovery_popup"><img src="../clientconvertgraphics2016/mailerarrowtransp.png" width="18" height="24" /></a></td>
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
                                            <table width="100%" border="0" bgcolor="#7BA3C6">
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
                                                    <td align="center" class="emmahelveticaa17whitebold"><a href="../airports/airportshome.php" class="emmahelveticaa17whitebold">Content Summary</a></td>
                                                    <td>&nbsp;</td>
                                                    <td class="emmahelveticaa14white"><a href="../airports/airportshome.php" class="emmahelveticaa14white">Want to know which airports, terminals, or countries we cover in our modules? Use this easy link to find out quickly.</a></td>
                                                    <td>&nbsp;</td>
                                                    <td><a href="../airports/airportshome.php"><img src="../clientconvertgraphics2016/mailerarrowtransp.png" width="18" height="24" /></a></td>
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
                                            <table width="100%" border="0" bgcolor="#F8F8F8">
                                                <tr>
                                                    <td width="6%">&nbsp;</td>
                                                    <td width="3%" class="emmahelveticaa13darkgreybold">&nbsp;</td>
                                                    <td width="85%">&nbsp;</td>
                                                    <td width="6%">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td colspan="2" align="center" class="emmahelveticaa17darkgreybold">An Introduction to Your Site</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="10"></td>
                                                    <td height="10" valign="top" class="emmahelveticaa13darkgreybold"></td>
                                                    <td height="10" class="emmahelveticaa13darkgrey"></td>
                                                    <td height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td class="emmahelveticaa13darkgreybold">✓</td>
                                                    <td class="emmahelveticaa13darkgreybold">This website is your first point of access to the data to which your company subscribes with Air4casts.</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td valign="top" class="emmahelveticaa13darkgreybold">✓</td>
                                                    <td class="emmahelveticaa13darkgrey">Your team subscribes to data by module. Each module has a theme, a unique base of source data and a particular use for Travel Retail. Our module content is explained below.</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td class="emmahelveticaa13darkgreybold">✓</td>
                                                    <td class="emmahelveticaa13darkgrey">They can be accessed using the navigation bar at the top of the page throughout the site. </td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td class="emmahelveticaa13darkgreybold">&nbsp;</td>
                                                    <td class="emmahelveticaa13darkgrey">&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td class="emmahelveticaa13darkgreybold">✓</td>
                                                    <td class="emmahelveticaa13darkgreybold">You can browse, select and download data from numerous perspectives within each module.</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td valign="top" class="emmahelveticaa13darkgreybold">✓</td>
                                                    <td class="emmahelveticaa13darkgrey">In some cases, our database holds too much data to be able to browse on a website. Where applicable, this is always noted on the page. If you wish to see more data from a particular section of the site, just get in touch.</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td valign="top" class="emmahelveticaa13darkgreybold">✓</td>
                                                    <td class="emmahelveticaa13darkgrey">There are also three ways to analyze data from multiple modules at once. You will find these at the top of your welcome page whenever you sign in. You have customised downloads, specified by your team and updated every month automatically. These can be modified or added to at any time. You also have our Infographics and Maps Packages, taking summary data from a minimum of four modules at a time.</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td class="emmahelveticaa13darkgreybold">&nbsp;</td>
                                                    <td class="emmahelveticaa13darkgrey">&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td class="emmahelveticaa13darkgreybold">✓</td>
                                                    <td class="emmahelveticaa13darkgreybold">Support is available 24/7. </td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td valign="top" class="emmahelveticaa13darkgreybold">✓</td>
                                                    <td class="emmahelveticaa13darkgrey">If you have questions, require more information, need direct technical help or want to download large amounts of data at once, simply contact one of our Support Staff through the link above.</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td class="emmahelveticaa13darkgreybold">&nbsp;</td>
                                                    <td class="emmahelveticaa13darkgrey">&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" border="0" bgcolor="#F0F0F0">
                                                <tr>
                                                    <td width="3%">&nbsp;</td>
                                                    <td width="94%">&nbsp;</td>
                                                    <td width="3%">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td align="center" class="emmahelveticaa17darkgreybold">How does it work?</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td align="center">&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td align="center"><img src="../clientconvertgraphics2016/howitworks800.png" width="600" height="381" /></td>
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
    <div id="myModal" class="modal fade fade_out" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog welcome_msg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <p class="emmahelveticaa30darkgreylight">Download Notice</p>
                    <p class="emmahelveticaa15darkgreybold">Thank you for logging in to your Air4casts website. You may wish to download data while you’re here.</p>
                    <p class="emmahelveticaa15darkgrey"> That’s absolutely fine. You should! But our data is copyright protected and so it is important that we have a record of the downloads created on our website each day.
                    </p>
                    <p class="emmahelveticaa15darkgrey">Under new GDPR laws, you must consent to having information about your website usage logged in this way. Please give us your consent below and continue into your website.</p>
                    <p class="emmahelveticaa15darkgrey" style="padding-bottom:0px;">If you have questions, please get in touch with your Support Team:
                    <div class="link emmahelveticaa15darkgrey"><a href="http://>support@air4casts.com" target="_blank">support@air4casts.com</a></div>
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default cnf_btn" data-dismiss="modal" data-toggle="modal" data-target="#coronaModal" id="gdpr_button"><i class="fa fa-check" aria-hidden="true" style="color:white"></i><span class="space emmahelveticaa15white">I consent</span></button>
                    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
                </div>
            </div>

        </div>
    </div>

    @endsection
  