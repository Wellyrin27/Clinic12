<?php
session_start();
require_once 'connect.php';

$stmt = $connection->prepare('select * from doctors where id_doctor=?');
$stmt->execute([$_POST['id_doc']]);
$res = $stmt->fetch(PDO::FETCH_ASSOC);

$old_login = $res['login_doc'];
$old_password = $res['password_doc'];

$tmp = $connection->prepare('select * from doctors where login_doc=?');
$tmp->execute([$old_login]);
$res = $tmp->fetch(PDO::FETCH_ASSOC);

if ($old_login!=$_POST['login'] && $tmp->rowCount() > 0) {
    $_SESSION['message_error'] = 'Врач с таким логином уже существует в базе поликлиники!';
    header('Location: ../show_doctor.php');
}

if($old_password == $_POST['password']){
    $stmt = $connection->prepare('update doctors set login_doc=?, fio=?, specialty=? where id_doctor = ?');
    $stmt->execute([$_POST['login'], $_POST['fio'], $_POST['specialty'], $_POST['id_doc']]);
    $_SESSION['message_good'] = 'Данные врача успешно обновлены.';
    header('Location: ../show_doctor.php');
}
else{
    $stmt = $connection->prepare('update doctors set login_doc=?, fio=?, specialty=?, password_doc=? where id_doctor = ?');
    $stmt->execute([$_POST['login'], $_POST['fio'], $_POST['specialty'], md5($_POST['password']), $_POST['id_doc']]);
    $_SESSION['message_good'] = 'Данные врача успешно обновлены.';
    header('Location: ../show_doctor.php');
}