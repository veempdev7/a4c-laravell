<?php ob_start();
$hostname_conn_33mysql = "localhost";
$database_conn_33mysql = "db283755273";
$username_conn_33mysql = "dbo283755273";
$password_conn_33mysql = "WHu));6;5uah49Cd6QAJ9zF2";
 $socket = '/tmp/mysql5.sock';
//$conn_33mysql = mysqli_connect($hostname_conn_33mysql, $username_conn_33mysql, $password_conn_33mysql) ;

//$conn_newsitemysql = mysqli_connect($hostname_conn_newsitemysql, $username_conn_newsitemysql, $password_conn_newsitemysql,'',null,$socket) or trigger_error(mysqli_error(),E_USER_ERROR);
$conn_33mysql = mysqli_connect($hostname_conn_33mysql,$username_conn_33mysql,$password_conn_33mysql,'',null,$socket);

?>