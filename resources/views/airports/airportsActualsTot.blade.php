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
            <td align="center" class="emmahelveticaa26darkgrey">
    Latest Actual Total Data | {{ count($aportDrop) }} Leading World Airports
</td>
            </tr>
			  <tr>
				<td align="center" class="emmahelveticaa18darkgreylight">Arriving plus departing passengers</td>
            </tr>
            <tr>
              <!-- <td align="center" class="emmahelveticaa18darkgreylight">Data is sourced from airports' web sites, from national bodies and from both ACI and ICAO.</td> -->
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
  <td align="center" class="emmahelveticaa16darkgreylight">This update: {{ $thisupdateYr }}</td>
</tr>
<tr>
  <td align="center" class="emmahelveticaa16darkgreylight">Next update: {{ $nxtupdateYr }}</td>
</tr>

            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
<td>


<div class="section group">
    <div class="col span_1_of_3 emmahelveticaa17darkgreylight">
        <h2>{{ $latestList[0]->dlup_fullmontxt ?? 'N/A' }} Data</h2>
        {{ count($latestList ?? []) }} Airports
    </div>
    
    <div class="col span_1_of_3 emmahelveticaa17darkgreylight">
        <h2>{{ isset($latestList2[0]) ? $latestList2[0]->dlup_fullmontxt : 'No Data' }} Data</h2>
        {{ count($latestList2 ?? []) }} Airports
    </div>

    <div class="col span_1_of_3 emmahelveticaa17darkgreylight">
        <h2>{{ isset($latestList3Head[0]) ? $latestList3Head[0]->dlup_fullmontxt : 'No Data' }} Data</h2>
        {{ count($latestList3Head ?? []) }} Airports
    </div>
</div>

                          <div class="section group">

                        <form action="#" method="post" name="form1" class="formtest" id="form3">

                          <div class="col span_1_of_3">

                          <select name="searchAPID" size= "25" class="a-10-b-listmenu160bl select_box" id="searchAPID">
                          <select name="searchAPID" size="25" class="a-10-b-listmenu160bl select_box" id="searchAPID">
    @foreach ($latestList as $item)
        <option value="{{ $item->jracode }}">{{ $item->aport_apref }}</option>
    @endforeach
</select>

                          </select>
                          <label>
                          
 <button type="submit" name="submit" class="btn_grey">Submit <i class="fa fa-angle-right" aria-hidden="true">&nbsp;</i></button>
                          
                          </label>

                        </div>
                      </form>




<form action="#" method="post" name="form2" class="formtest" id="form4">

<div class="col span_1_of_3">
<select name="searchAPID" size="25" class="a-10-b-listmenu160bl select_box" id="searchAPID">
    @foreach ($latestList2 as $item)
        <option value="{{ $item->jracode }}">{{ $item->aport_apref }}</option>
    @endforeach
</select>

  <button type="submit" name="submit" class="btn_grey">Submit <i class="fa fa-angle-right" aria-hidden="true">&nbsp;</i></button>
</div>
</form>



<form action="#" method="post" name="form2" class="formtest" id="form4">

  <div class="col span_1_of_3">
  <select name="searchAPID" size="25" class="a-10-b-listmenu160bl select_box" id="searchAPID">
  <?php
do {  
?>
                                                          <option value="<?php echo $row_rst_latest_list3['jracode']?>"><?php echo $row_rst_latest_list3['aport_apref']?></option>
                                                          <?php
} while ($row_rst_latest_list3 = mysqli_fetch_assoc($rst_latest_list3));
  $rows = mysqli_num_rows($rst_latest_list3);
  if($rows > 0) {
      mysqli_data_seek($rst_latest_list3, 0);
    $row_rst_latest_list3 = mysqli_fetch_assoc($rst_latest_list3);
  }
?>
 </select>
 <label>
<button type="submit" name="submit" class="btn_grey">Submit <i class="fa fa-angle-right" aria-hidden="true">&nbsp;</i></button>
  </div>
</form>
</div>


