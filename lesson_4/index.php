<?php
header("Content-type:text/html;charset=utf-8");
define("ADD",1);
define("SUB",2);
define("MULT",3);
define("DIV",4);
function addition($a,$b){ //Эти функции взял из предыдущих уроков
	return $a+$b;
}
function subtraction($a,$b){
	return $a-$b;
}
function multiplication($a,$b){
	return $a*$b;
}
function division($a,$b){
    if($b==0) $result="Ошибка в аргументах. На ноль делить нельзя!";
    else $result=$a/$b;
    return $result;
}
function mathOperation($arg1, $arg2, $operation){
	switch ($operation){
		case ADD:
			return addition($arg1, $arg2);
			break;
		case SUB:
			return subtraction($arg1, $arg2);
			break;
		case MULT:
			return multiplication($arg1, $arg2);
			break;
		case DIV:
			return division($arg1, $arg2);
			break;
		default: return "Неверно задана операция";
	}
}
$a=$b=$result=''; //инициализация переменных
$oper=1; //операция по умолчанию будет сложение
if(count($_POST) && isset($_POST['a']) && isset($_POST['b']) && isset($_POST['oper'])){
	$a=(int) $_POST['a'];
	$b=(int) $_POST['b'];
	$oper=(int) $_POST['oper'];
	if(strlen($a)!=strlen($_POST['a']) || strlen($b)!=strlen($_POST['b']) || strlen($oper)!=strlen($_POST['oper'])) $result='Ошибка в параметрах!';
	else{
		$result=mathOperation($a,$b,$oper);
	}
	header("Location:?a={$a}&b={$b}&oper={$oper}&result={$result}");
}
if(count($_GET) && isset($_GET['a']) && isset($_GET['b']) && isset($_GET['oper']) && isset($_GET['result'])){
	$a=(int) $_GET['a'];
	$b=(int) $_GET['b'];
	$oper=(int) $_GET['oper'];
	$result=$_GET['result'];
}
$symbol=array(1=>"+",2=>"-",3=>"*",4=>"/"); //массив знаков математических операций
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Домашнее задание. Урок 4</title>
</head>
	<body>
		<h2>Задание 1. Галерея.</h2>
		<p> Первые 4-е картинки обычным образом сделаны<br />
			<?php
			for($i=1;$i<5;$i++){
				echo "<a href=\"photo.php?id=$i\">Изображдение №$i</a><br />";
			}?>
			Остальные с ЧПУ<br />
			<?php
			for($i=5;$i<9;$i++){
				echo "<a href=\"photo/$i/\">Изображдение №$i</a><br />";
			}
			?>
		</p>
		<h2>Задание 2.</h2>
			<form method="post" name="variant1">
				<input type="text" name="a" value="<?php echo $a?>" />
				<select name="oper">
				<?php
					foreach($symbol as $key=>$value){
						echo "<option value=\"$key\"";
						echo $oper==$key ? " selected" : "";
						echo ">$value</option>";
					}
				?>
				</select>
				<input type="text" name="b" value="<?php echo $b?>" />
				<input type="submit" value="=" /> <strong><?php echo $result?></strong>
			</form>
		<h2>Задание 3.</h2>
			<form method="post" name="variant2">
				<input type="text" name="a" value="<?php echo $a?>" />
				<?php echo $symbol[$oper]?>
				<input type="text" name="b" value="<?php echo $b?>" /> = <strong><?php echo $result?></strong><br />
				<?php
					foreach($symbol as $key=>$value){
						echo "<button type=\"submit\" name=\"oper\" value=\"$key\">$value</button>";
					}
				?>
			</form>
	</body>
</html>