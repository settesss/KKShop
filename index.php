<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/styles/fonts.css">
    <link rel="stylesheet" href="./src/styles/reset.css">
    <link rel="stylesheet" href="./src/styles/style.css">
    <link rel="shortcut icon" href="./src/assets/favicons/favicon.ico" type="image/x-icon">
    <title>KK Shop</title>
</head>

<body>
    <div class="wrapper">

        <?php require_once("./src/scripts/php/header.php"); ?>

        <main class="main">
            <div class="main__image">
                <img src="./src/assets/images/main-bg.jpg" alt="Sales">
            </div>
            <section class="main__cards cards">
                <div class="cards__container">
                <h1 class="cards__title">Товары</h1>
                <div class="cards__block">

                    <?php require_once("./src/scripts/php/products.php"); ?>
        
                </div>
                </div>
            </section>
        </main>

    </div>
</body>

</html>