<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 31.10.2015
 * Time: 14:43
 */
header("Content-type: text/html; charset=utf-8");

define("MYSQL_SERVER","localhost");
define("MYSQL_USER","root");
define("MYSQL_PASSWORD","");

define("MYSQL_DB","test_db");

$link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD);

mysqli_select_db($link,MYSQL_DB);

mysqli_query($link,"SET NAMES 'utf-8'");
mysqli_query($link,"SET CHARACTER SET 'utf8'");


if (isset($_POST['action']))
{
    if ($_POST['action']==='add')
    {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $middlename = $_POST['middlename'];
        $id_dept = $_POST['id_dept'];

        $query = "
INSERT INTO `person` (
`id` ,
`id_dept` ,
`name` ,
`surname` ,
`middlename`
)
VALUES (
NULL , '{$id_dept}', '{$name}', '{$surname}', '{$middlename}'
);";
        $result = mysqli_query($link,$query);
    }

    if ($_POST['action']==='delete')
    {
        $id = $_POST['id'];
        $query = "DELETE FROM `person` WHERE `id` = '{$id}'";
        $result = mysqli_query($link,$query);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<h1>Сотрудники</h1>
<table class="table">

<?php
$result = mysqli_query($link,"SELECT `person`.*, `departments`.`title` AS `department` FROM `person` JOIN `departments` ON `departments`.`id` = `person`.`id_dept` ORDER BY `person`.`id`");
$num = 0;
while($row = mysqli_fetch_assoc($result))
{
    $num++;
    $id = $row['id'];
    $department = $row['department'];

    $name = $row['name'];
    $surname = $row['surname'];
    $middlename = $row['middlename'];
?>
    <tr>
        <td><?php echo $num; ?></td>
        <td><?php echo $department; ?></td>
        <td><?php echo $surname; ?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $middlename; ?></td>
        <td><form action="" method="POST"><input name="action" value="delete" type="hidden"/><input name="id" type="hidden" value="<?php echo $id; ?>"/><button class="btn btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i></button></button></form> </td>
    </tr>
<?php

}
?>
</table>
<h2>Добавление нового сотрудника</h2>
<form action="" method="POST">
    <input type="hidden" name="action" value="add"/>
    <select name="id_dept">
<?php
$result = mysqli_query($link,"SELECT * FROM `departments`");

while($row = mysqli_fetch_assoc($result))
{
    $id = $row['id'];
    $title = $row['title'];
    echo "<option value=\"{$id}\">$title</option>";
}

?>
    </select>
    <input type="text" name="name" placeholder="Имя"/>
    <input type="text" name="surname" placeholder="Фамилия"/>
    <input type="text" name="middlename" placeholder="Отчество"/>
    <button type="submit" class="btn btn-primary">Добавить</button>
</form>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>

