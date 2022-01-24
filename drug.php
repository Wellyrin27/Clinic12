<?php
session_start();
require_once 'backend/connect.php';
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
    <title>Лекарства</title>
</head>
<body class="body_drug">
<?php
$stmt = $connection->query('select * from drug');
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$array = array();
foreach ($result as $bow)   {   array_push($array,$bow);    }
if (count($array)>0){
    echo '<a href="drug_new.php" class="btn btn-primary" style="margin: 1% 0 0 2%; position: absolute;">Добавить новое лекарство</a>
<div class="form_drug">
    <a href="profile.php" class="btn btn-danger btn-return-table" style="width: 200px">Вернуться в профиль</a>
     <h2 style="display: flex;flex-direction: column;align-items: center;">Список лекарственных препаратов</h2>
     <table class="table">
          <thead>
               <tr>
                   <th >Наименование лекарства</th>
                   <th >Описание</th>
                   <th >Изменение</th>
                   <th >Удаление</th>
               </tr>
          </thead>';
    foreach ($array as $bow){
        echo '<tr>
                <td> <p> '.$bow['drug_name'].' </p> </td>
                <td> <p> '.$bow['description'].'</p> </td>
                <td> <a href="drug_update_next.php?name='.$bow['drug_name'].'"> <button type="submit" class="btn btn-success">Изменить описание</button> </a> </td>
                <td> <a href="drug_delete.php?name='.$bow['drug_name'].'"> <button type="submit" class="btn btn-warning">Удалить</button> </a> </td>
            </tr>';
    }
}
    else    {    $_SESSION['message_error'] = 'Лекарств в базе пока нет.';    }
    if($_SESSION['message_error'])    {    echo '<p class="msg_err">' . $_SESSION['message_error'] . '</p>';    }
    unset($_SESSION['message_error']);
    if($_SESSION['message_good'])    {    echo '<p class="msg_good">' . $_SESSION['message_good'] . '</p>';    }
    unset($_SESSION['message_good']);
    ?>
    </table>
</div>
</body>
</html>
