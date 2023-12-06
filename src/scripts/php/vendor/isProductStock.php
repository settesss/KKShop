<?php

    require_once("connect.php");

    function isProductStock($productId) {
        global $connect;

        $query = "SELECT * FROM `accounting` WHERE `product_id` = ?";
        $statement = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($statement, "i", $productId);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);

        if ($accounting = mysqli_fetch_assoc($result)) {
            return $accounting['quantity'] > 0;
        }

        return false;
    }

?>