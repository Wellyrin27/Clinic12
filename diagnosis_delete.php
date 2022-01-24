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
<body class="body_delete_diagnosis">
<div class="form_diagnosis_delete">
    <form action="backend/diagnosis_delete_bak.php" method="post" class="signup_form">
        <h2 style="display: flex;flex-direction: column;align-items: center;">Удаление поставленного диагноза</h2>
        <div class="del_cont">
           <?php echo '<p><label for="answer">Вы уверены, что хотите удалить "'.$_GET['name'].'" из списка диагностированных заболеваний в данном обращении?</label>'; ?>
            <select name="answer" class="form-control" required>
                <option>Нет</option>
                <option>Да</option>
            </select>
            </p>
        </div>
        <?php echo '<input name="id_diagnosis" style="display:none;" type="text" value="'.$_GET['id_diagnosis'].'">'?>
        <?php echo '<input name="id_appeal" style="display:none;" type="text" value="'.$_GET['id_appeal'].'">'?>
        <button type="submit" class="btn btn-success">Подтвердить</button>
        <?php
        echo '<a href="profile.php" class="btn btn-danger" style="margin-top: 2%">Вернуться в свой профиль</a>';
        ?>
    </form>
</div>
</body>
</html>
