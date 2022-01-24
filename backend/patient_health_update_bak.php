<?php
session_start();
require_once 'connect.php';
$stmt = $connection->prepare('update patient_health_features set allergy=?, disability=?, chronic_diseases=?, health_status=? where id_patient = ?');
$stmt->execute([$_POST['allergy'], $_POST['disability'], $_POST['disease'], $_POST['health'], $_POST['id_patient']]);
$_SESSION['message_good'] = 'Данные по здоровью пациента успешно обновлены.';
header('Location: ../profile.php');