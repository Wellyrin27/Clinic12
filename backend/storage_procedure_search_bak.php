<?php
session_start();
require_once 'connect.php';

$tmp = $connection->prepare('select * from patient where insurance_policy_number=?');
$tmp->execute([$_POST['polis']]);
$res = $tmp->fetch(PDO::FETCH_ASSOC);
if($tmp->rowCount()>0){
    $answer = 1;
    $_SESSION['message_good'] = 'Пациент с таким номером страхового полиса уже существует в базе поликлиники, это "'.$res['full_name'].'", поэтому для создания нового обращения, вам осталось только записать его жалобы на здоровье.';
    header('Location: ../storage_procedure.php?answer='.$answer.'&id_doctor='.$_POST['id_doctor'].'&id_patient='.$res['id_patient'].'');
}
else{
    $answer = 0;
    $_SESSION['message_error'] = 'Пациент с таким номером страхового полиса не существует в базе поликлиники. Вам необходимо провести его анкетирование и записать жалобы, после чего будет создано его обращение.';
    header('Location: ../storage_procedure.php?answer='.$answer.'&id_doctor='.$_POST['id_doctor'].'&polis='.$_POST['polis'].'');
}