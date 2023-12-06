<?php

    session_start();
    require_once('connect.php');
    require_once('getProductData.php');

    $productId = isset($_GET['productId']) ? $_GET['productId'] : '';
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    $accountingQuery = "SELECT `quantity` FROM `accounting` WHERE `product_id` = ?";
    $stmt = mysqli_prepare($connect, $accountingQuery);
    mysqli_stmt_bind_param($stmt, 's', $productId);
    mysqli_stmt_execute($stmt);
    $accountingResult = mysqli_stmt_get_result($stmt);

    if ($accountingData = mysqli_fetch_assoc($accountingResult)) {
        $availableQuantity = $accountingData['quantity'];

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
            $productInfoQuery = "SELECT `id`, `product_name`, `image_url`, `price`, `expiration_date` FROM `products` WHERE `id` = ?";
            $stmtProductInfo = mysqli_prepare($connect, $productInfoQuery);
            mysqli_stmt_bind_param($stmtProductInfo, 's', $productId);
            mysqli_stmt_execute($stmtProductInfo);
            $productInfoResult = mysqli_stmt_get_result($stmtProductInfo);

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