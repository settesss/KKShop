<?php 

    

?>

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
    <form class="form" action="register.html" method="POST">
        <label for="form__name">Полное имя:</label>
        <input  class="form__item" placeholder="Введите полное ФИО" type="text" name="name" id="form__name" required />
        <label for="form__mail">Электронная почта:</label>
        <input  class="form__item" placeholder="kkshop@shop.com" type="email" name="mail" id="form__mail" required />
        <label for="form__photo">Фотография профиля:</label>
        <input  class="form__item" type="file" name="photo" id="form__photo" required />
        <label for="form__password">Пароль:</label>
        <input  class="form__item" placeholder="Введите свой пароль" type="password" name="password" id="form__password" required />
        <label for="form__password-check">Подтверждение пароля:</label>
        <input  class="form__item" placeholder="Подтвердите пароль" type="password" name="password-check" id="form__password-check" required />
        <label for="form__phone">Номер телефона:</label>
        <input  class="form__item" placeholder="+7 (000) 000-00-00" type="tel" name="phone" id="form__phone" required />
        <button class="form__button" type="submit">Зарегистрироваться</button>
    </form>
    </div>
    </div>
</body>
</html>