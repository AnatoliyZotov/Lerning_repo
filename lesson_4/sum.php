<?php
    if(isset($_POST['a']) && isset($_POST['b']))
        $result = $_POST['a'] + $_POST['b'];
    else
        $result = "";
    ?>

<head>
    <title>Галерея изображений</title>
</head>

<br>
    <form method="post">

        <input type="text" name="a" />
        <select size="3" multiple name="[]">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="/">/</option>
            <option value="*">*</option>
        </select>
        <input type="text" name="b" />
        <input type="submit" value="=" />

        <?php
            echo $result;
        ?>
    </form></br>
   <!--- <form>
        <form action="select1.php" method="post">
            <p><select size="3" multiple name="[]">
                    <option value="+">+</option>
                    <option value="-">-</option>
                    <option value="/">/</option>
                    <option value="*">*</option>
                </select>
            </p>
            <p><input type="submit" value="Отправить"></p>
        </form>
    </form> --->
</body>

</html>