<?php
session_start();
require_once 'connect.php';
if ($_POST['answer']=="Да"){
    $stmt = $connection->prepare('delete from diagnosis where id=? and application_number=?');
    $stmt->execute([$_POST['id_diagnosis'], $_POST['id_appeal']]);
    $_SESSION['message_good'] = 'Выбранный диагноз удалён из списка диагностированных заболеваний.';
    header('Location: ../profile.php');
}
elseif ($_POST['answer']=="Нет"){
    $_SESSION['message_error'] = 'Удаление выбранного диагноза отменено.';
    header('Location: ../profile.php');
}