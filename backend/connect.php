<?php
// $connection = new PDO('pgsql:host=localhost;port=5432;dbname=Clinic34;user=postgres;password=qwerty123');
try {
    // Подключаемся к БД
    $connection = new PDO('pgsql:host=localhost;port=5432;dbname=Clinic34;user=postgres;password=qwerty123');
} catch (PDOException $e) {
    // Если не получилось подключиться к БД, то бросаем исключение
    echo $e;
    die();
}
if(!$connection){
    die('Error connect to db!');
}
