<?php 

    require_once("connect.php");

    $query = "SELECT * FROM `product_categories`";

    $result = mysqli_query($connect, $query);

    $categories = [];

    while ($category = mysqli_fetch_assoc($result)) {
        $categories[] = array(
            'category_id' => $category['id'],
            'category_name' => $category['category_name']
        );
    }

?>