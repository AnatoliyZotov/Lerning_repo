<?php

header("Content-type: text/html; charset=utf-8;");
setcookie("page","b");
include_once("auth.php");
?>
<h1>Это страница B</h1>

Привет, <?php echo $username; ?><br/>

<a href="a.php">Страница A</a><br/>
