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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Удаление</title>
</head>
<body class="body_delete_patient">

<div class="container form_delete">
    <form action="backend/appeal_delete_bak.php" method="post" class="signup_form">
        <h2 style="display: flex;flex-direction: column;align-items: center; ">Удаление обращения из базы клиники</h2>
        <div class="del_cont">
            <?php echo '<label for="answer">Вы уверены, что хотите удалить это обращение из БД клиники?</label>'; ?>
            <select name="answer" class="form-control" required>
                <option>Нет</option>
                <option>Да</option>
            </select>
        </div>
        <?php echo '<input name="id_appeal" style="display:none;" type="text" value="'.$_GET['id_appeal'].'">'?>
        <button type="submit" class="btn btn-success btn-del">Подтвердить</button>
    </form>
    <a href="show_appeal.php" class="btn btn-danger" style="margin-top: 2%">Вернуться к списку обращений</a>
</div>
</body>
</html>