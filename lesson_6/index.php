<?php include_once("upload.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Galery</title>
    <style>
   header{text-align: center;}
    .picture  img{width: 200px; height: 200px;}
    .ssilka  {width: 200px; float: left; margin-left: 5px; text-align: center;}
    .main {height: 500px; width: 850px; position: relative; left: 0; top: 0; right: 0; bottom: 0; margin: auto; text-align: center;}
        body {text-align: center;}
  </style>
</head>
<header><h1>Фото галерея</h1></header>
<body>



   
   <?php
  $dir = 'uploads/'; // Папка с изображениями
  $cols = 4 ; // Количество столбцов при создании таблицы
  $files = scandir($dir); // все изображения из папки
  echo "<table>"; // начало таблицы
  $k = 0; // счетчик картинок в троке
  for ($i = 0; $i < count($files); $i++) { // Перебираем все файлы
    if (($files[$i] != ".") && ($files[$i] != "..")) { // Текущий каталог и родительский пропускаем
      if ($k % $cols == 0) echo "<tr>"; // Добавляем новую строку
      echo "<td>"; // Начинаем столбец
      $path = $dir.$files[$i]; // Получаем путь к картинке
      echo "<a href='$path' target='_blank'>"; // Делаем ссылку на картинку
      echo "<img src='$path' alt='' width='100' />"; // Вывод превью картинки
      echo "</a>"; // Закрываем ссылку
      echo "</td>"; // Закрываем столбец
      if ((($k + 1) % $cols == 0) || (($i + 1) == count($files))) echo "</tr>";//переход на следеющею строку при заполнении
      $k++; // Увеличиваем  счётчик картинок в троке.
    }
  }
  echo "</table>"; // Закрываем таблицу
?>
   
   
   
    </body>
</html>