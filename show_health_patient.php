<?php
session_start();
require_once 'backend/connect.php';
$stmt = $connection->prepare('select * 
                                            from patient_health_features as H inner join patient as P on P.id_patient=H.id_patient
                                                where P.id_patient=?');
$stmt->execute([$_GET['id_patient']]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>Здоровье</title>
</head>
<body class="body_show_health">
<div class="form_show_health" style="">
    <form action="backend/patient_health_update_bak.php" method="post" class="update_form">
        <?php echo '<h2 style="display: flex;flex-direction: column;align-items: center;">Особенности здоровья "'.$result['full_name'].'"</h2>
        <label>Если необходимо изменить какие-либо данные, впишите новые значения в соостветствующие поля. Иначе оставьте данные без изменений.</label>
        <table class="table">
            <thead>
                <tr>
                    <th >Аллергии</th>
                    <th >Инвалидность</th>
                    <th >Хронические заболевания</th>
                    <th >Текущее состояние здоровья</th>
                </tr>
            </thead>
                <tr>
                    <td> <p>'.$result['allergy'].' </p>
                    <input type="text" name="allergy" class="form-control" placeholder="Аллергия" value="'.$result['allergy'].'" required>
                    </td>                    
                    <td> <p> '.$result['disability'].' </p>
                     <select name="disability" class="form-control" required>
                        <option>Отсутствует</option>
                        <option>Первая</option>
                        <option>Вторая</option>
                        <option>Третья</option>
                    </select></td>                  
                    <td> <p> '.$result['chronic_diseases'].' </p>
                    <input type="text" name="disease" class="form-control" placeholder="Дата рождения" value="'.$result['chronic_diseases'].'" required>
                    </td>                    
                    <td> <p> '.$result['health_status'].'</p>
                    <input type="text" name="health" class="form-control" placeholder="Дата рождения" value="'.$result['health_status'].'" required>
                    </td>
                </tr>
                </table>'; ?>
        <?php echo '<input name="id_patient" style="display:none;" type="text" value="'.$_GET['id_patient'].'">'?>
        <button type="submit" class="btn btn-success">Обновить данные пациента</button>
    </form>
    <a href="profile.php" class="btn btn-danger" style="margin-top: 1%">Вернуться в профиль и оставить данные без изменений</a>
</div>
</body>
</html>
