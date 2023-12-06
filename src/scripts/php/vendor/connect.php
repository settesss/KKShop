<?php 

    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'online_store_db');

    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$connect) {
        die('Подключение к базе данных не удалось. Ошибка: ' . mysqli_connect_error());
    }
    
?>