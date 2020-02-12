<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 22.10.2015
 * Time: 22:28
 */
header("Content-type: text/html; charset=utf-8;");
setcookie("page","a");
include_once("auth.php");
?>
<h1>Это страница A</h1>

Привет, <?php echo $username; ?><br/>

<a href="b.php">Страница B</a><br/>
