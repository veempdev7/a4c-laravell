<?php 
    require_once('../Connections/conn_409mysql.php');
    mysqli_select_db($conn_409mysql,$database_conn_409mysql);
    // $searchconsumer = $_GET['consumerCode']; 
    $getConsumercode = $_POST["keyword"];
    $explodesearch = explode(";",$getConsumercode); 
    $searchconsumer  = $explodesearch[1];


     $getdefaultconsumer = "SELECT *, dlup.dlup_monthtxt FROM `tfc_data`  LEFT JOIN dlup ON dlup.id_dlup = tfc_data.dlup WHERE  tfc_data.termcode   LIKE '{$searchconsumer}%' AND tfc_data.year > '2014' Group By tfc_data.dlup, tfc_data.dno, tfc_data.termcode ORDER BY tfc_data.dlup ASC";

    mysqli_query($conn_409mysql,$getdefaultconsumer) or die(mysqli_error($conn_409mysql)); 
    $res = $conn_409mysql->query($getdefaultconsumer); 


         $arr = [];
         $arrNew = [];
         while($row = mysqli_fetch_assoc($res))
         {
            //$arr[$row['termcode']]  = $row['pax'];
            $arr[$row['termcode']] [$row['year']] [$row['dlup'].'-'.$row['dlup_monthtxt']][$row['dno']] = $row['pax'];
            $arrNew[$row['dno']] [$row['dlup'].'-'.$row['dlup_monthtxt']] [$row['year']] [$row['termcode']] = $row['pax'];
         }

         $arrValArr = [];
         $arrAllTerminal = [];
         $allterminal = [];
         
         foreach($arr as $keyCode =>$valCode){
            $allterminal[] = $keyCode;
         }

         $arrTryNewData = [];
         foreach($arrNew as $keyNewA =>$valNewA){
            //echo "<pre>"; print_r($valNewA);  // $keyNewA = 3
            foreach($valNewA as $keyNewB =>$valNewB){
               //echo "<pre>"; print_r($valNewB);  // $keyNewB = 289-jan
               foreach($valNewB as $keyNewC =>$valNewC){
                //echo "<pre>"; print_r($valNewC);  // $keyNewC = 2015

                  $arrMonth = explode("-",$keyNewB);      
                  $monthVal = date("m", strtotime($arrMonth['1']));
                  $monthName = date("F", strtotime($arrMonth['1']));
                  $a = ($arrMonth['1'] == 'Jan') ? $key : '';
                  $monthWithyear = $monthName.' '.$a;
                  $arrTryNew= array(
                        'mon' => $arrMonth['1'].' '.$keyNewC,
                        'year'   => $keyNewC,
                        'date'  => $keyNewC.'-'.$monthVal,
                        'terminal'  => $keyNewC.'-'.$monthVal,
                    
                     );
                  foreach($allterminal as $keyTer =>$valTer){
                      $arrTryNew[$valTer.'_'.$keyNewA] = 0;
                  }
                  foreach($valNewC as $keyNewD =>$valNewD){
                      $arrTryNew[$keyNewD.'_'.$keyNewA] = $valNewD;
                  }
                  $arrTryNewData[$keyNewA][] = $arrTryNew; 
               }
            }
         }

         $arrResult = array('arrTerminal'=> $allterminal  , 'data'=> $arrTryNewData);

    echo $arr_grapgh = json_encode($arrResult);
        die;
?>