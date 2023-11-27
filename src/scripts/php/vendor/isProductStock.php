<?php 

    require_once("connect.php");

    function isProductStock($productId) {
        global $connect; 

        $query = "SELECT * FROM `accounting` WHERE `product_id`='$productId'";
        $result = mysqli_query($connect, $query);

        if ($accounting = mysqli_fetch_assoc($result)) {
            if ($accounting['quantity'] == 0) {
                return false;
            }
            else {
                return true;
            }
        } else {
            return false;
        }
    }

?>