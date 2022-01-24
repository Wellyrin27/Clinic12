<?php
session_start();
require_once 'connect.php';
$stmt = $connection->prepare('select * from drug where drug_name = ?');
$stmt->execute([$_POST['name']]);
if ($stmt->rowCount()>0){
    $stmt = $connection->prepare('insert into recipe(medication_schedule, drug_name, application_number) values (?,?,?)');
    $stmt->execute([$_POST['medication_schedule'],$_POST['name'], $_POST['id_appeal']]);
    $_SESSION['message_good'] = 'Рецепт успешно выписан.';
    header('Location: ../profile.php');
}
else{
    $_SESSION['message_error'] = 'Лекарство с таким наименование не найдено в БД.';
    header('Location: ../recipe.php');
}