<?php

    session_start();
    require_once('connect.php');

    $userId = $_SESSION['user']['id'];
    $query = "SELECT * FROM `stores` WHERE `user_id` = ?";
    $stmtStores = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmtStores, "i", $userId);
    mysqli_stmt_execute($stmtStores);
    $storesResult = mysqli_stmt_get_result($stmtStores);

    if ($stores = mysqli_fetch_assoc($storesResult)) {
        $storeId = $stores['id'];
        $storeName = $stores['name'];
        $storeAddress = $stores['address'];
        $storeHours = $stores['hours'];
    }

    mysqli_stmt_close($stmtStores);

?>
