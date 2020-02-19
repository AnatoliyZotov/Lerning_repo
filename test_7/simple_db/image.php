<?php
// Соединяемся с сервером БД
mysql_connect ( 'localhost', 'root', '' );
mysql_query( 'SET NAMES utf8' );
mysql_select_db ( 'upload' );

$size = 'big';
if ( isset( $_GET['size'] ) and $_GET['size'] == 'small' ) $size = 'small';

if ( isset( $_GET['id'] ) ) {
    // Здесь $id номер изображения
    $id = (int)$_GET['id'];
    if ( $id > 0 ) {
        $query = "SELECT `img_".$size."`, `mimetype` FROM `images` WHERE `id`=".$id;
        // Выполняем запрос и получаем файл
        $res = mysql_query($query);
        if ( mysql_num_rows( $res ) == 1 ) {
            $image = mysql_fetch_array($res);
            // Отсылаем браузеру заголовок, сообщающий о том, что сейчас будет передаваться файл изображения
            if ( $size == 'big' )
                header('Content-type: '.$image['mimetype']);
            else
                header('Content-type: image/jpeg');
            // И  передаем сам файл
            echo $image['img_'.$size];
        }
    }
}
?>