<?php
error_reporting(1);
//header("content-type: text/html; charset=UTF-8");
if(isset($_SESSION['kt_login_user']) && $_SESSION['kt_login_user']!= '')
{
$user_name = $_SESSION["kt_login_user"];
}
else
{
header ("Location: index.php");
}

?>
<table width="100%" border="0">
<tr>
  <td width="5%">&nbsp;</td>
  <td width="6%" class="emmahelveticaa12midgrey"><a class="emmahelveticaa12midgrey" data-toggle="tooltip" title="Please contact the Support Team through the Support Centre.">Contact</a></td>
  <td width="7%" class="emmahelveticaa12midgrey"><a href="https://www.air4casts.com/our-services.php" class="emmahelveticaa12midgrey">About Us</a></td>
  <td width="12%" class="emmahelveticaa12midgrey"><a href="../about/tandc.php" class="emmahelveticaa12midgrey">Terms &amp; Conditions</a></td>
  <td width="48%">&nbsp;</td>
  <td width="10%" class="emmahelveticaa12midgrey"><div align="right">Copyright <?php echo date("Y"); ?></div></td>
  <td width="1%" class="emmahelveticaa12midgrey"><div align="center">|</div></td>
  <td width="6%" class="emmahelveticaa12midgrey"><a href="http://www.air4casts.com/" class="emmahelveticaa12midgrey">Air4casts</a></td>
  <td width="5%">&nbsp;</td>
  </tr>
</table>
<div class="loading">&nbsp;</div>

<!-- <script>
$(document).ready(function(){
    $("a[href$='nationalitiestransview.php']").css("display", "none");});
</script> -->
<script type="text/javascript">
jQuery(window).load(function(){
	jQuery('.loading').fadeOut(700);
});
</script>
<script>
jQuery(document).ready(function(){
    jQuery("[data-toggle='tooltip']").tooltip();
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function()
{
   //alert('Rajeev');
   jQuery.ajax({
    type: "POST",
    url: '../action.php',
    data: {name:'<?php echo $user_name?>'},
    success: function(data)
    {
       if(data==1)
       window.location.href = '../about/userredirect.php';
    }
    });
});

	jQuery('body').on("contextmenu",function(e){
		//alert('Right click not allowed.');
		return true;
	});

jQuery(document).keydown(function(event){
	if(event.keyCode==123){
		return false;
	}
	else if (event.ctrlKey && event.shiftKey && event.keyCode==73){
			 return false;
	}
});



document.onkeydown = function(e) {
	if (e.ctrlKey &&
		(e.keyCode === 67 ||
		 e.keyCode === 86 ||
		 e.keyCode === 85 ||
		 e.keyCode === 117)) {
		//alert('not allowed');
		return false;
	} else {
		return true;
	}
};
</script>

