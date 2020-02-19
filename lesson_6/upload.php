<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Galery</title>
    <style>
  
  </style>
</head>
<body>

<form method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="upload"/>
<input type="file" name="userfile" />
<input type="submit" value="Загрузить файл!" />
 </form>

<?php
    
if (count($_POST))
{
    $uploaddir = "./uploads/";
    $uploadfile = $uploaddir.basename($_FILES['userfile']['name']);

    
    if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
    {echo "фаил тип:  ".$_FILES['userfile']['type']. ",   размером:  ".$_FILES['userfile']['size']." байт загружен<br/>";}
    else {echo "ошибка<br/>";}
}
    
    
?>




   
   
   
   
   
   
    </body>
</html>