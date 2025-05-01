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



   ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <link href="../style/bootstrap.min.css" rel="stylesheet" type="text/css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="../ElasticSlideshow/css/demo.css" />
      <link href="https://subnews.air4casts.com/style/a4clinks.css" rel="stylesheet" type="text/css" />
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>Multi Selectors</title>
      
      <link href="../style/a4cnew.css" rel="stylesheet" type="text/css" />
      <!-- New Sytle for div -->
      <link href="../style/a4csytle_new.css" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
      <link href="../style/a4clinks.css" rel="stylesheet" type="text/css" />
      <link href="../style/tablestylegreyhover550.css" rel="stylesheet" type="text/css" />
      <link href="../style/tablestylegreyhoversmallnohead.css" rel="stylesheet" type="text/css" />
      <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css' />
      <script type="text/javascript" src="../includes/extendjQuery.js"></script>
      <script type="text/javascript" src="../includes/FlexiMenus2/fleximenus2.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link href="../includes/FlexiMenus2/CSSMenu_ClientMenu2.css" rel="stylesheet" type="text/css" />
      <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css' />
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800' rel='stylesheet' type='text/css' />
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
                                             <td align="center" class="emmahelveticaa16darkgreybold">Download More Data at Once</td>
                                             <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                             <td height="10"></td>
                                             <td height="10"></td>
                                             <td height="10"></td>
                                          </tr>
                                          <tr>
                                             <td>&nbsp;</td>
                                             <td align="center" class="emmahelveticaa15darkgreylight">Use these multi-selectors to pull down multiple terminals at once to Excel. Select terminals by name or
extract every terminal in a given country.</td>
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
                                   <td><div class="grey_container">
                                      <p class="emmahelveticaa22darkgrey">Terminal Forecasts | Multi-Selector</p>
                                      <p class="emmahelveticaa16darkgrey">Use this selector to choose multiple terminals and years for actual data and download them.</p>
                                      <div class="nati_form_container nati_form_container_new">
                                       <form id="form5" name="form4" method="post" action="terminal-forecasts-multi-selectors.php">
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
                                      <p class="emmahelveticaa22darkgrey">Terminal Forecasts by Country | Multi-Selector</p>
                                      <p class="emmahelveticaa16darkgrey">Use this selector to choose a country and see all terminals within, and then multiple years for actual data and download them.</p>
                                      <div class="nati_form_container nati_form_container_new">
                                       <form id="form5" name="form4" method="post" action="terminals-by-country-multi-selectors.php">
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

          
            <script type="text/javascript">
            var $j = jQuery.noConflict();
            $j(document).ready(function() {
               // $j('#hiddenconsumervalue').text("AAT Altay | Terminal Pax Numbers");
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
       
         
   </body>
</html>
