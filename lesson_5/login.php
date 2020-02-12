<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 22.10.2015
 * Time: 22:08
 */
header("Content-type: text/html; charset=utf-8;");
if (isset($_POST['username']))
{

    // проверка введенных данных

    session_start();


    $_SESSION['username'] = $_POST['username'];
    if (isset($_POST['remember']))
    {
        setcookie("username",$_POST['username'],time()+3600**24*7);
    }
    header("Location: /index.php");
}



?>
<h1>Авторизация</h1>
<form action="login.php" method="post">
    Имя пользователя: <input type="text" name="username"/><br/>
    <input type="checkbox" name="remember" value="1"/>запомнить меня<br/>
    <input type="submit" value="Войти"/>
</form>