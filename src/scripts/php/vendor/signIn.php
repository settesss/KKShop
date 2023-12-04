<?php

    session_start();
    require_once("connect.php");

    $email = mysqli_real_escape_string($connect, strip_tags(trim($_POST['login'])));

    $query = "SELECT * FROM `users` WHERE `email` = '$email'";

    $checkUser = mysqli_query($connect, $query);

    if (!$checkUser) {
        die('Ошибка выполнения запроса: ' . mysqli_error($connect));
    }

    if (mysqli_num_rows($checkUser) > 0) {

        $user = mysqli_fetch_assoc($checkUser);

        $_SESSION['user'] =  ["id" => $user['id']];

        setcookie('fullName', $user['full_name'], time() + 86400, '/');
        setcookie('email', $user['email'], time() + 86400, '/');
        setcookie('photo', $user['photo_url'], time() + 86400, '/');
        setcookie('phoneNumber', $user['phone_number'], time() + 86400, '/');
        setcookie('address', $user['delivery_address'], time() + 86400, '/');
        setcookie('userType', $user['user_type'], time() + 86400, '/');

        if ($user['user_type'] === 'seller') {
            $storeIdQuery = "SELECT `id` FROM `stores` WHERE `user_id` = {$user['id']}";
            $storeIdResult = mysqli_query($connect, $storeIdQuery);

            if (!$storeIdResult) {
                die('Ошибка выполнения запроса: ' . mysqli_error($connect));
            }

            if (mysqli_num_rows($storeIdResult) > 0) {
                $store = mysqli_fetch_assoc($storeIdResult);
                setcookie('store_id', $store['id'], time() + 86400, '/');
            }
        }

        header("Location: /index.php");
        exit();

    } else {
        $_SESSION['message'] = "Неверный логин. Повторите попытку.";
        header('Location: ../login.php');
        exit();
    }

?>