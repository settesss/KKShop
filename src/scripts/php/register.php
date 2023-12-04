<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/fonts.css">
    <link rel="stylesheet" href="../../styles/reset.css">
    <link rel="stylesheet" href="../../styles/login.css">
    <title>Регистрация</title>
</head>
<body>
    <div class="wrapper">
    <div class="container">
    <h1 class="form__title">Регистрация</h1>
    <form class="form" id="register__form" action="./vendor/signUp.php" method="POST" enctype="multipart/form-data">
        <label for="form__full-name">Полное имя:</label>
        <input  class="form__item" placeholder="Введите полное ФИО" type="text" name="full_name" id="form__full-name" required />
        <label for="form__email">Электронная почта:</label>
        <input  class="form__item" placeholder="kkshop@shop.com" type="email" name="email" id="form__email" required />
        <label for="form__photo">Фотография профиля:</label>
        <input  class="form__item" type="file" name="photo" id="form__photo" accept=".jpg, .png">
        <label for="form__password">Пароль:</label>
        <input  class="form__item" placeholder="Введите свой пароль" type="password" name="password" id="form__password" required />
        <label for="form__password_confirm">Подтверждение пароля:</label>
        <input  class="form__item" placeholder="Подтвердите пароль" type="password" name="password_confirm" id="form__password_confirm" required />
        <label for="form__phone">Номер телефона:</label>
        <input  class="form__item" placeholder="+7 (000) 000-00-00" type="tel" name="phone_number" id="form__phone"/>
        <div class="form__radios">
            <div class="form__radio">
                <input
                class="form__buyer"
                type="radio"
                name="user_type"
                id="form__buyer"
                value="buyer"
                form="register__form"
                checked
                />
                <label for="form__buyer">Я покупатель</label>
            </div>
            <div class="form__radio">
                <input
                class="form__seller"
                type="radio"
                name="user_type"
                id="form__seller"
                value="seller"
                form="register__form"
                />
                <label for="form__seller">Я продавец</label>
            </div>
        </div>
        <button class="form__button" type="submit">Зарегистрироваться</button>
        <a class="form__link" href="./login.php">У вас уже есть аккаунт?</a>
        <?php 
            if (isset($_SESSION['message'])) {
                echo '<p class="message">' . $_SESSION['message'] . '</p>';
            }
            unset($_SESSION['message']);
        ?>
    </form>
    </div>
    </div>
</body>
</html>