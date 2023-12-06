<?php

    require_once('connect.php');

    function getStoreName($productId) {
        global $connect;

        $query =
        "SELECT stores.name
        FROM products
        JOIN accounting ON products.id = accounting.product_id
        JOIN stores ON accounting.store_id = stores.id
        WHERE products.id = ?";

        $stmt = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt, "i", $productId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($store = mysqli_fetch_assoc($result)) {
            $storeName = $store['name'];
            echo $storeName;
        }

        mysqli_stmt_close($stmt);
    }

?>
