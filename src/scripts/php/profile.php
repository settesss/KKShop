<?php 

    session_start();

    require_once("./vendor/getOrderData.php");
    require_once("./vendor/getStoreData.php");
    
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
                        <ul class="orders">
                            <?php while ($orders = mysqli_fetch_assoc($ordersResult)) : ?>
                                <li class="orders__order order">
                                    <a class="order__link" href="order.php?order_id=<?php echo $orders['id']; ?>">
                                    <p class="order__text">Заказ №<?php echo $orders['id']; ?></p>
                                    <p class="order__date">
                                        <?php
                                            $orderDate = date_create($orders['order_date']);
                                            echo date_format($orderDate, 'd.m.Y'); 
                                        ?>
                                    </p>
                                    </a>
                                    <div class="order__line"></div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </section>

                    <section class="profile__store-block" id="store-block">
                        <?php if (isset($stores)) : ?>
                            <h3 class="profile__title"><?php echo $storeName; ?></h3>
                        <?php else : ?>
                            <h3 class="profile__title">Мой магазин</h3>
                            <h2 class="profile__subtitle">У вас пока что нет магазина.
                            <a 
                            class="store__link" 
                            id="store_link" 
                            href="javascript:void(0);" 
                            onclick="showStoreForm()"
                            >Создать?</a></h2>
                            <form class="store__form" id="store__form" method="POST" action="addStore.php">
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