<?php

    session_start();
    require_once("connect.php");

    $storeName = strip_tags(trim($_POST['name']));
    $storeAddress = strip_tags(trim($_POST['address']));
    $storeHours = strip_tags(trim($_POST['hours']));
    $userId = $_SESSION['user']['id'];

    $insertStoreQuery = 
        "INSERT INTO `stores` (`name`, `address`, `hours`, `user_id`) 
        VALUES (?, ?, ?, ?)";

    $stmtStore = mysqli_prepare($connect, $insertStoreQuery);
    mysqli_stmt_bind_param($stmtStore, "sssi", $storeName, $storeAddress, $storeHours, $userId);
    mysqli_stmt_execute($stmtStore);

    $currentUrl = $_SERVER['HTTP_REFERER'];
    header("Location: $currentUrl");

?>