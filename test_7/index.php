<?php
header("Content-type: text/html; charset=utf-8");

define("MYSQL_SERVER","localhost");
define("MYSQL_USER","root");
define("MYSQL_PASSWORD","");

define("MYSQL_DB","add_image_db");

$link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD);

mysqli_select_db($link,MYSQL_DB);

mysqli_query($link,"SET NAMES 'utf-8'");

if (isset($_POST['action']))
{
    if ($_POST['action'] === 'add') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $content = $_POST['content'];
        $query = "
INSERT INTO `images` (
`id` ,
`title` ,
`description` ,
`content`
)

VALUES (
NULL ,  '{$title}', '{$description}','{$content}' 
);";
        $result = mysqli_query($link, $query);
    }

    if ($_POST['action']==='delete')
    {
        $id = $_POST['id'];
        $query = "DELETE FROM `image` WHERE `id` = '{$id}'";
        $result = mysqli_query($link,$query);
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Image gallery(test version)</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>
<body>
<h1>image</h1>
<table class="table">

    <?php
    $result = mysqli_query($link,"SELECT * FROM `images`");
    $num = 0;
    while($row = mysqli_fetch_assoc($result))
    {
    $num++;
    $id = $row['id'];
    $title = $row['title'];
    $description = $row['description'];
    $content = $row['content'];
    ?>
    <tr>
        <td><?php echo $num; ?></td>
        <td><?php echo $title; ?></td>
        <td><?php echo $description; ?></td>
        <td><?php echo $content; ?></td>
        <td><form action="" method="POST"><input name="action" value="delete" type="hidden"/><input name="id" type="hidden" value="<?php echo $id; ?>"/><button class="btn btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i></button></button></form> </td>
    </tr>
<?php

}
?>
</table>
<h2>Добавление нового изображения</h2>
<form action="" method="POST">
    <input type="hidden" name="action" value="add"/>
    <select name="image_id">
<?php
        $result = mysqli_query($link,"SELECT * FROM `images`");

        while($row = mysqli_fetch_assoc($result))
        {
            $id = $row['id'];
            $title = $row['title'];
            echo "<option value=\"{$id}\">$title</option>";
        }

?>

    </select>
    <input type="text" name="title" placeholder="название"/>
    <input type="text" name="description" placeholder="описание"/>
    <input type="file" name="myimage">
    <input  type="submit"name="submit_image"value="Upload">
</form>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>