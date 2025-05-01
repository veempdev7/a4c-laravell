<?php 
   require_once('../Connections/conn_33mysql.php'); 
   require_once('../Connections/conn_409mysql.php');

   session_start();
      ////////////
      $airportcode="";
      $dataset="";
      $aport=array(trim($_POST['airportlist']));
      $setaport = trim(implode(",",$aport));
      $FileName = str_replace("'", "", $setaport);
      $aportarr=explode(",",$setaport);
      $dataset=array();
      $dataset=array($_POST['dataset']);
      $set = trim(implode(",",$dataset));
      $data=explode(",",$set);
      $viewname=$_POST['viewname'];

      date_default_timezone_set('Europe/London'); 
      $curdate=date("Y-m-d H:i:s");


      mysqli_select_db($conn_33mysql,$database_conn_33mysql)or die("Could not select Database");   
      $username=$_SESSION['kt_login_name'];
      $company=$_SESSION['kt_login_company'];
      $userid=$_SESSION['kt_login_id'];
      $compid=$_SESSION['kt_login_company_id'];



     $csv_filename = 'TerminalForcastsCountryMultiselect.csv';
     header('Content-Type: text/csv; charset=utf-8');
     header('Content-Disposition: attachment; filename='.$csv_filename.'');   
      // make lists of downloads

      //$qury="insert into downloadhistory (userid,username, company, selector,datet,company_id) values ('$userid','$username','$company','$viewname','$curdate','$compid')"; 
      $qury="insert into downloadhistory (userid,username, company, selector,datet,company_id) values ('$userid','$username','$company','$viewname','$curdate','$compid')";  
      $res=mysqli_query($conn_33mysql,$qury); 



      /////////////
      


      $output = fopen('php://output', 'a');
      $output1 = fopen('TerminalForcastsCountryMultiselectCsv.csv', 'w');
      $contents=utf8_encode("Air4casts Terminal Forecasts Download");
      fputcsv($output,array($contents));
      fputcsv($output1,array($contents));
      fputcsv($output, array("Terminal  Country Multi Selector"));
      fputcsv($output1, array("Terminal  Country Multi Selector"));
      fputcsv($output, array("\n"));
      fputcsv($output1, array("\n"));
      $curdate=date('m/d/y');
      fputcsv($output,array($curdate));
      fputcsv($output1,array($curdate));
      fputcsv($output, array("\n"));
      fputcsv($output1, array("\n"));
      fputcsv($output, array("International = 3, Domestic = 4, Total = 5"));
      fputcsv($output1, array("International = 3, Domestic = 4, Total = 5"));
      fputcsv($output, array("\n"));
      fputcsv($output1, array("\n"));
      fputcsv($output,array($_POST['airportlist']));
      fputcsv($output1,array($_POST['airportlist'])); 
      fputcsv($output,array($_POST['dataset'])); 
      fputcsv($output1,array($_POST['dataset']));
      fputcsv($output,array("PAX 000"));
      fputcsv($output1,array("PAX 000"));
      fputcsv($output, array("\n"));
      fputcsv($output1, array("\n"));

        mysqli_select_db($conn_409mysql,$database_conn_409mysql);

   
      //$qry="select id_ap ,apname from lupap where apname IN (".$_POST['airportlist'].")";
      $qry ="SELECT DISTINCT(code), aport FROM tfc_termlup WHERE ctry = '{$_POST['airportlist']}'";
      //echo $qry;die; 
      $res=mysqli_query($conn_409mysql,$qry);
      $i=0;
      while($row1=mysqli_fetch_assoc($res))
      {
         $str_aportCode[$i]=$row1['code'];
         $str_apname[$i]="'".$row1['aport']."'";
         $i++;
      }   

      for($i=0;$i<sizeof($str_aportCode);$i++){
         $query_rst_dltrend = "SELECT *, dlup.dlup_monthtxt FROM `tfc_data`  
                                 LEFT JOIN dlup ON dlup.id_dlup = tfc_data.dlup 
                                 WHERE  tfc_data.termcode  LIKE '{$str_aportCode[$i]}%'  
                                 AND tfc_data.year IN (".$_POST['dataset'].") 
                                 Group By tfc_data.year, tfc_data.dlup ,tfc_data.dno, tfc_data.TERMCODE
                                 ORDER BY tfc_data.dlup,tfc_data.termcode ASC";

         $rst_dltrend = mysqli_query($conn_409mysql,$query_rst_dltrend);
         fputcsv($output,array("\n")); 
         fputcsv($output,array($str_apname[$i].' : '.$str_aportCode[$i]));
         fputcsv($output,array('Terminal Code','Year','Month','Data No','Pax 000'));

         while ($row = mysqli_fetch_assoc($rst_dltrend)) {
                fputcsv($output,array($row['termcode'],$row['year'],$row['dlup_monthtxt'],$row['dno'],$row['pax']));
        }
         fputcsv($output, array("\n"));
         fputcsv($output, array("\n"));
      }

      for($i=0;$i<sizeof($str_aportCode);$i++){
         $query_rst_dltrend = "SELECT *, dlup.dlup_monthtxt FROM `tfc_data`  
                                 LEFT JOIN dlup ON dlup.id_dlup = tfc_data.dlup 
                                 WHERE  tfc_data.termcode  LIKE '{$str_aportCode[$i]}%'  
                                 AND tfc_data.year IN (".$_POST['dataset'].") 
                                 Group By tfc_data.year, tfc_data.dlup ,tfc_data.dno, tfc_data.TERMCODE
                                 ORDER BY tfc_data.dlup,tfc_data.termcode ASC";

         $rst_dltrend = mysqli_query($conn_409mysql,$query_rst_dltrend);
         fputcsv($output1,array("\n")); 
         fputcsv($output1,array($str_apname[$i].' : '.$str_aportCode[$i]));
         fputcsv($output1,array('Terminal Code','Year','Month','Data No','Pax 000'));

         while ($row = mysqli_fetch_assoc($rst_dltrend)) {
                fputcsv($output1,array($row['termcode'],$row['year'],$row['dlup_monthtxt'],$row['dno'],$row['pax']));
        }
         fputcsv($output1, array("\n"));
         fputcsv($output1, array("\n"));
      }
   
      
      
       require_once('terminal_forecasts_country_multi_selector_csv_email.php'); 

   ?>