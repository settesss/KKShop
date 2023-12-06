<?php

    require_once("connect.php");

    function getProductData() {
        global $connect;

        $productsQuery = "SELECT * FROM `products`";
        $productsResult = mysqli_query($connect, $productsQuery);

        $products = [];

        while ($product = mysqli_fetch_assoc($productsResult)) {
            $categoryId = $product['category_id'];

            $categoryQuery = "SELECT `category_name` FROM `product_categories` WHERE `id` = ?";
            $stmtCategory = mysqli_prepare($connect, $categoryQuery);
            mysqli_stmt_bind_param($stmtCategory, "i", $categoryId);
            mysqli_stmt_execute($stmtCategory);
            $categoryResult = mysqli_stmt_get_result($stmtCategory);

            if (!$categoryResult) {
                die("Ошибка выполнения запроса к таблице product_categories: " . mysqli_error($connect));
            }

            $categoryData = mysqli_fetch_assoc($categoryResult);
            mysqli_stmt_close($stmtCategory);

            $product['category_name'] = $categoryData['category_name'];
            $products[] = $product;

            mysqli_free_result($categoryResult);
        }

        mysqli_free_result($productsResult);

        return $products;
    }

    $products = getProductData();

?>
