<?php require_once('../Connections/conn_333mysql.php'); ?><?php
   require_once('../Connections/conn_33mysql.php'); 
   require_once('../Connections/conn_409mysql.php');
   // Load the tNG classes
   require_once('../includes/tng/tNG.inc.php');
   // Make unified connection variable
   $conn_conn_33mysql = new KT_connection($conn_33mysql,$database_conn_33mysql);
   //Start Restrict Access To Page
   $restrict = new tNG_RestrictAccess($conn_conn_33mysql, "../");
   //Grand Levels: Any
   $restrict->Execute();
   //End Restrict Access To Page   
    require_once('../includes/common/hitcounter_a4c_functions.php');


   mysqli_select_db($conn_409mysql,$database_conn_409mysql);

   // gettermcode
      $gettermcodeval = "SELECT * FROM `tfc_data` LEFT JOIN tfc_termlup on tfc_termlup.code = tfc_data.termcode WHERE tfc_data.year = '2015' ORDER BY tfc_data.termcode ASC LIMIT 1";
      mysqli_query($conn_409mysql,$gettermcodeval) or die(mysqli_error($conn_409mysql)); 
      $resgettermcodeval = $conn_409mysql->query($gettermcodeval); 
      $rowgettermcodeval = $resgettermcodeval->fetch_assoc();
      $finalgettermcodeval = $rowgettermcodeval['termcode'];
      $finalapnameval = $rowgettermcodeval['aport'];
      $mergevalues = $rowgettermcodeval['aport'].' '.$rowgettermcodeval['termcode'];

      $_SESSION['sess_terminal_sel']=$rowgettermcodeval['termcode'];

      //$terminalalldata = "SELECT *, dlup.dlup_monthtxt FROM `tfc_data` LEFT JOIN dlup ON dlup.id_dlup = tfc_data.dlup WHERE `termcode`='$finalgettermcodeval' ORDER BY `id` DESC";
      $terminalalldata = "SELECT *, dlup.dlup_monthtxt FROM `tfc_data`  LEFT JOIN dlup ON dlup.id_dlup = tfc_data.dlup WHERE  tfc_data.termcode ='$finalgettermcodeval' AND tfc_data.year > '2014' Group By tfc_data.dlup, tfc_data.dno ORDER BY tfc_data.dlup ASC";
      mysqli_query($conn_409mysql,$terminalalldata) or die(mysqli_error($conn_409mysql)); 
      $rst_terminal = $conn_409mysql->query($terminalalldata); 



   // millenials
      $getterminalpass="SELECT DISTINCT(termcode) FROM `tfc_data`";
      mysqli_query($conn_409mysql,$getterminalpass) or die(mysqli_error($conn_409mysql)); 
      $resultterminalpass = $conn_409mysql->query($getterminalpass); 
      $terminalarray=[];
      if ($resultterminalpass->num_rows > 0) {
         while($rowterminalcount = $resultterminalpass->fetch_assoc()) {
            $terminalcount = $rowterminalcount["termcode"]; 
            array_push($terminalarray,$terminalcount);
         }
      }
      $implodeterminalvalue=implode(',',$terminalarray); 
   // millenials

   $query_rst_top500airport = "SELECT * FROM tfc_termlup WHERE FIND_IN_SET(termcode, '$implodeterminalvalue') ORDER BY termcode ASC";
      $rst_airport = mysqli_query($conn_409mysql,$query_rst_top500airport);
      while($row = mysqli_fetch_assoc($rst_airport))
      {
         $data[] = $row['aport'].' ; '.$row['termcode'];
      }
      $encodeddata = json_encode($data); 


         $res = mysqli_query($conn_409mysql,$terminalalldata);
         $arr = [];
         while($row = mysqli_fetch_assoc($res))
         {
            $arr[$row['termcode']] [$row['year']] [$row['dlup'].'-'.$row['dlup_monthtxt']][$row['dno']] = $row['pax'];
         }

         $arrValArr = [];
         $arrIntTerminalData = [];
         $arrDomTerminalData = [];
         $arrTotTerminalData = [];
         foreach($arr as $key =>$val){
            //echo "<pre>"; print_r($val);
            foreach($val as $keyA =>$valA){
            //echo "<pre>"; print_r($valA);
             foreach($valA as $keyB =>$valB){
               $arrMonth = explode("-",$keyB);
               $arrVal = array(
                     'termcode' => $key,
                     'year' => $keyA,
                     'dlup' => $keyB,
                     'month' => $arrMonth['1'],
                     'int'  => $valB['3'],
                     'dom'  => $valB['4'],
                     'tot'  => $valB['5']
               );

               $monthVal = date("m", strtotime($arrMonth['1']));
               $monthName = date("F", strtotime($arrMonth['1']));
               $a = ($arrMonth['1'] == 'Jan') ? $keyA : '';
               $monthWithyear = $monthName.' '.$a;
               $arrAllTerminal= array(
                     'mon' => $arrMonth['1'].' '.$keyA,
                     'month' =>  $monthWithyear,
                     'int_prop'  => $valB['3'],
                     'dom_prop'  => $valB['4'],
                     'tot_prop'  => $valB['5'],
                     'date'  => $keyA.'-'.$monthVal,
                     'year' => (string) $keyA
               );
               $arrIntTerminal= array(
                     'mon' => $arrMonth['1'].' '.$keyA,
                     'month' =>  $monthWithyear,
                     'prop'  => $valB['3'],
                     'date'  => $keyA.'-'.$monthVal,
                     'year' => (string) $keyA
               );
               $arrDomTerminal = array(
                     'mon' => $arrMonth['1'].' '.$keyA,
                     'month' =>  $monthWithyear,
                     'prop'  => $valB['4'],
                     'date'  => $keyA.'-'.$monthVal,
                     'year' => (string) $keyA
               );
               $arrTotTerminal = array(
                     'mon' => $arrMonth['1'],
                     'prop'  => $valB['3'],
                     'year' => $keyA
               );

               $arrValArr[] = $arrVal;
                $arrAllTerminalData[] = $arrAllTerminal;
               $arrIntTerminalData[] = $arrIntTerminal;
               $arrDomTerminalData[] = $arrDomTerminal;
               $arrTotTerminalData[] = $arrTotTerminal;
               }
            }
         }



   ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <link href="../style/bootstrap.min.css" rel="stylesheet" type="text/css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="../ElasticSlideshow/css/demo.css" />
      <link href="http://subnews.air4casts.com/style/a4clinks.css" rel="stylesheet" type="text/css" />
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>Terminal by Terminal</title>
      
      <link href="../style/a4cnew.css" rel="stylesheet" type="text/css" />
      <!-- New Sytle for div -->
      <link href="../style/a4csytle_new.css" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
      <link href="../style/a4clinks.css" rel="stylesheet" type="text/css" />
      <link href="../style/tablestylegreyhover550.css" rel="stylesheet" type="text/css" />
      <link href="../style/tablestylegreyhoversmallnohead.css" rel="stylesheet" type="text/css" />
      <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css' />
      <script type="text/javascript" src="../includes/extendjQuery.js"></script>
      <script type="text/javascript" src="../includes/FlexiMenus2/fleximenus2.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link href="../includes/FlexiMenus2/CSSMenu_ClientMenu2.css" rel="stylesheet" type="text/css" />
      <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css' />
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800' rel='stylesheet' type='text/css' />
      <link href="../includes/FlexiMenus2/CSSMenu_RoutesMenu.css" rel="stylesheet" type="text/css" />
      <link href="../style/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
       <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <link href="css/custom.css?v=<?php echo date('h')?>" rel="stylesheet" type="text/css" />
      <link href="css/terminal-custom.css?v=<?php echo date('h')?>" rel="stylesheet" type="text/css" />
      <style>
         .ternimal_data_opt {
    margin: 0px !important;
    width: 27px;
    vertical-align: text-bottom;
    }
    .chart_selector_div {
    align-items: center;
    text-align: center;
    border: solid 1px;
    padding-top: 2px;
    padding-bottom: 2px;
    margin-left: 7px;
    margin-right: 7px;
}
      </style>
      
   </head>
   <body class="oneColElsCtr">
      <div id="container">
         <table width="100%" border="0">
            <!-- global table -->
            <tr>
               <td>
                  <!-- //Header go here -->
                  <?php include('../header.php'); ?> 
                  <!--Header End here-->
               </td>
            </tr>
            <tr>
               <td>
                  <table width="100%" border="0" bgcolor="#F1F1F1">
                     <!-- central elastic table  ../clientconvertgraphics2016/A4CChinaDomesticHeader.jpeg-->
                                 <?php include('common/commonnav.php'); ?>
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
                                             <td align="center" class="emmahelveticaa16darkgreybold">Choose One Terminal at a Time</td>
                                             <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                             <td height="10"></td>
                                             <td height="10"></td>
                                             <td height="10"></td>
                                          </tr>
                                          <tr>
                                             <td>&nbsp;</td>
                                             <td align="center" class="emmahelveticaa15darkgreylight">Select one terminal at a time and see full data for multiple years by month in table and graph format and
