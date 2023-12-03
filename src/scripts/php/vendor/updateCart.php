<?php

require_once('connect.php');
require_once('getProductData.php');

$productId = $_GET['productId'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

$query = "SELECT `id`, `product_name`, `image_url`, `price`, `expiration_date` FROM `products` WHERE `id` = '$productId'";
$productInfo = mysqli_query($connect, $query);
$productInCart = mysqli_fetch_assoc($productInfo);

if ($productInCart) {
    session_start();

    $productExistsInCart = false;

    // Проверяем каждый продукт в корзине.
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productInCart['id']) {
            if ($action == 'plus') {
                $item['quantity'] = intval($item['quantity']) + 1;
            } else if ($action == 'minus' && $item['quantity'] > 1) {
                $item['quantity'] = intval($item['quantity']) - 1;
            }
            else if ($action == 'minus' && $item['quantity'] == 1) {
                $key = array_search($item, $_SESSION['cart']);
                unset($_SESSION['cart'][$key]);
            }
            
            $productExistsInCart = true;
            break;
        }
    }

    // Если в корзине не было продуктов, он добавляется.
    if (!$productExistsInCart) {
        $productInCart['quantity'] = 1;
        $_SESSION['cart'][] = $productInCart;
    }

    $currentUrl = $_SERVER['HTTP_REFERER'];

    header("Location: $currentUrl");
} 

?>