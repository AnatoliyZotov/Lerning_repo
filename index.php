<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>learning</title>
</head>
<body>
<?
echo "Hello?";
?>
<h4 style="text-align: center">Занятие 1</h4>
<div style="text-align: center">

    <?
    $x = 5;
    echo "$x<br/>";?>
    <?
    $x = 10;
    echo "$x<br/>"; ?>



    <? $a = '734.789';
    echo (int) "$a";
    ?><br/>

    <?
    $name = 'Иван';
    echo 'Hello, ' . $name . '!'
    ?><br/>

    <?
    $a = 'Hello, ';
    $b = 'World!';
    echo $a . $b;
    ?><br/>

    <?
    $a = (3 < 4);
    echo $a;
    ?><br/>



</div>
<h3>Выполнение ДЗ</h3>
<div>
    <li><b> 1. Вывести с помощью оператора echo</b></li>
    <li>  a. Целочисленную переменную (int) </li>
    <li>  b. Переменную дробного типа (double) </li>
    <li>  c. Переменную булевского типа (bool) </li>
    <li>  d. Строковую переменную (string) </li>
    <li>  e. Константу (define()) </li>
</div>
<div>
<?
$a = '12.224';
echo (int) "$a"; // a. Целочисленную переменную (int)
?><br/>
<?
echo (double) "$a"; // b. Переменную дробного типа (double)
?><br/>
<?
$a = true;
$b = false;
echo (bool) true; // c. Переменную булевского типа (bool)
?><br/>
<?
$st = "Строка содержащая числовые и буквенные значения, 42!";
echo (string) "$st"; // d. Строковую переменную (string)
?><br/>
<?
define("PI", "3.14"); //e. Константу (define())
echo PI;
?>
</div>

<li><b>2. Повторите вывод, заключив переменные в двойные кавычки (“). Посмотрите, что получится. Объясните результат. </b></li>
<li><b>3. Повторите вывод, заключив переменные в одинарные кавычки (‘). Посмотрите, что получится. Объясните результат.</b></li>

<?
$int = 100;
$one = "Значение переменной равно $int<br/>"; // "" позволяют подставит значение переменной при результирующем выводе
$two = 'Значение переменной равно $int<br/>'; // '' подстановки не происходит
echo $one;
echo $two;
?>
<li><b>4. Выведите на экран любое четверостишие.</b></li>

<?
echo (string) "<li>«Славная осень! Здоровый, ядреный</li> ";
echo (string) "<li>Воздух усталые силы бодрит;</li> ";
echo (string) "<li>Лед неокрепший на речке студеной</li>";
echo (string) "<li>Словно как тающий сахар лежит.»</li> ";
echo (string) "    <li><u>Н. А. Некрасов</u> </li>";
?><br/>
<li><b>5. Выполните эти же действия, с помощью одного оператора echo.</b></li>
<?
echo "
<pre>
«Славная осень! Здоровый, ядреный 
Воздух усталые силы бодрит; 
Лед неокрепший на речке студеной 
Словно как тающий сахар лежит.» 
<u>Н. А. Некрасов</u> </pre>"
?><br/>
<li><b>6. Попробуйте в выражении использовать разные типы данных, например, сложите число «10» и строку «20 приветов». Что получится? Объясните результат.</b></li>
<?
$a = "10";
$b = "20 приветов";
$c = $a+$b; //ответ "30" т.к. в математическом процессе участвуют только числовые значения
echo $c;
?><br/>

<li><b>7. Дайте ответ на вопрос, как работает оператор xor</b></li>
<table border="1"> <!--TRUE, если $a, или $b TRUE, но не оба.-->
    <tr>
        <td>$a</td>
        <td>$b</td>
        <td>$a xor $b</td>
    </tr>
    <tr>
        <td>true</td>
        <td>false</td>
        <td>true</td>
    </tr>
    <tr>
        <td>false</td>
        <td>true</td>
        <td>true</td>
    </tr>
    <tr>
        <td>false</td>
        <td>false</td>
        <td>false</td>
    </tr>
    <tr>
        <td>true</td>
        <td>true</td>
        <td>false</td>
    </tr>
</table>

</body>
</html>