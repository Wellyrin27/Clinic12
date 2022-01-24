<?php
session_start();
require_once 'connect.php';
$stmt = $connection->prepare('insert into drug(drug_name, description) values (?,?)');
$stmt->execute([$_POST['drug_name'], $_POST['description']]);
$_SESSION['message_good'] = 'Новое лекарство успешно добавлено.';
header('Location: ../drug.php');
