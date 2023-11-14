<?php 

    $connect = mysqli_connect('localhost', 'root', '', 'online_store_db');

    if (!$connect) {
        die('Подключение к базе данных не удалось.');
    }

?>