<?php
session_start();
require_once 'connect.php';
$tmp = $connection->prepare('select * from patient where id_patient=?');
$tmp->execute([$_POST['ID_pat']]);
$stmt = $connection->prepare('select * from doctors where id_doctor=?');
$stmt->execute([$_POST['ID_doc']]);
if ($tmp->rowCount()==0 && $stmt->rowCount()==0){
    $_SESSION['message_error'] = 'Пациента и врача с такими ID нет в БД клиники.';
    header('Location: ../appeal.php');
    exit();
}
elseif ($tmp->rowCount()==0)
{
    $_SESSION['message_error'] = 'Пациента с таким ID нет в БД клиники.';
    header('Location: ../appeal.php');
    exit();
}
elseif ($stmt->rowCount()==0)
{
    $_SESSION['message_error'] = 'Врача с таким ID нет в БД клиники.';
    header('Location: ../appeal.php');
    exit();
}
else
{
$stmt = $connection->prepare('insert into appeal(date_of_the_application, id_patient, id_doctor, complaints) values (?,?,?,?)');
$stmt->execute([date("Y.m.d"), $_POST['ID_pat'], $_POST['ID_doc'], $_POST['complaints']]);
$_SESSION['message_good'] = 'Создание нового обращения прошло успешно.';
header('Location: ../profile.php');
}
