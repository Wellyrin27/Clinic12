<?php
session_start();
require_once 'connect.php';
$stmt = $connection->prepare('select * from class_mkb where id=?');
$stmt->execute([$_POST['id_disease']]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($stmt->rowCount()>0){
    $tmp = $connection->prepare('insert into diagnosis(application_number, id) values (?,?)');
    $tmp->execute([$_POST['id_appeal'], $_POST['id_disease']]);
    $_SESSION['message_good'] = 'Заболевание было диагностировано.';
    header('Location: ../profile.php');
}
else{
    $_SESSION['message_error'] = 'Заболевание с таким id не найдено.';
    header('Location: ../diagnosis.php');
}
