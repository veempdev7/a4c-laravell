<?php 
session_start();
require_once('../Connections/conn_333mysql.php');
require_once('../Connections/conn_natmysql.php'); 
require_once('../Connections/conn_promplan.php'); 

require_once('../includes/common/startmonth_functions.php');
//MX Widgets3 include
require_once('../includes/wdg/WDG.php');

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


if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
    
}
}



/* mysql_select_db($database_conn_33mysql,$conn_33mysql);
$queryrestrict="select restrictview from loginapp where login_id=".$_SESSION['kt_login_id']; 

$rst_restrict=mysql_query($queryrestrict);
$row_rst_restrict = mysql_fetch_assoc($rst_restrict);
$totalRows = mysql_num_rows($rst_restrict); */  // for restriction code
	
mysql_select_db($database_conn_natmysql, $conn_natmysql);
$query_rst_reg = "SELECT * FROM lupreg WHERE id_region < 7 ORDER BY id_region ASC";
$rst_reg = mysql_query($query_rst_reg, $conn_natmysql) or die(mysql_error());
$row_rst_reg = mysql_fetch_assoc($rst_reg);
$totalRows_rst_reg = mysql_num_rows($rst_reg);



mysql_select_db($database_conn_natmysql, $conn_natmysql);
$query_rst_ctry = "SELECT * FROM lup_dd_country ORDER BY countryname ASC";
$rst_ctry = mysql_query($query_rst_ctry, $conn_natmysql) or die(mysql_error());
$row_rst_ctry = mysql_fetch_assoc($rst_ctry);
$totalRows_rst_ctry = mysql_num_rows($rst_ctry);



mysql_select_db($database_conn_natmysql, $conn_natmysql);
$query_rst_aport = "SELECT * FROM lup_dd_airport ORDER BY aportname ASC";
$rst_aport = mysql_query($query_rst_aport, $conn_natmysql) or die(mysql_error());
$row_rst_aport = mysql_fetch_assoc($rst_aport);
$totalRows_rst_aport = mysql_num_rows($rst_aport);


mysql_select_db($database_conn_natmysql, $conn_natmysql);
$query_rst_year = "SELECT * FROM lup_years ORDER BY `year` ASC";
$rst_year = mysql_query($query_rst_year, $conn_natmysql) or die(mysql_error());
$row_rst_year = mysql_fetch_assoc($rst_year);
$totalRows_rst_year = mysql_num_rows($rst_year);

//begin JSRecordset
$jsObject_rst_ctry = new WDG_JsRecordset("rst_ctry");
echo $jsObject_rst_ctry->getOutput();

//end JSRecordset

//begin JSRecordset
$jsObject_rst_aport = new WDG_JsRecordset("rst_aport");
echo $jsObject_rst_aport->getOutput();
//end JSRecordset
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
 <script src="../js/dataTables.bootstrap.min.js"></script>
 
 <script src="../includes/commontab/recordVisit.js"></script>
<script type="text/javascript" src="../includes/common/js/sigslot_core.js"></script>
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/resources/calendar.js"></script>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../includes/wdg/classes/JSRecordset.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/DependentDropdown.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js.php"></script>


 <link href="../style/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../style/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
 <script type="text/javascript">
$(document).ready(function() {
	 $('#example, #example2').DataTable({ 
           "order": []
    });
});
</script>

<link rel="stylesheet" type="text/css" href="../ElasticSlideshow/css/demo.css" />
<link href="http://www.subnews.air4casts.com/style/a4clinks.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Airport View</title>
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
#NatsMenuSimple_container{width:1000px !important;}
ul.FM2_ClientMenu2 li a,ul.FM2_ClientMenu2 li:hover >a, ul.FM2_ClientMenu2 li.hover >a{/*width: 180px !important; */height: 67px !important;}
/*div.FM2_NatsMenuSimple_container{height:auto !important;} */
ul.FM2_NatsMenuSimple li a,ul.FM2_NatsMenuSimple li a:hover{width: 135px !important; /*margin-top:0 !important;*/}
.contentnn{float: left; width: 100%; height: 450px;}
</style> 

<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<link href="../style/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<script src="../js/bootstrap-multiselect.js" type="text/javascript"></script>
 
<script type="text/javascript">
	$(function () {
		$('.sel_yrmon_multi').multiselect({
			//includeSelectAllOption: true
		});
		$(".multiselect-container>li:first-child").find("input").trigger('click');
	});
</script>

