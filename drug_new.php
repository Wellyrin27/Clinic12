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
    <title>Добавление</title>
</head>
<body class="body_drug_new">
<div class="container form_drug_new">
    <form action="backend/drug_new_bak.php" method="post" >
        <h2 style="display: flex;flex-direction: column;align-items: center;">Добавление нового лекарства в БД клиники</h2>
        <div >
            <label for="drug_name">Введите наименование лекарства</label>
            <input type="text"name="drug_name" class="form-control" placeholder="Наименование" required>
        </div>

        <div >
            <label for="description">Напишите описание лекарства (Фармакологические свойства, показания для применения...)</label>
            <input type="text"name="description" class="form-control" placeholder="Описание" required>
        </div>
    <button type="submit" class="btn btn-success" style="margin-top: 2%">Добавить новое лекарство</button>
    </form>
    <a href="drug.php" class="btn btn-danger" style="margin-top: 2%">Вернуться к списку лекарств</a>
</div>
</body>
</html>
