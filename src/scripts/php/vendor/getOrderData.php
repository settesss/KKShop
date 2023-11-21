<?php 

    session_start();

    require_once("./vendor/connect.php");

    $userId = $_SESSION['user']['id'];

    $query = "SELECT `id`,`order_date`,`user_id` FROM `orders` WHERE `user_id` = '$userId'";

    $ordersResult = mysqli_query($connect, $query);

?>