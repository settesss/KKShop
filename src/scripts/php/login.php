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
    <title>Вход</title>
</head>
<body>
    <div class="wrapper">
    <div class="container">
    <h1 class="form__title">Вход в аккаунт</h1>
    <form class="form" action="../../html/index.html" method="POST">
        <label for="form__login">Логин:</label>
        <input 
        class="form__item" 
        placeholder="Введите свой логин"
        type="text" name="login" 
        id="form__login" 
        required />
        <label for="form__password">Пароль:</label>
        <input 
        class="form__item" 
        placeholder="Введите пароль"
        type="password" name="password" 
        id="form__password" 
        required />
        <button class="form__button" type="submit">Войти</button>
        <a class="form__link" href="./register.php">Ещё не зарегистрированы?</a>
    </form>
    </div>
    </div>
</body>
</html>