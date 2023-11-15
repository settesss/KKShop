<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/fonts.css">
    <link rel="stylesheet" href="../../styles/reset.css">
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="shortcut icon" href="../../assets/favicons/favicon-90.ico" type="image/x-icon">
    <title>KK Shop</title>
</head>

<body>
    <div class="wrapper">

        <?php require_once("header.php"); ?>

        <main class="main">
        <div class="main__image">
            <img src="../../assets/images/main-bg.jpg" alt="Sales">
        </div>
        <section class="main__cards cards">
            <div class="cards__container">
            <h1 class="cards__title">Товары</h1>
            <div class="cards__block">

                <?php require_once("./products.php"); ?>
    
            </div>
            </div>
        </section>
        </main>

    </div>
</body>

</html>