<?php
session_start();
require_once 'connect.php';
$mas = array();
if ($_POST['answer']=='Да'){
    $stmt = $connection->prepare('select * from patient as P inner join appeal as A on P.id_patient = A.id_patient where P.id_patient=?');
    $stmt->execute([$_POST['id_patient']]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $bow)   {   array_push($mas,$bow);    }
        if (count($mas)>0) {
            foreach ($mas as $bow) {
                $qwe = $connection->prepare('delete from appeal where application_number = ?');
                $qwe->execute([$bow['application_number']]);
            }
        }
        $stmt = $connection->prepare('delete from patient where id_patient = ?');
        $stmt->execute([$_POST['id_patient']]);

        $_SESSION['message_good'] = 'Удаление пациента из БД клиники прошло успешно.';
        header('Location: ../show_patient.php');
}
elseif ($_POST['answer']=='Нет'){
    $_SESSION['message_error'] = 'Удаление пациента из БД отменено.';
    header('Location: ../show_patient.php');
}