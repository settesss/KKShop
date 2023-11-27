<?php 

    require_once("connect.php");

    function isProductStock($productId) {
        global $connect; 

        $query = "SELECT * FROM `accounting` WHERE `product_id`='$productId'";
        $result = mysqli_query($connect, $query);

        if (mysqli_fetch_assoc($result)) {
            return true;
        }
        else {
            return false;
        }
    }

?>