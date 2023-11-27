<?php 

    session_start();
    require_once('connect.php');

    $userId = $_SESSION['user']['id'];
    $query = "SELECT * FROM `stores` WHERE `user_id`='$userId'";
    $storesQuery = mysqli_query($connect, $query);
    
    if ($stores = mysqli_fetch_assoc($storesQuery)) {
        $storeId = $stores['id'];
        $storeName = $stores['name'];
        $storeAddress = $stores['address'];
        $storeHours = $stores['hours'];
    }

?>