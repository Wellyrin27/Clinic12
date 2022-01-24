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
    <title>Процедура</title>
</head>
<body class="body_storage_procedure">
<?php
if ($_GET['answer']==1){
    echo '<a href="profile.php" class="btn btn-danger btn-return-table" style="width: 200px">Вернуться в профиль</a>
          <a href="storage_procedure_search.php" class="btn btn-warning" style="margin-top: 4%; position: absolute; left: 98%; transform: translate(-98%, 0);">Вернуться к вводу номера страхового полиса</a>
<form action="backend/storage_procedure_bak.php" method="post" class="form_procedure-1">
<h2 style="display: flex;flex-direction: column;align-items: center;">Хранимая процедура</h2>';
    if($_SESSION['message_good'])
    {    echo '<p class="msg_good">' . $_SESSION['message_good'] . '</p>';    }
    unset($_SESSION['message_good']);
    echo '<div class="reg_cont">  
        <label for="complaints">Укажите жалобы пациента на здоровье </label>
        <input type="text"name="complaints" class="form-control" placeholder="Жалобы" required>
    </div>
    <input name="id_doctor" style="display:none;" type="text" value="'.$_GET['id_doctor'].'">
    <input name="id_patient" style="display:none;" type="text" value="'.$_GET['id_patient'].'">
    <input name="answer" style="display:none;" type="text" value="'.$_GET['answer'].'">
    <button type="submit" class="btn btn-success btn-reg">Создать новое обращение</button>
</form>';
}
elseif ($_GET['answer']==0){
    echo '<a href="storage_procedure_search.php" class="btn btn-warning" style="position: absolute; left: 98%; transform: translate(-98%, 0); margin-top: 5%;">Вернуться к вводу номера страхового полиса</a>
<a href="profile.php" class="btn btn-danger btn-return" style="width: 200px;">Вернуться в профиль</a>
<div class="form_procedure-2">
 <h2 style="display: flex;flex-direction: column;align-items: center;">Хранимая процедура</h2>';
    if($_SESSION['message_error'])
    {    echo '<p class="msg_err">' . $_SESSION['message_error'] . '</p>';    }
    unset($_SESSION['message_error']);
    echo '<form action="backend/storage_procedure_bak.php" method="post">    
        <div>
            <label for="full_name">Введите ФИО пациента</label>
            <input type="text"name="full_name" class="form-control" placeholder="ФИО" required>
        </div>

        <div>
            <label for="sex">Выберите пол пациента</label>
            <select name="sex" class="form-control" required>
                <option>Мужской</option>
                <option>Женский</option>
            </select>
        </div>

        <div>
            <label for="DOB">Введите дату рождения пациента</label>
            <input type="date" name="DOB" class="form-control" placeholder="Дата рождения" required>
        </div>

        <div>
            <label for="allergy">Введите аллергии пациента (при наличие)</label>
            <input type="text" name="allergy" class="form-control" placeholder="Аллергия" value="Отсутствует" required>
        </div>

        <div>
            <label for="disability">Выберите группу инвалидности пациента (при наличие)</label>
            <select name="disability" class="form-control" required>
                <option>Отсутствует</option>
                <option>Первая</option>
                <option>Вторая</option>
                <option>Третья</option>
            </select>
        </div>

        <div>
            <label for="disease">Введите хронические заболевания пациента (при наличие)</label>
            <input type="text" name="disease" class="form-control" placeholder="Дата рождения" value="Отсутствует" required>
        </div>

        <div>
            <label for="health">Введите текущее состояние здоровья пациента</label>
            <input type="text" name="health" class="form-control" placeholder="Дата рождения" value="В норме" required>
        </div>
        
        <div>
            <label for="complaints">Укажите жалобы пациента на здоровье </label>
            <input type="text"name="complaints" class="form-control" placeholder="Жалобы" required>
        </div>
        
        <input name="polis" style="display:none;" type="text" value="'.$_GET['polis'].'">
        <input name="id_doctor" style="display:none;" type="text" value="'.$_GET['id_doctor'].'">
        <input name="answer" style="display:none;" type="text" value="'.$_GET['answer'].'">
        
        <button type="submit" class="btn btn-success" style="margin-top: 3%">Зарегистрировать нового пациента и создать обращение</button>
    </form>
</div>';
}?>
</body>
</html>