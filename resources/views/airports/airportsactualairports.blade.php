@extends('layouts.app')

@section('content')
<div id="container">
<table width="100%" border="0"> <!-- global table -->
  <tr>
	  <td>
      @include('includes.header')
	  </td>
  </tr>
  <tr>
    <td><table width="100%" border="0" bgcolor="#F1F1F1"> <!-- central elastic table -->
      <tr>
        <td valign="top"><div align="center">
          <table width="1000" border="0" bgcolor="#FFFFFF">
            <tr>
              <td><table width="100%" height="350" background="../clientconvertgraphics2016/skyplane1000.png">
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
                  <td><table width="100%" border="0">
                    <tr>
                      <td>&nbsp;</td>
                      <td width="97%" class="emmahelveticaa25whitebold">Airport Actuals and</td>
                    </tr>
                    <tr>
                      <td width="3%">&nbsp;</td>
                      <td class="emmahelveticaa25whitebold">Forecasts</td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="10">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <!-- central fixed table -->
            <tr>
              <td><table width="100%" border="0">
                <tr>
                  <td valign="middle">
                  		<div id="AirportsMenuSimple_container" class="FM2_AirportsMenuSimple_container" style="display:block">
                            <ul id="AirportsMenuSimple" class="FM2_AirportsMenuSimple">
							  <!-- version=@@buildNumber@@;name=AirportEmmaMenu;baseskin=skin08;colorscheme=dark_blue;type=tabbed; -->
							  <li> <a href="airportshome.php" target="_self"><font class="leaf">Airports&nbsp;Home</font></a></li>
							  <li> <a href="airportsactualairports.php" target="_self"><span class="branch">Airports </span></a>
								<!-- <ul>
								  <li> <a href="airportsactualairports.php" target="_self"><font class="leaf">Airports</font></a></li>
								  <li> <a href="airportsactualsairl.php" target="_self"><font class="leaf">Airlines</font></a></li>
								</ul> -->
							  </li>
							  <li> <a href="#" target="_self"><span class="branch">Recovery Forecasts <i class="fa fa-angle-down"></i></span></a>
								<ul>
								  <li> <a href="airportsforecasts.php" target="_self"><font class="leaf">One at a Time</font></a></li>
								  <li> <a href="airportforecasts_multiselector.php" target="_self"><font class="leaf">Multi-Selectors</font></a></li>
								</ul>
							  </li>
							</ul>
                            <script type="text/javascript">registerFlexiCSSMenu("AirportsMenuSimple", {"menuType":"tabbed","effectSub":{"name":"slide","direction":"up","duration":250,"easing":"swing","useFade":true},"effectRest":{"name":"slide","direction":"up","duration":250,"easing":"swing","useFade":true},"effectSubTwo":{"name":"slide","direction":"left","duration":250,"easing":"swing","useFade":true},"options":{"preset":"fixed","enableTablet":false,"enableMobile":false,"mobileMaxWidth":640,"tabletMaxWidth":1023,"tabletCloseBtnLabel":"Close","tabletCloseBtnEnable":false,"align":"center"}});
                          </script>
                    </div>
                  </td>
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
              <td align="center" class="emmahelveticaa26darkgrey">Airport Actuals Data</td>
            </tr>
            <tr>
              <td height="10" align="center" class="emmahelveticaa18darkgreylight"></td>
            </tr>
            <tr>
              <td align="center" class="emmahelveticaa18darkgreylight"><table width="100%" border="0">
                <tr>
                  <td width="3%">&nbsp;</td>
                  <td width="94%" align="center" class="emmahelveticaa16darkgreylight">Use this section to select to get actual data for airports. You can select one at a time, or many if you need larger data extractions. For individual airports, you can look at international and total data on separate pages.</td>
                  <td width="3%">&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>

            <tr>
			  <td><div class="grey_container">
				  <p class="emmahelveticaa22darkgrey">Airport Selection</p>

				  <div class="nati_form_container nati_form_container_new">
				  	<p class="emmahelveticaa20darkgrey">Airport Actuals | Which is the latest month?</p>
				  	<p class="emmahelveticaa16darkgrey" style="margin: 10px 0;">Are you looking at an airport and wondering: what is their latest month for air passengers actuals? Use this tool to find out! </p>
					<form id="form5" name="form4" method="post" action="airportsactuallatmonth.php">
					  <div class="form_colmn">
						<div class="form_field">
						  <button name="form_term_multiple" type="submit" class="headsubmitgrey" value="form_term_multiple">Submit <i class="fa fa-angle-right"></i></button>
						</div>
					  </div>
					</form>
				  </div>

				  <div class="nati_form_container nati_form_container_new nati_form_container_bord">
				  	<p class="emmahelveticaa20darkgrey">Latest Airport Actuals | International</p>
				  	<p class="emmahelveticaa16darkgrey">Select an airport from lists sorted by the latest month’s actuals declared and get actual summaries for the last 12 months.</p>
					<form id="form5" name="form4" method="post" action="airportsactualsint.php">
					  <div class="form_colmn">
						<div class="form_field">
						  <button name="form_term_multiple" type="submit" class="headsubmitgrey" value="form_term_multiple">Submit <i class="fa fa-angle-right"></i></button>
						</div>
					  </div>
					</form>
				  </div>

				  <div class="nati_form_container nati_form_container_new nati_form_container_bord">
				  	<p class="emmahelveticaa20darkgrey">Latest Airport Actuals | Total</p>
				  	<p class="emmahelveticaa16darkgrey">Select an airport from lists sorted by the latest month’s actuals declared and get actual summaries for the last 12 months.</p>
					<form id="form5" name="form4" method="post" action="airportsactualstot.php">
					  <div class="form_colmn">
						<div class="form_field">
						  <button name="form_term_multiple" type="submit" class="headsubmitgrey" value="form_term_multiple">Submit <i class="fa fa-angle-right"></i></button>
						</div>
					  </div>
					</form>
				  </div>
				</div></td>
			</tr>

            <tr>
			  <td><div class="grey_container">
				  <p class="emmahelveticaa22darkgrey">Airport Actuals | Multi-Selector</p>
				  <p class="emmahelveticaa16darkgrey">Use this selector to choose multiple airports and years for actual data and download them.</p>
				  <div class="nati_form_container nati_form_container_new">
					<form id="form5" name="form4" method="post" action="airportsactualairportsmulti.php">
					  <div class="form_colmn">
						<div class="form_field">
						  <button name="form_term_multiple" type="submit" class="headsubmitgrey" value="form_term_multiple">Submit <i class="fa fa-angle-right"></i></button>
						</div>
					  </div>
					</form>
				  </div>
				</div></td>
			</tr>

            <tr>
			  <td><div class="grey_container">
				  <p class="emmahelveticaa22darkgrey">Airport Actuals by Country | Multi-Selector</p>
				  <p class="emmahelveticaa16darkgrey">Use this selector to choose a country and see all airports within, and then multiple years for actual data and download them.</p>
				  <div class="nati_form_container nati_form_container_new">
					<form id="form5" name="form4" method="post" action="airportsactualairportscountrymulti.php">
					  <div class="form_colmn">
						<div class="form_field">
						  <button name="form_term_multiple" type="submit" class="headsubmitgrey" value="form_term_multiple">Submit <i class="fa fa-angle-right"></i></button>
						</div>
					  </div>
					</form>
				  </div>
				</div></td>
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
            </table>
        </div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" bgcolor="#E1E1E1"> <!-- footer elastic table -->
      <tr>
        <td><div align="center">
          <table width="1000" border="0"> <!-- footer fixed table -->
            <tr>
              <td><table width="100%" border="0" bgcolor="#54545E"> <!-- footer extra fixed table -->
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
                </table></td>
            </tr>
          </table>
        </div></td>
        </tr>
      </table></td>
  </tr>
</table>
<!-- end #container --></div>
@endsection