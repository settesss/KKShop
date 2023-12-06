<?php 

    session_start();
    require_once("./vendor/connect.php");

    $userId = $_SESSION['user']['id'];

    $query = "SELECT `id`, `order_date`, `user_id` FROM `orders` WHERE `user_id` = ?";

    $stmt = mysqli_prepare($connect, $query);

    if (!$stmt) {
        die('Ошибка подготовки запроса: ' . mysqli_error($connect));
    }

    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);


    $ordersResult = mysqli_stmt_get_result($stmt);

?>