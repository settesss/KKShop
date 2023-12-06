<?php

    require_once("connect.php");

    $orderId = $_GET['order_id'];

    $orderDataQuery = "SELECT `order_date` FROM `orders` WHERE `id` = ?";
    $stmtOrderData = mysqli_prepare($connect, $orderDataQuery);
    mysqli_stmt_bind_param($stmtOrderData, "i", $orderId);
    mysqli_stmt_execute($stmtOrderData);
    $orderDataResult = mysqli_stmt_get_result($stmtOrderData);

    if (!$orderDataResult) {
        die('Ошибка выполнения запроса: ' . mysqli_error($connect));
    }

    $orderData = mysqli_fetch_assoc($orderDataResult);
    $orderDate = date_create($orderData['order_date']);
    mysqli_stmt_close($stmtOrderData);

    $orderItemsQuery = "SELECT * FROM `order_items` WHERE `order_id` = ?";
    $stmtOrderItems = mysqli_prepare($connect, $orderItemsQuery);
    mysqli_stmt_bind_param($stmtOrderItems, "i", $orderId);
    mysqli_stmt_execute($stmtOrderItems);
    $orderItemsResult = mysqli_stmt_get_result($stmtOrderItems);

    if (!$orderItemsResult) {
        die('Ошибка выполнения запроса: ' . mysqli_error($connect));
    }

    $orderProducts = [];
    $total = 0;

    while ($orderItems = mysqli_fetch_assoc($orderItemsResult)) {
        $productId = $orderItems['product_id'];

        $orderProductsQuery = "SELECT `id`, `product_name`, `image_url`, `price` FROM `products` WHERE `id` = ?";
        $stmtOrderProducts = mysqli_prepare($connect, $orderProductsQuery);
        mysqli_stmt_bind_param($stmtOrderProducts, "i", $productId);
        mysqli_stmt_execute($stmtOrderProducts);
        $orderProductsResult = mysqli_stmt_get_result($stmtOrderProducts);

        if (!$orderProductsResult) {
            die('Ошибка выполнения запроса: ' . mysqli_error($connect));
        }

        $product = mysqli_fetch_assoc($orderProductsResult);
        mysqli_stmt_close($stmtOrderProducts);

        $productQuantity = $orderItems['quantity'];
        $product['quantity'] = intval($productQuantity);

        $orderProducts[] = $product;

        $total += $product['price'] * $productQuantity;
    }

    mysqli_free_result($orderItemsResult);
    mysqli_stmt_close($stmtOrderItems);

?>
