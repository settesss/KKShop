<?php 

    session_start(); 

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
                <div class="profile__user-block">
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
                        <li class="profile__list-item">
                        <a class="profile__list-link" href="../php/vendor/logout.php">
                            выйти
                        </a>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="profile__information-block" id="information-block">
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
                </div>
                <div class="profile__orders-block" id="orders-block">
                    <h2 class="profile__title">Мои заказы</h2>
                    <h3 class="profile__subtitle">Заполните профиль и получите 10% бонусную карту</h3>
                    <ul class="orders">
                        <li class="orders__order order">
                            <a class="order__link" href="#">
                            <p class="order__text">Заказ №31211</p>
                            <p class="order__date">23.04.2023</p>
                            </a>
                            <div class="order__line"></div>
                        </li>
                        <li class="orders__order order">
                            <a class="order__link" href="#">
                            <p class="order__text">Заказ №31212</p>
                            <p class="order__date">17.05.2023</p>
                            </a>
                            <div class="order__line"></div>
                        </li>
                        <li class="orders__order order">
                            <a class="order__link" href="#">
                            <p class="order__text">Заказ №31213</p>
                            <p class="order__date">28.05.2023</p>
                            </a>
                            <div class="order__line"></div>
                        </li>
                    </ul>
                </div>
                </div>
            </section>
        </main> 

    </div>
    <script src="../js/edit-profile.js"></script>
</body>
</html>