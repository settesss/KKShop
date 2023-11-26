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
        }

        $_SESSION['user']['userType'] = $newType;

        $query = "UPDATE `users` SET user_type='$newType' WHERE id='$userId'";

        $result = mysqli_query($connect, $query);

        ($result) ? header("Location: $currentUrl") : mysqli_error($connect);
    }

?>