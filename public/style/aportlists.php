<?php
require_once('conn.php');
mysql_select_db($database, $conn);
$var=$_POST["keyword"];

$query="";
if(!empty($_POST["keyword"]))
{
  if(strlen($var) == 3)
  {
   $query = "SELECT jracode,aportname FROM mapmap where jracode = '$var' ORDER BY aportname ASC ";
  } 	
  else{  
		$query = "SELECT jracode,aportname FROM mapmap where aportname LIKE '%$var%' || jracode LIKE '%$var%' ORDER BY aportname ASC ";
     }	 
		$result = mysql_query($query);
		$row=mysql_fetch_assoc($result);
		
		if(!empty($result)) 
		{
?>
		<ul id="aport-list">
			<?php
			do{
			?>
			<!--<li onClick="selectAirport('<?php echo strtoupper(utf8_encode($row['aportname'])).";". strtoupper($row['jracode']); ?>');">-->
			<li>
			                            <?php echo strtoupper(utf8_encode($row['aportname']))."; ". strtoupper($row['jracode']); ?></li>
			<?php } while($row=mysql_fetch_assoc($result)); ?>
			</ul>
<?php } } ?>