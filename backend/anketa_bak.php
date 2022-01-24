<?php
session_start();
require_once 'connect.php';

$dob = new DateTime($_POST['DOB']);
$now = new DateTime();
$age = $dob->diff($now)->format("%y");

$stmt = $connection->prepare('select insurance_policy_number from patient where insurance_policy_number = ?');
$stmt->execute([$_POST['polis']]);
if($stmt->rowCount() > 0)
{
    $_SESSION['message_error'] = 'Пациент с таким номером страхового полиса уже существует в БД клиники.';
    header('Location: ../anketa.php');
}
else
    {
    $stmt = $connection->prepare('insert into patient(full_name, gender, insurance_policy_number, dob, age, phone, register_number) values (?,?,?,?,?,?,?)');
    $stmt->execute([$_POST['full_name'], $_POST['pol'], $_POST['polis'], $_POST['DOB'], $age, $_POST['phone'], $id_register]);
    $_SESSION['message_good'] = 'Анкетирование нового пациента прошло успешно.';
    header('Location: ../profile.php');
}
