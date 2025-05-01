<?php require_once('../Connections/conn_333mysql.php'); ?><?php
   require_once('../Connections/conn_33mysql.php'); 
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
      <link href="http://subnews.air4casts.com/style/a4clinks.css" rel="stylesheet" type="text/css" />
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>Air4casts TERMINAL FORECASTS</title>
      
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
      <link href="css/custom.css?v=<?php echo date('h')?>" rel="stylesheet" type="text/css" />
      <link href="css/terminal-custom.css?v=<?php echo date('h')?>" rel="stylesheet" type="text/css" />
      
      
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
                                             <td align="center" class="emmahelveticaa16darkgreybold">Air4casts Terminal Forecasts</td>
                                             <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                             <td height="10"></td>
                                             <td height="10"></td>
                                             <td height="10"></td>
                                          </tr>
                                          <tr>
                                             <td>&nbsp;</td>
                                             <td align="center" class="emmahelveticaa15darkgreylight">Our terminal forecasts module delivers passenger actual and forecast numbers for the major international
and domestic terminals around the world, bringing together, on a single page, everything that data users
need for any one of 2,000+ terminals, showing how domestic passengers compare with international and extending the forecasts to fit seamlessly with the long-established Airports 1500.</td>
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
                                                         <table width="300" height="450" background="../clientconvertgraphics2016/coronaflag.png" style="background-size:120% 100%; background-position: bottom;">
                                                            <!-- <td width="35%" align="center" valign="top"><table width="300" height="521" bgcolor="#DEB780"> -->
                                                            <tr>
                                                               <td>&nbsp;</td>
                                                               <td class="emmahelveticaa18whitebold">&nbsp;</td>
                                                               <td>&nbsp;</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                               <td>&nbsp;</td>
                                                               <td align="center" class="emmahelveticaa18darkgreybold">Terminal Forecasts</td>
                                                               <td>&nbsp;</td>
                                                            </tr>
                                                            <tr style="height:160px;">
                                                               <td>&nbsp;</td>
                                                               <td align="center" class="emmahelveticaa15darkgreylight">The <b>Terminal Forecasts</b> module
presents a unique database of
global 
<b>terminal passenger
actuals and forecasts;</b> international, domestic and total. At
the heart of this module is
Air4casts’ rigorous data collection
methodology. </td>
                                                            </tr>
                                                            <tr>
                                                               <td>&nbsp;</td>
                                                               <td align="center" class="emmahelveticaa15darkgreylight">For more information, <b>read on.</b></td>
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
                                                               <td width="5%">&nbsp;</td>
                                                               <td width="90%" class="emmahelveticaa15whitebold">&nbsp;</td>
                                                               <td width="5%">&nbsp;</td>
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
                                                               <td class="emmahelveticaa18darkgreybold">Terminal Actuals and Forecasts</td>
                                                            </tr>
                                                            <tr>
                                                               <td height="5" class="emmahelveticaa15darkgreylight"></td>
                                                            </tr>
                                                            <tr>
                                                               <td class="emmahelveticaa15darkgreylight">Understand the monthly passenger traffic for every terminal, split by
domestic and international passengers, with historical data back to
January 2011 and forecasts out to December 2040. The domestic
and international passenger proportions at each terminal have never
been so important with airports increasingly mixing domestic and
international ights within a single terminal.</td>
                                                            </tr>
                                                             <tr>
                                                               <td height="10" class="emmahelveticaa15darkgreylight"></td>
                                                            </tr>
                                                            <tr>
                                                               <td class="emmahelveticaa18darkgreybold">Greater detail, more control</td>
                                                            </tr>
                                                            <tr>
                                                               <td height="10" class="emmahelveticaa15darkgreylight"></td>
                                                            </tr>
                                                            <tr>
                                                               <td class="emmahelveticaa15darkgreylight">The module covers 2000+ terminals and rising. To be included in
this analysis an airport must be shown to be providing regular
monthly updates of its arriving and departing passenger numbers. It
shows both international and domestic passenger numbers by
month for all of the years from 2011 to 2040. It sets each terminal in
the context of the airport itself. It brings together both international and domestic passenger flows. It shows how, on a monthly/annual
basis, numbers have developed over time. It extends the forecast
horizon to 2040 bringing it in line with the established, pre-Covid,
conventions of the Airports 1500 module.</td>
                                                            </tr>
                                                            
                                                            
                                                            <tr>
                                                               <td height="10" class="emmahelveticaa15darkgreylight"></td>
                                                            </tr>
                                                            <tr>
                                                               <td class="emmahelveticaa15darkgreylight">As with the Airports 1500 module, subscribers are able to specify a
whole range of custom downloads which they can access through
their dedicated websites.</td>
                                                            </tr>
                                                            <tr>
                                                               <td height="10" class="emmahelveticaa15darkgreylight"></td>
                                                            </tr>
                                                            <tr>
                                                               <td class="emmahelveticaa15darkgreylight">Everything we do is updated monthly at a minimum. Airports declare
their latest month’s actuals every day and we upload them live.</td>
                                                            </tr>
                                                            <tr>
                                                               <td height="10" class="emmahelveticaa15darkgreylight"></td>
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
                                                               <td align="center" class="emmahelveticaa18whitelight"> Updated</td>
                                                               <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                               <td>&nbsp;</td>
                                                               <td align="center" class="emmahelveticaa18whitebold">
                                                                  <p>Every Day</p>
                                                               </td>
                                                               <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                               <td>&nbsp;</td>
                                                               <td>&nbsp;</td>
                                                               <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                               <td>&nbsp;</td>
                                                               <td align="center" class="emmahelveticaa18whitelight">&nbsp;</td>
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
                                                               <td align="center" class="emmahelveticaa18whitelight"><a href="https://help.air4casts.com" target="_blank" class="emmahelveticaa18whitelight">or ask the Support <br>Team</a></td>
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
                                                                  <p><a href="https://help.air4casts.com" target="_blank" class="emmahelveticaa12whitelight">If you need more data, you can explore our databases and products with a member of the team.</a></p>
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
      <!-- restrict access -->
      <script>
         jQuery(document).ready(function(){
            var getloginsub='<?php print_r($_SESSION['kt_login_sub']) ?>';
            if(getloginsub.indexOf(5)==-1){
               window.location.href = '/welcome/welcomepage.php';
            }
         });
      </script>
      <!-- restrict access -->
   </body>
</html>