<?php
session_start();
require_once 'connect.php';
if ($_POST['answer']==1){
    $tmp = $connection->prepare('insert into appeal(date_of_the_application, complaints, id_patient, id_doctor) values (?,?,?,?)');
    $tmp->execute([date("d.m.Y"), $_POST['complaints'], $_POST['id_patient'], $_POST['id_doctor']]);
    $_SESSION['message_good'] = 'Новое обращение было создано.';
    header('Location: ../profile.php');
}
elseif ($_POST['answer']==0){

    $phone = '8' . rand(1000000000,9999999999);

    $dob = new DateTime($_POST['DOB']);
    $now = new DateTime();
    $age = $dob->diff($now)->format("%y");

    $tmp = $connection->query("select register_number from register where login_register='Registratura' and password_register='a49ca48de3824a5dcb12ce740720802e'");
    $result = $tmp->fetch(PDO::FETCH_ASSOC);
    $id_register = $result['register_number'];

    $tmp = $connection->prepare('insert into patient(age, gender, full_name, dob, phone, insurance_policy_number, register_number) values (?,?,?,?,?,?,?)');
    $tmp->execute([$age, $_POST['sex'], $_POST['full_name'], $_POST['DOB'], $phone, $_POST['polis'], $id_register]);

    $tmp = $connection->prepare('select id_patient from patient where insurance_policy_number=?');
    $tmp->execute([$_POST['polis']]);
    $result = $tmp->fetch(PDO::FETCH_ASSOC);
    $id_patient = $result['id_patient'];

    $tmp = $connection->prepare('insert into patient_health_features(id_patient, allergy, disability, chronic_diseases, health_status) values (?,?,?,?,?)');
    $tmp->execute([$id_patient, $_POST['allergy'], $_POST['disability'], $_POST['disease'], $_POST['health']]);

    $tmp = $connection->prepare('insert into appeal(date_of_the_application, complaints, id_patient, id_doctor) values (?,?,?,?)');
    $tmp->execute([date("d.m.Y"), $_POST['complaints'], $id_patient, $_POST['id_doctor']]);

    $_SESSION['message_good'] = 'Анкетирование пациента и создание обращения прошли успешно.';
    header('Location: ../profile.php');
}