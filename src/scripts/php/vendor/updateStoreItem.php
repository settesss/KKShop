<?php

    require_once("connect.php");

    if (isset($_GET['id']) && isset($_GET['action'])) {
        $productId = $_GET['id'];
        $action = $_GET['action'];
        $currentUrl = $_SERVER['HTTP_REFERER'];

        if ($action === 'increment' || $action === 'decrement') {
            updateQuantity($productId, ($action === 'increment' ? 1 : -1));
            header("Location: $currentUrl#store-block");
            exit();
        } else {
            echo "Неверный запрос!";
        }
    }

    function updateQuantity($productId, $quantityChange) {
        global $connect;

        $query = "UPDATE `accounting` SET `quantity` = GREATEST(0, `quantity` + ?) WHERE `product_id`=?";
        $stmt = mysqli_prepare($connect, $query);
        
        mysqli_stmt_bind_param($stmt, 'is', $quantityChange, $productId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

?>
