<?php 

session_start();
require_once("connect.php");

$fullName = strip_tags(trim($_POST['full_name']));
$email = strip_tags(trim($_POST['email']));
$password = strip_tags(trim($_POST['password']));
$passwordConfirm = strip_tags(trim($_POST['password_confirm']));
$phoneNumber = strip_tags(trim($_POST['phone_number']));

if ($password === $passwordConfirm) {
        
    $path = 'uploads/' . time() . $_FILES['photo']['name'];
    if (!move_uploaded_file($_FILES['photo']['tmp_name'], '../../../' . $path)) {
        $_SESSION['message'] = "Не удалось загрузить фотографию.";
        header('Location: ../register.php');
    }
        
    $password = md5($password);

    $query = 
    "INSERT INTO `users` (`id`, `full_name`, `email`, `photo_url`, `phone_number`, `delivery_address`, `user_type`) 
    VALUES 
    (NULL, '$fullName', '$email', '$path', '$phoneNumber', NULL, 'buyer')";

    mysqli_query($connect, $query);

    $_SESSION['message'] = "Регистрация прошла успешно!";
    header('Location: ../login.php');

} else {
    $_SESSION['message'] = "Пароли не совпадают.";
    header('Location: ../register.php');
}

?>