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
    <title>Рецепт</title>
</head>
<body class="body_anketa">
<div class="form_recipe_delete">
    <form action="backend/recipe_delete_bak.php" method="post" class="signup_form">
        <h2 style="display: flex;flex-direction: column;align-items: center;">Удаление выписанного рецепта</h2>
        <div>
           <?php echo '<label for="answer">Вы уверены, что хотите удалить рецепт на лекарство "'.$_GET['name'].'"?</label>'; ?>
            <select name="answer" class="form-control" required>
                <option>Нет</option>
                <option>Да</option>
            </select>
        </div>
        <?php echo '<input name="id_recipe" style="display:none;" type="text" value="'.$_GET['id_recipe'].'">'?>
        <?php echo '<input name="id_appeal" style="display:none;" type="text" value="'.$_GET['id_appeal'].'">'?>
        <button type="submit" class="btn btn-success" style="margin-top: 2%">Подтвердить</button>
        <?php
        echo '<a href="profile.php" class="btn btn-danger" style="margin-top: 2%">Вернуться в свой профиль</a>';
        ?>
    </form>
</div>
</body>
</html>
