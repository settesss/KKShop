<?php

    require_once("connect.php");

    function getProductData() {
        global $connect; 

        $query = "SELECT * FROM `products`";
        $productsQuery = mysqli_query($connect, $query);

        $products = array();  

        while ($product = mysqli_fetch_assoc($productsQuery)) {
            $categoryId = $product['category_id'];
            $categoryQuery = "SELECT `category_name` FROM `product_categories` WHERE `id` = $categoryId";
            $category = mysqli_query($connect, $categoryQuery);

            if ($category) {
                $categoryData = mysqli_fetch_assoc($category);

                $product['category_name'] = $categoryData['category_name'];
                $products[] = $product;  

                mysqli_free_result($category);
            } else {
                die("Ошибка выполнения запроса к таблице category: " . mysqli_error($connect));
            }
        }

        mysqli_free_result($productsQuery);

        return $products; 
    }

    $products = getProductData();

?>