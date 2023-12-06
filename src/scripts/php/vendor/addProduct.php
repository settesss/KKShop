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
    $path = 'assets/images/cards/' . time() . '-' . $_FILES['photo']['name'];

    if (!move_uploaded_file($_FILES['photo']['tmp_name'], '../../../' . $path)) {
        die("Не удалось загрузить фотографию.");
    }

    $queryProducts = 
        "INSERT INTO `products`
        (`product_name`, `category_id`, `image_url`, `description`, `price`, `expiration_date`) 
        VALUES 
        (?, ?, ?, ?, ?, ?)";

    $stmtProducts = mysqli_prepare($connect, $queryProducts);
    mysqli_stmt_bind_param($stmtProducts, "sissds", $productName, $productCategory, $image_url, $productDescription, $productPrice, $productExpirationDate);
    mysqli_stmt_execute($stmtProducts);

    $productId = mysqli_insert_id($connect);

    $queryAccounting = "INSERT INTO `accounting`
        (`store_id`, `product_id`, `quantity`, `unit_of_measure`) 
        VALUES 
        (?, ?, ?, 'шт.')";

    $stmtAccounting = mysqli_prepare($connect, $queryAccounting);
    mysqli_stmt_bind_param($stmtAccounting, "iid", $_COOKIE['store_id'], $productId, $productQuantity);
    mysqli_stmt_execute($stmtAccounting);

    header("Location: ../profile.php#store-block");

?>