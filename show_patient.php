<?php
session_start();
require_once 'backend/connect.php';
$now = new DateTime();
$array = array();
$stmt = $connection->query('select dob, id_patient from patient');
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
for ($i=0; $i<$stmt->rowCount();$i++){
    $dob = new DateTime($result[$i]['dob']);
    $age = $dob->diff($now)->format("%y");
    $tmp = $connection->prepare('update patient set age =? where id_patient=?');
    $tmp->execute([$age, $result[$i]['id_patient']]);
}
$stmt = $connection->query('select full_name, gender, dob, age, insurance_policy_number, phone, id_patient from patient order by id_patient');
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $bow){
    array_push($array,$bow);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Список пациентов</title>
</head>
<body class="body_show_patient">
<?php
echo '<div class="form_show_patient">
<a href="profile.php" class="btn btn-danger btn-return-table" style="width: 200px">Вернуться в профиль</a>
      <h2 style="display: flex;flex-direction: column;align-items: center;">Список пациентов поликлиники</h2>';
        if (count($array)>0)
        {
            echo '<table class="table">
            <thead>
            <tr>
            <th >ФИО</th>
            <th >Пол</th>
            <th >Дата рождения</th>
            <th >Возраст</th>
            <th >Номер страхового полиса</th>
            <th >Номер сотового телефона</th>
            <th >ID пациента</th>
            <th >Отчёт</th>
            <th >Редактирование</th>
            <th >Удаление</th>
            </tr>
            </thead>';
        foreach ($array as $bow)
        {
            echo '<tr>
            <td> <p>'.$bow['full_name'].'<p></td>
            <td> <p> '.$bow['gender'].' </p></td>
            <td> <p> '.$bow['dob'].' </p></td>
            <td> <p> '.$bow['age'].'</p></td>
            <td> <p> '.$bow['insurance_policy_number'].'</p></td>
            <td> <p> '.$bow['phone'].'</p></td>
            <td> <p> '.$bow['id_patient'].'</p></td>
            <td> <a href="patient_report.php?id_patient='.$bow['id_patient'].'&full_name='.$bow['full_name'].'"> <button type="submit" class="btn btn-info">Сводка о пациенте</button> </a> </td>
            <td> <a href="patient_update_next.php?id_patient='.$bow['id_patient'].'"> <button type="submit" class="btn btn-success">Редактировать данные</button> </a> </td>
            <td> <a href="patient_delete.php?id_patient='.$bow['id_patient'].'&full_name='.$bow['full_name'].'"> <button type="submit" class="btn btn-warning">Удалить</button> </a> </td>
            </tr>';
            }
        }
        else    {   $_SESSION['message_error'] = 'Пациентов в базе пока нет.';    }
        if($_SESSION['message_error'])
            {   echo '<p class="msg_err">' . $_SESSION['message_error'] . '</p>';   }
        unset($_SESSION['message_error']);
        if($_SESSION['message_good'])
            {    echo '<p class="msg_good">' . $_SESSION['message_good'] . '</p>';  }
        unset($_SESSION['message_good']);
        ?>
        </table>
</div>
<?php
?>
</body>
</html>
