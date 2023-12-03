<?php 

    session_start();
    require_once("connect.php");

    if (isset($_SESSION['user']) && isset($_SESSION['user']['userType'])) {
        $userType = $_SESSION['user']['userType'];
        $userId = $_SESSION['user']['id'];
        $currentUrl = $_SERVER['HTTP_REFERER'];

        if ($userType === "buyer") {
            $newType = "seller";
        } else if ($userType === "seller") {
            $newType = "buyer";

            $updateQuantityQuery = "UPDATE `accounting`
            JOIN `stores` ON accounting.store_id = stores.id
            SET accounting.quantity = 0
            WHERE stores.user_id = '$userId'";

            $updateQuantityResult = mysqli_query($connect, $updateQuantityQuery);

            if (!$updateQuantityResult) {
                die(mysqli_error($connect));
            }
        }

        $_SESSION['user']['userType'] = $newType;

        $updateUserTypeQuery = "UPDATE `users` SET user_type='$newType' WHERE id='$userId'";
        $updateUserTypeResult = mysqli_query($connect, $updateUserTypeQuery);

        if (!$updateUserTypeResult) {
            die(mysqli_error($connect));
        }

        header("Location: $currentUrl");
    }

?>