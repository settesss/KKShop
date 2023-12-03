<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/fonts.css">
    <link rel="stylesheet" href="../../styles/reset.css">
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="../../styles/product.css">
    <link rel="stylesheet" href="../../styles/cart.css">
    <title>Cart</title>
</head>

<body>
    <div class="wrapper">
        <main class="main">
        <section class="main__cart cart">
            <div class="cart__container">
                <?php 
                    $totalItems = 0;

                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $product) {
                            $totalItems += $product['quantity'];
                        }
                    }
                ?>
                <h2 class="cart__title">Корзина / <?php echo (isset($_SESSION['cart'])) ? $totalItems : 0; ?></h2>
                <div class="cart__items">
                    <?php 
                        $totalCost = 0;

                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) :
                            foreach($_SESSION['cart'] as $product) : ?>
                                <div class="cart__item item">
                                    <div class="item__image">
                                        <img src="../../assets/images/cards/<?php echo $product['image_url']; ?>" alt="Товар в корзине">
                                    </div>
                                    <div class="item__info">
                                        <p class="item__name"><?php echo $product['product_name']; ?></p>
                                        <p class="item__expiration-date"><?php echo $product['expiration_date']; ?></p>
                                    </div>
                                    <div class="item__price-block">
                                        <div class="item__quantity quantity">
                                            <a class="quantity__minus quantity__symbol" 
                                            href="./vendor/updateCart.php?productId=<?php echo $product['id']; ?>&action=minus">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="12" fill="#F7F7F7" />
                                                <rect x="7" y="11" width="10" height="2" fill="#333" />
                                                </svg>
                                            </a>
                                            <p class="quantity__number"><?php echo $product['quantity']; ?></p>
                                            <a class="quantity__plus quantity__symbol" 
                                            href="./vendor/updateCart.php?productId=<?php echo $product['id']; ?>&action=plus">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="12" fill="#F6F6F6" />
                                                <rect x="7" y="11" width="10" height="2" fill="#333" />
                                                <rect x="11" y="17" width="10" height="2" transform="rotate(-90 11 17)" fill="#333" />
                                                </svg>
                                            </a>
                                        </div>
                                        <p class="quantity__price"><?php echo $product['price'] . ' руб.'; ?></p>
                                    </div>
                                </div>
                            <?php $totalCost += $product['price'] * $product['quantity']; ?>
                            <?php endforeach; else : 
                            ?>
                                <p class="item__name">Корзина пуста</p>
                            <?php endif; ?>
                    <div class="cart__receipt">
                        <p class="cart__receipt-text">К оплате</p>
                        <p class="quantity__price"><?php echo $totalCost . ' руб.'?></p>
                    </div>
                    <a class="cart__button button <?php echo (empty($_SESSION['cart'])) ? 'button--hidden' : ''; ?>" href="./vendor/addOrder.php" id="cart__button">
                        <p class="cart__button-text">
                            Оформить заказ
                        </p>
                    </a>
                    <a class="cart__button-back button button--gray" href="/index.php">
                        <p class="cart__button-text">
                            Вернуться назад
                        </p>
                    </a>
                </div>
            </div>
        </section>
        </main>

        <div class="success__modal" id="success__modal">
            <div class="success__window">
                <h2 class="success__text">Заказ успешно оформлен!</h2>
                <button class="success__close" id="success__close">
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    >
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
            <div class="overlay"></div>
        </div>

    </div>

    <script src="../js/pop-up.js"></script>

</body>

</html>