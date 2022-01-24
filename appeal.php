<?php
session_start();
require_once 'backend/connect.php';
if(!$_SESSION['row']){
    header('Location: /');
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
    <title>Обращение</title>
</head>
<body class="body_appeal">
<a href="profile.php" class="btn btn-danger btn-return" style="width: 200px">Вернуться в профиль</a>
<div class="container form_appeal" style="width: 600px;">
    <form action="backend/appeal_bak.php" method="post">
        <h2 style="display: flex;flex-direction: column;align-items: center; text-align: center;">Создание нового обращения</h2>
        <div class="appeal" style="width: 500px;">
            <label for="complaints">Укажите жалобы пациента на здоровье </label>
            <input type="text"name="complaints" class="form-control" placeholder="Жалобы" required>
        </div>

        <div class="appeal">
            <label for="ID_pat">Укажите ID пациента, обратившегося в клинику </label>
            <input type="text"name="ID_pat" class="form-control" placeholder="ID пациента" required>
        </div>

        <div class="appeal">
            <label for="ID_doc">Укажите ID, лечащего, врача </label>
            <input type="text"name="ID_doc" class="form-control" placeholder="ID врача" required>
        </div>
        <button type="submit" class="btn btn-success"style="margin-top: 2%">Создать новое обращение</button>
    </form>
</div>
<?php
if($_SESSION['message_error']){
    echo '<p class="msg_err">' . $_SESSION['message_error'] . '</p>';
}
unset($_SESSION['message_error']);
?>
</body>
</html>
