<?php 

    require_once('connect.php');
    require_once('getProductData.php');

    $productId = $_GET['productId'];
    $query = "SELECT `product_name`, `image_url`, `price`, `expiration_date` FROM `products` WHERE `id` = '$productId'";
    $productInfo = mysqli_query($connect, $query);
    $productInCart = mysqli_fetch_assoc($productInfo);

    if ($productInCart) {
        session_start();
    
        $_SESSION['cart'][] = $productInCart;

        header("Location: ../index.php");
    }

?>