<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 22.10.2015
 * Time: 21:19
 */
header("Content-type: text/html; charset=utf-8;");

include_once("auth.php");


echo "Привет, {$username}<br/>";

?>
<a href="a.php">Страница A</a><br/>
<a href="b.php">Страница B</a>

