<?php 

    session_start();
    require_once("connect.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstname = mysqli_real_escape_string($connect, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($connect, $_POST['lastname']);
        $patronimyc = mysqli_real_escape_string($connect, $_POST['patronimyc']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $phone = mysqli_real_escape_string($connect, $_POST['phone']);
        $address = mysqli_real_escape_string($connect, $_POST['address']);

        if(isset($_COOKIE['address'])) {
            $_COOKIE['address'] = $address;
        }

        $fullname = $firstname . ' ' . $lastname . ' ' . $patronimyc;

        $query = "UPDATE `users` SET `full_name`='$fullname',`email`='$email',`phone_number`='$phone',`delivery_address`=
        '$address' WHERE `email` = '$email'";

        mysqli_query($connect, $query);
    }

?>