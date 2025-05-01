<?php
require_once('../Connections/conn_33mysql.php');
session_start();
$getid=$_POST['data'];
$viewid=$_POST['dataview'];
$dataview_id=$_POST['dataview_id'];
$loginname = $_SESSION['kt_login_name'];
$companyname = $_SESSION['kt_login_coname'];

mysqli_select_db($conn_33mysql,$database_conn_33mysql);

 $queryrestrict1 = "select restrictview from loginapp where login_id=".$getid; 
$rst_restrict1=mysqli_query($conn_33mysql,$queryrestrict1);
$row_rst_restrict1 = mysqli_fetch_assoc($rst_restrict1);

$viewArr = explode(',',$row_rst_restrict1['restrictview']);




$currentDateTime = date('Y-m-d');
$queryrestrict = "select count(selector) as selectorname from downloadhistory where userid  = ".$getid."  and  selector = '".$viewid."' and  DATE(datet) = '".$currentDateTime."' and count_download = '1' and countfile IS NULL";
$dataArray= $getid.'='.$viewid.'='.$currentDateTime;


$rst_restrict=mysqli_query($conn_33mysql,$queryrestrict);
$row_rst_restrict = mysqli_fetch_assoc($rst_restrict);
$row_rst_restrict['selectorname'];
$check_mail = $row_rst_restrict['selectorname'];

// count user blocked
 $queryrestrict2 = "select count(selector) as selectorname from downloadhistory where userid  = ".$getid."  and  selector = '".$viewid."' and  DATE(datet) = '".$currentDateTime."'";
$rst_restrict2=mysqli_query($conn_33mysql,$queryrestrict2);
$row_rst_restrict2 = mysqli_fetch_assoc($rst_restrict2);
$check_mail2 = $row_rst_restrict2['selectorname'];

$numberlimits = '';
$numberlimits = $check_mail2/5;
$putnumber='';
if($numberlimits>=0){
    $putnumber=$numberlimits;
    if($putnumber==1){
        $putnumber="User is blocked ".$putnumber.' time';
    }else{
        $putnumber="User is blocked ".$putnumber.' times';
    }
}
else{
    $putnumber='';
}
// count user blocked


 $allow_download = false;
 if($check_mail < 5){
        $allow_download = true;
        if(in_array($dataview_id,$viewArr)){
             $allow_download = false;
        }
 }
 if($check_mail >= 5){
    $allow_download = false; 
 }

 $send_mail = false;
 if($allow_download){
     echo "1";
 } else{
     echo "5";
    $send_mail = true;
 }



//  if($check_mail >= 10)
if($send_mail >= 5)
 {
   require ('PHPMailer/PHPMailerAutoload.php');
   $mail = new PHPMailer;
$mail->setFrom('support@air4casts.com', 'Air4Casts');
$mail->addAddress('supportrequest@air4casts.com', 'Support'); 

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Limit Reached';
$mail->Body    = 'Username :'.$loginname.' from Company : '.$companyname .' has been blocked to download data for this selector : '.$viewid.'. '.$putnumber.
'<span style="display: block; padding: 10px 0px 20px;"><a href="https://air4casts.com/userunblock.php?data='.$dataArray.'" style="display: block; float: left; padding: 15px 15px; border-radius: 3px; background-color: dodgerblue; color: #fff; text-decoration: none; font-weight: bold">Unblock user</a></span>';


if(!$mail->send()) {
    ///echo 'Message could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    //echo 'Message has been sent';
}





 }


//echo $row_rst_restrict['restrictview'];  
?>