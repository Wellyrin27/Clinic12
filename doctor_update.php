<?php
session_start();
require_once 'backend/connect.php';
$stmt = $connection->prepare('select fio, specialty, login_doc, password_doc from doctors where id_doctor=?');
$stmt->execute([$_GET['id_doctor']]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$array = array();
foreach ($result as $bow)
{    array_push($array,$bow);   }
?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Обновление</title>
</head>
<body class="body_update_patient_next">
<div class="form_update_patient_next">
    <form action="backend/doctor_update_bak.php" method="post" class="update_form">
        <h2 style="display: flex;flex-direction: column;align-items: center;">Обновление данных врача</h2>
        <label>Обновите все необходимые данные врача, если какие-то данные не нуждаются в обновлении, оставьте их без изменения.
            Если нужно изменить пароль, просто введите новый пароль на естественном языке, зашифруется он автоматически.
            Если изменять пароль не требуется, тогда ничего не меняйте в соостветствующем столбце.</label>
        <table class="table">
            <thead>
            <tr>
                <th>ФИО врача</th>
                <th>Специальность врача</th>
                <th>Логин врача</th>
                <th>Пароль врача</th>
            </tr>
            </thead>
            <?php
            foreach ($array as $bow){
                echo'
                    <tr>
                        <td>'.$bow['fio'].' 
                            <input type="text" name="fio" class="form-control" placeholder="ФИО" value="'.$bow['fio'].'" required>
                        </td> 
                        <td>       
                            <p> '.$bow['specialty'].'
                                <input type="text" name="specialty" class="form-control" placeholder="Специальность" value="'.$bow['specialty'].'" required>
                            </p>
                        </td>
                        <td>       
                            <p> '.$bow['login_doc'].'
                                <input type="text" name="login" class="form-control" placeholder="Логин" value="'.$bow['login_doc'].'" required>
                            </p>
                        </td>    
                        <td>       
                            <p> Текущий зашифрованный пароль
                                <input type="text" name="password" class="form-control" placeholder="Пароль" value="'.$bow['password_doc'].'" required>
                            </p>
                        </td>  
                    </tr>';
            }?>
        </table>
        <?php echo '<input name="id_doc" style="display:none;" type="text" value="'.$_GET['id_doctor'].'">'?>
        <button type="submit" class="btn btn-success btn-upd">Обновить данные врача</button>
    </form>
    <a href="show_doctor.php" class="btn btn-danger" style="margin-top: 1%">Вернуться к списку врачей и оставить данные без изменений</a>
</div>
</body>
</html>