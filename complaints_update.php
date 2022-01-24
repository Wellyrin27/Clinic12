<?php
session_start();
require_once 'backend/connect.php';
$stmt = $connection->prepare('select complaints from appeal where application_number=?');
$stmt->execute([$_GET['id_appeal']]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Обновление</title>
</head>
<body class="body_update_patient_next">
<div class="form_update_patient_next" style="width: 1000px; position: absolute; left: 50%; transform: translate(-50%, 0);">
    <form action="backend/complaints_update_bak.php" method="post" class="update_form">
        <h2 style="display: flex;flex-direction: column;align-items: center;">Обновление жалоб пациента</h2>
            <?php echo ' <p> <lable> Текущие жалобы: '.$result[0]['complaints'].' </lable> </p>
                       <p> <input type="text" name="complaints" class="form-control" placeholder="Жалобы" value="'.$result[0]['complaints'].'" required></p>';?>
        <?php echo '<input name="id_appeal" style="display:none;" type="text" value="'.$_GET['id_appeal'].'">'?>
        <button type="submit" class="btn btn-success" style="margin-right: 1%">Обновить</button>
    </form>
    <a href="profile.php" class="btn btn-danger" style="margin-top: 2%">Вернуться в профиль и оставить данные без изменений</a>
</div>
</body>
</html>