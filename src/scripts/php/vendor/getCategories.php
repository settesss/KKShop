<?php 

    require_once("connect.php");

    $query = "SELECT * FROM `product_categories`";

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die('Ошибка выполнения запроса: ' . mysqli_error($connect));
    }

    $categories = [];

    while ($category = mysqli_fetch_assoc($result)) {
        $categories[] = array(
            'category_id' => $category['id'],
            'category_name' => $category['category_name']
        );
    }

    mysqli_free_result($result);

?>