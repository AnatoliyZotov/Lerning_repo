<?php
// Соединяемся с сервером БД
mysql_connect ( 'localhost', 'root', '' );
mysql_query( 'SET NAMES utf8' );
mysql_select_db ( 'upload' );

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    // Проверяем пришел ли файл
    if( !empty( $_FILES['image']['name'] ) ) {
        // Проверяем, что при загрузке не произошло ошибок
        if ( $_FILES['image']['error'] == 0 ) {
            // Если файл загружен успешно, то проверяем - графический ли он
            if( substr($_FILES['image']['type'], 0, 5)=='image' ) {
                // Создаем превьюшку
                img_resize($_FILES['image']['tmp_name'], $_FILES['image']['tmp_name'].'_small', 100, 100);
                // Читаем содержимое исходного файла
                $img_big = file_get_contents( $_FILES['image']['tmp_name'] );
                // Экранируем специальные символы в содержимом исходного файла
                $img_big = mysql_escape_string( $img_big );
                // Читаем содержимое файла превьюшки
                $img_small = file_get_contents( $_FILES['image']['tmp_name'].'_small' );
                // Экранируем специальные символы в содержимом файла превьюшки
                $img_small = mysql_escape_string( $img_small );
                $title = mysql_escape_string( $_POST['title'] );
                // Формируем запрос на добавление файла в базу данных
                $query="INSERT INTO `images` VALUES(NULL, '".$title."', '".$img_big."', '".$img_small."', '".$_FILES['image']['type']."')";
                // После чего остается только выполнить данный запрос к базе данных
                mysql_query( $query );
            }
        }
    }
    header( 'Location: '.$_SERVER['PHP_SELF'] );
    die();
}

/*
Функция img_resize(): генерация thumbnails
Параметры:
$src - имя исходного файла
$dest - имя генерируемого файла
$width, $height - ширина и высота генерируемого изображения, в пикселях
Необязательные параметры:
$rgb - цвет фона, по умолчанию - белый
$quality - качество генерируемого JPEG, по умолчанию - максимальное (100)
*/
function img_resize($src, $dest, $width, $height, $rgb=0xFFFFFF, $quality=100)
{
    if (!file_exists($src)) return false;

    $size = getimagesize($src);

    if ($size === false) return false;

    // Определяем исходный формат по MIME-информации, предоставленной
    // функцией getimagesize, и выбираем соответствующую формату
    // imagecreatefrom-функцию.
    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
    $icfunc = "imagecreatefrom" . $format;
    if (!function_exists($icfunc)) return false;

    $x_ratio = $width / $size[0];
    $y_ratio = $height / $size[1];

    $ratio = min($x_ratio, $y_ratio);
    $use_x_ratio = ($x_ratio == $ratio);

    $new_width = $use_x_ratio ? $width : floor($size[0] * $ratio);
    $new_height = !$use_x_ratio ? $height : floor($size[1] * $ratio);
    $new_left = $use_x_ratio ? 0 : floor(($width - $new_width) / 2);
    $new_top = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

    // Читаем в память файл изображения с помощью функции imagecreatefrom...
    $isrc = $icfunc($src);
    // Создаем новое изображение
    $idest = imagecreatetruecolor($width, $height);

    // Заливка цветом фона
    imagefill($idest, 0, 0, $rgb);
    // Копируем существующее изображение в новое с изменением размера:
    imagecopyresampled(
        $idest, // Идентификатор нового изображения
        $isrc, // Идентификатор исходного изображения
        $new_left, $new_top, // Координаты (x,y) верхнего левого угла в новом изображении
        0, 0, // Координаты (x,y) верхнего левого угла копируемого блока
        // существующего изображения
        $new_width, // Новая ширина копируемого блока
        $new_height, // Новая высота копируемого блока
        $size[0], // Ширина исходного копируемого блока
        $size[1] // Высота исходного копируемого блока
    );
    // Сохраняем результат в JPEG-файле: функция imagejpeg, может выводить
    // результат своей работы не только в броузер, но и в файл. Для этого
    // следует указать имя файла в необязательном втором параметре.
    // Функция imagejpeg имеет и третий необязательный параметр - качество
    // изображения.
    imagejpeg($idest, $dest, $quality);

    imagedestroy($isrc);
    imagedestroy($idest);

    return true;
}
?>

<html>
<head>
    <title>Загрузка изображений</title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
</head>
<body>
<h1>Загруженные изображения</h1>
<?php
$query = "SELECT id, title FROM images WHERE 1 ORDER BY id";
$res = mysql_query( $query );
while( $img = mysql_fetch_array( $res ) ) {
    // Выводим заголовок
    echo '<h3>'.$img['title'].'</h3>';
    // Выводим изображение
    $title = str_replace( '"', '', $img['title'] );
    echo '<div><a href="image.php?size=big&id='.$img['id'].'" target="_blank">';
    echo '<img src="image.php?size=small&id='.$img['id'].'" alt="'.$title.'" border="0" /></a></div>';
    // Разделительная линия между отдельными изображениями
    echo '<hr>';
}
?>
<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    Наименование: <input type="text" name="title" value="" /><br/>
    Изображение: <input type="file" name="image" /><br/>
    <input type="submit" value="Загрузить" />
</form>
</body>
</html>