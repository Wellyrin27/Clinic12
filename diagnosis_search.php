<?php
session_start();
require_once 'backend/connect.php';
$mas=array();
$tmp = $connection->prepare("select * from class_mkb where name like ?");
$string = '%'.$_POST['name'].'%';
$tmp->execute([$string]);
$res = $tmp->fetchAll(PDO::FETCH_ASSOC);
foreach ($res as $bow) {  array_push($mas,$bow);  };?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Поиск</title>
</head>
<body class="body_diagnosis_search">
<div class="btn-return_diagnosis_search">
    <a href="/profile.php" class="btn btn-danger">Вернуться в свой профиль</a>
    <a href="/diagnosis.php" class="btn btn-warning" style="margin-top: 4%; width: 210px">Вернуться к МКБ-10</a>
</div>
<div class="container">
    <form action="backend/diagnosis_bak.php" method="post" class="container form_diagnosis">
        <label for="id_disease">Введите ID, диагностированного заболевания, найденное в представленном ниже списке</label>
        <input type="text" name="id_disease" class="form-control" placeholder="ID заболевания" required>
        <?php echo '<input name="id_appeal" style="display:none;" type="text" value="'.$_POST['id_appeal'].'">'?>
        <button type="submit" class="btn btn-success" style="margin: 1%">Диагностировать заболевание</button>
        <?php
        if($_SESSION['message_error'])  {   echo '<p class="msg_err">' . $_SESSION['message_error'] . '</p>';    }
        unset($_SESSION['message_error']);
        ?>
    </form>
</div>
<?php
echo '<div class="table_diagnosis">
    <h2 style="display: flex;flex-direction: column;align-items: center;">Результаты поиска по "'.$_POST['name'].'"</h2>
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
            foreach ($mas as $bow)
            {
                echo '<tr>
                        <td>'.$bow['id'].'</td>
                        <td> <p> '.$bow['name'].' </p></td>
                        <td> <p> '.$bow['code'].'</p></td>
                        <td> <p> '.$bow['parent_code'].' </p></td>
                        <td> <p> '.$bow['node_count'].'</p></td>
                        <td> <p> '.$bow['parent_id'].' </p></td>
                        <td> <p> '.$bow['additional_info'].'</p></td>
                        </tr>';
    }
    ?>
    </table>
</div>
</body>
</html>
