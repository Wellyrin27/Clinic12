<?php
session_start();
require_once 'backend/connect.php';
$stmt = $connection->prepare('select * from drug where drug_name=?');
$stmt->execute([$_GET['name']]);
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
    <title>Обновление</title>
</head>
<body class="body_drug_update">
<div class="form_drug_update">
    <form action="backend/drug_update_bak.php" method="post">
       <?php echo '<h2 style="display: flex;flex-direction: column;align-items: center;">Изменение описания "'.$result[0]['drug_name'].'"</h2>'; ?>
        <div    >
            <label for="description">Введите новое описание для выбранного лекарства</label>
            <input type="text"name="description" class="form-control" placeholder="Новое описание" required>
        </div>
        <button type="submit" class="btn btn-success" style="margin-top: 2%">Подтвердить изменение</button>
    </form>
    <a href="drug.php" class="btn btn-danger" style="margin-top: 2%">Вернуться к списку лекарств</a>
</div>
</body>
</html>
