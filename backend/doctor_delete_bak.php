<?php
session_start();
require_once 'connect.php';
$mas = array();
if ($_POST['answer']=='Да'){
    $stmt = $connection->prepare('select * from doctors as D inner join appeal as A on D.id_doctor = A.id_doctor where D.id_doctor=?');
    $stmt->execute([$_POST['id_doctor']]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $bow)   {   array_push($mas,$bow);    }
    if (count($mas)>0)    {
        foreach ($mas as $bow) {
            $qwe = $connection->prepare('delete from appeal where application_number = ?');
            $qwe->execute([$bow['application_number']]);
        }
    }
    $stmt = $connection->prepare('delete from doctors where id_doctor = ?');
    $stmt->execute([$_POST['id_doctor']]);

    $_SESSION['message_good'] = 'Удаление доктора из БД клиники прошло успешно.';
    header('Location: ../show_doctor.php');
}
elseif ($_POST['answer']=='Нет'){
    $_SESSION['message_error'] = 'Удаление врача из БД отменено.';
    header('Location: ../show_doctor.php');
}