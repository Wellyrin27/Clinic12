<?php
session_start();
if($_SESSION['row']){
    header('Location: profile.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Авторизация и регистрация</title>
</head>
<body class="body_anketa">
<div class="form_register">
<form action="backend/signup.php" method="post" class="signup_form">
    <h2 style="display: flex;flex-direction: column;align-items: center;">Регистрация</h2>
    <div class="reg_cont">
    <input type="text"name="full_name" class="form-control register" placeholder="ФИО" required>
    </div>
    <div class="reg_cont">
        <input type="text" name="special" class="form-control register" placeholder="Специальность" required>
    </div>
    <div class="reg_cont">
        <input type="text" name="login" class="form-control register" placeholder="Логин" required>
    </div>
    <div class="reg_cont">
        <input type="password" name="password" class="form-control register" placeholder="Пароль" required>
    </div>
    <div class="reg_cont">
    <input type="password" name="password_confirm"class="form-control register" placeholder="Подтверждение пароля" required>
    </div>
    <button type="submit" class="btn btn-success "style="margin: 1% 0 2% 0">Зарегистрироваться</button>
    <p class="info_cont a">
        <span>У вас уже есть аккаунт?  <a href="/index.php">Авторизоваться</a></span>
    </p>
    <?php
    if($_SESSION['message_error']){
        echo '<p class="msg_err">' . $_SESSION['message_error'] . '</p>';
    }
    unset($_SESSION['message_error']);
    ?>
</form>
</div>
</body>
</html>
