<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-olOxEXxDwd20BlATUibkEnjPN3sVq2YWmYOnsMYutq7X8YcUdD6y/1I+f+ZOq/47" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-NU/T4JKmgovMiPaK2GP9Y+TVBQxiaiYFJB6igFtfExinKlzVruIK6XtKqxCGXwCG" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form action="dologin.php" method="post">
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">账号：</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="username">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">密码：</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="password">
                </div>
            </div>
            <div class="form-group row">
                <button type="submit" class="btn btn-primary">用户登录</button>
            </div>
        </form>
    </div>

</body>
</html>