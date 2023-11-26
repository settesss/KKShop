<?php 

    session_start();

    require_once("connect.php");

    $storeName = strip_tags(trim($_POST['name']));
    $storeAddress = strip_tags(trim($_POST['address']));
    $storeHours = strip_tags(trim($_POST['hours']));
    $userId = $_SESSION['user']['id'];

    $query =
    "INSERT 
    INTO `stores`(`name`, `address`, `hours`, `user_id`) 
    VALUES ('$storeName','$storeAddress','$storeHours','$userId')";

    mysqli_query($connect, $query);

    $currentUrl = $_SERVER['HTTP_REFERER'];

    header("Location: $currentUrl");

?>