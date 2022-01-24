<?php
session_start();
require_once 'connect.php';
$mas = array();
if ($_POST['answer']=='Да'){
    $qwe = $connection->prepare('delete from appeal where application_number = ?');
    $qwe->execute([$_POST['id_appeal']]);
    $_SESSION['message_good'] = 'Удаление обращения из БД клиники прошло успешно.';
    header('Location: ../show_appeal.php');

}
elseif ($_POST['answer']=='Нет'){
    $_SESSION['message_error'] = 'Удаление обращения отменено.';
    header('Location: ../show_appeal.php');
}