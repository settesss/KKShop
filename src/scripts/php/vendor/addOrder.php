<?php 

    session_start();

    require_once("connect.php");

    $cart = $_SESSION['cart'];
    $userId = $_SESSION['user']['id'];
    $currentDate = date("Y-m-d");
    $storeId = 1;

    $insertOrderQuery = "INSERT INTO `orders` (store_id, order_date, user_id) VALUES ($storeId, '$currentDate', $userId)";

    mysqli_query($connect, $insertOrderQuery);

    $orderId = mysqli_insert_id($connect);

    $selectOrdersQuery = "SELECT * FROM `orders` WHERE 'id' = '$orderId'";

    $orderResult = mysqli_query($connect, $selectOrdersQuery);

    if ($orderResult) {
        $order = mysqli_fetch_assoc($orderResult);

        foreach ($cart as $product) {
            $productId = $product['id'];
            $productQuantity = $product['quantity'];
    
            $orderItemsQuery = "INSERT INTO `order_items` (order_id, product_id, quantity) VALUES ('$orderId', '$productId', '$productQuantity')";
    
            mysqli_query($connect, $orderItemsQuery);
        }
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>