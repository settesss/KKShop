<?php

    session_start();
    require_once("connect.php");

    $fullName = mysqli_real_escape_string($connect, strip_tags(trim($_POST['full_name'])));
    $email = mysqli_real_escape_string($connect, strip_tags(trim($_POST['email'])));
    $password = strip_tags(trim($_POST['password']));
    $passwordConfirm = strip_tags(trim($_POST['password_confirm']));
    $phoneNumber = mysqli_real_escape_string($connect, strip_tags(trim($_POST['phone_number'])));
    $userType = $_POST['user_type'];

    if ($password === $passwordConfirm) {
        
        if ($_FILES['photo']['size'] > 0) {
            $path = 'uploads/' . time() . $_FILES['photo']['name'];
        
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], '../../../' . $path)) {
                $_SESSION['message'] = "Не удалось загрузить фотографию.";
                header('Location: ../register.php');
                exit();
            }
        } else {
            $path = NULL;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $query =
            "INSERT INTO `users` (`id`, `full_name`, `email`, `photo_url`, `phone_number`, `delivery_address`, `user_type`) 
            VALUES (NULL, ?, ?, ?, ?, NULL, ?)";

        $stmt = mysqli_prepare($connect, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssss", $fullName, $email, $path, $phoneNumber, $userType);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $_SESSION['message'] = "Регистрация прошла успешно!";
            header('Location: ../login.php');
            exit();
        } else {
            $_SESSION['message'] = "Ошибка в подготовленном запросе.";
            header('Location: ../register.php');
            exit();
        }
    } else {
        $_SESSION['message'] = "Пароли не совпадают.";
        header('Location: ../register.php');
        exit();
    }

?>