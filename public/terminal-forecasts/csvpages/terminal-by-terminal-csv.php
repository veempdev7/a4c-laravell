<?php 
    require_once('../Connections/conn_409mysql.php');
    mysqli_select_db($conn_409mysql,$database_conn_409mysql);

    session_start();
    $searchconsumer  = $_SESSION['sess_terminal_sel'];

    $getdefaultconsumer = "SELECT *, dlup.dlup_monthtxt FROM `tfc_data`  LEFT JOIN dlup ON dlup.id_dlup = tfc_data.dlup WHERE  tfc_data.termcode ='$searchconsumer' AND tfc_data.year > '2014'  Group By tfc_data.dlup, tfc_data.dno ORDER BY tfc_data.dlup ASC";
    mysqli_query($conn_409mysql,$getdefaultconsumer) or die(mysqli_error($conn_409mysql)); 
    $resuldefaultconsumers = $conn_409mysql->query($getdefaultconsumer); 
    $res = mysqli_query($conn_409mysql,$getdefaultconsumer);
         $arr = [];
         while($row = mysqli_fetch_assoc($res))
         {
            $arr[$row['termcode']] [$row['year']] [$row['dlup'].'-'.$row['dlup_monthtxt']][$row['dno']] = $row['pax'];
         }

         $arrValArr = [];
         foreach($arr as $key =>$val){
            foreach($val as $keyA =>$valA){
             foreach($valA as $keyB =>$valB){
               $arrMonth = explode("-",$keyB);
            
               $arrVal = array(
                     'termcode' => $key,
                     'year' => $keyA,
                     'dlup' => $keyB,
                     'month' => $arrMonth['1'],
                     'dom'  => $valB['4'],
                     'int'  => $valB['3'],
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

               $arrValArr[] = $arrVal;
               $arrAllTerminalData[] = $arrAllTerminal;
               }
            }
         }
          $date = "".date("m/d/Y");
         $csv_filename = 'TerminalForecasts1_'.$db_record.'_'.date('Y-m-d').'.csv';
         header('Content-Type: text/csv; charset=utf-8');
         header('Content-Disposition: attachment; filename='.$csv_filename.'');

        $output = fopen('php://output', 'a');

        $contents="Terminal Forecast Passenger Numbers";
        fputcsv($output, array($contents));
        fputcsv($output, array("\n"));
        fputcsv($output, array("One Terminal"));
        fputcsv($output, array("\n"));
        fputcsv($output, array($date));
        fputcsv($output, array("\n"));
        fputcsv($output, array("International = 3, Domestic = 4, Total = 5"));
        fputcsv($output, array("\n"));
        fputcsv($output, array('Terminal Code','Year','Month','Data No','Pax 000'));
        while ($row = mysqli_fetch_assoc($resuldefaultconsumers)) {
                fputcsv($output,array($searchconsumer,$row['year'],$row['dlup_monthtxt'],$row['dno'],$row['pax']));
          //fputcsv($output, $row);
        }
   
        die;
?>