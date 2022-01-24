<?php
session_start();
require_once 'backend/connect.php';
$array = array();
$stmt = $connection->query('select A.date_of_the_application, A.discharge_date, A.treatment_duration, A.complaints, P.full_name, D.fio, A.application_number 
                                            from appeal as A inner join patient as P on A.id_patient = P.id_patient inner join doctors as D on A.id_doctor=D.id_doctor');
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
    <title>Обращения</title>
</head>
<body class="body_show_appeal">
<?php
echo '<a href="profile.php" class="btn btn-danger btn-return" style="width: 200px">Вернуться в профиль</a>
<div class="form_show_appeal">
    <h2 style="display: flex;flex-direction: column;align-items: center;">Список всех обращений в клинику</h2>';
    foreach ($result as $bow)   {   array_push($array,$bow);    }
    if (count($array)>0)
    {
                echo '<table class="table">
                <thead>               
                <tr>
                <th >Пациент</th>
                <th >Лечащий врач</th>
                <th >Дата обращения</th>
                <th >Дата выписки</th>
                <th >Длительность лечения</th>
                <th >Жалобы на здоровье</th>
                <th >Удаление</th>
                </tr>
                </thead>';
        foreach ($array as $bow)
        {
            echo '<tr>
                <td> <p>'.$bow['full_name'].'</p></td>
                <td> <p> '.$bow['fio'].'</p></td>
                <td> <p> '.$bow['date_of_the_application'].' </p></td>
                <td> <p> '.$bow['discharge_date'].'</p></td>
                <td> <p> '.$bow['treatment_duration'].'</p></td>
                <td> <p> '.$bow['complaints'].'</p></td>
                <td> <a href="appeal_delete.php?id_appeal='.$bow['application_number'].'"> <button type="submit" class="btn btn-warning">Удалить</button> </a> </td>
                </tr>';
        }
    }
    else    {        $_SESSION['message_error'] = 'Обращений в базе пока нет.';    }
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