<!-- New Sytle for div -->
<link href="../style/a4cnew.css" rel="stylesheet" type="text/css" />
<link href="../style/a4csytle_new.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

<link href="../style/a4clinks.css" rel="stylesheet" type="text/css" />
<link href="../style/tablestylegreyhover550.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css' />
<script type="text/javascript" src="../includes/extendjQuery.js"></script>
<script type="text/javascript" src="../includes/FlexiMenus2/fleximenus2.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="../includes/FlexiMenus2/CSSMenu_ClientMenu2.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800' rel='stylesheet' type='text/css' />
<link href="../includes/FlexiMenus2/CSSMenu_NatsMenuSimple.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../style/jquery.mCustomScrollbar.css">

<script type="text/javascript">


    var str_assign="";
	var arr=[];
	var str_hidden="";
	    function enableDownload(){  
        if(dataarr.length >0 && arr.length >0){
            $('#btnCrtDownload').prop('disabled', false);
        }else{
            $('#btnCrtDownload').prop('disabled', true);            
        }
    }
	
	function selectAirport(val) {
		
		   /* if(arr.indexOf(val) == -1 )
			{
			   $('#selectedlist').append("<li>"+val+"<span><i class='fa fa-close'></i></span></li>");
			   $("#search").val(val);
			   $("#suggesstion-box").hide();
			   arr.push(val); 
			}	
			
			
			str_assign="'"+arr[0]+"'";
			for(i=1;i<arr.length;i++)		
            {
                str_assign = str_assign+','+"'"+arr[i]+"'";
            }
		    $('#airportlist').val(str_assign);
			$("#search").val('');
			$("#suggesstion-box").hide();
            enableDownload();  */
			
			
			 $("#search").val(val);
		     $("#suggesstion-box").hide();
		
		    var text=val.split(';');
			var text_slct=text[1].trim();
			
			//alert(text_slct);
			if(arr.indexOf(text_slct) == -1 )
			{
				arr.push(text_slct); 
				$('#selectedlist').append("<li>"+val+"<span><i class='fa fa-close'></i></span></li>");
			}	
			
			
			str_assign="'"+arr[0]+"'";				
			for(i=1;i<arr.length;i++)		
            {
                str_assign = str_assign+','+"'"+arr[i]+"'";
            }
		    $('#airportlist').val(str_assign);
			$("#search").val('');
			$("#suggesstion-box").hide();
            enableDownload();
		}

	
	

