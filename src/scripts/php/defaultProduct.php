<?php

    session_start();

    if (!isset($_SESSION['user']['id'])) {
        header("Location: login.php");
        exit();
    } else if (isset($_COOKIE['userType']) && $_COOKIE['userType'] == 'buyer') {
        header("Location: /index.php");
    }

    require_once("./vendor/getCategories.php"); 

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/fonts.css">
    <link rel="stylesheet" href="../../styles/reset.css">
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="../../styles/product.css">
    <link rel="shortcut icon" href="../../assets/favicons/favicon.ico" type="image/x-icon">
    <title>Добавить продукт</title>
</head>

<body>

    <?php require_once('header.php'); ?>

    <main class="main">
        <section class="main__product product">
            <div class="product__container">
                <div class="product__block">
                    <div class="product__image-block product__image-block--default">
                        <input
                        class="input__file"
                        type="file"
                        id="file" 
                        name="photo" 
                        form="product__form" 
                        onchange="previewImage()"
                        accept=".png"
                        required />
                        <label class="product__image--default" for="file" id="upload">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 44 44">
                                <path d="M22,0C9.8,0,0,9.8,0,22s9.8,22,22,22s22-9.8,22-22S34.2,0,22,0z M34,23c0,0.6-0.4,1-1,1h-8.5c-0.3,0-0.5,0.2-0.5,0.5V33  c0,0.6-0.4,1-1,1h-2c-0.6,0-1-0.4-1-1v-8.5c0-0.3-0.2-0.5-0.5-0.5H11c-0.6,0-1-0.4-1-1v-2c0-0.6,0.4-1,1-1h8.5  c0.3,0,0.5-0.2,0.5-0.5V11c0-0.6,0.4-1,1-1h2c0.6,0,1,0.4,1,1v8.5c0,0.3,0.2,0.5,0.5,0.5H33c0.6,0,1,0.4,1,1V23z"/>
                            </svg>
                        </label>
                        <img src="" alt="Загруженный продукт" id="uploaded_photo">
                    </div>
                    <div class="product__buy-block">
                        <form class="product__form" id="product__form" action="./vendor/addProduct.php" method="POST" enctype="multipart/form-data">
                            <label class="product__label" for="product_name">Название товара:</label>
                            <input 
                            class="product__input" 
                            type="text" 
                            name="name" 
                            id="product_name" 
                            autocomplete="off"
                            placeholder="Клетка для кошки"
                            required />
                            <div class="product__row">
                                <div class="product__column">
                                    <label class="product__label" for="product_price">Стоимость товара:</label>
                                    <input 
                                    class="product__input" 
                                    type="number" 
                                    name="price" 
                                    id="product_price"
                                    autocomplete="off"
                                    placeholder="1000.00"
                                    min="0"
                                    required />
                                </div>
                                <div class="product__column">
                                    <label class="product__label" for="product_quantity">Количество товара:</label>
                                    <input 
                                    class="product__input" 
                                    type="number" 
                                    name="quantity" 
                                    id="product_quantity"
                                    autocomplete="off"
                                    placeholder="1"
                                    min="0"
                                    required />
                                </div>
                            </div>
                            <label class="product__label" for="product_date">Срок годности товара:</label>
                            <input 
                            class="product__input" 
                            type="date" 
                            name="date" 
                            id="product_date"
                            min="<?php echo date('Y-m-d'); ?>">
                            <label class="product__label" for="product_description">Описание товара:</label>
                            <textarea 
                            class="product__textarea"
                            name="description" 
                            id="product_description" 
                            rows="3"
                            autocomplete="off"
                            form="product__form"
                            placeholder="Опишите товар настолько, насколько вы считаете нужным"></textarea>
                            <label class="product__label" for="product_category">Категория товара:</label>
                            <select class="product__category" name="category" id="product_category">
                                <?php foreach ($categories as $category) : ?>
                                        <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button class="button" type="submit">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="../js/upload-photo.js"></script>
</body>

</html>