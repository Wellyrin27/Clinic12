<?php
session_start();
require_once 'backend/connect.php';
$array = array();
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
<body class="body_recipe">
<a href="profile.php" class="btn btn-danger btn-return-table" style="width: 220px">Вернуться в свой профиль</a>
<div class="form_recipe">
    <form action="backend/recipe_bak.php" method="post" class="signup_form">
        <h2 style="display: flex;flex-direction: column;align-items: center;">Выписка рецепта</h2>
        <div class="reg_cont">
            <label for="name">Введите наименование лекарства</label>
            <input type="text"name="name" class="form-control" placeholder="Наименование" required>
        </div>

        <div class="reg_cont">
            <label for="medication_schedule">Напишите схему приёма лекарства</label>
            <input type="text" name="medication_schedule" class="form-control" placeholder="Схема приёма" required>
        </div>
        <?php echo '<input name="id_appeal" style="display:none;" type="text" value="'.$_GET['id_appeal'].'">'?>
        <button type="submit" class="btn btn-success">Выписать рецепт</button>
</div>
<?php
$stmt = $connection->query("select * from drug");
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $bow)   {   array_push($array,$bow);    }
if($stmt->rowCount()>0){
    echo '<div class="table_recipe" style="background-color: honeydew; position: absolute; padding: 1%; margin: 1%;  text-align: left ">
  <h2 style="display: flex;flex-direction: column;align-items: center;">Список лекарств</h2>
            <table class="table">
            <thead>
            <tr>
            <th >Наименование лекарственного препарата</th>
            <th >Описание</th>
            </tr>
            </thead>';
    foreach ($array as $bow)
    {
        echo '<tr>
            <td>'.$bow['drug_name'].'</td>
            <td> <p> '.$bow['description'].'</p></td>
            </tr>';
    }
    echo '</table>
</div>';
}
else{
    $_SESSION['message_error'] = 'Лекарственных препаратов в базе пока нет.';
}
if($_SESSION['message_error'])
{    echo '<p class="msg_err">' . $_SESSION['message_error'] . '</p>';    }
unset($_SESSION['message_error']);
?>
</body>
</html>