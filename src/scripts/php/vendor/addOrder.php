<?php

    session_start();
    require_once("connect.php");

    $cart = $_SESSION['cart'];
    $userId = $_SESSION['user']['id'];
    $currentDate = date("Y-m-d");

    $insertOrderQuery = "INSERT INTO `orders` (order_date, user_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($connect, $insertOrderQuery);
    mysqli_stmt_bind_param($stmt, "si", $currentDate, $userId);
    mysqli_stmt_execute($stmt);

    $orderId = mysqli_insert_id($connect);

    $selectOrdersQuery = "SELECT * FROM `orders` WHERE id = ?";
    $stmt = mysqli_prepare($connect, $selectOrdersQuery);
    mysqli_stmt_bind_param($stmt, "i", $orderId);
    mysqli_stmt_execute($stmt);
    $orderResult = mysqli_stmt_get_result($stmt);

    if ($orderResult) {
        $order = mysqli_fetch_assoc($orderResult);

        foreach ($cart as $product) {
            $productId = $product['id'];
            $productQuantity = $product['quantity'];

            $orderItemsQuery = "INSERT INTO `order_items` (order_id, product_id, quantity) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($connect, $orderItemsQuery);
            mysqli_stmt_bind_param($stmt, "iid", $orderId, $productId, $productQuantity);
            mysqli_stmt_execute($stmt);

            $updateAccountingQuery = "UPDATE `accounting` SET `quantity` = `quantity` - ? WHERE `product_id` = ?";
            $stmt = mysqli_prepare($connect, $updateAccountingQuery);
            mysqli_stmt_bind_param($stmt, "di", $productQuantity, $productId);
            mysqli_stmt_execute($stmt);
        }
    }

    unset($_SESSION['cart']);

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
