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


      /////////////
      mysqli_select_db($conn_409mysql,$database_conn_409mysql);

      $getterminalpass="SELECT DISTINCT(termcode) FROM `tfc_data` ";
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
      $query_rst_top500airport = "SELECT DISTINCT(code), aport FROM tfc_termlup WHERE FIND_IN_SET(termcode, '$implodeterminalvalue') ORDER BY termcode ASC";
      $rst_airport = mysqli_query($conn_409mysql,$query_rst_top500airport);

      


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
      <title>Terminal Forecasts Multi-Selector</title>
      
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

             <link href="../../popup/overlay.css" rel="stylesheet" type="text/css"/>
                           <!--<script src="http://code.jquery.com/jquery-latest.min.js"></script>-->
                           <script type="text/javascript" src="../popup/overlay.js"></script>

                             <div class="overlay" id="popUp">
                              <div class="modal">
                                <p class="emmahelveticaa30darkgreylight" id="tabtext">Limit Reached</p>
                                <p class="emmahelveticaa18darkgreylight m_bt_15"><span id="nametxt">Air4casts has a limit on the amount of bulk downloading you can do from our website.</span></p>
                                <p class="emmahelveticaa16darkgrey"><span id="detailstxt">You look like you need a lot of it. Get in touch with the Support Team, let them know what you are working on and what you need and we will help.</span></p><br />

                                <p class="emmahelveticaa17darkgrey">........................................</p> 
                                 <div class="clearfix">&nbsp;</div> 
                              </div>
                             </div>
  

