<?php
session_start();
require_once 'connect.php';

$stmt = $connection->prepare('update appeal set complaints=? where application_number = ?');
$stmt->execute([$_POST['complaints'], $_POST['id_appeal']]);
$_SESSION['message_good'] = 'Жалобы пациента успешно обновлены.';
header('Location: ../profile.php');