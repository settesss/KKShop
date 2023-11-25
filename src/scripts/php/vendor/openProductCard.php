<?php

    require_once("getProductData.php");

    $productId = $_GET['productId'];

    $products = getProductData();

    $productSelected = [];

    foreach ($products as $product) {
        if ($product['id'] == $productId) {
            $productSelected = $product;
            break; 
        }
    }

    if (!empty($productSelected)) {
        session_start();
        $_SESSION['productSelected'] = $productSelected;
        header('Location: /src/scripts/php/product.php');
    } else {
        echo "Продукт с ID $productId не найден.";
    }
    
?>