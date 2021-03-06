<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>lesson2</title>
</head>
<body>
<div>
    <?
    $x = 10;
    $y = 15;
    if ($x > $y)          // Условие 1
        echo "$x > $y";   // Блок 1
    elseif ($x < $y)      // Условие 2
        echo "$x < $y";   // Блок 2
    else
        echo "$x = $y";   // Блок 3
    ?>
</div><br/>

<?
$max = ($x > $y) ? $x : $y ;
echo $max;
?><br/>

<?
$now = 'night';  //Оператор switch смотрит на значение переменной
// (вместо неё также может стоять выражение, возвращающее значение)
// и сравнивает его с предложенными вариантами.
// В случае совпадения выполняется соответствующий блок кода.
switch ($now)
{
    case 'night':
        echo 'Доброй ночи!';
        break;
    case 'morning':
        echo 'Доброе утро!';
        break;
    case 'evening':
        echo 'Добрый вечер!';
        break;
    default:
        echo 'Добрый день!';
        break;
}
?><br/>

<?
function compare_numbers($x, $y) //сравнивает значения переданные в compare_numbers()
{
    if ($x > $y)
        echo "$x > $y";
    elseif ($x < $y)
        echo "$x < $y";
    else
        echo "$x = $y";
}

?>
<?
echo compare_numbers (5,10);
?><br/>

<?
function average ($x,$y)  //высчитывает среднее арифметическое переданное в average ()
{
    return ($x+$y)/2;
}
$avg = average(5,7);
echo $avg;
?><br/>

<?
function mult($a, $b = 1) //использует значение по умолчанию $b = 1
{
    return $a * $b;
}
echo mult(8);
?><br/>
<h3><b>выполнение ДЗ</b></h3>
<li><b>1. Объявите две целочисленные переменные $a и $b</b></li>
<!--Объявите две целочисленные переменные $a и $b
и задайте им произвольные начальные значения.
Затем напишите скрипт, который работает по следующему принципу:
a. если $a и $b положительные,  выведите их разность;
b. если $а и $b отрицательные, выведите их произведение;
c. если $а и $b разных знаков,  выведите их сумму.
Ноль можно считать положительным числом.-->
<?
$a = -5;        //для проверки заменять числа в переменных на отрицательные и положительные
$b = 10;
if (($a> 0) && ($b>0))
    echo $a - $b;
elseif (($a< 0) && ($b<0))
    echo $a * $b;
elseif ((($a> 0) && ($b<0)) xor (($b>0) or (($a<0))))
    echo $a + $b;
?>
<li><b>2. Присвойте переменной $а значение в промежутке [0..15] </b></li>
<!--организуйте вывод чисел от $a до 15 -->
<?
$a = 10;
while ($a <= 15)
{
    echo "$a "."";
    $a++;
}
?><br/>
<li><b>3. Реализуйте основные 4 арифметические операции (+, -, *, %)</b></li>
<?
function addition ($x,$y)
{
    return ($x+$y);
}
$add = addition(5,7); //для получения результата ввести значения
echo $add;
?><br/>
<?
function subtraction ($x,$y)
{
    return ($x-$y);
}
$sub = subtraction(5,7); //для получения результата ввести значения
echo $sub;
?><br/>
<?
function division ($x,$y)
{
    if ($y==0) $result="на ноль делить нельзя!";
    else $result=$x/$y;
    return $result;
}
$div = division(10,2); //для получения результата ввести значения
echo $div;
?><br/>
<?
function multiplication ($x,$y)
{
    return ($x*$y);
}
$mult = multiplication(10,2); //для получения результата ввести значения
echo $mult;
?><br/>

<li><b>4. Реализуйте функцию с тремя параметрами</b></li>
<!--  function mathOperation($arg1, $arg2, $operation),
 где $arg1, $arg2 – значения аргументов,
  $operation – строка с названием операции. -->
<?
function mathOperation($arg1, $arg2, $operation){
    switch ($operation){
        case '$add':
        return addition($arg1,$arg2);
        break;
        case '$sub':
        return subtraction($arg1,$arg2);
        break;
        case '$div':
        return division($arg1,$arg2);
        break;
        case '$mult':
        return multiplication($arg1,$arg2);
        break;
    }
}
echo mathOperation(2,2,$mult);
?>
</body>
</html>