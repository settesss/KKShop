<?php 

    require_once("./vendor/getOrderItems.php");

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
    <link rel="stylesheet" href="../../styles/order.css">
    <title>Заказ</title>
</head>
<body>
    <div class="wrapper">
        <main class="main">
            <section class="main__order order">
                <div class="order__container">
                    <div class="order__info">
                        <h2 class="order__title">Заказ №<?php echo $orderId; ?></h2>
                        <h3 class="order__store">Scent Haven</h3>
                        <p class="order__date"><?php echo date_format($orderDate, 'd.m.Y'); ?></p>
                    </div>
                    <div class="order__items">
                        <ul class="order__list">
                            <?php 
                                $total = 0;
                                foreach ($orderProducts as $product) : ?>
                                <li class="order__item">
                                    <a class="order__link" href="#">
                                        <div class="order__image">
                                            <img src="../../assets/images/cards/<?php echo $product['image_url']; ?>" alt="Картинка товара">
                                        </div>
                                        <div class="order__item-info">
                                            <h3 class="order__item-name"><?php echo $product['product_name']; ?></h3>
                                            <p class="order__item-quantity"><?php echo intval($productQuantity) . ' шт.'; ?></p>
                                        </div>
                                        <p class="order__item-price"><?php echo $product['price'] . ' руб.'; ?></p>
                                    </a>
                                </li>
                                <?php $total += $product['price'] * $productQuantity; ?>
                            <?php endforeach; ?>
                        </ul>
                        <div class="order__receipt">
                            <p class="order__receipt-text">Итого</p>
                            <p class="order__price"><?php echo $total . ' руб.'; ?></p>
                        </div>
                        <a class="order__button-back button button--gray" href="profile.php#orders-block">Вернуться назад</a>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>