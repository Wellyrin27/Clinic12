<?php
session_start();
if(!$_SESSION['row']){
    header('Location: /');
}
require_once 'backend/connect.php';
$main_mas = array();
$diagnosis_mas = array();
$recipe_mas = array();
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
    <title>Профиль</title>
</head>
<body class="body_profile">
<?php
if ($_SESSION['row']['login']=='Registratura'){
    echo '<a href="backend/logout.php" class="btn btn-danger" style="position: absolute; left: 98%; transform: translate(-98%, 0); margin-top: 2%">Выход</a>
          <div class="profile_register">
            <h2 style="display: flex;flex-direction: column;align-items: center;">Регистратура клиники "Панацея"</h2>
            <a href="anketa.php" class="btn btn-primary btn-register" >Создать нового пациента</a>
            <a href="appeal.php" class="btn btn-primary btn-register">Создать новое обращение в клинику</a>
            <a href="show_patient.php" class="btn btn-info btn-register">Посмотреть список пациентов клиники</a>
            <a href="show_doctor.php" class="btn btn-info btn-register">Посмотреть список врачей клиники</a>
            <a href="show_appeal.php" class="btn btn-info btn-register">Посмотреть список всех обращений в клинику</a>
            <a href="drug.php" class="btn btn-info btn-register">Просмотреть список лекарственных препаратов</a>';
            if($_SESSION['message_error'])
                {    echo '<p class="msg_err">' . $_SESSION['message_error'] . '</p>';    }
            unset($_SESSION['message_error']);
            if($_SESSION['message_good'])
                {    echo '<p class="msg_good">' . $_SESSION['message_good'] . '</p>';    }
            unset($_SESSION['message_good']);
         echo '</div>';

}
else    {
        $tmp = $connection->prepare('select id_doctor, fio from doctors where login_doc=?');
        $tmp->execute([$_SESSION['row']['login']]);
        $res = $tmp->fetch(PDO::FETCH_ASSOC);
        $id_doc = $res['id_doctor'];
        $fio_doc = $res['fio'];
        $tmp = $connection->prepare('select P.id_patient, P.full_name, P.age, P.gender, A.date_of_the_application, A.complaints, A.application_number
                                                    from appeal as A inner join Patient as P on A.id_patient = P.id_patient
                                                        where A.id_doctor=? order by A.application_number');
        $tmp->execute([$id_doc]);
        $res = $tmp->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $row)  {
            array_push($main_mas,$row);
        }
        if (count($main_mas)>0) {
                echo '<div class="table-profile">
                <a href="backend/logout.php" class="btn btn-danger" style="position: absolute; left: 98%; transform: translate(-98%, 0);">Выход</a>
                <a href="storage_procedure_search.php?id_doctor='.$id_doc.'" class="btn btn-primary" style="margin-bottom: 1%; margin-left: 40%">Создать профиль пациента</a>';
                if($_SESSION['message_error'])
                {    echo '<p class="msg_err">' . $_SESSION['message_error'] . '</p>';    }
                unset($_SESSION['message_error']);
                if($_SESSION['message_good'])
                {    echo '<p class="msg_good">' . $_SESSION['message_good'] . '</p>';    }
                unset($_SESSION['message_good']);
                     echo '<h2 style="display: flex;flex-direction: column;align-items: center;">'.$fio_doc.', это список пациентов, проходящих у вас лечение.  </h2>';
                echo '<table class="table">
                <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Возраст</th>
                        <th>Пол</th>
                        <th>Дата обращения</th>
                        <th>Жалобы на здоровье</th>
                        <th>Диагнозы</th>
                        <th>Рецепты</th>
                        <th>Отчёт</th>
                        <th>Выписка</th>
                    </tr>
                </thead>';
                foreach ($main_mas as $bow) {
                    $tmp = $connection->prepare('select discharge_date from appeal where application_number=?');
                    $tmp->execute([$bow['application_number']]);
                    $res = $tmp->fetch(PDO::FETCH_ASSOC);
                    if ($res['discharge_date'] == null)  {
                        echo '<tr>
                        <td><a href="show_health_patient.php?id_patient='.$bow['id_patient'].'">'.$bow['full_name'].'</td></a>
                        <td>' . $bow['age'] . '</td>
                        <td>' . $bow['gender'] . '</td>
                        <td>' . $bow['date_of_the_application'] . '</td>
                        <td><a href="complaints_update.php?id_appeal='.$bow['application_number'].'">'.$bow['complaints'].'</a></td>';
                        #Вывод всех диагнозов текущего обращения
                        $tmp = $connection->prepare('select *
                                                                from diagnosis as D inner join class_mkb as MKB on D.id=MKB.id
                                                                    where D.application_number=? order by MKB.id');
                        $tmp->execute([$bow['application_number']]);
                        $res = $tmp->fetchAll(PDO::FETCH_ASSOC);
                        if ($tmp->rowCount() == 0) {
                            echo '<td> <a href="diagnosis.php?id_appeal=' . $bow['application_number'] . '"> <button type="submit" class="btn btn-secondary"> Диагностировать заболевание </button> </a></td>';
                        } else {
                            foreach ($res as $row) {
                                array_push($diagnosis_mas, $row);
                            }
                            echo '<td>';
                            foreach ($diagnosis_mas as $a) {
                                echo '<a href="diagnosis_delete.php?id_diagnosis=' . $a['id'] . '&id_appeal=' . $bow['application_number'] . '&name='.$a['name'].'"><p> ' . $a['name'] . '</p></a>';
                            }
                            echo '<a href="diagnosis.php?id_appeal=' . $bow['application_number'] . '"> <button type="submit" class="btn btn-secondary">Диагностировать ещё одно заболевание</button> </a></td>';
                        }
                        $diagnosis_mas = array();
                        #Вывод всех выписанных рецептов текущего обращения
                        $tmp = $connection->prepare('select * from recipe where application_number=? order by recipe_number');
                        $tmp->execute([$bow['application_number']]);
                        $res = $tmp->fetchAll(PDO::FETCH_ASSOC);
                        if ($tmp->rowCount() == 0) {
                            echo '<td> <a href="recipe.php?id_appeal=' . $bow['application_number'] . '"> <button type="submit" class="btn btn-secondary"> Выписать рецепт </button> </a></td>';
                        } else {
                            foreach ($res as $gow) {
                                array_push($recipe_mas, $gow);
                            }
                            echo '<td>';
                            foreach ($recipe_mas as $a) {
                                echo '<a href="recipe_delete.php?id_recipe=' . $a['recipe_number'] . '&id_appeal=' . $bow['application_number'] . '&name='.$a['drug_name'].'"><p> ' . $a['drug_name'] . '</p></a>';
                            }
                            echo '<a href="recipe.php?id_appeal=' . $bow['application_number'] . '"> <button type="submit" class="btn btn-secondary">Выписать ещё один рецепт</button> </a></td>';
                        }
                        $recipe_mas = array();
                        echo '<td><a href="patient_report.php?id_patient='.$bow['id_patient'].'&full_name='.$bow['full_name'].'" class="btn btn-info">Сводка о пациенте</a></td>';
                        echo '<td><a href="discharge.php?id_appeal=' . $bow['application_number'] . '&name='.$bow['full_name'].'"> <button type="submit" class="btn btn-warning"> Выписать пациента </button> </a></td>
                              </tr>';
                    }
                }
            echo '</table>';
            }
        else{
                echo '<p style="display: flex;flex-direction: column;align-items: center; color: #ff6167; font-size: large;">'.$fio_doc.', пока нет пациентов, проходящих у вас лечение. </p>
                      <a href="backend/logout.php" class="btn btn-danger" style="position: absolute; left: 98%; transform: translate(-98%, 0);">Выход</a>';
            }
}
?>
</div>
</body>
</html>
