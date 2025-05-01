<?php 
    require_once('../Connections/conn_409mysql.php');
    mysqli_select_db($conn_409mysql,$database_conn_409mysql);

    $var=$_POST["keyword"];

    $getterminalpass="SELECT DISTINCT(termcode) FROM `tfc_data` where termcode LIKE '%$var%' ";
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
      $result = mysqli_query($conn_409mysql,$query_rst_top500airport);
      $row=mysqli_fetch_assoc($result);

        if($row > 0) 
        {
    
?>
        <ul id="aport-list">
            <?php
            do{
            ?>
            <li>
                                        <?php 
                                              if(isset($row['code']))
                                              {
                                                    echo utf8_encode($row['code']);
                                                    //echo utf8_encode($row['aportname']);
                                              }
                                         ?>   
            </li>
            <?php } while($row=mysqli_fetch_assoc($result)); ?>
            </ul>
<?php }  
?>