<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
phpinfo();
    if (!empty($_POST)) {
        var_dump($_FILES);
       echo $_FILES;
    }
?>

<form method="post" action="" enctype="mutipart/form-data">
    <input type="file" name="face">
    <input type="submit" name="button" value="上传">
</form>


</body>
</html>