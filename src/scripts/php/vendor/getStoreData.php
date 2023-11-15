<?php 

    require_once('connect.php');

    $query = "SELECT * FROM `stores`";
    $storesQuery = mysqli_query($connect, $query);
    $stores = mysqli_fetch_assoc($storesQuery);

    if ($stores) {
        $storeName = $stores['store_name'];
        $storeAddress = $stores['store_address'];
        $storeHours = $stores['store_hours'];
    }

?>