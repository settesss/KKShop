<?php

    session_start();
    require_once("connect.php");

    if (isset($_SESSION['user']) && isset($_COOKIE['userType'])) {
        $userType = $_COOKIE['userType'];
        $userId = $_SESSION['user']['id'];
        $currentUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';

        if ($userType === "buyer") {
            $newType = "seller";
        } else if ($userType === "seller") {
            $newType = "buyer";
            $updateQuantityQuery = "UPDATE `accounting`
                JOIN `stores` ON accounting.store_id = stores.id
                SET accounting.quantity = 0
                WHERE stores.user_id = ?";
            $stmt = mysqli_prepare($connect, $updateQuantityQuery);

            if (!$stmt) {
                die(mysqli_error($connect));
            }

            mysqli_stmt_bind_param($stmt, 'i', $userId);
            $updateQuantityResult = mysqli_stmt_execute($stmt);

            if (!$updateQuantityResult) {
                die(mysqli_error($connect));
            }

            mysqli_stmt_close($stmt);
        }

        setcookie('userType', $newType, time() + 86400, '/');

        $updateUserTypeQuery = "UPDATE `users` SET user_type=? WHERE id=?";
        $stmt = mysqli_prepare($connect, $updateUserTypeQuery);

        if (!$stmt) {
            die(mysqli_error($connect));
        }

        mysqli_stmt_bind_param($stmt, 'si', $newType, $userId);
        $updateUserTypeResult = mysqli_stmt_execute($stmt);

        if (!$updateUserTypeResult) {
            die(mysqli_error($connect));
        }

        mysqli_stmt_close($stmt);

        header("Location: $currentUrl");
    }

?>