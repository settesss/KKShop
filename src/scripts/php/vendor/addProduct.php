<?php

    session_start();

    require_once("connect.php");

    $productName = strip_tags(trim($_POST['name']));
    $productPrice = strip_tags(trim($_POST['price']));
    $productQuantity = strip_tags(trim($_POST['quantity']));
    $productDescription = strip_tags(trim($_POST['description']));
    $productCategory = $_POST['category'];
    $productExpirationDate = $_POST['date'];
    $image_url = time() . '-' . $_FILES['photo']['name'];
    $currentUrl = $_SERVER['HTTP_REFERER'];
    $path = 'assets/images/cards/' . time() . '-' . $_FILES['photo']['name'];

    if (!move_uploaded_file($_FILES['photo']['tmp_name'], '../../../' . $path)) {
        die("Не удалось загрузить фотографию.");
    }

    $query_products = 
    "INSERT INTO `products`
    (`product_name`, `category_id`, `image_url`, `description`, `price`, `expiration_date`) 
    VALUES 
    ('$productName', '$productCategory', '$image_url', '$productDescription', '$productPrice', '$productExpirationDate')";

    mysqli_query($connect, $query_products);

    $productId = mysqli_insert_id($connect);

    $accountingQuery = "INSERT INTO `accounting`
    (`store_id`, `product_id`, `quantity`, `unit_of_measure`) 
    VALUES 
    ({$_SESSION['user']['store_id']}, '$productId', '$productQuantity', 'шт.')";

    mysqli_query($connect, $accountingQuery);

    header("Location: $currentUrl");

?>