</td>
            </tr>
            
            <tr>
              <td align="center">&nbsp;</td> 
            </tr>
            <tr>
              <td align="center">&nbsp;</td> 
            </tr>
            <tr>
              <td align="center">&nbsp;</td> 
            </tr>

			<script type="text/javascript">
                $(document).ready(function(){
                    var airNameVal = $("#searchAPID option").first().val();
                     document.cookie = "cookieName="+airNameVal;				 
                });
			</script>

            <tr>
              <td align="center" class="emmahelveticaa26darkgrey"><?php echo $row_rst_latest_aport['aport_apref']; ?>; <?php echo $row_rst_latest_aport['jracode']; ?> | Latest Total Passenger Actuals</td>
            </tr>
			  <tr>
				<td align="center" class="emmahelveticaa18darkgreylight">Arriving plus departing passengers</td>
            </tr>
            <tr>
              <!-- <td align="center" class="emmahelveticaa18darkgreylight">Data is sourced from airports' web sites, from national bodies and from both ACI and ICAO.</td> -->
            </tr>
            
            <tr>
              <td>
              	<div class="mlr_6_per">
              	@if ($airportStats)
    <table class="table_ip_actual">
        <thead>
            <tr bgcolor="#3a618a">
                <td>&nbsp;</td>
                <td>{{ $airportStats->dlup_fullmontxt }}</td>
                <td>Year to Date</td>
                <td>Rolling 12 Month</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Change %</td>
                <td>{{ number_format($airportStats->paxchange, 1, '.', ',') }}%</td>
                <td>{{ number_format($airportStats->pax_chytd, 1, '.', ',') }}%</td>
                <td>{{ number_format($airportStats->roll_ch, 1, '.', ',') }}%</td>
            </tr>
            <tr>
                <td>Pax 000</td>
                <td>{{ number_format($airportStats->pax, 0, '.', ',') }}</td>
                <td>{{ number_format($airportStats->pax_ytd, 0, '.', ',') }}</td>
                <td>{{ number_format($airportStats->roll_thisyr, 0, '.', ',') }}</td>
            </tr>
        </tbody>
    </table>
