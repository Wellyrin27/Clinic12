<?php
session_start();
require_once 'connect.php';
$stmt = $connection->prepare('update drug set description=?');
$stmt->execute([$_POST['description']]);
$_SESSION['message_good'] = 'Описание, выбранного лекарства, успешно обновлено.';
header('Location: ../drug.php');