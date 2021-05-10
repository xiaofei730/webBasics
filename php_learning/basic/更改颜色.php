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
        if (isset($_POST['button'])) {
            switch ($_POST['color']) {
                case '1':
                    $color = '#FF0000';
                    break;
                case '2':
                    $color = '#009900';
                    break;
                case '3':
                    $color = '#0000FF';
                    break;
            }
            echo <<<str
            <script type="text/javascript">
            window.onload=function(){
                document.getElementById('shi').style.color='$color';
            }
            </script>
            str;
        }
    ?>
    <div id="shi">
        锄禾日当午；<br />
        汗滴禾下土；<br />
        谁知盘中餐；<br />
        粒粒皆辛苦；<br />
    </div>
    <form method="post" action="">
        <select name="color">
            <option value="0">请选择颜色</option>
            <option value="1">红色</option>
            <option value="2">绿色</option>
            <option value="3">蓝色</option>
        </select>
        <input type="submit" name="button" value="更改颜色">
    </form>
</body>
</html>