@endif

                </div>
              </td> 
            </tr>
            
            <tr>
            	<td>
                	<div class="mlr_6_per">
                        <div class="emmahelveticaa15darkgreylight" style="float:left;"><?php echo $row_rst_onsystem['entdate']; ?></div>
                        <div class="emmahelveticaa15darkgreylight" style="float:right;">Source: <?php echo $row_rst_websource['websource']; ?></div>
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
            	<td>
                	<div class="mlr_6_per">
                        <div class="emmahelveticaa18darkgreylight" style="text-align:center;">Last 12 Months Pax Changes | <?php echo $row_rst_latest_aport['dlup_fullmontxt']; ?> <?php echo $row_rst_latest_aport['dlup_year']; ?></div>
                        <div class="row">
                        	<div class="wd_50">
                            	<table class="table_ip_actual">
                                    <thead>
                                        <tr bgcolor="#3a618a">
                                          <td>&nbsp;</td>
                                          <td>Year</td>
                                          <td>Month</td>
                                          <td>% changes</td>
                                        </tr>
                                    </thead>
                                  <tbody>
                                     
                                      <?php do { ?>
                                                  <tr >
                                                  <td>&nbsp;</td>
                                                    <td><?php echo $row_rst_latest12['dlup_year']; ?></td>
                                                    <td ><?php echo $row_rst_latest12['dlup_monthtxt']; ?></td>
                                                    <td ><?php echo number_format($row_rst_latest12['fc_change'],1,'.',','); ?></td>
                                                    </tr>
                                                  <?php } while ($row_rst_latest12 = mysqli_fetch_assoc($rst_latest12)); ?>
                                    
                                  </tbody> 
                                </table>
                            </div>
                            <div class="wd_50"><?php require_once('../amcharts/latest_apgraph_amcharts.php');?></div>
                        </div>                        
                    </div>
                </td> 
            </tr>
             <tr>
            	<td>&nbsp;</td>
            </tr>
            <tr>
            	<td>
                	<div class="mlr_6_per">
                        <div class="emmahelveticaa18darkgreylight" style="text-align:center;">Last 12 Months Pax Numbers | <?php echo $row_rst_latest_aport['dlup_fullmontxt']; ?> <?php echo $row_rst_latest_aport['dlup_year']; ?></div>
                        <div class="row">
                        	<div class="wd_50">
                            	<table class="table_ip_actual">
                                    <thead>
                                        <tr bgcolor="#3a618a">
                                          <td>&nbsp;</td>
                                          <td>Year</td>
                                          <td>Month</td>
                                          <td>pax number</td>
                                        </tr>
                                    </thead>
                                  <tbody>
                                      <?php do { ?>
                                                 
                                                  <tr>
                                                   <td>&nbsp;</td>
                                                    <td><?php echo $row_rst_latest12pax['dlup_year']; ?></td>
                                                    <td ><?php echo $row_rst_latest12pax['dlup_monthtxt']; ?></td>
                                                    <td ><?php echo number_format($row_rst_latest12pax['fc'],0,'.',','); ?></td>
                                                    </tr>
                                                  <?php } while ($row_rst_latest12pax = mysqli_fetch_assoc($rst_latest12pax)); ?>
                                  </tbody>
                                </table>
                            </div>
                            <div class="wd_50"><?php require_once('../amcharts/latest_apanngraphint280_new.php');?></div>
                        </div>                        
                    </div>
                </td>
            </tr>
            <tr>
            	<td>&nbsp;</td>
            </tr>
            <tr>
            	<td>
              <style>
                 .button_export{
                  background:url(csvpages/airportactuals_lot_csv.php) center no-repeat; border:0; height:28px; width: 40px; background-size: 100%; float:right; margin: 0;font-size: 0px;position: relative;
                  left: -22px;
                  top: -4px;
                  bottom: 1px;
                  outline:none;
                 }
                 </style>
                	<div class="mlr_6_per">
                        <div class="emmahelveticaa18darkgreylight" style="text-align:center;">Actual Data for the Last Two Years</div>
                        <div class="row">
                        	<div class="wd_50">
                            	<div class="dwn_sprd_btn">
                                    <p>Click the Button below to download the last 24 months data which will be opened directly by your spreadsheet software:</p>
                                    <p><a href="#"><i class="fa fa-angle-down" aria-hidden="true"></i></a></p>
                                </div>
                            </div>
                            <div class="wd_50"> <?php require_once ('../amcharts/lastest_apgraph_line_amcharts.php');?></div>
                        </div>                        
                    </div>
                </td>
            </tr>

            <tr>
              <td align="center" class="emmahelveticaa26darkgrey"><?php echo $row_rst_latest_aport['aport_apref']; ?>; <?php echo $row_rst_latest_aport['jracode']; ?> | Latest Total Passenger Actuals</td>
            </tr>
			  <tr>
				<td align="center" class="emmahelveticaa18darkgreylight">Arriving plus departing passengers</td>
            </tr>
            <tr>
              <!-- <td align="center" class="emmahelveticaa18darkgreylight">Data is sourced from airports' web sites, from national bodies and from both ACI and ICAO.</td> -->
            </tr>
            
            <tr>
              <td>
                <div class="mlr_6_per">
                <table class="table_ip_actual">
                  <thead>
                      <tr bgcolor="#3a618a">
                          <td>&nbsp;</td> 
                          <td><?php echo $row_rst_latest_aport['dlup_fullmontxt']; ?></td>
                          <td>Year to Date</td>
                          <td>Rolling 12 Month</td>
                        </tr>
                    </thead>
                  <tbody>
                    <tr>
                      <td>Change %</td>
                  <td ><?php echo number_format($row_rst_latest_aport['paxchange'],1,'.',','); ?>%</td>
                                      <td ><?php echo number_format($row_rst_ytd['pax_chytd'],1,'.',','); ?>%</td>
                                      <td ><?php echo number_format($row_rst_ytd['roll_ch'],1,'.',','); ?>%</td>
                    </tr>
                    <tr>
                      <td>Pax 000</td>
                      <td ><?php echo number_format($row_rst_latest_aport['pax'],0,'.',','); ?></td>
                      <td ><?php echo number_format($row_rst_ytd['pax_ytd'],0,'.',','); ?></td>
                      <td ><?php echo number_format($row_rst_ytd['roll_thisyr'],0,'.',','); ?></td>
                    </tr>
                  </tbody>
                </table>
                </div>
              </td> 
            </tr>
            
            <tr>
              <td>
                  <div class="mlr_6_per">
                        <div class="emmahelveticaa15darkgreylight" style="float:left;"><?php echo $row_rst_onsystem['entdate']; ?></div>
                        <div class="emmahelveticaa15darkgreylight" style="float:right;">Source: <?php echo $row_rst_websource['websource']; ?></div>
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
              <td>
                  <div class="mlr_6_per">
                        <div class="emmahelveticaa18darkgreylight" style="text-align:center;">Last 12 Months Pax Changes | <?php echo $row_rst_latest_aport['dlup_fullmontxt']; ?> <?php echo $row_rst_latest_aport['dlup_year']; ?></div>
                        <div class="row">
                          <div class="wd_50">
                              <table class="table_ip_actual">
                                    <thead>
                                        <tr bgcolor="#3a618a">
                                          <td>Year</td>
                                          <td>Month</td>
                                          <td>% change</td>
                                        </tr>
                                    </thead>
                                  <tbody>
                                     
                                      <?php do { ?>
                                                  <tr >
                                                    <td><?php echo $row_rst_latest12['dlup_year']; ?></td>
                                                    <td ><?php echo $row_rst_latest12['dlup_monthtxt']; ?></td>
                                                    <td ><?php echo number_format($row_rst_latest12['fc_change'],1,'.',','); ?></td>
                                                    </tr>
                                                  <?php } while ($row_rst_latest12 = mysqli_fetch_assoc($rst_latest12)); ?>
                                    
                                  </tbody>
                                </table>
                            </div>
                            <div class="wd_50"><?php require_once('../amcharts/latest_apgraph_amcharts.php');?></div>
                        </div>                        
                    </div>
                </td> 
            </tr>
            <tr>
            	<td>&nbsp;</td>
            </tr>
            <tr>
              <td>
                  <div class="mlr_6_per">
                        <div class="emmahelveticaa18darkgreylight" style="text-align:center;">Last 12 Months Pax Numbers | <?php echo $row_rst_latest_aport['dlup_fullmontxt']; ?> <?php echo $row_rst_latest_aport['dlup_year']; ?></div>
                        <div class="row">
                          <div class="wd_50"> 
                              <table class="table_ip_actual">
                                    <thead>
                                        <tr bgcolor="#3a618a">
                                          <td>Year</td>
                                          <td>Month</td>
                                          <td>pax number</td>
                                        </tr>
                                    </thead>
                                  <tbody>
                                      <?php do { ?>
                                                 
                                                  <tr>
                                                    <td><?php echo $row_rst_latest12pax['dlup_year']; ?></td>
                                                    <td ><?php echo $row_rst_latest12pax['dlup_monthtxt']; ?></td>
                                                    <td ><?php echo number_format($row_rst_latest12pax['fc'],0,'.',','); ?></td>
                                                    </tr>
                                                  <?php } while ($row_rst_latest12pax = mysqli_fetch_assoc($rst_latest12pax)); ?>
                                  </tbody>
                                </table>
                            </div>
                            <div class="wd_50"><?php require_once('../amcharts/latest_apanngraphint280_new.php');?></div>
                        </div>                        
                    </div>
                </td>
            </tr>
            <tr>
            	<td>&nbsp;</td>
            </tr>
            <tr>
              <td>
                 <style>
                 .button_export{
                  background:url(csvpages/airportactuals_lot_csv.php) center no-repeat; border:0; height:28px; width: 40px; background-size: 100%; float:right; margin: 0;font-size: 0px;position: relative;
                  left: -22px;
                  top: -4px;
                  bottom: 1px;
                  outline:none;
                 }
                 </style>
                  <div class="mlr_6_per">
                        <div class="emmahelveticaa18darkgreylight" style="text-align:center;">Actual Data for the Last Two Years</div>
                        <div class="row">
                          <div class="wd_50">
                              <div class="dwn_sprd_btn">
                                    <p>Click the Button below to download the last 24 months data which will be opened directly by your spreadsheet software:</p>
                                    <p><a href="#"><i class="fa fa-angle-down" aria-hidden="true"></i></a></p>
                                </div>
                                <!-- <form class="dwn_sprd_btn" id="formdown1" name="formdown1" method="post" action="csvpages/airportactuals_lot_csv.php">
                                        <i class="fa fa-angle-down" aria-hidden="true"><input name="export" type="submit" id="export" class="button_export" aria-hidden="true" 
                        /> </i> -->
                                
                                <!-- <input name="export" value="^" type="submit" class="whit_btn" id="export" 
                                          style="background:url(csvpages/airportactuals_lot_csv.php) center no-repeat; border:0; height:28px; width: 40px; background-size: 100%; float:right; margin: 0;" /> -->
                                <!-- </form> -->
                            </div>
                            <div class="wd_50"> <?php require_once ('../amcharts/lastest_apgraph_line_amcharts.php');?></div>
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
                       <!-- <form class="dwn_sprd_btn" id="formdown1" name="formdown1" method="post" action="csvpages/airportactuals_lot_csv.php">
                                        <i class="fa fa-angle-down" aria-hidden="true"><input name="export" type="submit" id="export" class="button_export" aria-hidden="true" 
                        /> </i> -->
                      	<form id="formdown1" name="formdown1" method="post" action="csvpages/airportactuals_lot_csv.php">
                              <!--  <input name="export" type="submit" class="whit_btn" id="export" value="Spreadsheet Download" /> -->
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
                    @include('include.footer')
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
@endsection

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Column 1</th>
            <th>Column 2</th>
            <!-- Add more columns as needed -->
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->jracode }}</td>
                <td>{{ $row->dlup }}</td>
                <!-- Match columns from your actual table -->
            </tr>
        @endforeach
    </tbody>
</table>
