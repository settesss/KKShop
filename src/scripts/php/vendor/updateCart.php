<?php

require_once('connect.php');
require_once('getProductData.php');

$productId = $_GET['productId'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Получаем доступное количество продукта из таблицы accounting
$accountingQuery = "SELECT `quantity` FROM `accounting` WHERE `product_id` = '$productId'";
$accountingResult = mysqli_query($connect, $accountingQuery);

if ($accountingData = mysqli_fetch_assoc($accountingResult)) {
    $availableQuantity = $accountingData['quantity'];

    session_start();

    $productExistsInCart = false;

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId) {
            if (($action == 'increment' && $item['quantity'] < $availableQuantity) ||
                ($action == 'decrement' && $item['quantity'] > 1)) {
                $item['quantity'] = ($action == 'increment') ? intval($item['quantity']) + 1 : intval($item['quantity']) - 1;
            } else if ($action == 'decrement' && $item['quantity'] == 1) {
                $key = array_search($item, $_SESSION['cart']);
                unset($_SESSION['cart'][$key]);
            }

            $productExistsInCart = true;
            break;
        }
    }

    if (!$productExistsInCart) {
        $productInfoQuery = "SELECT `id`, `product_name`, `image_url`, `price`, `expiration_date` FROM `products` WHERE `id` = '$productId'";
        $productInfoResult = mysqli_query($connect, $productInfoQuery);
        $productInCart = mysqli_fetch_assoc($productInfoResult);

        if ($productInCart) {
            $productInCart['quantity'] = 1;
            $_SESSION['cart'][] = $productInCart;
        }
    }

    $currentUrl = $_SERVER['HTTP_REFERER'];

    header("Location: $currentUrl");
} 

?>