<?php
session_start();
require_once 'connect.php';
if ($_POST['answer']=='Да'){

    $tmp = $connection->prepare('delete from drug where drug_name = ?');
    $tmp->execute([$_POST['name']]);

    $_SESSION['message_good'] = 'Удаление лекарства из БД клиники прошло успешно.';
    header('Location: ../drug.php');
}
elseif ($_POST['answer']=='Нет'){
    $_SESSION['message_error'] = 'Удаление лекарства отменено.';
    header('Location: ../drug.php');
}
