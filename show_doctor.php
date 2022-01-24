<?php
session_start();
require_once 'backend/connect.php';
$array = array();
$stmt = $connection->query('select fio, specialty, id_doctor, login_doc from doctors order by id_doctor');
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Список врачей</title>
</head>
<body class="body_show_doctor">
<?php
echo '<a href="profile.php" class="btn btn-danger btn-return" style="width: 200px">Вернуться в профиль</a>
<div class="form_show_doctor">
    <h2 style="display: flex;flex-direction: column;align-items: center;">Список врачей поликлиники</h2>';
    foreach ($result as $bow){
        array_push($array,$bow);
    }
    if (count($array)>0){
        echo '<table class="table">
                <thead>
                <tr>
                <th >ФИО</th>
                <th >Специальность</th>
                <th >ID</th>
                <th >Логин</th>
                <th >Отчёт</th>
                <th >Редактирование</th>
                <th >Удаление</th>
                </tr>
                </thead>';
        foreach ($array as $bow)    {
            echo '<tr>
                <td><p>'.$bow['fio'].'</p></td>
                <td><p>'.$bow['specialty'].'</p></td>
                <td><p>'.$bow['id_doctor'].'</p></td>
                <td><p>'.$bow['login_doc'].'</p></td>
                <td> <a href="doctor_report.php?id_doctor='.$bow['id_doctor'].'&fio='.$bow['fio'].'"> <button type="submit" class="btn btn-info">Сводка о враче</button> </a> </td>
                <td> <a href="doctor_update.php?id_doctor='.$bow['id_doctor'].'"> <button type="submit" class="btn btn-success">Редактировать данные</button> </a> </td>
                <td> <a href="doctor_delete.php?id_doctor='.$bow['id_doctor'].'&fio='.$bow['fio'].'"> <button type="submit" class="btn btn-warning">Удалить</button> </a> </td>
                </tr>';
        }
    }
    else    {        $_SESSION['message_error'] = 'Врачей в базе пока нет.';    }
    if($_SESSION['message_error'])
        {    echo '<p class="msg_err">' . $_SESSION['message_error'] . '</p>';    }
    unset($_SESSION['message_error']);
    if($_SESSION['message_good'])
        {    echo '<p class="msg_good">' . $_SESSION['message_good'] . '</p>';    }
    unset($_SESSION['message_good']);
    ?>
    </table>
</div>
</body>
</html>