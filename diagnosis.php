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
    <title>Диагноз</title>
</head>
<body class="body_diagnosis">
<a href="profile.php" class="btn btn-danger" style="width: 220px; position: absolute; left: 98%; transform: translate(-98%, 0); ">Вернуться в свой профиль</a>
    <form action="backend/diagnosis_bak.php" method="post" class="container form1">
        <label for="id_disease">Введите ID, диагностированного заболевания, найденное в МКБ-10</label>
        <input type="text" name="id_disease" class="form-control" placeholder="ID заболевания" required>
        <?php echo '<input name="id_appeal" style="display:none;" type="text" value="'.$_GET['id_appeal'].'">'?>
        <button type="submit" class="btn btn-success btn-reg">Диагностировать заболевание</button>
    </form>
    <form action="diagnosis_search.php" method="post" class="container form2">
        <label for="name">Если вы не можете найти ID заболевания или не помните его, введите здесь частичное или полное название заболевания для поиска соответствий в БД</label>
        <input type="text" name="name" class="form-control" placeholder="Частичное или полное название заболевания" required>
        <?php echo '<input name="id_appeal" style="display:none;" type="text" value="'.$_GET['id_appeal'].'">'?>
        <button type="submit" class="btn btn-primary btn-reg">Поиск</button>
    </form>

<?php
$tmp = $connection->query('select * from class_mkb order by id');
$result = $tmp->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $bow) {  array_push($array,$bow);  }
echo '<div class="form_table">
    <h2 style="display: flex;flex-direction: column; align-items: center;">МКБ-10</h2>
    <table class="table">
                <thead>
                <tr>
                <th >ID</th>
                <th >Название</th>
                <th >Класс</th>
                <th >Родительский класс</th>
                <th >Количество потомков</th>
                <th >ID родительского класса</th>
                <th >Дополнительная информация</th>
                </tr>
                </thead>';
    foreach ($array as $bow)
    {
        echo '<tr>
                <td>'.$bow['id'].'</td>
                <td> <p> '.$bow['name'].' </p></td>
                <td> <p> '.$bow['code'].'</p></td>
                <td> <p> '.$bow['parent_code'].' </p></td>
                <td> <p> '.$bow['node_count'].'</p></td>
                <td> <p> '.$bow['parent_id'].' </p></td>
                <td> <p> '.$bow['additional_info'].'</p></td>
                </tr>';}
    ?>
    </table>
</div>
</body>
</html>