<?php
session_start();
require_once 'connect.php';
if ($_POST['login']=='Registratura'){
    $query = 'select * from register where login_register=? and password_register=?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$_POST['login'], md5($_POST['password'])]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if($count > 0)  {
        $_SESSION['row']['login'] = $result['login_register'];
        header('Location: ../profile.php');
    }
    else    {
        $_SESSION['message_error'] = 'Такие имя логин и пароль не существуют.';
        header('Location: ../index.php');
    }
}
else {
    $query = 'select * from doctors where login_doc=? and password_doc=?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$_POST['login'], md5($_POST['password'])]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $_SESSION['row']['login'] = $result['login_doc'];
        header('Location: ../profile.php');
    } else {
        $_SESSION['message_error'] = 'Такие имя логин и пароль не существуют.';
        header('Location: ../index.php');
    }
}
