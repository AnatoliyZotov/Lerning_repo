<?php
header("Cache-Control: no-cache"); //попробуем отключить кеширование, а то картинки не те показывает
header("Content-type:text/html;charset=utf-8"); //попробуем победить кодировку
$err=array();//массив для записи ошибок. Правда массив тут не понадобился, можно было обойтись переменной.
define("JPEG","image/jpeg");
define("PNG","image/png");
define("GIF","image/gif");
define("THUMB_SIZE",150);
define("ASC","asc");
define("DESC","desc");
define("ERR_WRONG_ARGS","Ошибка в параметрах");
define("ERR_FORMAT_RESTR","Загружать можно только файлы в формате jpeg, png и gif");
define("ERR_TOO_LARGE","Не удалось сохранить. Файл слишком большой!");
define("ERR_NO_FILE","Файл для загрузки не выбран!");
define("ERR_OTHER","Произошла ошибка загрузки файла");
$img_path="./img";//путь хранения картинок
$filename_file="./list_files"; //файл где хранится массив-список файлов
$filenames_array=array();//массив имен файлов
$types=array(JPEG,PNG,GIF); //массив типов файлов доступных к загрузке
function get_type($file){ // проверка типа файла
	$finfo=finfo_open(FILEINFO_MIME_TYPE);
	$file_type=finfo_file($finfo,$file); 
	finfo_close($finfo);
	return $file_type;
}
function create_thumb($src_img,$dest_image){
	$img_size=getimagesize($src_img);
	$new_height=THUMB_SIZE; //выравниваем по высоте
	$new_width=THUMB_SIZE*$img_size[0]/$img_size[1];
	switch($img_size[2]){ //в зависимости от типа файла
	case 1://gif
		$source_image_res=imagecreatefromgif($src_img);
		$dest_image_res=imagecreatetruecolor($new_width,$new_height);
		ImageCopyResampled($dest_image_res,$source_image_res,0,0,0,0,$new_width,$new_height,$img_size[0],$img_size[1]);
		imagegif($dest_image_res,$dest_image);
        break;
	case 2://jpeg
		$source_image_res=imagecreatefromjpeg($src_img);
		$dest_image_res=imagecreatetruecolor($new_width,$new_height);
		ImageCopyResampled($dest_image_res,$source_image_res,0,0,0,0,$new_width,$new_height,$img_size[0],$img_size[1]);
		imagejpeg($dest_image_res,$dest_image,90);
        break;
	case 3://png
		$source_image_res=imagecreatefrompng($src_img);
		$dest_image_res=imagecreatetruecolor($new_width,$new_height);
		ImageCopyResampled($dest_image_res,$source_image_res,0,0,0,0,$new_width,$new_height,$img_size[0],$img_size[1]);
		imagepng($dest_image_res,$dest_image,9);
        break;
  	}
	imagedestroy($source_image_res);
	imagedestroy($dest_image_res);
}
function save_array($filename_file, $filenames_array){
	file_put_contents($filename_file, serialize($filenames_array));
	header("Location: index.php");
	die();
}
function delete_file($key_to_delete){
	@unlink("{$img_path}/i_{$filenames_array[$key_to_delete]}");//удаляем картинку, с подавлением ошибки, чтоб не проверять наличие файла
	@unlink("{$img_path}/t_{$filenames_array[$key_to_delete]}");//удаляем миниатюру
	@unlink("{$img_path}/t_{$key_to_delete}");//и описание
}
//создаем массив с именами файлов
if(file_exists($filename_file)){ //если файла нет, то создаем его 
	$filenames_array=unserialize(file_get_contents($filename_file));
}
//var_dump($filenames_array);
//удаление
if(isset($_GET['delete'])){
	$key_to_delete=(int) $_GET['delete'];
	if(strlen($key_to_delete)==strlen($_GET['delete'])){
		delete_file($key_to_delete);
		unset($filenames_array[$key_to_delete]);
		save_array($filename_file, $filenames_array);
	}
	else $err[]=ERR_WRONG_ARGS;
}
if(isset($_GET['deleteall'])){
	foreach(scandir($img_path) as $file){
		if(!is_dir($file)) unlink("{$img_path}/{$file}");
	}
	$filenames_array=array();
	save_array($filename_file, $filenames_array);
}
//сортировка общая
if(isset($_GET['sort'])){
	switch($_GET['sort']){
		case ASC:
			ksort($filenames_array);
			break;
		case DESC:
			krsort($filenames_array);
			break;
	}
	save_array($filename_file, $filenames_array);
}
//перемещение картинок
if(isset($_GET['left'])){
	$key_to_move=(int)$_GET['left'];
	if(strlen($key_to_move)!=strlen($_GET['left']) || !array_key_exists($key_to_move, $filenames_array)) $err[]=ERR_WRONG_ARGS;
	else{
		$replace_array=array();
		$position=0;
		$count=count($filenames_array)-1;
		foreach ($filenames_array as $key => $value) {
			if($key==$key_to_move){ // тут костыли для вытаскивания нужных элементов массива в нужном порядке
				if($position!=$count) prev($filenames_array);//ничего умней придумать уже нет времени
				else end($filenames_array);
				$a=each($filenames_array);
				$replace_array[$a[0]]=$a[1];
				if($position!=$count) prev($filenames_array);
				else end($filenames_array);
				prev($filenames_array);
				$a=each($filenames_array);
				$replace_array[$a[0]]=$a[1];
				$first_part=array_slice($filenames_array, 0, $position-1, TRUE);
				$last_part=array_slice($filenames_array, $position+1,NULL,TRUE);
				$filenames_array=$first_part+$replace_array+$last_part;
				break;
			}
			$position++;
		}
		save_array($filename_file, $filenames_array);
	}
}
if(isset($_GET['right'])){
	$key_to_move=(int)$_GET['right'];
	if(strlen($key_to_move)!=strlen($_GET['right']) || !array_key_exists($key_to_move, $filenames_array)) $err[]=ERR_WRONG_ARGS;
	else{
		$replace_array=array();
		$position=0;
		foreach ($filenames_array as $key => $value) {
			if($key==$key_to_move){
				$a=each($filenames_array);
				$replace_array[$a[0]]=$a[1];
				$replace_array[$key]=$value;
				$first_part=array_slice($filenames_array, 0, $position, TRUE);
				$last_part=array_slice($filenames_array, $position+2,NULL,TRUE);
				$filenames_array=$first_part+$replace_array+$last_part;
				break;
			}
			$position++;
		}
		save_array($filename_file, $filenames_array);
	}
}
//загрузка новой картинки
if(isset($_POST['load'])){
	if(isset($_FILES['file']) && $_FILES['file']['error']==UPLOAD_ERR_OK){//если ошибок загрузки нет
		$file_type=get_type($_FILES['file']['tmp_name']);
		if(in_array($file_type, $types)){ //проверяем соответствует ли тип файла разрешенным вариантам
			end($filenames_array); //идем в конец массива имен файлов
			if(count($filenames_array)==0) $new_key=0; //если массив еще пустой, то первый индекс будет 0
			else $new_key=max(array_keys($filenames_array))+1; //и вычисляем новый индекс массива
			$ext=substr($file_type,strpos($file_type,"/")+1); //расширение файла
			$array_value=$new_key.".".$ext; //значение которое будем хранить в массиве
			$new_filename="i_{$array_value}"; //новое имя файла с номером индекса массива
			$full_thumb_name=$img_path."/"."t_{$array_value}";//имя маленькой картинки с путем
			$filenames_array[]=$array_value; //запишем в массив новое значение
			$full_name=$img_path."/".$new_filename; //полный путь к новой картинке
			$txt_filename=$img_path."/t_".$new_key; //имя текстового файла с описанием
			if(move_uploaded_file($_FILES['file']['tmp_name'], $full_name)) file_put_contents($filename_file, serialize($filenames_array)); // сохраним файал и запишем массив имен в файл
			create_thumb($full_name,$full_thumb_name);
			if($_POST['description']!='') file_put_contents($txt_filename, htmlspecialchars(trim($_POST['description']),ENT_QUOTES)); //преобразуем текст, чтобы не поломался html код
			header("Location: index.php");
			die();
		}
		else $err[]=ERR_FORMAT_RESTR;
	}
	else{
		switch($_FILES['file']['error']){ //обработка ошибок загрузки
			case UPLOAD_ERR_INI_SIZE:
				$err[]=ERR_TOO_LARGE;
				break;
			case UPLOAD_ERR_FORM_SIZE:
				$err[]=ERR_TOO_LARGE;
				break;
			case UPLOAD_ERR_NO_FILE:
				$err[]=ERR_NO_FILE;
				break;
			default:
				$err[]=ERR_OTHER;
		}
	}
}
//загрузка картинок
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <title>Домашнее задание. Урок 6</title>
</head>
	<body>
	<h1>Галерея</h1>
	<div class="col1">
	<form action="index.php" method="post" enctype="multipart/form-data">
		<h3>Новая фотография для загрузки</h3>
		<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
		<input type="file" name="file" /><br />
		Краткое описание файла. Будет выведено во всплывающем окошке.<br />
		<textarea name="description"><?php echo isset($_POST['description'])? $_POST['description'] : ''?></textarea><br />
		<input type="submit" name="load" value="Загрузить" />
	</form>
	<div class="err"><?php
	if(count($err)>0) echo implode("<br />",$err);
	?>
	<br /><a href="?sort=<?php echo ASC?>">Сортировать: последние в конце</a>
	<br /><a href="?sort=<?php echo DESC?>">Сортировать: последние в начале</a>
	<br /><br /><br /><a href="?deleteall">Очистить все</a>
	</div>
	</div>
	<div class="col2">
		<?php 
			$index_to_delete=array();
			foreach ($filenames_array as $key => $value) {
				if(!is_file("{$img_path}/i_{$value}")){ //если файла по какой-то причине не нашлось, то надо убрать его из массива
					$index_to_delete[]=$key;
					@unlink("{$img_path}/t_{$value}");//удалим миниатюру на всякий случай тоже
					@unlink("{$img_path}/t_{$key}");//и описание
				}
				else{
					if(is_file("{$img_path}/t_{$key}")) $alt=file_get_contents("{$img_path}/t_{$key}"); // если есть файл с описанием выводим его в title картинки
					else $alt="{$img_path}/t_{$value}";
				?>
					<div class="item">
						<div class="img">
							<a target="_blank" href="<?php echo "{$img_path}/i_{$value}"?>">
								<img src="<?php echo "{$img_path}/t_{$value}"?>" alt="<?php echo $alt?>" title="<?php echo $alt?>" />
							</a>
						</div>
						<a href="?left=<?php echo $key?>" class="left"></a>
						<a href="?right=<?php echo $key?>" class="right"></a>
						<a href="?delete=<?php echo $key?>" class="delete">X</a>
					</div>
				<?php 
				}
			}
			if(count($index_to_delete)>0){ //удалим пропавшие файлы из массива
				foreach ($index_to_delete as $value) {
					unset($filenames_array[$value]);
				}
				file_put_contents($filename_file, serialize($filenames_array));
			}
		?>
	</div>
	</body>
</html>