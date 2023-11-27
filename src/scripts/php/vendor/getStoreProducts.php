<?php 

    require_once("connect.php");

    function getStoreProducts($storeId) {
        global $connect;

        $query = 
        "SELECT accounting.*, products.product_name, products.image_url
        FROM accounting
        INNER JOIN products ON accounting.product_id = products.id
        WHERE accounting.store_id = ?";

        $statement = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($statement, "i", $storeId);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);

        $products = array();

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = $row;
            }
        } else {
            die("Ошибка выполнения запроса: " . mysqli_error($connect));
        }

        mysqli_stmt_close($statement);

        return $products;
    }

?>