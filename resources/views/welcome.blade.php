@extends('layouts.app')

@section('title', 'Welcome to Air4casts Online')

@section('content')
<div id="container">
    <table width="100%" border="0"> <!-- global table -->

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
                                                <td width="25%"><a href="{{ route('home') }}">
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
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" height="350" background="{{ asset('clientconvertgraphics2016/skyplane1000.png') }}">
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
                                                                        <li> <a href="../welcome/welcomepage.php" target="_self">
                                                                                <font class="leaf">Home</font>
                                                                            </a></li>
                                                                        <li>
                                                                            <a target="_self" class="selected">
                                                                                <font class="leaf"><span class="branch">Data&nbsp;Modules &nbsp; <i class="fa fa-angle-down"></i></span></font>
                                                                            </a>
                                                                            <div class="mega-menu" aria-hidden="true" role="menu">
                                                                                <div class="nav-column air_meg_container">
                                                                                    <div class="nav-column air_mega">
                                                                                        <h3>Global</h3>
                                                                                        <ul>
                                                                                            <li id="1" role="menuitem" class="menuitem"><a target="_self" class="selected">
                                                                                                    <font class="leaf">Airports&nbsp;1500</font>
                                                                                                </a></li>
                                                                                            <li id="5" role="menuitem" class="menuitem"><a target="_self" class="selected">
                                                                                                    <font class="leaf">Terminals&nbsp;2000</font>
                                                                                                </a></li>
                                                                                            <li id="2" role="menuitem" class="menuitem"><a target="_self" class="selected">
                                                                                                    <font class="leaf">Nationalities&nbsp;1000</font>
                                                                                                </a></li>
                                                                                            <li id="3" role="menuitem" class="menuitem"><a target="_self" class="selected">
                                                                                                    <font class="leaf">Routes&nbsp;1000</font>
                                                                                                </a></li>
                                                                                            <li id="4" role="menuitem" class="menuitem"><a target="_self" class="selected">
                                                                                                    <font class="leaf">Retail&nbsp;Reach</font>
                                                                                                </a></li>
                                                                                            <li id="7" role="menuitem" class="menuitem"><a target="_self" class="selected">
                                                                                                    <font class="leaf">ACI&nbsp;x&nbsp;A4C</font>
                                                                                                </a></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="nav-column air_mega">
                                                                                        <h3>Market-Specific</h3>
                                                                                        <ul>
                                                                                            <li id="8" role="menuitem" class="menuitem"><a target="_self" class="selected">
                                                                                                    <font class="leaf">ChinaDomestic</font>
                                                                                                </a></li>
                                                                                            <li role="menuitem" class="menuitem">&nbsp;</li>
                                                                                            <li role="menuitem" class="menuitem">&nbsp;</li>
                                                                                            <li role="menuitem" class="menuitem">&nbsp;</li>
                                                                                            <li role="menuitem" class="menuitem">&nbsp;</li>
                                                                                            <li role="menuitem" class="menuitem">&nbsp;</li>
                                                                                        </ul>

                                                                                    </div>
                                                                                    <div class="nav-column air_mega">
                                                                                        <h3>Research-Based</h3>
                                                                                        <ul>
                                                                                            <li id="6" role="menuitem" class="menuitem"><a target="_self" class="selected">
                                                                                                    <font class="leaf">The Luxury Shopper</font>
                                                                                                </a></li>
                                                                                            <li role="menuitem" class="menuitem">&nbsp;</li>
                                                                                            <li role="menuitem" class="menuitem">&nbsp;</li>
                                                                                            <li role="menuitem" class="menuitem">&nbsp;</li>
                                                                                            <li role="menuitem" class="menuitem">&nbsp;</li>
                                                                                            <li role="menuitem" class="menuitem">&nbsp;</li>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="nav-column air_mega">
                                                                                        <h3>Other</h3>
                                                                                        <ul>
                                                                                            <li id="13" role="menuitem" class="menuitem"><a target="_self" class="selected">
                                                                                                    <font class="leaf">Gatewayz</font>
                                                                                                </a></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li id="9"> <a target="_self" class="selected">
                                                                                <font class="leaf">Beyond&nbsp;the&nbsp;Airport</font>
                                                                            </a></li>
                                                                        <li id="11"> <a target="_self" class="selected">
                                                                                <font class="leaf">Apps</font>
                                                                            </a></li>
                                                                    </ul>
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
                                                Site from Air4casts
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
                                                                                <td width="85%" align="left">
                                                                                    <!-- option to select -->

                                                                                    <a href="">Custom Downloads</a>

                                                                                </td>

                                                                                <td width="15%">

                                                                                    <a class="selectedcustomdownload" href="">
                                                                                        <img src="{{ asset('clientconvertgraphics2016/mailerarrowgreysm.png') }}" width="10" height="19" />
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
                                                                            <img src="{{ asset('clientconvertgraphics2016/cutomdownload320.png') }}" width="320" height="139" />
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td width="8%" align="center" valign="middle"><img src="{{ asset('clientconvertgraphics2016/homeline280.png') }}" width="11" height="280" /></td>
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


                                                                        </table>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td class="emmahelveticaa15darkgreybold">
                                                                        <table width="100%" border="0">
                                                                            <tr>
                                                                                <td width="70%">Air4casts Data Maps</td>
                                                                                <td width="30%" class="selectedjmap">
                                                                                    <a href="#"><img src="{{ asset('clientconvertgraphics2016/mailerarrowgreysm.png') }}" width="10" height="19" alt="" /></a>
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
                                                                        <a href="#" class="selectInfo"><img src="{{ asset('clientconvertgraphics2016/infographicbutton210.png') }}" width="160" height="210" /></a>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td align="left" valign="top" class="selectedjmap">
                                                                        <a href="#" id="javamaps"><img src="{{ asset('clientconvertgraphics2016/javamap240.png') }}" width="240" height="150" alt="" /></a>
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
                                            <td>
                                                <!-- Latest MAGAZINE ARTICLES -->
                                                <div id="artical_container" class="artical_container">
                                                    <div id="card-container">
                                                        <div class="artical_col_wrapper">

                                                            <div class="artical_col">
                                                                <div class="item col-first">
                                                                    <div class="article_divider">
                                                                        <div class="article_des">
                                                                            <p class="des_text">Air4casts</p>
                                                                            <p class="article_heading_text">Newscast Magazine</p>
                                                                            <p class="des_text long_text_des">Don't miss our latest data analysis articles, available to all users.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class='article_group'>
                                                                    @if ($posts->isNotEmpty())
                                                                    @php
                                                                    $row_recent = $posts->first();
                                                                    @endphp

                                                                    <div class="item col-second">
                                                                        <div class="article_img">
                                                                            <img src="{{ asset('img/' . $row_recent->post_image) }}" alt="{{ $row_recent->title }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="item col-third">
                                                                        <a class="link-txt" target="_blank" href="#">
                                                                            <div class="post-details">
                                                                                <span class="post-author">
                                                                                    @php
                                                                                    $formated_date = \Carbon\Carbon::parse($row_recent->date)->format('d F Y');
                                                                                    @endphp
                                                                                    <span class="post-date">{{ $formated_date }}</span>
                                                                                    <span class="blog-separator">|</span>
                                                                                    <span class="post-by">by <span class="author vcard">{{ $row_recent->author }}</span></span>
                                                                                </span>
                                                                                <p class="post-title">{{ $row_recent->title }}</p>
                                                                            </div>
                                                                            <div class="post-content">
                                                                                {{ substr(strip_tags($row_recent->post_desc), 0, 150) . '...' }}
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Latest MAGAZINE ARTICLES -->
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
                                                        <td align="center"><img src="{{ asset('clientconvertgraphics2016/howitworks800.png') }}" width="600" height="381" /></td>
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

