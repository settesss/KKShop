<?php

    require_once('connect.php');

    function getStoreName($productId) {
        global $connect;

        $query = 
        "SELECT stores.name
        FROM products
        JOIN accounting ON products.id = accounting.product_id
        JOIN stores ON accounting.store_id = stores.id
        WHERE products.id = '$productId'";

        $result = mysqli_query($connect, $query);

        if ($store = mysqli_fetch_assoc($result)) {
            $storeName = $store['name'];
            echo $storeName;
        }
    }

?>