<!-- pop Up code -->

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
                                             <td>&nbsp;</td>
                                             <td>&nbsp;</td>
                                             <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                             <td width="10%"></td>
                                             <td width="80%"></td>
                                             <td width="10%"></td>
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
                                    <td>&nbsp;</td>
                                 </tr>
                                 <tr>
                                   <td>
                                 <div class="emmahelveticaa16darkgreylight" style="text-align:center;">SELECT UP TO 10 TERMINALS:</div>  
                                   </td>
                                 </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                 </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                 </tr>
                                 
                                 <tr>
                                    <td align="center"><div class="pageCompare pageMulti" style="padding-top:0;">
                                      <div class="compare_cont_left">
                                       <div class="search_drop"> 
                                         <input type="search" name="search" placeholder="Search airport list" id="search">
                                         <div id="suggesstion-box"></div>
                                       </div>
                                       <select class="comp_multi_select" id="airport_list" size="17">
                                           <?php  echo "<pre>"; print_r($row_rst_aport); 
                                                do {  
                                                ?>
                                                <!--option value="<?php //echo $row_rst_aport['aportname']."; ". $row_rst_aport['id_ap']; ?>"><?php //echo $row_rst_aport['aportname']."; ". $row_rst_aport['jracode']; ?></option-->
                                                <option value="<?php echo $row_rst_aport['aport']."; ". $row_rst_aport['code']; ?>"><?php echo $row_rst_aport['code']; ?></option>
                                                <?php
                                                } while ($row_rst_aport = mysqli_fetch_assoc($rst_airport));
                                                $rows = mysqli_num_rows($rst_airport);
                                                if($rows > 0) {
                                                mysqli_data_seek($rst_airport, 0);
                                                $row_rst_aport = mysqli_fetch_assoc($rst_airport);
                                                }
                                             ?>
                                       </select>
                                    </div>
                                      <div class="compare_cont_right">
                                       <div class="emmahelveticaa16darkgreybold" style="text-align: left;">SELECTED</div>
                                       <div class="compare_selected_airport" id="menu" style="height: 311px;">
                                         <ul id="selectedlist">
                                         </ul>
                                       </div>
                                       <div class="emmahelveticaa15darkgrey no_airp">No. of Airports: <span id="nmbr">0</span></div>
                                      </div>
                                    </div>
                                    <div class="pageCompare pageMulti" style="padding-top:0;">
                                      <div class="emmahelveticaa16darkgrey" style="margin-bottom:20px;">SELECT ONE/MORE YEARS:</div>
                                       
                                       <?php 
                                        $qry = " SELECT DISTINCT(`year`) FROM `tfc_data`  order BY year asc  ";
                                       $qry_result = mysqli_query($conn_409mysql,$qry);
                                       $resA=mysqli_fetch_assoc($qry_result);  
                                       $rows = mysqli_num_rows($qry_result);
                                       do{
                                          if($data['year'] > 2014){ ?>
                                          <label class="btn btn-default yearsel">
                                          <input type="checkbox" id="<?php echo $data['year']; ?>" class="check_airport" value="<?php echo $data['year']; ?>">
                                          <?php echo $data['year']; ?> </label>
                                       <?php } }while($data=mysqli_fetch_assoc($qry_result));
                                             ?>
                                      

                                       <div class="row">
                                       <form id="formdown1" name="formdown1" method="post" action="csvpages/terminal-forecasts-multi-selector-csv-data.php">
                                          <input class="btn_download" id="btnCrtDownload" style="width: 260px;" type="button" value="CREATE DOWNLOAD"  disabled="disabled">
                                                <input type="hidden" id="airportlist" name="airportlist" value="">
                                          <input type="hidden" id="airportlistsendto" name="airportlistsendto" value="">
                                          <input type="hidden" id="dataset" name="dataset" value="">                 
                                          <input type="hidden" name="viewname" id="viewname" value="Terminal Forecasts | Multi-Selector">
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
                                    <td>
                                      
                                             </td>
                                             <td width="5%"></td>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td></td>
                                             <td></td>
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

            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script type="text/javascript">
            var $j = jQuery.noConflict();
            $j(document).ready(function() {
               // $j('#hiddenconsumervalue').text("AAT Altay | Terminal Pax Numbers");
            });
            </script>
            <!-- restrict access -->
            <script>
               $j(document).ready(function(){
                  var getloginsub='<?php print_r($_SESSION['kt_login_sub']) ?>';
                  if(getloginsub.indexOf(5)==-1){
                     window.location.href = '/welcome/welcomepage.php';
                  }
               });
            </script>
             <script>
               $j(document).ready(function(){
                  enableDownload();
                });  
               var str_assign="";
               var arr=[];
               var str_hidden="";
                  function enableDownload(){  
                     if(dataarr.length >0 && arr.length >0){
                     $j('#btnCrtDownload').prop('disabled', false);
                     }else{
                     $j('#btnCrtDownload').prop('disabled', true);            
                     }
                  }
                 
                  function selectAirport(val) {
                     $j("#search").val(val);
                     $j("#suggesstion-box").hide();
                     if(arr.indexOf(val) == -1 )
                     {
                     arr.push(val);
                     $j('#selectedlist').append("<li>"+val+"<span><i class='fa fa-close'></i></span></li>");
                     } 

                     str_assign="'"+arr[0]+"'";          
                     for(i=1;i<arr.length;i++)     
                     {
                     str_assign = str_assign+','+"'"+arr[i]+"'";
                     }
                     $j('#airportlist').val(str_assign);
                     $j("#search").val('');
                     $j("#suggesstion-box").hide();
                     enableDownload();
                  }

                  $j(document).on('click','#airport_list option', function(){
                     var val = $j(this).val();        // whole text         
                     var valtxt = $j(this).text();
                     
                     var text_slct_combo=val.split(';');
                     var text_slct=text_slct_combo[1].trim();
                     
                     if(arr.indexOf(valtxt) == -1)
                         {
                         if ( $j('#menu ul li').size() <= 9 && $j('#menu ul li').size() >= 0) 
                           {
                              if(arr.indexOf(valtxt) != -1)
                              {
                                 var indx = arr.indexOf(valtxt);
                                 arr.splice(indx,1);
                              }
                              else 
                              {
                                 $j('#selectedlist').append("<li>"+valtxt+"<span><i class='fa fa-close'></i></span></li>");
                                 arr.push(valtxt);
                                 $j('#nmbr').text($j('#menu ul li').size() );
                                 enableDownload();
                              }
                           
                                 str_assign="'"+arr[0]+"'";
                                 for(i=1;i<arr.length;i++)     
                                 {
                                    str_assign = str_assign+','+"'"+arr[i]+"'";
                                 }
                                 $j('#airportlist').val(str_assign);
                           }
                           else{
                              $j("#btn_trigger").trigger("click");
                           } 
                       }
                      else{
                         alert("Allready Exists");
                      }
                     
                  });

                  $j(document).on("click", "#aport-list li", function(){
                     if ( $j('#menu ul li').size() <= 9 && $j('#menu ul li').size() >= 0) 
                       {
                         var valueList = $j(this).text().trim();
                         if($j(this).hasClass('active') != true)
                          {
                             //alert(valueList) ;
                             selectAirport(valueList);
                             $j(this).addClass('active');
                          }
                        $j("#search").val('');
                        $j('#nmbr').text($j('#menu ul li').size() );
                        enableDownload();
                     }else{
                        alert("You select only 10 Airports");
                     }   
                              
                  });
                  $j(document).on("click","#selectedlist li", function () {
                     var textaport= $j(this).text();

                     for(i=0;i<arr.length;i++)
                     {
                     if(textaport == arr[i])
                     {
                     arr.splice(i,1);
                     }
                     }
                     str_assign="'"+arr[0]+"'";
                     for(i=1;i<arr.length;i++)     
                     {
                     str_assign = str_assign+','+"'"+arr[i]+"'";
                     }
                     //alert(str_assign);
                     $j('#airportlist').val(str_assign);
                     $j(this).closest("li").remove(); 
                     $j('#nmbr').text($j('#menu ul li').size() );
                     enableDownload();
                  });

                  var str_hidden_aport = '';
                     var counter_aport = 0;
                     var dataarr=[];
                     var datastr_assign="";
                     $j(document).on("click",".check_airport", function () {
                       counter_aport = counter_aport + 1;
                       var text_slct_aport=$j(this).val();

                       //alert(text_slct_aport);

                       if(dataarr.indexOf(text_slct_aport) != -1)
                       {
                           //alert("exists");
                           var indx = dataarr.indexOf(text_slct_aport);
                           dataarr.splice(indx,1);
                       }
                       else /* if(dataarr.indexOf(text_slct_aport) === -1) */
                       {
                           //alert("Fresh values" + text_slct_aport);
                           dataarr.push(text_slct_aport);
                       }
                        //alert(dataarr);
                       datastr_assign=dataarr[0];
                       for(i=1;i<dataarr.length;i++)     
                       {
                           datastr_assign = datastr_assign+', '+dataarr[i];
                       }
                       $j('#dataset').val(datastr_assign); 
                       enableDownload();
                     });  

               
            </script>

            <script type="text/javascript">  
               $j( "#formdown1" ).on("click", function(e) {
                  var getid="<?php echo $_SESSION['kt_login_id']; ?>";
                  var viewid="Terminal Forecasts | Multi-Selector";
                  var view_id=12;

                    $j.ajax({
                            type: "POST",
                            url: "alertboxallterminalview.php",
                            data: { data: getid, dataview: viewid ,dataview_id: view_id },
                        success: function (data){
                               //alert(data);
                           // if(data !=0 && data >= 10)
                           if(data !=0 && data >= 5)
                           {$j('#popUp').trigger('show');}
                           else{
                              $j('#formdown1').submit();}
                        }
                        });
               });
            </script>





<script type="text/javascript">
      $j("#search").keyup(function(){
         var search_keyword_value = $j(this).val();
         if(search_keyword_value!= '')
            {
         $j.ajax({
         type: "POST",
         url: "aportlists-ajax.php",
         data:'keyword='+$j(this).val(),
         beforeSend: function(){
            $j("#search").css("background","#FFF");
         },
         success: function(data){
            $j("#suggesstion-box").show();
            $j("#suggesstion-box").html(data);
            $j("#search").css("background","#FFF");
         }
         });
         
         }
         else{
            $j("#suggesstion-box").hide();
         }
         
      });
   
      
   $j(document).on('click','label.btn [type="checkbox"]', function(){
        $j(this).parent().toggleClass('active');
    });
   
   
   
   </script>
           
           
   </body>
</html>
