<?php
session_start();
require_once 'connect.php';
if ($_POST['answer']=="Да"){
    $stmt = $connection->prepare('delete from recipe where recipe_number=? and application_number=?');
    $stmt->execute([$_POST['id_recipe'], $_POST['id_appeal']]);
    $_SESSION['message_good'] = 'Выбранный выписанный рецепт был удалён.';
    header('Location: ../profile.php');
}
elseif ($_POST['answer']=="Нет"){
    $_SESSION['message_error'] = 'Удаление выбранного выписанного рецепта было отменено.';
    header('Location: ../profile.php');
}