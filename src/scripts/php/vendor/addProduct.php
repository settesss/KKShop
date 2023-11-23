<?php 

    require_once("connect.php");

    $productName = strip_tags(trim($_POST['name']));
    $productPrice = strip_tags(trim($_POST['price']));
    $productDescription = strip_tags(trim($_POST['description']));

    $path = 'assets/images/cards/' . $_FILES['photo']['name'];
    if (!move_uploaded_file($_FILES['photo']['tmp_name'], '../../../' . $path)) {
        $_SESSION['message'] = "Не удалось загрузить фотографию.";
    }

    print_r($_POST);

?>