<?php
	$id=0; //инициализируем id, если в дальнейшем ему ничего не присвоится, значит останется 0 и будет выведена ошибка
	$uri=explode("/",$_SERVER['REQUEST_URI']); //проверим наличие mod_rewrite
	$key=array_search("photo", $uri); //ищем позицию photo в адресе
	if($key){ //убедились что сработал ЧПУ
		$id=$uri[$key+1];
		array_splice($uri,$key);
		$path=implode("/",$uri)."/";
	}
	if(isset($_GET['id']) && strlen(intval($_GET['id']))==strlen($_GET['id'])){ //если переход без ЧПУ
		$id=(int) $_GET['id'];
		$path="";
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link href="<?php echo $path?>style.css" rel="stylesheet" type="text/css" />
    <title>Просмотр картинки № <?php echo $id?></title>
</head>
<body>
<?php
	if($id<1 || $id>8){
	?>
		<p>Изображение не найдено!
	<?php
	}
	else{
		?><p>
		<img src="<?php echo "{$path}img/{$id}"?>.jpg" width="300" alt="Какое-то описание картинки" />
		<br />Какое-то описание картинки<br /><br />
		<?php
	}
	?>
	<a href="<?php echo $path?>index.php">Назад</a>
</p>
</body>
</html>
