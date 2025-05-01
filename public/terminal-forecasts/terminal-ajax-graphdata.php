<?php 
    require_once('../Connections/conn_409mysql.php');
    mysqli_select_db($conn_409mysql,$database_conn_409mysql);
    // $searchconsumer = $_GET['consumerCode']; 
    $getConsumercode = $_POST["keyword"];
    $explodesearch = explode(";",$getConsumercode); 
    $searchconsumer  = $explodesearch[1];

    //$getdefaultconsumer = "SELECT * FROM `term_fc` WHERE `apname`='$searchconsumer' ORDER BY `id` DESC";
    //$getdefaultconsumer = "SELECT * FROM `tfc_data` WHERE `termcode`='$searchconsumer' ORDER BY `id` DESC";
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
            //echo "<pre>"; print_r($val);
            foreach($val as $keyA =>$valA){
            //echo "<pre>"; print_r($valA);
             foreach($valA as $keyB =>$valB){
               $arrMonth = explode("-",$keyB);
             //  echo "<pre>"; print_r($valB);
               //echo $keyA;
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
    echo $arr_grapgh = json_encode($arrAllTerminalData);
        die;
?>