@section('scripts')
<script type="text/javascript">
    $("#ClientMenu2 li").click(function() {
        var eleid = this.id;
        var getids = "<?php echo $_SESSION['kt_login_sub']; ?>";
        var getcompname = "<?php echo $_SESSION["kt_login_company_id"]; ?>";
        $('#subheadingtxt').html("");

        if (eleid == 1) {
            if (getids.indexOf(eleid) != -1) {
                sessionStorage.setItem('navText', $(this).text());
                $(".selected").attr("href", "../airports/airportshome.php");
            } else {
                $('#tabtext').html("Airports 1500");
                $('#nametxt').html("Airports 1500 is one of Air4casts’ longest running and most powerful modules.");
                $('#detailstxt').html("It presents forecasts and actuals separately for all major global airports");
                $('#airport_popUp').trigger('show');
                return false;
                //alert("You are not able to access Airport Section");
            }
        }

        if (eleid == 2) {
            if (getids.indexOf(eleid) != -1) {
                sessionStorage.setItem('navText', $(this).text());
                $(".selected").attr("href", "../nationalities/nationalitieshome.php");
            } else {
                $('#tabtext').html("Nationalities 1000");
                $('#nametxt').html("Nationalities 1000 is one of Air4casts’ largest and most powerful modules.");
                $('#detailstxt').html("It tracks departing international passengers by nationality through 840 airports with accompanying demographic data. 200 nationalities are covered");
                $('#airport_popUp').trigger('show');
                return false;

                //alert("You are not able to access Nationalities Home");
            }
        }

        if (eleid == 3) {
            if (getids.indexOf(eleid) != -1) {
                sessionStorage.setItem('navText', $(this).text());
                $(".selected").attr("href", "../routes/routeshome.php");
            } else {
                //alert("You are not able to access Routes Home");
                $('#tabtext').html("Routes 1000");
                $('#nametxt').html("Routes 1000 is one of Air4casts’ largest and most powerful modules.");
                $('#detailstxt').html("It tracks departing international passengers by destination from 940 airports and 1148 terminals and much more");
                $('#airport_popUp').trigger('show');
                return false;
            }
        }

        if (eleid == 4) {
            if (getids.indexOf(eleid) != -1) {
                sessionStorage.setItem('navText', $(this).text());
                $(".selected").attr("href", "../retailreach/retailreachhome.php");
            } else {

                $('#tabtext').html("RetailReach");
                $('#nametxt').html("RetailReach is one of Air4casts’ most interesting modules.");
                $('#detailstxt').html("It combines two unique and extensive sets of data:outlet locations for every airport retailer globally, and monthly passenger footfall forecasts one year ahead");
                $('#airport_popUp').trigger('show');
                return false;

                //alert("You are not able to access Retail Reach");
            }
        }

        if (eleid == 5) {
            if (getids.indexOf(eleid) != -1) {
                sessionStorage.setItem('navText', $(this).text());
                $(".selected").attr("href", "../terminal-forecasts/terminal-forecasts-home.php");
            } else {

                $('#tabtext').html("TERMINALS 2000");
                $('#nametxt').html("Terminals 2000 delivers passenger past and forecast numbers for the major international and domestic terminals around the world.");
                $('#detailstxt').html("");
                $('#airport_popUp').trigger('show');
                return false;
                //alert("You are not able to access Brandweb");
            }
        }

        if (eleid == 6) {
            if (getids.indexOf(eleid) != -1) {
                sessionStorage.setItem('navText', $(this).text());
                $(".selected").attr("href", "../luxshopper/luxshopperhome.php");
            } else {
                $('#tabtext').html("The Luxury Shopper");
                $('#subheadingtxt').html("");
                $('#nametxt').html("The Luxury Shopper is a multi-module package for the owners of Luxury Brands focusing on high net worth individuals from China, India, South Korea and the Middle East.");
                $('#detailstxt').html("");
                $('#airport_popUp').trigger('show');
                return false;
            }
        }
        if (eleid == 7) {
            if (getids.indexOf(eleid) != -1) {
                sessionStorage.setItem('navText', $(this).text());
                $(".selected").attr("href", "../aica4c/aica4chome.php");
            } else {
                $('#tabtext').html("ACI x A4C");
                $('#subheadingtxt').html("");
                $('#nametxt').html("ACI x A4C combines our direct access to airport passenger actuals with ACI’s to provide 2000 airports updated every day.");
                $('#detailstxt').html("");
                $('#airport_popUp').trigger('show');
                return false;
            }
        }

        // china
        if (eleid == 8) {
            // $(".selected").attr("href", "../insights/insightshome.php");
            if (getids.indexOf(eleid) != -1) {
                $(".selected").attr("href", "../insights/insightshome.php");
            } else {
                $('#chinadomesticModal').trigger('show');
                return false;
            }
        }
        // china



        if (eleid == 9) {
            if (getids.indexOf(eleid) != -1) {
                sessionStorage.setItem('navText', $(this).text());
                $(".selected").attr("href", "../beyond-the-airport/beyond-the-airport-home.php");
            } else {
                $('#tabtext').html("Beyond the Airport");
                $('#subheadingtxt').html("");
                $('#nametxt').html("Free data summaries available to all clients covering the cruise market, land and sea borders and ferries.");
                $('#detailstxt').html("");
                $('#airport_popUp').trigger('show');
                return false;
                return false;
            }
        }


        //Gatewayz
        if (eleid == 13) {
            $('#tabtext').html("Gatewayz");
            $('#subheadingtxt').html("- COMING SOON -");
            $('#nametxt').html("Gatewayz delivers passenger traffic and nationality data down to the gate level across hundreds of airports.");
            $('#detailstxt').html("");
            $('#airport_popUp').trigger('show');
            return false;
        }

        //Free Resources
        if (eleid == 14) {
            $('#tabtext').html("Beyond the Airport");
            $('#subheadingtxt').html("- COMING SOON -");
            $('#nametxt').html("Free data summaries available to all clients covering the cruise market, land and sea borders and ferries.");
            $('#detailstxt').html("");
            $('#airport_popUp').trigger('show');
            return false;
        }

        // APAC
        if (eleid == 10) {
            $(".selected").attr("href", "../APAC/APAChome.php");
            // if(getids.indexOf(eleid) != -1)
            // {
            //   $(".selected").attr("href", "../APAC/APAChome.php");
            // }
            // else{
            //   $('#chinadomesticModal').trigger('show');
            //   return false;
            // }
        }
        // APAC


        if (eleid == 11) {
            sessionStorage.setItem('navText', $(this).text());
            if (getcompname == '17') {
                $(this).find("a").attr("href", "../apps/appshomecoty.php");
            } else {
                $(this).find("a").attr("href", "../apps/appshome.php");
            }
        }


    });



    $(document).on('click', '.selectedjmap', function() {
        var getids = "<?php echo $_SESSION['kt_login_sub']; ?>";
        if (getids.indexOf("1") != -1 && getids.indexOf("2") != -1 && getids.indexOf("3") != -1) {
            $(this).find('a').attr("href", "../airportsdatamaps/airportsdatamapshome.php");
        } else {
            $('#tabtext').html("Air4casts Data Maps");
            $('#nametxt').html("Our Maps combine data from multiple data modules to give you profiles all across Travel Retail and all based in our Mapping System.");
            $('#detailstxt').html("The data maps are available to companies who take our three largest modules");
            $('#airport_popUp').trigger('show');
            return false;

            //alert("You are not able to access Javamaps");
        }

    });


    // $('.selectedcustomdownload').click(function(e)
    //$('.selectedcustomdownload').on('click', function(e)


    $(document).on('click', '.infographics_id', function() {
        var getids = "<?php echo $_SESSION['kt_login_sub']; ?>";
        var case1 = getids.indexOf("1");
        var case2 = getids.indexOf("2");
        var case3 = getids.indexOf("3");
        // alert(typeof(getids));
        var getcompname = "<?php echo $_SESSION["kt_login_company_id"]; ?>";
        // if( case1 != -1 && case2 != -1 && case3 != -1 )
        // {
        if (getcompname == "17") {
            $(this).find('a').attr("href", "../infographics/cotyinfographicsmain.php");
        } else if (getcompname == "2") {
            $(this).find('a').attr("href", "../infographics/infographicsmain.php");
        } else {
            $(this).find('a').attr("href", "../infographics/infographicsmain.php");
        }
        // }
        // else{
        // 	$('#tabtext').html("Air4casts Data Maps");
        // 	$('#nametxt').html("Our Maps combine data from multiple data modules to give you profiles all across Travel Retail and all based in our Mapping System.");
        // 	$('#detailstxt').html("The data maps are available to companies who take our three largest modules.");
        // 	$('#airport_popUp').trigger('show');
        // 	return false;

        // 	//alert("You are not able to access Javamaps");
        // }

    });
