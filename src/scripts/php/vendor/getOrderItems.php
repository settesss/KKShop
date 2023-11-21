<?php 

    require_once("connect.php");

    $orderId = $_GET['order_id'];
    $orderDataQuery = "SELECT `order_date` FROM `orders` WHERE `id` = '$orderId'";
    $orderDataResult = mysqli_query($connect, $orderDataQuery);
    $orderData = mysqli_fetch_assoc($orderDataResult);
    $orderDate = date_create($orderData['order_date']);

    $orderItemsQuery = "SELECT * FROM `order_items` WHERE `order_id` = $orderId";
    $orderItemsResult = mysqli_query($connect, $orderItemsQuery);

    $orderProducts = [];

    while ($orderItems = mysqli_fetch_assoc($orderItemsResult)) {

        $productId = $orderItems['product_id'];
        $orderProductsQuery = "SELECT `id`,`product_name`,`image_url`,`price` FROM `products` WHERE `id` = '$productId'";
        $orderProductsResult = mysqli_query($connect, $orderProductsQuery);
        $orderProducts[] = mysqli_fetch_assoc($orderProductsResult);
        $productQuantity = $orderItems['quantity'];

    }
?>