$(document).on('click','#airport_list option', function(){
			var val = $(this).text();        // whole text
			var text_slct_combo=val.split(';');
			var text_slct=text_slct_combo[1].trim();
			
			if(arr.indexOf(text_slct) == -1)
             {
				 if ( $('#menu ul li').size() <= 9 && $('#menu ul li').size() >= 0) 
					{
					   if(arr.indexOf(text_slct) != -1)
						{
							var indx = arr.indexOf(text_slct);
							arr.splice(indx,1);
						}
						else 
						{
							$('#selectedlist').append("<li>"+val+"<span><i class='fa fa-close'></i></span></li>");
							arr.push(text_slct);
							$('#nmbr').text($('#menu ul li').size() );
							enableDownload();
						}
					
							/* if($(this).find('option:selected').hasClass('active') != true){
							$('#selectedlist').append("<li>"+text_slct_co+"<span><i class='fa fa-close'></i></span></li>");
							$(this).find('option:selected').addClass('active');
							} */
							str_assign="'"+arr[0]+"'";
							for(i=1;i<arr.length;i++)		
							{
								str_assign = str_assign+','+"'"+arr[i]+"'";
							}
							//alert("string"+str_assign);   // only jracode
							$('#airportlist').val(str_assign);
							console.log($('#airportlist').val()); 
					}
					else{
						//alert("Please select up to 10 airports");
						$("#btn_trigger").trigger("click");
					} 
		     }
			 else{
				 alert("ALready Exists");
			 }
			
});

	
	  	$(document).on("click", "#aport-list li", function(){
		   if ( $('#menu ul li').size() <= 9 && $('#menu ul li').size() >= 0) 
           {
				 var valueList = $(this).text().trim();
			 	 if($(this).hasClass('active') != true)
				  {
					  //alert(valueList) ;
					  selectAirport(valueList);
					  $(this).addClass('active');
				  }
				$("#search").val('');
				$('#nmbr').text($('#menu ul li').size() );
				enableDownload();
		   }else{
				alert("You select only 10 Airports");
               }   
           		   
        });	
	
	
	
	  	$(document).on("click","#selectedlist li", function () {
		var textaport= $(this).text();
		
		//alert(textaport);
		var text_slct_combo=textaport.split(';');
		var text_slct=text_slct_combo[1].trim();
		for(i=0;i<arr.length;i++)
		{
			if(text_slct == arr[i])
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
		$('#airportlist').val(str_assign);
		$(this).closest("li").remove(); 
		$('#nmbr').text($('#menu ul li').size() );
        enableDownload();
		
	}); 
	
</script>




<script>
    var str_hidden_aport = '';
    var counter_aport = 0;
	var dataarr=[];
	var datastr_assign="";
    $(document).on("click",".check_airport", function () {
        counter_aport = counter_aport + 1;
        var text_slct_aport=$(this).val();

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
        $('#dataset').val(datastr_assign); 
        
        enableDownload();
		   
    }); 
</script>





</head>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="btn_trigger" style="display:none !important;">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:left;">Selection Alert</h4>
      </div>
      <div class="modal-body">
        <p class="emmahelveticaa16darkgrey">Please select up to 10 airports</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>





<body class="oneColElsCtr">

<!-- pop Up code -->

 <link href="../popup/overlay.css" rel="stylesheet" type="text/css"/>
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
<table width="100%" border="0"> <!-- global table -->
  <tr>
    <td>
        
<!-- //Header go here -->
<?php include('../header.php'); ?>
<!--Header End here-->

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
                      <td width="97%" class="emmahelveticaa25whitebold">Nationalities and </td>
                    </tr>
                    <tr>
                      <td width="3%">&nbsp;</td>
                      <td class="emmahelveticaa25whitebold">Demographics</td>
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
                  <td valign="top">
                  		<div id="NatsMenuSimple_container" class="FM2_NatsMenuSimple_container" style="display:block">
                    <ul id="NatsMenuSimple" class="FM2_NatsMenuSimple">
                      <!-- version=@@buildNumber@@;name=NatsMenuSimple;baseskin=skin08;colorscheme=dark_blue;type=tabbed; -->
                      <li> <a href="nationalitieshome.php" target="_self"><font class="leaf">N&nbsp;Home</font></a></li>
                      <li> <a href="nationalitiesallnats.php" target="_self"><font class="leaf">All&nbsp;Nationalities</font></a></li>
                      <li> <a href="nationalitiesairpview.php" target="_self"><font class="leaf">Airport&nbsp;View</font></a></li>
                      <li> <a href="nationalitiestermview.php" target="_self"><font class="leaf">Terminal&nbsp;View</font></a></li>
                      <li> <a href="nationalitiestransview.php" target="_self"><font class="leaf">Transit&nbsp;View</font></a></li>
                      <li> <a href="nationalitiescountryview.php" target="_self"><font class="leaf">Country&nbsp;View</font></a></li>
                      <li> <a href="nationalitiesdemog.php" target="_self"><font class="leaf">Demographics</font></a></li>
                    </ul>
                    <script type="text/javascript">registerFlexiCSSMenu("NatsMenuSimple", {"menuType":"tabbed","effectSub":{"name":"slide","direction":"up","duration":250,"easing":"swing","useFade":true},"effectRest":{"name":"slide","direction":"up","duration":250,"easing":"swing","useFade":true},"effectSubTwo":{"name":"slide","direction":"left","duration":250,"easing":"swing","useFade":true},"options":{"preset":"fixed","enableTablet":false,"enableMobile":false,"mobileMaxWidth":640,"tabletMaxWidth":1023,"tabletCloseBtnLabel":"Close","tabletCloseBtnEnable":false,"align":"center"}});
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
              <td align="center" class="emmahelveticaa26darkgrey">Airport View | Multi-Selector</td>
            </tr>
            <tr>
              <td>
				<div class="emmahelveticaa16darkgreylight" style="text-align:center;">Use the panel below to make easy multi-selections, using an airport as a basis. <br />You can use this tool to select multiple airports, and then decide the years you want to profile.</div>  
              </td>
            </tr> 
            <tr>
              <td>&nbsp;</td>
            </tr> 
            <tr>
              <td>
				<div class="emmahelveticaa16darkgreylight" style="text-align:center;">Give it a go!</div>  
              </td>
            </tr> 
            <tr>
              <td>&nbsp;</td>
            </tr> 
            <tr>
              <td>
				<div class="emmahelveticaa16darkgreylight" style="text-align:center;">SELECT UP TO 10 AIRPORTS:</div>  
              </td>
            </tr> 
            
            <tr>
              <td>&nbsp;</td>
            </tr>
            
            <tr>
              <td align="center">
              		<div class="pageCompare pageMulti" style="padding-top:0;">
					  <div class="compare_cont_left">
						<div class="search_drop"> 

						  <!--div class="ui-widget" style="float:left;">
														<input id="search" name="search" class="controls" type="text" >
														</div-->

						  <input type="search" name="search" placeholder="Search Airport list" id="search">
						  <div id="suggesstion-box"></div>
						  
						</div>
						<select class="comp_multi_select" id="airport_list" size="17">
						    <?php
								do {  
								?>
								<option value="<?php echo $row_rst_aport['aportname']."; ". $row_rst_aport['jracode']; ?>"><?php echo $row_rst_aport['aportname']."; ". $row_rst_aport['jracode']; ?></option>
								<?php
								} while ($row_rst_aport = mysql_fetch_assoc($rst_aport));
								$rows = mysql_num_rows($rst_aport);
								if($rows > 0) {
								mysql_data_seek($rst_aport, 0);
								$row_rst_aport = mysql_fetch_assoc($rst_aport);
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
						<div class="emmahelveticaa15darkgrey no_airp">No. of airports: <span id="nmbr">0</span></div>
					  </div>
					</div>
             	
             	
             	<div class="pageCompare pageMulti" style="padding-top:0;">
					<div class="emmahelveticaa16darkgrey" style="margin-bottom:20px;">SELECT ONE/MORE YEARS:</div>
				  <label class="btn btn-default yearsel">
					<input type="checkbox" id="2014" id="2014" class="check_airport" value="2014">
					2014 </label>
				  <label class="btn btn-default yearsel">
					<input type="checkbox" id="2015" id="2015" class="check_airport" value="2015">
					2015 </label>
				  <label class="btn btn-default yearsel">
					<input type="checkbox" id="2016" id="2016" class="check_airport" value="2016">
					2016</label>
				  <label class="btn btn-default yearsel">
					<input type="checkbox" id="2017" id="2017" class="check_airport" value="2017">
					2017 </label>
				  <label class="btn btn-default yearsel">
					<input type="checkbox" id="2018" id="2018" class="check_airport" value="2018">
					2018 </label> 
					
					 <div class="row">
						<form id="formdown1" name="formdown1" method="post" action="comparedata.php">
						    <input class="btn_download" id="btnCrtDownload" style="width: 260px;" type="submit" value="CREATE DOWNLOAD">
						    <input type="hidden" id="airportlist" name="airportlist" value="">
							<input type="hidden" id="airportlistsendto" name="airportlistsendto" value="">
							<input type="hidden" id="dataset" name="dataset" value="">	
							
							<input type="hidden" name="viewname" id="viewname" value="airportview">
							
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
                  <td><?php include('../footer.php'); ?></td>
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
<!-- custom scrollbar plugin -->
	<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
	
	<script>
		(function($){
			$(window).on("load",function(){						
				$(".demo-yx").mCustomScrollbar({
					axis:"yx"
				});
			});
		})(jQuery);
	</script>
	
	
	
	<script type="text/javascript">	
	$( "#formdown1" ).on("click", function(e) {
		var getid="<?php echo $_SESSION['kt_login_id']; ?>";
		  $.ajax({
                type: "POST",
                url: "alertbox.php",
                data: { data: getid },
				success: function (data){
					if(data !=0 && data == 1)
					{$('#popUp').trigger('show');}
					else{
						$('#formdown1').submit();}
				}
            });
	});
	
	</script>
	<script type="text/javascript">
		$("#search").keyup(function(){
			var search_keyword_value = $(this).val();
			if(search_keyword_value!= '')
            {
			$.ajax({
			type: "POST",
			url: "aportlists.php",
			data:'keyword='+$(this).val(),
			beforeSend: function(){
				$("#search").css("background","#FFF");
			},
			success: function(data){
				$("#suggesstion-box").show();
				$("#suggesstion-box").html(data);
				$("#search").css("background","#FFF");
			}
			});
			
			}
			else{
				$("#suggesstion-box").hide();
			}
			
		});
	
	
	
	
	
	$(document).on('click','label.btn [type="checkbox"]', function(){
        $(this).parent().toggleClass('active');
    });
	
	
	
	</script>
	
	
	
	
</body>
</html>