</script>

<?php if ($gdpr_st == 0) { ?>
    <script>
        //alert('hi');
        $(window).load(function() {
            $('#myModal').modal('show');
        });

        $("#ClientMenu2 li").hover(function() {
            $("#ClientMenu2 li").removeAttr("href");
        });
    </script>
<?php } else { ?>
    <script>
        // $(window).load(function(){
        // coronaModal
        // $('#coronaModal').modal('show');
        // });
    </script>
<?php } ?>
<script>
    $(document).on("click", "#gdpr_button", function() {
        var login_dspr = "<?php echo $_SESSION['kt_login_name']; ?>";
        var gdpr_login = "<?php echo $_SESSION['kt_login_id']; ?>"
        var date = new Date();
        var d = new Date();

        var month = d.getMonth() + 1;
        var day = d.getDate();

        var output = d.getFullYear() + '-' +
            (('' + month).length < 2 ? '0' : '') + month + '-' +
            (('' + day).length < 2 ? '0' : '') + day;
        // alert(output);
        var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
        //alert(time);

        //alert(login_dspr);
        $.ajax({

            type: "POST",
            url: "gdpr.php",
            data: {
                val: login_dspr,
                gdpr_date: output,
                gdpr_time: time,
                dspr_login: gdpr_login
            },
            success: function(response) {
                //alert(response);
                $('#chinaadvertmessage').modal('show');
            }
        });

    });
