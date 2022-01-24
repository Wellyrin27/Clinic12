<?php
session_start();
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
    <title>Процедура</title>
</head>
<body class="body_procedure_search">

<div class="form_procedure_search">
    <form action="backend/storage_procedure_search_bak.php" method="post" class="container">
        <h2 style="display: flex;flex-direction: column;align-items: center;">Создание пациента</h2>
        <div style="width: 400px">
            <input type="text" name="polis" class="form-control" placeholder="Номер полиса" required>
        </div>
        <?php echo '<input name="id_doctor" style="display:none;" type="text" value="'.$_GET['id_doctor'].'">'?>
        <button type="submit" class="btn btn-success" style="margin-top: 2%">Подтвердить</button>
    </form>
    <a href="profile.php" class="btn btn-danger" style="margin-top: 2%">Вернуться в свой профиль</a>
</div>
</body>
</html>
