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
    <title>Удаление</title>
</head>
<body class="body_drug_delete">

<div class="form_drug_delete" style="width: 600px; position: absolute; left: 50%; transform: translate(-50%, 0);">
    <form action="backend/drug_delete_bak.php" method="post">
        <h2 style="display: flex;flex-direction: column;align-items: center;">Удаление лекарства из базы клиники</h2>
        <div class="del_cont">
            <?php echo '<label for="answer">Вы уверены, что хотите удалить лекарство "'.$_GET['name'].'" из БД клиники?</label>'; ?>
            <select name="answer" class="form-control" required>
                <option>Нет</option>
                <option>Да</option>
            </select>
        </div>
        <?php echo '<input name="name" style="display:none;" type="text" value="'.$_GET['name'].'">'; ?>
        <button type="submit" class="btn btn-success" style="margin-top: 2%">Удалить лекарство</button>
    </form>
    <a href="drug.php" class="btn btn-danger" style="margin-top: 2%">Вернуться к списку лекарств</a>
</div>
</body>
</html>
