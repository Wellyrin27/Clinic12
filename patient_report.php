<?php
session_start();
require_once 'backend/connect.php';
$mas = array();
$tmp = $connection->prepare('select PHF.allergy, PHF.disability, PHF.chronic_diseases, PHF.health_status, A.application_number, A.date_of_the_application,
                                             A.discharge_date, A.treatment_duration, A.complaints, D.fio
                                                from patient as P inner join patient_health_features as PHF on P.id_patient=PHF.id_patient
                                                left join appeal as A on A.id_patient = P.id_patient
	                                            left join doctors as D on D.id_doctor=A.id_doctor
                                                    where P.id_patient = ? order by A.application_number');
$tmp->execute([$_GET['id_patient']]);
$result = $tmp->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)  {
    array_push($mas,$row);
}
$tmp = $connection->prepare('select count(A.ID_Patient) from patient as P inner join appeal as A on P.id_patient=A.id_patient where A.id_patient=?');
$tmp->execute([$_GET['id_patient']]);
$result = $tmp->fetch(PDO::FETCH_ASSOC);
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
    <title>Отчёт</title>
</head>
<body class="body_report_patient">
<button type="submit" class="btn btn-success btn-save-report">Сохранить отчёт в PNG</button>
<?php echo '<a href="profile.php" class="btn btn-danger btn-return" style="width: 200px">Вернуться в профиль</a>
<div class="form_report_patient">
    <h2 style="display: flex;flex-direction: column;align-items: center;">Сводка о пациенте "'.$_GET['full_name'].'" </h2>
    <h4 style="display: flex;flex-direction: column;align-items: center;">Особенности здоровья пациента </h4>
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
            <td> '.$mas[0]['allergy'].'</td>
            <td> '.$mas[0]['disability'].' </td>
            <td> '.$mas[0]['chronic_diseases'].' </td>
            <td> '.$mas[0]['health_status'].'</td>
        </tr>
    </table>';
    echo '<h4 style="display: flex;flex-direction: column;align-items: center;">Список обращений пациента в клинику (всего '.$result['count'].')</h4>
    <table class="table">
        <thead>
                <tr>
                    <th >Номер обращения</th>
                    <th >Дата обращения</th>
                    <th >Дата выписки</th>
                    <th >Длительность лечения</th>
                    <th >Жалобы</th>
                    <th >ФИО лечащего врача</th>
                </tr>
        </thead>';
        foreach ($mas as $m)
        {
            echo '
            <tr>
                <td>'.$m['application_number'].'</td>
                <td>'.$m['date_of_the_application'].'</td>
                <td>'.$m['discharge_date'].'</td>
                <td>'.$m['treatment_duration'].'</td>
                <td>'.$m['complaints'].'</td>
                <td>'.$m['fio'].'</td>
            </tr>';
        }
    ?>
    </table>
<?php echo '<p>Информация актуальна на '.date('d.m.Y H:i').' </p>'; ?>
</div>
</body>
<script src="js/patient_report.js"></script>
<script src="js/html2canvas.js"></script>
</html>