use your download button to pull it down to Excel.</td>
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
                                 
<!-- added -->
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
                                             <form action ="" id="consumernameget" name="airport" method="post">
                                                <input type="text" id="selinfog" name="selinfog" placeholder="Type a terminal code" />
                                                <button class="getairportname"><img src="../clientconvertgraphics2016/ic_arrow_right.png" /></button>
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
                                    <td>&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td>&nbsp;</td>
                                 </tr>
                                 <tr>
                                    <td align="center" class="emmahelveticaa26darkgrey" id="hiddenconsumervalue"><?php echo $mergevalues ?>  | Terminal Pax Numbers</td>
                                 </tr>
                                 <tr>
                                    <td align="center" class="emmahelveticaa17darkgreylight" style="padding:0 6%;">
                                       <p>Arriving + Departing</p>
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

                                                <?php  
            
                                                   foreach($arrValArr as $resKey => $rst_natinality){
                                                   ?>  
                                                <tr class="emmahelveticaa14darkgreylight">

                                                   <td><?php echo $rst_natinality['year'] ?></td>
                                                   <td><?php echo $rst_natinality['month'] ?></td>
                                                   <td><?php echo $rst_natinality['int'] ?></td>
                                                   <td><?php echo $rst_natinality['dom'] ?></td>
                                                   <td><?php echo $rst_natinality['tot'] ?></td>
                                                </tr>
                                                <?php }
                                                ?>
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


