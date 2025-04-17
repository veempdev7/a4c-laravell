<style type="text/css">
.oneColElsCtr #container {
	width: 100%;
	background: #FFFFFF;
	margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
	border: 0px solid #FFFFFF;
	text-align: left; /* this overrides the text-align: center on the body element. */
}
.oneColElsCtr #mainContent {
	padding: 0px; /* remember that padding is the space inside the div box and margin is the space outside the div box */
}
#AirportsMenuSimple_container{height:auto !important; margin: 0 !important; width:1000px !important;}
ul.FM2_AirportsMenuSimple li a{width:320px !important;}
ul.FM2_AirportsMenuSimple li ul{left:0 !important;}
ul.FM2_AirportsMenuSimple ul li a,ul.FM2_AirportsMenuSimple ul li:hover >a, ul.FM2_AirportsMenuSimple ul li.hover >a{width: 470px !important;}
ul.FM2_ClientMenu2 li a{height:67px !important;}
ul.FM2_ClientMenu2 li:hover >a, ul.FM2_ClientMenu2 li.hover >a{height: 67px !important;}
#AirportsMenuSimple_container ul.FM2_AirportsMenuSimple li a i{float:right; font-size: 18px}
</style>
<style>
    ul.FM2_ClientMenu2 li a {
        /* padding: 17px 25px 0px 25px; */
        /* padding: 17px 35px 0px 35px; */
        padding: 28px 15px 0px 29px;
    }

    ul.FM2_ClientMenu2 li a span,
    ul.FM2_ClientMenu2 li a font,
    ul.FM2_ClientMenu2 li a:hover span,
    ul.FM2_ClientMenu2 li a:hover font {
        font-weight: normal !important;
    }
    
</style>

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
                                        <td width="25%"><a href="{{ url('/') }}">
                                                <img src="{{ asset('clientconvertgraphics2016/a4conlinelogosim.png') }}" width="200" height="54" alt="Logo">
                                            </a></td>
                                        <td width="5%">&nbsp;</td>
                                        <td width="48%" align="right" class="emmahelveticaa22whitebold">

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
                                                    <td>&nbsp;</td>
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
                                                                <li> <a href="{{ route('airports.home') }}" target="_self">
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
                </div>
            </td>
        </tr>
    </table>
</td>

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
</div>
</td>
</tr>
</table>
<div class="overlay" id="airport_popUp">
    <div class="modal">
        <p class="emmahelveticaa30darkgreylight" id="tabtext"></p>
        <p class="emmahelveticaa18darkgrey m_bt_15"><span id="nametxt"></span></p>
        <p class="emmahelveticaa15darkgreylight"><span id="detailstxt"></span>. If you would like to find out more about it, please visit <a href="http://www.air4casts.com" target="_blank">www.air4casts.com</a>, read about it in the Support Center or request a demonstration from our Support Team.</p><br />

        <p class="emmahelveticaa17darkgrey">........................................</p>
        <div class="clearfix">&nbsp;</div>
    </div>
</div>
<!--href="../apps/appshome.php"-->
<!-- pop Up code -->
<link href="https://maintest17.air4casts.com/popup/overlay.css" rel="stylesheet" type="text/css" />
<!--<script src="http://code.jquery.com/jquery-latest.min.js"></script>-->
<script type="text/javascript" src="https://maintest17.air4casts.com/popup/overlay.js"></script>
<!-- Popup Message-->


<!-- new popup -->
<div class="overlay" id="chinadomesticModal" style="z-index: 99">
    <div class="modal">
        <p class="emmahelveticaa30darkgreylight" id="tabtext">Air4casts ChinaDomestic</p>
        <p class="emmahelveticaa18darkgreylight m_bt_15">The new <span style="font-weight: bold">ChinaDomestic</span> module has been developed by Air4casts in response to the need for fast and <span style="font-weight: bold">accurate</span> data on <span style="font-weight: bold">up-to-the minute</span> changes to the China domestic travel market.</p><br />
        <p class="emmahelveticaa16darkgreylight" style="padding: 0px 10px;">This module is available to users of companies who subscribe to it.</p>
        <p class="emmahelveticaa16darkgreylight" style="padding: 0px 17px;">If you would like to find out more about it, please request a demonstration from our Support Team.</p>
        <p class="emmahelveticaa17darkgrey">........................................</p>
        <div class="clearfix">&nbsp;</div>
    </div>
</div>
<!-- new popup -->

<!-- Airports 1500-->
<!-- Popup Message-->
<script type="text/javascript">

</script>