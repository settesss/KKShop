<?php
    session_start();

    require_once("./vendor/isProductStock.php");
    include("./vendor/getStoreName.php");

    if (isset($_SESSION['productSelected'])) {
        $productSelected = $_SESSION['productSelected'];
        $nameExplode = explode(' ', $productSelected['product_name']);
        $firstWord = $nameExplode[0];
        array_shift($nameExplode);
        $remainingName = implode(' ', $nameExplode);
    } else {
        echo "Данные о продукте не найдены.";
    }
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
    <title>Product</title>
</head>

<body>

    <?php require_once('header.php'); ?>

    <div class="wrapper">
        <main class="main">
            <section class="main__product product">
                <div class="product__container">
                    <p class="product__path">Главная / <?php echo $productSelected['category_name']; ?> / <?php echo $productSelected['product_name']; ?></p>
                    <div class="product__block">
                        <div class="product__image-block">
                            <img src="../../assets/images/cards/<?php echo $productSelected['image_url']; ?>" alt="<?php echo $productSelected['product_name']; ?>">
                            <h2 class="product__name"><span><?php echo $firstWord; ?></span> <?php echo $remainingName; ?></h2>
                        </div>
                        <div class="product__buy-block">
                            <h2 class="product__store"><?php getStoreName($productSelected['id']); ?></h2>
                            <h3 class="product__price"><?php echo $productSelected['price'] . ' руб.'; ?></h3>
                            <div class="product__buttons">
                                <?php if (!isProductStock($productSelected['id'])) : ?>
                                    <div class="product__add button button--disabled">Добавить в корзину</div>
                                <?php else : ?>
                                    <a class="product__add button" href="./vendor/updateCart.php?productId=<?php echo $productSelected['id'];?>&action=increment">Добавить в корзину</a>
                                <?php endif; ?>
                                <button class="product__like button">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                        d="M12 21C11.355 20.428 10.626 19.833 9.85502 19.2H9.84502C7.13002 16.98 4.05302 14.468 2.69402 11.458C2.24754 10.4997 2.01093 9.45712 2.00001 8.4C1.99703 6.94948 2.57879 5.55898 3.61383 4.54276C4.64887 3.52654 6.04981 2.97039 7.50002 3C8.68065 3.00186 9.83586 3.34308 10.828 3.983C11.264 4.26596 11.6584 4.60825 12 5C12.3435 4.60979 12.7381 4.2677 13.173 3.983C14.1648 3.34295 15.3197 3.00171 16.5 3C17.9502 2.97039 19.3512 3.52654 20.3862 4.54276C21.4213 5.55898 22.003 6.94948 22 8.4C21.9898 9.45881 21.7532 10.5032 21.306 11.463C19.947 14.473 16.871 16.984 14.156 19.2L14.146 19.208C13.374 19.837 12.646 20.432 12.001 21.008L12 21ZM7.50002 5C6.56853 4.98834 5.6701 5.34484 5.00002 5.992C4.35441 6.62616 3.99358 7.49504 3.99994 8.4C4.01135 9.1705 4.18585 9.92985 4.51202 10.628C5.15353 11.9267 6.01913 13.102 7.06902 14.1C8.06002 15.1 9.20002 16.068 10.186 16.882C10.459 17.107 10.737 17.334 11.015 17.561L11.19 17.704C11.457 17.922 11.733 18.148 12 18.37L12.013 18.358L12.019 18.353H12.025L12.034 18.346H12.039H12.044L12.062 18.331L12.103 18.298L12.11 18.292L12.121 18.284H12.127L12.136 18.276L12.8 17.731L12.974 17.588C13.255 17.359 13.533 17.132 13.806 16.907C14.792 16.093 15.933 15.126 16.924 14.121C17.9741 13.1236 18.8397 11.9485 19.481 10.65C19.8131 9.9458 19.9901 9.1785 20.0001 8.4C20.0042 7.49783 19.6435 6.63229 19 6C18.3312 5.34992 17.4326 4.99048 16.5 5C15.3619 4.99032 14.274 5.46736 13.51 6.311L12 8.051L10.49 6.311C9.72609 5.46736 8.6381 4.99032 7.50002 5Z"
                                        fill="white" />
                                    </svg>
                                </button>
                            </div>
                            <p class="product__availability">
                                <?php
                                    $availability = isProductStock($productSelected['id']);

                                    echo $availability ? "Товар в наличии" : "Товар отсутствует в магазинах";
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="product__bar">
                        <p class="product__bar-title">Описание</p>
                        <div class="product__line"></div>
                    </div>
                    <div class="product__description-block description">
                        <h3 class="description__product-title"><?php echo $productSelected['product_name']; ?></h3>
                        <p class="description__text"><?php echo $productSelected['description']; ?></p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>