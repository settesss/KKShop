<?php 

session_start();
require_once("connect.php");

$email = strip_tags(trim($_POST['login']));

$query = "SELECT * FROM `users` WHERE `email` = '$email'";

$checkUser = mysqli_query($connect, $query);

if (mysqli_num_rows($checkUser) > 0) {

    $user = mysqli_fetch_assoc($checkUser);

    $_SESSION['user'] = [
        "id" => $user['id'],
        "fullName" => $user['full_name'],
        "email" => $user['email'],
        "photo" => $user['photo_url'], 
        "phoneNumber" => $user['phone_number'],
        "userType" => $user['user_type'],
    ];

    header("Location: ../../../html/index.html");

} else {
    $_SESSION['message'] = "Неверный логин. Повторите попытку.";
    header('Location: ../login.php');
}

?>