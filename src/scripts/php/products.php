<?php
    require_once("vendor/getProductData.php");
    require_once("vendor/isProductStock.php");

    foreach ($products as $product) :
        $productId = $product['id'];
        $productName = $product['product_name'];
        $productDescription = $product['description'];
        $productCategory = $product['category_name'];
        $productImage = $product['image_url'];
        $productPrice = $product['price'];
        ?>
        <div class="cards__block-card item-card">
            <a class="item-card__link" href="/src/scripts/php/vendor/openProductCard.php?productId=<?php echo $productId; ?>">
                <div class="item-card__image">
                    <object>
                        <?php if (isProductStock($productId)) : ?>
                            <a class="item-card__buy-block" href="/src/scripts/php/vendor/updateCart.php?productId=<?php echo $productId; ?>&action=increment">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.8" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.99996 7V6C9.99996 4.89543 10.8954 4 12 4C13.1045 4 14 4.89543 14 6V7H9.99996ZM7.99996 7V6C7.99996 3.79086 9.79082 2 12 2C14.2091 2 16 3.79086 16 6V7H18.3308C18.849 7 19.2813 7.39576 19.3269 7.91187L20.373 19.7356C20.5282 21.49 19.1459 23 17.3847 23H6.61449C4.85328 23 3.47095 21.49 3.62616 19.7356L4.67224 7.91187C4.7179 7.39576 5.15022 7 5.66835 7H7.99996ZM16 9H14H9.99996H7.99996H6.58378L5.61838 19.9119C5.56664 20.4967 6.02742 21 6.61449 21H17.3847C17.9718 21 18.4325 20.4967 18.3808 19.9119L17.4154 9H16Z"
                                        fill="black" />
                                </svg>
                            </a>
                        <?php else : ?>
                            <div class="item-card__buy-block item-card__disabled">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.8" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.99996 7V6C9.99996 4.89543 10.8954 4 12 4C13.1045 4 14 4.89543 14 6V7H9.99996ZM7.99996 7V6C7.99996 3.79086 9.79082 2 12 2C14.2091 2 16 3.79086 16 6V7H18.3308C18.849 7 19.2813 7.39576 19.3269 7.91187L20.373 19.7356C20.5282 21.49 19.1459 23 17.3847 23H6.61449C4.85328 23 3.47095 21.49 3.62616 19.7356L4.67224 7.91187C4.7179 7.39576 5.15022 7 5.66835 7H7.99996ZM16 9H14H9.99996H7.99996H6.58378L5.61838 19.9119C5.56664 20.4967 6.02742 21 6.61449 21H17.3847C17.9718 21 18.4325 20.4967 18.3808 19.9119L17.4154 9H16Z"
                                        fill="black" />
                                </svg>
                            </div>
                        <?php endif; ?>
                    </object>
                    <img src="/src/assets/images/cards/<?php echo $productImage; ?>" alt="Product Card">
                </div>
            </a>
            <div class="item-card__wrapper">
                <div class="item-card__body">
                    <div class="item-card__info">
                        <h2 class="item-card__title"><?php echo $productName ?></h2>
                        <p class="item-card__description"><?php 
                            echo mb_strlen($productDescription) > 50 ? mb_substr($productDescription, 0, 50) . '...' : $productDescription; ?>
                        </p>
                    </div>
                    <p class="item-card__price"><?php echo $productPrice . ' руб.' ?></p>
                </div>
                <a class="item-card__category" href="#"><?php echo $productCategory ?></a>
            </div>
        </div>
    <?php
    endforeach;
?>