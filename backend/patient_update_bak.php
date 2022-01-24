<?php
session_start();
require_once 'connect.php';

$stmt = $connection->prepare('select * from patient where id_patient=?');
$stmt->execute([$_POST['id_pat']]);
$res = $stmt->fetch(PDO::FETCH_ASSOC);

$old_polis = $res['insurance_policy_number'];
$old_phone = $res['phone'];
$tmp = $connection->prepare('select * from patient where insurance_policy_number=?');
$tmp->execute([$old_polis]);
$res = $tmp->fetch(PDO::FETCH_ASSOC);
if ($old_polis!=$_POST['polis'] && $tmp->rowCount() > 0) {
    $_SESSION['message_error'] = 'Пациент с таким номером страхового полиса уже существует в БД клиники!';
    header('Location: ../show_patient.php');
}
$tmp = $connection->prepare('select * from patient where phone=?');
$tmp->execute([$old_phone]);
$res = $tmp->fetch(PDO::FETCH_ASSOC);
if ($old_phone!=$_POST['phone'] && $tmp->rowCount() > 0) {
    $_SESSION['message_error'] = 'Пациент с таким номером телефона уже существует в БД клиники!';
    header('Location: ../show_patient.php');
}
else {

$stmt = $connection->prepare('update patient set gender=?, full_name=?, dob=?, phone=?, insurance_policy_number=? where id_patient = ?');
$stmt->execute([$_POST['sex'], $_POST['fio'], $_POST['dob'], $_POST['phone'], $_POST['polis'], $_POST['id_pat']]);
    $_SESSION['message_good'] = 'Данные пациента успешно обновлены.';
    header('Location: ../show_patient.php');
}

