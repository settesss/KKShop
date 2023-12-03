<?php
require_once("connect.php");

if (isset($_GET['id']) && isset($_GET['action'])) {
    $productId = $_GET['id'];
    $action = $_GET['action'];
    $currentUrl = $_SERVER['HTTP_REFERER'];

    if ($action === 'increment') {
        updateQuantity($productId, 1);
    } elseif ($action === 'decrement') {
        updateQuantity($productId, -1);
    }

    header("Location: $currentUrl#store-block");
    exit();
} else {
    echo "Неверный запрос!";
}

function updateQuantity($productId, $quantityChange) {
    global $connect;

    $query = "UPDATE `accounting` SET `quantity` = GREATEST(0, `quantity` + $quantityChange) WHERE `product_id`='$productId'";
    mysqli_query($connect, $query);
}
?>