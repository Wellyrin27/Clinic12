<?php
session_start();
require_once 'connect.php';
$stmt = $connection->prepare('select fio, specialty from doctors where fio=? and specialty=?');
$stmt->execute([$_POST['full_name'], $_POST['special']]);
$tmp = $connection->prepare('select login_doc from doctors where login_doc=?');
$tmp->execute([$_POST['login']]);
if($stmt->rowCount() > 0){
    $_SESSION['message_error'] = 'Такой врач уже зарегистрирован в базе поликлиники.';
    header('Location: ../register.php');
}
elseif ($tmp->rowCount() > 0){
    $_SESSION['message_error'] = 'Такой логин уже занят другим пользователем.';
    header('Location: ../register.php');
}
elseif ($_POST['full_name'] == 'Registratura' || $_POST['full_name'] == 'registratura'){
    $_SESSION['message_error'] = 'Такой логин недопустим для регистрации.';
    header('Location: ../register.php');
}
else    {
    if ($_POST['password'] === $_POST['password_confirm'])    {
        $stmt = $connection->prepare('insert into doctors(fio, specialty, login_doc, password_doc) values (?,?,?,?)');
        $stmt->execute([$_POST['full_name'], $_POST['special'], $_POST['login'], md5($_POST['password'])]);
        $_SESSION['message_good'] = 'Регистрация прошла успешно.';
        header('Location: ../index.php');
        }
    else    {
        $_SESSION['message_error'] = 'Пароли не совпадают.';
        header('Location: ../register.php');
        }
}
