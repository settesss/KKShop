<?php 

    session_start();

    require_once("./vendor/getOrderData.php");
    require_once("./vendor/getStoreData.php");
    require_once("./vendor/getStoreProducts.php");
    
    $username = $_SESSION['user']['fullName'];
    $usernameArray = explode(" ", $username);
    $firstname = $usernameArray[0];
    $lastname = $usernameArray[1];
    
    if (count($usernameArray) > 2) {
        $patronimyc = $usernameArray[2];
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
    <link rel="stylesheet" href="../../styles/order.css">
    <link rel="stylesheet" href="../../styles/profile.css">
    <title>Профиль</title>
</head>
<body>
    <div class="wrapper">
        
        <?php require_once("header.php"); ?>

        <main class="main">
            <section class="main__profile profile">
                <div class="profile__container">

                    <section class="profile__user-block">
                        <div class="profile__user-top user">
                        <div class="user__information">
                            <h3 class="user__name">
                                <?php echo $firstname . " " . $lastname; ?>
                            </h3>
                            <div class="user__image">
                            <img src="<?php 
                                $photoPath = "../../" . $_SESSION['user']['photo'];
                                if (isset($_SESSION['user']['photo']) && !file_exists($photoPath)) {
                                    echo ('../../uploads/default-user.png');
                                } else if (isset($_SESSION['user']['photo'])) {
                                    echo ('../../' . $_SESSION['user']['photo']); 
                                } else {
                                    echo ('../../uploads/default-user.png');
                                }
                            ?>" alt="Фотография пользователя">
                            </div>
                        </div>
                        <p class="user__bonus-card">бонусной карты нет</p>
                        </div>
                        <div class="profile__user-bottom">
                        <ul class="profile__list">
                            <li class="profile__list-item">
                                <a class="profile__list-link" href="#information-block">
                                    личная информация
                                </a>
                            </li>
                            <li class="profile__list-item">
                                <a class="profile__list-link" href="#orders-block">
                                    мои заказы
                                </a>
                            </li>
                            <?php if ($_SESSION['user']['userType'] == 'seller') : ?>
                                <li class="profile__list-item">
                                    <a class="profile__list-link" href="#store-block">
                                        мой магазин
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li class="profile__list-item">
                                <a class="profile__list-link" href="../php/vendor/logout.php">
                                    выйти
                                </a>
                            </li>
                        </ul>
                        </div>
                    </section>

                    <section class="profile__information-block" id="information-block">
                        <h2 class="profile__title">Личная информация</h2>
                        <h3 class="profile__subtitle">Заполните профиль и получите 10% бонусную карту</h3>
                        <input class="input" type="text" name="firstname" placeholder="Фамилия" value="<?php echo $firstname ?>">
                        <input class="input" type="text" name="lastname" placeholder="Имя" value = "<?php echo $lastname ?>">
                        <input class="input input--margin" name="patronimyc" type="text" placeholder="Отчество" value="<?php 
                        echo isset($patronimyc) ? $patronimyc : ''; 
                        ?>">
                        <input class="input" type="email" name="email" id="email" placeholder="Ваша почта" value="<?php 
                        echo $_SESSION['user']['email'];
                        ?>">
                        <input class="input" type="tel" name="phone" id="phone" placeholder="+7 (000) 000-00-00" value="<?php 
                        echo isset($_SESSION['user']['phoneNumber']) ? $_SESSION['user']['phoneNumber'] : ''; 
                        ?>">
                        <input class="input" name="address" type="text" placeholder="Адрес доставки" value="<?php
                        echo $_SESSION['user']['address'];
                        ?>">
                        <button class="profile__button button button--disabled" id="button_save" disabled>
                            <p class="profile__button-text">Сохранить</p>
                        </button>
                        <button class="profile__button button button--gray" id="button_edit"> 
                            <p class="profile__button-text">Редактировать</p>
                        </button>
                        <a class="profile__button button" href="./vendor/changeUserType.php">
                            <?php if ($_SESSION['user']['userType'] === 'buyer') : ?>
                                <p class="profile__button-text">Хочу стать продавцом</p>
                            <?php else : ?>
                                <p class="profile__button-text">Хочу стать покупателем</p>
                            <?php endif; ?>
                        </a>
                    </section>

                    <section class="profile__orders-block" id="orders-block">
                        <h2 class="profile__title">Мои заказы</h2>
                        <h3 class="profile__subtitle">Заполните профиль и получите 10% бонусную карту</h3>
                        <ul class="profile__orders">
                            <?php while ($orders = mysqli_fetch_assoc($ordersResult)) : ?>
                                <li class="profile__orders-order profile__order">
                                    <a class="profile__order__link" href="order.php?order_id=<?php echo $orders['id']; ?>">
                                    <p class="profile__order__text">Заказ №<?php echo $orders['id']; ?></p>
                                    <p class="profile__order__date">
                                        <?php
                                            $orderDate = date_create($orders['order_date']);
                                            echo date_format($orderDate, 'd.m.Y'); 
                                        ?>
                                    </p>
                                    </a>
                                    <div class="profile__order__line"></div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </section>

                    <section class="profile__store-block" id="store-block">
                        <?php if (isset($stores)) : ?>
                            <div class="store__header">
                                <h3 class="profile__title store__title"><?php echo $storeName; ?></h3>
                                <a class="store__header-button" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="24px" height="24px">
                                        <path d="M 10 2 L 9 3 L 5 3 C 4.4 3 4 3.4 4 4 C 4 4.6 4.4 5 5 5 L 7 5 L 17 5 L 19 5 C 
                                            19.6 5 20 4.6 20 4 C 20 3.4 19.6 3 19 3 L 15 3 L 14 2 L 10 2 z M 5 7 L 5 20 C 5 21.1 
                                            5.9 22 7 22 L 17 22 C 18.1 22 19 21.1 19 20 L 19 7 L 5 7 z M 9 9 C 9.6 9 10 9.4 10 10 
                                            L 10 19 C 10 19.6 9.6 20 9 20 C 8.4 20 8 19.6 8 19 L 8 10 C 8 9.4 8.4 9 9 9 z M 15 9 
                                            C 15.6 9 16 9.4 16 10 L 16 19 C 16 19.6 15.6 20 15 20 C 14.4 20 14 19.6 14 19 L 14 10 
                                            C 14 9.4 14.4 9 15 9 z"/>
                                    </svg>
                                </a>
                            </div>
                            <h2 class="profile__subtitle store__subtitle">Находится по адресу <?php echo $storeAddress; ?></h2>
                            <p class="store__hours">Время работы: <?php echo $storeHours; ?></p>
                            <ul class="store__product-list">
                                <?php 
                                    $products = getStoreProducts($storeId);

                                    foreach ($products as $product) : ?>
                                    <li class="order__item">
                                        <div href="" class="store__product-link">
                                            <div class="order__image">
                                                <img
                                                src="../../assets/images/cards/<?php echo $product['image_url'];?>" 
                                                alt="<?php echo $product['product_name']; ?>">
                                            </div>
                                            <div class="order__item-info">
                                                <p class="order__item-name"><?php echo $product['product_name']; ?></p>
                                                <p class="order__item-quantity"><?php echo $product['quantity'] . ' ' . $product['unit_of_measure']; ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else : ?>
                            <h3 class="profile__title">Мой магазин</h3>
                            <h2 class="profile__subtitle">У вас пока что нет магазина.
                            <a 
                            class="store__link" 
                            id="store_link" 
                            href="javascript:void(0);" 
                            onclick="showStoreForm()"
                            >Создать?</a></h2>
                            <form class="store__form" id="store__form" method="POST" action="./vendor/addStore.php">
                                <input 
                                class="input no-disable" 
                                type="text" 
                                id="store__name" 
                                name="name" 
                                placeholder="Название магазина" 
                                autocomplete="off" 
                                required />
                                <input 
                                class="input no-disable" 
                                type="text" 
                                id="store__address" 
                                name="address" 
                                placeholder="Адрес магазина" 
                                autocomplete="off" />
                                <input 
                                class="input no-disable" 
                                type="text" 
                                id="store__hours" 
                                name="hours" 
                                placeholder="Время работы (Пн-Пт 9:00-15:00)" 
                                autocomplete="off" />
                                <button class="profile__button button" id="button_save--store" type="submit">
                                    <p class="profile__button-text">Сохранить</p>
                                </button>
                            </form>
                        <?php endif; ?>
                    </section>

                </div>
            </section>
        </main> 

    </div>
    <script src="../js/edit-profile.js"></script>
    <script src="../js/showStoreForm.js"></script>
</body>
</html>