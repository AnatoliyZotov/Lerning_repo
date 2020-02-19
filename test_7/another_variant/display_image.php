
<html>
<body>

<formmethod="GET"action=" ">
<inputtype="file"name="your_imagename">
<inputtype="submit"name="display_image"value="Display">
</form>

</body>
</html>


<?php

$getname= $_GET[' your_imagename '];

echo"<img src = fetch_image.php?name=".$getname." width=200 height=200 >";

?>