</script>
<script>
    //$(document).ready(function(){
    $(document).click(function() {
        //$('#myModal').hide();
        //$('.fade_out').css('opacity', '0');
    });
    //});
</script>
<script>
    $(window).load(function() {
        var advertmsgshow = <?php echo $chinaadvertmsg ?>;
        var gdprmsgbox = <?php echo $gdpr_st ?>;
        var incrmsgval = advertmsgshow + 1;
        if (gdprmsgbox == 1 && (advertmsgshow == 0 || advertmsgshow == 1 || advertmsgshow == 2)) {
            $('#chinaadvertmessage').modal('show');
        }
        // new
        $(function() {
            $("body").click(function(e) {
                var loggedinUserId = <?php echo $gdpr_login ?>;
                if (e.target.id == "findoutmoreBtn" || $(e.target).parents("#findoutmoreBtn").length) {
                    incrmsgval = 3;
                    // ajax
                    $.ajax({
                        type: 'POST',
                        url: 'advertmsgUpdate.php',
                        data: {
                            postchinauserId: loggedinUserId,
                            postincrval: incrmsgval
                        },
                        success: function(response) {
                            $('#chinaadvertmessage').modal('hide');
                        }
                    });
                    // ajax
                    console.log("findoutmoreBtn" + incrmsgval);
                } else if (e.target.id == "bookademo" || $(e.target).parents("#bookademo").length) {
                    incrmsgval = 3;
                    // ajax
                    $.ajax({
                        type: 'POST',
                        url: 'advertmsgUpdate.php',
                        data: {
                            postchinauserId: loggedinUserId,
                            postincrval: incrmsgval
                        },
                        success: function(response) {
                            $('#chinaadvertmessage').modal('hide');
                        }
                    });
                    // ajax
                } else {
                    // ajax
                    $.ajax({
                        type: 'POST',
                        url: 'advertmsgUpdate.php',
                        data: {
                            postchinauserId: loggedinUserId,
                            postincrval: incrmsgval
                        },
                        success: function(response) {
                            console.log(response);
                        }
                    });
                    // ajax
                }
            });
        })
        // new
        // $('.getclickedvalue').click(function(){ console.log("click bound to document listening for #test");
        //   var loggedinUserId = <?php //echo $gdpr_login 
                                    ?>;
        //   // ajax
        //   // $.ajax({  
        //   //   type: 'POST',  
        //   //   url: 'advertmsgUpdate.php', 
        //   //   data: { postchinauserId: loggedinUserId, postincrval: incrmsgval },
        //   //   success: function(response) {
        //   //       console.log(response);
        //   //   }
        //   // });
        //   // ajax
        // }); 
        // document click 
    });

    $(document).on('click', '.selectedcustomdownload', function(e) {
        //alert('selected');
        e.preventDefault();
        var cntryId = '<?php echo $_SESSION["kt_login_company_id"]; ?>';
        //alert(cntryId);
        var id = '<?php echo $gdpr_login ?>'; //alert(cntryId);
        var lname = '<?php echo  $_SESSION["kt_login_emailad"]; ?>';
        //alert(lname);
        if (cntryId == '29') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdowrichemont.php");
        }

        if (cntryId == '17') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdowncoty.php");
        }

        if (cntryId == '16') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdownbulgari.php");
        }

        if (cntryId == '1') {
            $(".selectedcustomdownload").attr("href", "#");
        }

        if (cntryId == '2') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdowndior.php");
        }

        if (cntryId == '3') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdowdufry.php");
        }

        if (lname == 'rozeki@estee.com' || lname == 'cvernicek@estee.com') {

            $(".selectedcustomdownload").attr("href", "../customdown/customdownlaudersen.php");
        } else if (cntryId == '4') {

            $(".selectedcustomdownload").attr("href", "../customdown/customdownlauder.php");
        } else if (cntryId == '41') {

            $(".selectedcustomdownload").attr("href", "../customdown/customdowncartier.php");
        } else {
            //alert('hi');
        }
        /*if(cntryId == '4')
        {
          //alert('hii');
          $(".selectedcustomdownload").attr("href", "../customdown/customdownlauder.php");
        }*/
        if (cntryId == '5') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdownimptob.php");
        }

        if (cntryId == '6') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdownloreal.php");
        }

        if (cntryId == '7') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdownluxottica.php");
        }

        if (cntryId == '8') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdownmoet.php");
        }

        if (cntryId == '9') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdownpmi.php");
        }

        if (cntryId == '10') {
            $(".selectedcustomdownload").attr("href", "#");
        }

        if (cntryId == '11') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdownshiseido.php");
        }
        if (lname == 'jane.yeo@tr.shiseido.com' && id == '1932') {

            $(".selectedcustomdownload").attr("href", "../customdown/customdownshiseidosen.php");
        }

        if (cntryId == '11' && id != '1932') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdownshiseido.php");
        }

        if (cntryId == '12') {
            $(".selectedcustomdownload").attr("href", "#");
        }
        if (cntryId == '15') {
            $(".selectedcustomdownload").attr("href", "#");
        }

        if (cntryId == '47') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdownchanel.php");
        }

        if (cntryId == '48') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdownpernod.php");
        }

        if (cntryId == '51') {
            $(".selectedcustomdownload").attr("href", "../customdown/customdownjti.php");
        }

        if (cntryId == '54') {
            window.open('../customdown/customdowncartierrichemont.php');
        }

    });
