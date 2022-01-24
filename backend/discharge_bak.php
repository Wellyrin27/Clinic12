<?php
session_start();
require_once 'connect.php';
if ($_POST['answer']=="Да"){
    $tmp = $connection->prepare('select date_of_the_application from appeal where application_number=?');
    $tmp->execute([$_POST['id_appeal']]);
    $res = $tmp->fetchAll(PDO::FETCH_ASSOC);

    $date = new DateTime($res[0]['date_of_the_application']);
    $now = new DateTime();
    $tmp = $connection->prepare('update appeal set discharge_date=?, treatment_duration=? where application_number=?');
    $tmp->execute([date("Y.m.d"), $smth, $_POST['id_appeal']]);

    $_SESSION['message_good'] = 'Выбранный пациент был выписан.';
    header('Location: ../profile.php');
}
elseif ($_POST['answer']=="Нет"){
    $_SESSION['message_error'] = 'Выписка выбранного пациента отменена.';
    header('Location: ../profile.php');
}
