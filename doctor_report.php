<?php
session_start();
require_once 'backend/connect.php';
$mas = array();
$tmp = $connection->prepare('select distinct P.full_name, P.gender, P.age, P.insurance_policy_number 
                                            from appeal as A inner join patient as P on A.id_patient=P.id_patient 
                                                where A.id_doctor=?');
$tmp->execute([$_GET['id_doctor']]);
$result = $tmp->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)  {
    array_push($mas,$row);
}
$tmp = $connection->prepare('select distinct count(P.id_patient) as num
                                        from appeal as A inner join patient as P on A.id_patient=P.id_patient 
                                            where A.id_doctor=?');
$tmp->execute([$_GET['id_doctor']]);
$res = $tmp->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Отчёт</title>
</head>
<body class="body_doctor_report">
<button type="submit" class="btn btn-success btn-save-report">Сохранить отчёт в PNG</button>
<?php echo '<a href="profile.php" class="btn btn-danger btn-return" style="width: 220px">Вернуться в профиль</a> 
<a href="show_doctor.php" class="btn btn-warning btn-return-list" style="width: 220px">Вернуться к списку врачей</a>
    <div class="form_report_doctor">   
        <h2 style="display: flex;flex-direction: column;align-items: center;">Сводка о враче "'.$_GET['fio'].'" </h2>
        <h4 style="display: flex;flex-direction: column;align-items: center;">Список пациентов, лечением которых занимался врач (всего '.$res['num'].')</h4>
        <table class="table">
                <thead>
                        <tr>
                            <th >ФИО пациента</th>
                            <th >Пол</th>
                            <th >Возраст</th>
                            <th >Номер страхового полиса</th>
                        </tr>
                </thead>';
                foreach ($mas as $bow)    {
                    echo '
                    <tr>          
                        <td> '.$bow['full_name'].'</td>
                        <td> '.$bow['gender'].' </td>
                        <td> '.$bow['age'].' </td>   
                        <td> '.$bow['insurance_policy_number'].' </td>             
                </tr>';}?>
        </table>
    <?php echo '<p>Информация актуальна на '.date('d.m.Y H:i').'</p>
    </div>'; ?>
</body>
<script src="js/doctor_report.js"></script>
<script src="js/html2canvas.js"></script>
</html>

