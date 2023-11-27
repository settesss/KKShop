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
        "address" => $user['delivery_address'],
        "userType" => $user['user_type'],
    ];

    if ($user['user_type'] === 'seller') {
        $storeIdQuery = "SELECT `id` FROM `stores` WHERE `user_id` = {$user['id']}";
        $storeIdResult = mysqli_query($connect, $storeIdQuery);

        if (mysqli_num_rows($storeIdResult) > 0) {
            $store = mysqli_fetch_assoc($storeIdResult);
            $_SESSION['user']['store_id'] = $store['id'];
        }
    }

    header("Location: /index.php");

} else {
    $_SESSION['message'] = "Неверный логин. Повторите попытку.";
    header('Location: ../login.php');
}

?>