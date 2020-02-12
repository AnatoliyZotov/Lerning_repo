<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'user_adm';

$lnk = mysql_connect($db_host, $db_user, $db_password)
       or die ('Not connected : ' . mysql_error());

// сделать foo текущей базой данных
mysql_select_db($db_name, $lnk) or die ("Can\'t use {$dbname} :" . mysql_error());
?>