<!-- added end  -->
                                 <tr>
                                    <td>&nbsp;</td>
                                 </tr>
                                 <tr>
              <td><table width="100%" border="0">
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
                            <td class="emmahelveticaa15darkgreylight">By clicking on the button below you will be able to download the selected airport directly to your spreadsheet software</td>
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
                              <form id="formdown1" name="formdown1" method="post" action="csvpages/terminal-by-terminal-csv.php">
                                    <!--  <input name="export" type="submit" class="whit_btn" id="export" value="Spreadsheet Download" /> -->
                                    <input name="export" type="submit" class="whit_btn" id="export" value="Spreadsheet Download">
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
               </table></td>
            </tr>
                                 <tr>
                                    <td>
                                    </td>
                                    <td width="5%"></td>
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
                           </div>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
            <tr>
               <td>
                  <table width="100%" border="0" bgcolor="#E1E1E1">
                     <!-- footer elastic table -->
                     <tr>
                        <td>
                           <div align="center">
                              <table width="1000" border="0">
                                 <!-- footer fixed table -->
                                 <tr>
                                    <td>
                                       <table width="100%" border="0" bgcolor="#54545E">
                                          <!-- footer extra fixed table -->
                                          <tr>
                                             <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                             <td height="10"></td>
                                          </tr>
                                          <tr>
                                             <td><?php include('../footer.php'); ?></td>
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
         <!-- end #container -->
      </div>
      <script>
               var airportname = ""
               jQuery(document).ready(function(){
               jQuery(".getairportname").click(function(){
                  airportname = jQuery("#selinfog").val();  
                  });
               });
            </script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script src="../js/jquery.dataTables.min.js"></script>
            <script src="../js/dataTables.bootstrap.min.js"></script>

            <!-- Resources -->
            <script src="//www.amcharts.com/lib/4/core.js"></script>
            <script src="//www.amcharts.com/lib/4/charts.js"></script>
            <script src="//www.amcharts.com/lib/4/themes/animated.js"></script>
            <!-- Chart code -->

            <script>
               jQuery(document).ready(function() {
                  jQuery('#example_unique').dataTable( {
                     "order": [[ 0, 'asc' ]]
                  });
               });
            </script>
            <script>
               jQuery('#consumernameget').on('submit', function(e) {
                  e.preventDefault();
                  // var dataconinal = jQuery('#selinfog').val(); 
                  var dataconinalstr = jQuery('#selinfog').val(); 
                  var dataconinal = dataconinalstr.replaceAll(' ', '');
                  jQuery('#selinfog_name').val(dataconinal);
                  jQuery.ajax({
                     type:'POST',
                     dataType : 'html',
                     data: { consumerCode: dataconinal },
                     success: function(response){
                        jQuery('#ajaxTable').load("/terminal-forecasts/terminal-ajax-data.php?consumerCode="+dataconinal);
                     }   
                  });
               });


               

   
            </script>
            <script type="text/javascript">
            var $j = jQuery.noConflict();
            $j(document).ready(function() {
            });
            </script>
            <!-- restrict access -->
            <script>
               jQuery(document).ready(function(){
                  var getloginsub='<?php print_r($_SESSION['kt_login_sub']) ?>';
                  if(getloginsub.indexOf(5)==-1){
                     window.location.href = '/welcome/welcomepage.php';
                  }
               });
            </script>
           
            <script>
               $j( function() {
                  var getautocomplete = <?php echo $encodeddata; ?>;
                  $j( "#selinfog" ).autocomplete({
                     source: getautocomplete
                  });
               });
                             
            </script>
             <script type="text/javascript">
            var $j = jQuery.noConflict();

            var dataType = [];

            $j(document).ready(function() {
               var data ='';
                dataType.push('int');
                dataArr = <?php echo json_encode($arrAllTerminalData) ?>;
                data =  dataArr;
                creategraph(data,dataType);


                $j('#consumernameget').on('submit', function(e) {
                  e.preventDefault();
                  var dataconinalstr = $j('#selinfog').val(); 
                  var dataconinal = dataconinalstr.replaceAll(' ', '');
                  $j('#selinfog_name').val(dataconinal);
                  $j.ajax({
                     type: "POST",
                     url: "terminal-ajax-graphdata.php",
                     data:'keyword='+dataconinal,
                     dataType: "json",
                        success: function(graph_data){console.log('########');
             
                          data = graph_data;
                          creategraph(data,dataType);
                        }
                  });
               });


                $j(document).on("click", "input[type='checkbox']", function (e) {

                  if($j(this).is(":checked")){

                      dataType.push($j(this).val());
                  }
                  else if($j(this).is(":not(:checked)")){
                      const index = dataType.indexOf($j(this).val());
                         dataType.splice(index, 1);
                  }
                  creategraph(data,dataType);
               });

            });

              


            function creategraph(data, dataType){ 
               am4core.useTheme(am4themes_animated);
               // Create chart instance
               var chartT = am4core.create("acapChart", am4charts.XYChart);
               chartT.paddingRight = 20;
   
               chartT.data = data;
             
               chartT.legend = new am4charts.Legend();
               var categoryAxis1 = chartT.xAxes.push(new am4charts.CategoryAxis());
               categoryAxis1.dataFields.category = "mon";
               categoryAxis1.renderer.minGridDistance = 30;
               categoryAxis1.renderer.grid.template.location = 0.5;
               categoryAxis1.startLocation = 0.1;
               categoryAxis1.endLocation = 1.0;
               categoryAxis1.renderer.grid.template.disabled = true;
               categoryAxis1.renderer.labels.template.textAlign = "middle";
               categoryAxis1.labelRotation = 45;
               var label = categoryAxis1.renderer.labels.template;
               label.wrap = true;
               label.maxWidth = 100;
               categoryAxis1.events.on("sizechanged", function(ev) {
               var axis = ev.target;
                axis.renderer.labels.template.rotation = -45;
               });
               
               
               var valueAxis = chartT.yAxes.push(new am4charts.ValueAxis());

           

               function createSeries(field, name, color) {
                 var series = chartT.series.push(new am4charts.LineSeries());
                 series.dataFields.valueY = field;
                 series.dataFields.categoryX = "mon";
                 series.name = name;
                 series.dataFields.thisdateA = "date";
                 series.strokeWidth = 3;
                 series.tensionX = 0.8;
                 series.stroke = am4core.color(color);
                 series.tooltipText = " [b] {categoryX}: [b]{valueY}[/]";
                 series.tooltip.getFillFromObject = false;
                 series.tooltip.background.fill = am4core.color(color);
                 series.strokeWidth = 3;
                 return series;
               }

               console.log((dataType.length));
               if(dataType.length > 0) { console.log('Notempty');
               if ($j.inArray('int', dataType) > -1)
                {
                    //yourElement in yourArray
                    //code here
                }

               
                  if ($j.inArray('int', dataType) != -1){ 
                       var series1 = createSeries("int_prop", "International", "#405690");
                  }
             
                  if ($j.inArray('dom', dataType) != -1){  
                     var series2 = createSeries("dom_prop", "Domestic", "#de574e");
                  }
             
                  if ($j.inArray('tot', dataType) != -1){  
                      var series3 = createSeries("tot_prop", "Total", "#F7A941");
                  }
               } else {
                   if ($j.isEmptyObject(dataType)) {  console.log('empty');
                        document.getElementById("int_ternimal_data").checked = true;
                        dataType.push('int');
                       var series1 = createSeries("int_prop", "Int", "#405690");
                  }
               }
               
               
               
               chartT.cursor = new am4charts.XYCursor();
               chartT.scrollbarX = new am4core.Scrollbar();
            }

     
            </script>
             <script>
         jQuery(document).ready(function(){
            var getloginsub='<?php print_r($_SESSION['kt_login_sub']) ?>';
            if(getloginsub.indexOf(5)==-1){
               window.location.href = '/welcome/welcomepage.php';
            }
         });
      </script>
   </body>
</html>