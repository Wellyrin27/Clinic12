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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Анкетирование</title>
</head>
<body class="body_anketa">
<a href="profile.php" class="btn btn-danger btn-return" style="width: 200px">Вернуться в профиль</a>
<div class="form_anketa" style="width: 700px;">
    <form action="backend/anketa_bak.php" method="post">
        <h2 style="display: flex;flex-direction: column;align-items: center;">Создание нового пациента</h2>
        <div class="ank_cont" style="width: 600px">
            <label for="full_name">Введите ФИО пациента</label>
            <input type="text"name="full_name" class="form-control" placeholder="ФИО" required>
        </div>

        <div class="ank_cont">
            <label for="pol">Выберите пол пациента</label>
            <select name="pol" class="form-control" required>
                <option>Мужской</option>
                <option>Женский</option>
            </select>
        </div>

        <div class="ank_cont">
            <label for="polis">Введите номер страхового полиса пациента</label>
            <input type="text" name="polis" class="form-control" placeholder="Номер полиса" required>
        </div>

        <div class="ank_cont">
            <label for="phone">Введите номер телефона пациента</label>
            <input type="text" name="phone" class="form-control" placeholder="Номер телефона" required>
        </div>

        <div class="ank_cont">
            <label for="DOB">Введите дату рождения пациента</label>
            <input type="date" name="DOB" class="form-control" placeholder="Дата рождения" required>
        </div>

        <div class="ank_cont">
            <label for="allergy">Введите аллергии пациента (при наличие)</label>
            <input type="text" name="allergy" class="form-control" placeholder="Аллергия" value="Отсутствует" required>
        </div>

        <div class="ank_cont">
            <label for="disability">Выберите группу инвалидности пациента (при наличие)</label>
            <select name="disability" class="form-control" required>
                <option>Отсутствует</option>
                <option>Первая</option>
                <option>Вторая</option>
                <option>Третья</option>
            </select>
        </div>

        <div class="ank_cont">
            <label for="disease">Введите хронические заболевания пациента (при наличие)</label>
            <input type="text" name="disease" class="form-control" placeholder="Дата рождения" value="Отсутствует" required>
        </div>

        <div class="ank_cont">
            <label for="health">Введите текущее состояние здоровья пациента</label>
            <input type="text" name="health" class="form-control" placeholder="Дата рождения" value="В норме" required>
        </div>
        <button type="submit" class="btn btn-success btn-reg">Зарегистрировать нового пациента</button>
    </form>
</div>
<?php
if($_SESSION['message_error']){
    echo '<p class="msg_err">' . $_SESSION['message_error'] . '</p>';
}
unset($_SESSION['message_error']);

?>
</body>
</html>
