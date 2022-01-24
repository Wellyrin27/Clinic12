<?php
session_start();
require_once 'backend/connect.php';
$stmt = $connection->prepare('select full_name, dob, gender, insurance_policy_number, phone, id_patient from patient where id_patient=?');
$stmt->execute([$_GET['id_patient']]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$mas = array();
foreach ($result as $bow)
{    array_push($mas ,$bow);   }
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
    <form action="backend/patient_update_bak.php" method="post" class="update_form">
        <h2 style="display: flex;flex-direction: column;align-items: center;">Обновление данных пациента</h2>
        <label>Обновите все необходимые данные пациента. Если какие-либо данные не нуждаются в обновлении, оставьте их без изменения.</label>
            <table class="table">
                <thead>
                    <tr>
                    <th>ФИО пациента</th>
                    <th>Пол пациента</th>
                    <th>Дата рождения пациента</th>
                    <th>Номер страхового полиса пациента</th>
                    <th>Номер сотового телефона пациента</th>
                    </tr>
                </thead>
                <?php
                foreach ($mas  as $bow){
                    echo'
                    <tr>
                        <td> <p>'.$bow['full_name'].'</p>
                            <input type="text" name="fio" class="form-control" placeholder="ФИО" value="'.$bow['full_name'].'" required>
                        </td>          
                        <td> 
                            <p> '.$bow['gender'].' </p>                    
                                <select name="sex" class="form-control" class="form-control" required>
                                    <option>Мужской</option>
                                    <option>Женский</option>
                                </select>                           
                        </td>
                        <td> 
                            <p> '.date('d.m.Y', strtotime($bow['dob'])).'</p>
                                <input type="date" name="dob" class="form-control" placeholder="Дата рождения" value="'.date('Y-m-d', strtotime($bow['dob'])).'" required>                           
                        </td>
                        <td>
                            <p> '.$bow['insurance_policy_number'].'</p>
                                <input type="text" name="polis" class="form-control" placeholder="Номер полиса" value="'.$bow['insurance_policy_number'].'" required>       
                        </td>
                        <td> <p>'.$bow['phone'].'</p> 
                            <input type="text" name="phone" class="form-control" placeholder="Номер телефона" value="'.$bow['phone'].'" required>                  
                        </td>    
                    </tr>';
                }?>
            </table>
        <?php echo '<input name="id_pat" style="display:none;" type="text" value="'.$_GET['id_patient'].'">'?>
        <button type="submit" class="btn btn-success btn-upd">Обновить данные пациента</button>
    </form>
    <a href="show_patient.php" class="btn btn-danger" style="margin-top: 1%">Вернуться к списку пациентов и оставить данные без изменений</a>
</div>

</body>
</html>