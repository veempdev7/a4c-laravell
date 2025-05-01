<?php 
    require_once('../terminal-forecasts/common/Connections/conn_409mysql.php');

  echo  $getConsumercode = $_GET['consumerCode']; die;
    $explodesearch = explode(";",$getConsumercode); 
    $searchconsumer  = $explodesearch[1];
