<?php
$host='localhost';
$user='root';
$pass=' ';

mysql_connect($host, $user, $pass);

mysql_select_db('upload');
?>

<?php

$imagename=$_FILES["myimage"]["name"];

//Получаем содержимое изображения и добавляем к нему слеш
$imagetmp=addslashes(file_get_contents($_FILES['myimage']['tmp_name']));

//Вставляем имя изображения и содержимое изображения в image_table
$insert_image="INSERT INTO image_table VALUES('$imagetmp','$imagename')";

mysql_query($insert_image);

?>