</script>
<script>
    var getipaddress = '<?php echo $getipaddress ?>';
    var currentIPadd = '<?php echo $currentIP ?>';
    //  OTP feature
    // if(getipaddress!=''){
    //   if(getipaddress != currentIPadd){
    //     window.location.href = "https://maintest17.air4casts.com?myval=1";
    //     // $('#myModal2').modal('show');
    //   }
    // }

    // $(document).ready(function(){
    //   $('.otpsubmit').click(function(e){
    //     e.preventDefault();
    //     var getCurrUsr = '<?php echo $currentUser ?>'; 
    //     var getCurrpasswd = '<?php echo $currentPasswd ?>'; 
    //     var getcurrentIPadd = '<?php echo $currentIP ?>';
    //     var getotpvalue = $('#otpValue').val();
    //     console.log(getotpvalue);
    //     $.ajax({  
    //       type: 'POST',  
    //       url: 'otpCheck.php', 
    //       data: { sendCurrUsr: getCurrUsr, sendCurrpasswd: getCurrpasswd, sendotpvalue: getotpvalue, sendcurrentIPadd: getcurrentIPadd},
    //       success: function(response) {
    //           console.log(response);
    //           if(response == '1'){
    //             window.location.href = "https://maintest17.air4casts.com/welcome/welcomepage.php";
    //             $('#myModal2').modal('hide');
    //           }
    //           else{
    //             $('#otpErr').css({'display':'block'});
    //             $("#otpErr").fadeOut(3000);
    //           }
    //       }
    //     });
    //   });
    // });
</script>
<script type="text/javascript">
    $(".ris_customdownload").on("click", function(e) {
        var getid = "<?php echo $_SESSION['kt_login_id']; ?>";
        var custom_download_url = "<?php echo $redirectUrl; ?>";
        $.ajax({
            type: "POST",
            url: "customdownload_restriction_alertbox.php",
            data: {
                data: getid
            },
            success: function(data) {
                if (data != 0 && data == 1) {
                    window.location.href = custom_download_url;
                } else {
                    $('#ris_custom_popUp').trigger('show');
                }
            }
        });
    });


    $(".cls_recovery_popup").on("click", function(e) {
        $('#recovery_popup_modal').trigger('show');
    });
</script>
@endsection