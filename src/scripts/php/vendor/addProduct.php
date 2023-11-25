<?php 

    require_once("connect.php");

    $productName = strip_tags(trim($_POST['name']));
    $productPrice = strip_tags(trim($_POST['price']));
    $productDescription = strip_tags(trim($_POST['description']));
    $productCategory = $_POST['category'];
    $productExpirationDate = $_POST['date'];
    $image_url = time() . '-' . $_FILES['photo']['name'];
    $currentUrl = $_SERVER['HTTP_REFERER'];
    $path = 'assets/images/cards/' . time() . '-' . $_FILES['photo']['name'];

    if (!move_uploaded_file($_FILES['photo']['tmp_name'], '../../../' . $path)) {
        die("Не удалось загрузить фотографию.");
    }

    $query = 
    "INSERT INTO `products`
    (`product_name`, `category_id`, `image_url`, `description`, `price`, `expiration_date`) 
    VALUES 
    ('$productName','$productCategory','$image_url','$productDescription','$productPrice','$productExpirationDate')";

    mysqli_query($connect, $query);

    header("Location: $currentUrl");

?>