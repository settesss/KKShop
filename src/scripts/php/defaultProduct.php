<?php require_once("./vendor/getCategories.php"); ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/fonts.css">
    <link rel="stylesheet" href="../../styles/reset.css">
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="../../styles/product.css">
    <title>Product</title>
</head>

<body>

    <?php require_once('header.php'); ?>

    <main class="main">
        <section class="main__product product">
            <div class="product__container">
                <div class="product__block">
                    <div class="product__image-block product__image-block--default">
                        <input class="input__file" type="file" id="file" name="photo" form="product__form" onchange="previewImage()">
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
                            placeholder="Клетка для кошки">
                            <label class="product__label" for="product_price">Стоимость товара:</label>
                            <input 
                            class="product__input" 
                            type="number" 
                            name="price" 
                            id="product_price"
                            autocomplete="off"
                            placeholder="1000.00">

                            <label class="product__label" for="product_date">Срок годности товара:</label>
                            <input 
                            class="product__input" 
                            type="date" 
                            name="date" 
                            id="product_date">

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
                            <button class="button" type="submit">Опубликовать</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="../js/upload-photo.js"></script>
</body>

</html>