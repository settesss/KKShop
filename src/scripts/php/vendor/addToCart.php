<?php

require_once('connect.php');
require_once('getProductData.php');

$productId = $_GET['productId'];
$query = "SELECT `id`, `product_name`, `image_url`, `price`, `expiration_date` FROM `products` WHERE `id` = '$productId'";
$productInfo = mysqli_query($connect, $query);
$productInCart = mysqli_fetch_assoc($productInfo);

if ($productInCart) {
    session_start();

    $productExistsInCart = false;

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productInCart['id']) {
            if (isset($item['quantity'])) {
                $item['quantity'] = intval($item['quantity']) + 1;
            } else {
                $item['quantity'] = 2; 
            }
            $productExistsInCart = true;
            break;
        }
    }

    if (!$productExistsInCart) {
        $productInCart['quantity'] = 1;
        $_SESSION['cart'][] = $productInCart;
    }

    header("Location: ../index.php");
} 

?>