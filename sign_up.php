<?php
session_start();

if (!empty($_SESSION['username']))
{
    // Если есть логин в сессии, то пользователь уже авторизован.
    // Делаем перенаправление на его страницу.
    header('Location: ./');
}

//массив ошибок, заполняется при проверке отправленных данных
$_SESSION['message'] = '';

//если был отправлен HTML-запрос методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    //проверяем и обрабатываем введённые данные через validate.php
    require 'validate.php';

    //if (empty($error))
        //перебрасываем пользователя на страницу авторизации
        //header("location: sign_in.php");
}
?>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link href="icon.png" rel="icon" type="image/png">
    <script src="change_lang.js"></script>
    <title>BodyRebirth: регистрация</title>
</head>
<body>
<div class="form_background">
    <br>

    <?php
    if (!empty($error)) foreach ($error as $er)
    {
        print ($er);
    }
    ?>

    <div class="small_buttons">
        <!-- Возврат на главную -->
        <div class="back">
            <a href="index.php">
                <img class="rus_lang" src="back.png" alt="Вернуться на главную" title="Вернуться на главную">
                <img class="en_lang" src="back.png" alt="Go back to the main page" title="Go back to the main page">
            </a>
        </div>

        <!-- Кнопка смены языка -->
        <div class="change_lang"><span id="change_lang" onclick="change_lang()" type="button">English</span></div>
    </div>

    <!-- Русскоязычная форма -->
    <div class="rus_lang form--div">
        <h1>Зарегистрироваться</h1>
        <form class="form" action="sign_up.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <label>
                <input class="input_user1" type="text" placeholder="Имя на сайте (до 20 симв.)"
                       name="username" required value="<?php if (isset($username)) print ($username); ?>"/>
            </label>
            <label>
                <input class="input_user1" type="email" placeholder="Email"
                       name="email" required value="<?php if (isset($email)) print ($email); ?>"/>
            </label>
            <label>
                <input class="input_user1" type="password" placeholder="Пароль" name="password" required />
            </label>
            <label>
                <input class="input_user1" type="password" placeholder="Повторите пароль" name="confirm_password" required />
            </label>
            <button class="btn" type="submit" name="register">
                <img alt="регистрация" src="menu/menu4.png" onmouseover="this.src='menu/menu4h.png'" onmouseout="this.src='menu/menu4.png'">
            </button>
        </form>
        <div><a href="sign_in.php">У меня уже есть аккаунт</a></div>
    </div>


    <!-- Англоязычная форма -->
    <div class="en_lang form--div">
        <h1>Sign up</h1>
        <form class="form" action="sign_up.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <label>
                <input class="input_user1" type="text" placeholder="Nickname (20 char max)"
                       name="username" required value="<?php if (isset($username)) print ($username); ?>"/>
            </label>
            <label>
                <input class="input_user1" type="email" placeholder="Email"
                       name="email" required value="<?php if (isset($email)) print ($email); ?>"/>
            </label>
            <label>
                <input class="input_user1" type="password" placeholder="Password" name="password" required />
            </label>
            <label>
                <input class="input_user1" type="password" placeholder="Confirm password" name="confirm_password" required />
            </label>
            <button class="btn" type="submit" name="register">
                <img alt="регистрация" src="menu_en/menu4.png" onmouseover="this.src='menu_en/menu4h.png'" onmouseout="this.src='menu_en/menu4.png'">
            </button>
        </form>
        <div><a href="sign_in.php">I already have an account</a></div>
    </div>
</div>
</body>