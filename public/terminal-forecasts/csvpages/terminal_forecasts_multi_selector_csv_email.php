
<?php
session_start();

require ('../PHPMailer/PHPMailerAutoload.php');
$mail = new PHPMailer;


$username=$_SESSION['kt_login_name'];
$company=$_SESSION['kt_login_company'];
$mail->setFrom('support@air4casts.com', 'Air4Casts');
$mail->addAddress('supportrequest@air4casts.com', 'Support');
// $mail->addAddress('emma.robinson@air4casts.com', 'Emma');       // Add a recipient
// $mail->addAddress('a4ctest@air4casts.com', 'Test');    
//$mail->addAddress('disha24gupta@gmail.com', 'Emma');       // Add a recipient
$mail->addAttachment('TerminalForcastsMultiselectCsv.csv');         // Add attachments
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Downloaded Data';
$mail->Body    = 'Username is :'.$username.' has downloaded the data with Company : '.$company .' with respective to View : '. $viewname;


if(!$mail->send()) {
   
} else {
 
}

?>