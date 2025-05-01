<?php 
    require_once('../Connections/conn_409mysql.php');
    mysqli_select_db($conn_409mysql,$database_conn_409mysql);

    session_start();
    $searchconsumer  = $_SESSION['sess_airport_sel'];

     $getdefaultconsumer = "SELECT *, dlup.dlup_monthtxt FROM `tfc_data`  LEFT JOIN dlup ON dlup.id_dlup = tfc_data.dlup WHERE  tfc_data.termcode   LIKE '{$searchconsumer}%' AND tfc_data.year > '2014' Group By tfc_data.dlup, tfc_data.dno, tfc_data.termcode ORDER BY tfc_data.dlup ASC";
    mysqli_query($conn_409mysql,$getdefaultconsumer) or die(mysqli_error($conn_409mysql)); 
    $resuldefaultconsumers = $conn_409mysql->query($getdefaultconsumer); 

    $res = mysqli_query($conn_409mysql,$getdefaultconsumer);
        
         $arrNew = [];
         $arr    = [];
         while($row = mysqli_fetch_assoc($res))
         {
            $arr[$row['termcode']] [$row['year']] [$row['dlup'].'-'.$row['dlup_monthtxt']][$row['dno']] = $row['pax'];
            $arrNew[$row['dno']] [$row['dlup'].'-'.$row['dlup_monthtxt']] [$row['year']] [$row['termcode']] = $row['pax'];
         }

         $arrValArr = [];
         $arrAllTerminal = [];
         $allterminal = [];
         
         foreach($arr as $keyCode =>$valCode){
            $allterminal[] = $keyCode;
            foreach($valCode as $key =>$val){
      
               foreach($val as $keyA =>$valA){    
                  $arrMonth = explode("-",$keyA);      
                  $monthVal = date("m", strtotime($arrMonth['1']));
                  $monthName = date("F", strtotime($arrMonth['1']));
                  $a = ($arrMonth['1'] == 'Jan') ? $key : '';
                  $monthWithyear = $monthName.' '.$a;
                  $arrAll= array(
                        'termcode' => $keyCode,
                        'mon' => $arrMonth['1'],
                        'month' =>  $monthWithyear,
                        'int'  => $valA['4'],
                        'dom'  => $valA['3'],
                        'tot'  => $valA['5'],
                        'date'  => $key.'-'.$monthVal,
                        'year' => (string) $key
                  ); 
                             
                  $arrValArr[] = $arrAll;
                  
               }
            }
         }


         $date = "".date("m/d/Y");
         $csv_filename = 'TerminalForecasts2_'.date('Y-m-d').'.csv';
         header('Content-Type: text/csv; charset=utf-8');
         header('Content-Disposition: attachment; filename='.$csv_filename.'');

        $output = fopen('php://output', 'a');

        $contents="Air4cast Terminal Forecasts Download";
        fputcsv($output, array($contents));
        fputcsv($output, array("\n"));
        fputcsv($output, array("Terminal By Terminal"));
        fputcsv($output, array("\n"));
        fputcsv($output, array($date));
        fputcsv($output, array("\n"));
        fputcsv($output, array("International = 3, Domestic = 4, Total = 5"));
        fputcsv($output, array("\n"));
        fputcsv($output, array('Terminal Code','Year','Month','Data No','Pax 000'));
        while ($row = mysqli_fetch_assoc($resuldefaultconsumers)) {
                fputcsv($output,array($row['termcode'], $row['year'], $row['dlup_monthtxt'], $row['dno'], $row['pax']));
          
        }
   
        die;
?>