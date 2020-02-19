<?php

header("Content-type: text/html; charset=utf-8;");
setcookie("page","a");
include_once("auth.php");
?>
<h1>Это страница A</h1>

Привет, <?php echo $username; ?><br/>

<a href="b.php">Страница B</a><br/>
