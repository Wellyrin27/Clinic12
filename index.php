<?php
session_start();
if($_SESSION['row']){
    header('Location:profile.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <title>Авторизация и регистрация</title>
</head>
<body class="body_index">
<div class="container form_index" >
    <h2 style="display: flex;flex-direction: column;align-items: center;">Авторизация</h2>
    <form action="backend/signin.php" method="post" class="signin_form">
        <div class="form-group row">
            <div class="input-area">
                <input type="text" class="form-control index_form"  placeholder="Введите логин" name="login" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="input-area">
                <input type="password" class="form-control index_form" id="inputPassword3" placeholder="Введите пароль" name="password" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="width: 30%">Войти</button>
    </form>
        <p class="info_cont a">
          <a href="/register.php">Зарегистрироваться</a></span>
        </p>
</div>
<?php
if($_SESSION['message_good'])   {    echo '<p class="msg_good">' . $_SESSION['message_good'] . '</p>'; }
unset($_SESSION['message_good']);
if($_SESSION['message_error'])   {    echo '<p class="msg_err">' . $_SESSION['message_error'] . '</p>'; }
unset($_SESSION['message_error']);
?>
</body>
</html>
