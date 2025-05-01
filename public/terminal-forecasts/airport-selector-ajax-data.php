<?php 
    session_start();
    require_once('../Connections/conn_409mysql.php');
    mysqli_select_db($conn_409mysql,$database_conn_409mysql);
    // $searchconsumer = $_GET['consumerCode']; 
    $getConsumercode = $_GET['consumerCode']; 
    $explodesearch = explode(";",$getConsumercode); 
    $searchconsumer  = $explodesearch[1];
    if($searchconsumer !=''){
        $_SESSION['sess_airport_sel']='';
        $_SESSION['sess_airport_sel']=$searchconsumer;
    }
    

      $getdefaultconsumer ="SELECT *, dlup.dlup_monthtxt FROM `tfc_data`  LEFT JOIN dlup ON dlup.id_dlup = tfc_data.dlup WHERE  tfc_data.termcode   LIKE '{$searchconsumer}%' AND tfc_data.year > '2014' Group By tfc_data.dlup, tfc_data.dno, tfc_data.termcode ORDER BY tfc_data.dlup ASC";
        mysqli_query($conn_409mysql,$getdefaultconsumer) or die(mysqli_error($conn_409mysql)); 
        $resuldefaultconsumers = $conn_409mysql->query($getdefaultconsumer); 
        $res = mysqli_query($conn_409mysql,$getdefaultconsumer);
        
        $arr = [];
        $arrNew = [];
        while($row = mysqli_fetch_assoc($res))
        {

            $arr[$row['termcode']] [$row['year']] [$row['dlup'].'-'.$row['dlup_monthtxt']][$row['dno']] = $row['pax'];
            $arrNew[$row['dno']] [$row['dlup'].'-'.$row['dlup_monthtxt']] [$row['year']] [$row['termcode']] = $row['pax'];
        }

          $arrValArr = [];         
         foreach($arr as $keyCode =>$valCode){
            $allterminal[] = $keyCode;
            foreach($valCode as $key =>$val){
               //echo "<pre>"; print_r($val);
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
                        'int'  => $valA['3'],
                        'dom'  => $valA['4'],
                        'tot'  => $valA['5'],
                        'date'  => $key.'-'.$monthVal,
                        'year' => (string) $key
                  ); 
                             
                  $arrValArr[] = $arrAll;
               }
            }
         }

         //echo "<pre>"; print_r($arrValArr);
    
    $sqlselinfog = "SELECT distinct(aport) FROM tfc_termlup WHERE `code` = '$searchconsumer'";
    //$sqlselinfog = "SELECT distinct(termcode) FROM lup_term WHERE `apname` = '$searchconsumer'";
    mysqli_query($conn_409mysql,$sqlselinfog) or die(mysqli_error($conn_409mysql)); 
    $resultselinfog = $conn_409mysql->query($sqlselinfog); 
    $rowselinfog = $resultselinfog->fetch_assoc(); 

    // echo $searchconsumer;
?>
<td align="center">
    <table width="100%" id="example" class="table-style-two datatable">
        <thead>
            <tr class="emmahelveticaa14white">
                <th>Year</th>
                <th>Terminal</th>
                <th>Month</th>
                <th>International</th>
                <th>Domestic</th>
                <th>Total</th>
            </tr>
        </thead>                    
        <tbody>
            <?php if ($resuldefaultconsumers->num_rows > 0) { ?>
            <?php
                // while($rowDefaultconsumers = $resuldefaultconsumers->fetch_assoc()) { 
                foreach($arrValArr as $resKey => $rst_natinality){
                ?>                                                                 
                <tr class="emmahelveticaa14darkgreylight">
                   <td><?php echo $rst_natinality['year'] ?></td>
                   <td><?php echo $rst_natinality['termcode'] ?></td>
                   <td><?php echo $rst_natinality['mon'] ?></td>
                   <td><?php echo $rst_natinality['int'] ?></td>
                   <td><?php echo $rst_natinality['dom'] ?></td>
                   <td><?php echo $rst_natinality['tot'] ?></td>
                </tr>
            <?php } ?> 
            <?php } ?> 
        </tbody>
    </table>
</td>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    var $j = jQuery.noConflict();
    $j(document).ready(function() {
        $j('#example').DataTable({
            "order": [[ 0, 'asc' ]]
        });  
        var getmyselinfog = '<?php echo $explodesearch[1]//$_GET['consumerCode']?>';
        var getairportname = '<?php echo  $rowselinfog['aport']?>';
        var concateconsumer = ""
        $j('#consumername').html(concateconsumer);
        jQuery('#terminalairport').val(getairportname);
        $j('#hiddenconsumervalue').text(getmyselinfog +" - "+getairportname+ " | Terminal Pax Number");
    });
</script>