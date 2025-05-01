<?php 
    session_start();
    require_once('../Connections/conn_409mysql.php');
    mysqli_select_db($conn_409mysql,$database_conn_409mysql);
    // $searchconsumer = $_GET['consumerCode']; 
    $getConsumercode = $_GET['consumerCode']; 
    $explodesearch = explode(";",$getConsumercode); 
    $searchconsumer  = $explodesearch[1];
    if($searchconsumer !=''){
        $_SESSION['sess_terminal_sel']='';
        $_SESSION['sess_terminal_sel']=$searchconsumer;
    }
    

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

               $arrValArr[] = $arrVal;
               }
            }
         }
    
    $sqlselinfog = "SELECT distinct(aport) FROM tfc_termlup WHERE `termcode` = '$searchconsumer'";
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
                   <td><?php echo $rst_natinality['month'] ?></td>
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
        $j('#hiddenconsumervalue').text(getmyselinfog +" "+getairportname+ " | Terminal Pax Number");
    });
</script>