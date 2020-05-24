<?php
session_start();
if (!empty($_SESSION['username']))
{
    // Если есть логин в сессии, то пользователь уже авторизован.
    // Делаем перенаправление на его страницу.
    header('Location: account.php');
}

//если был отправлен HTML-запрос методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    //подключаемся к базе данных
    require 'db_connect.php';
    $username = $_POST['username'];

    $select = $db->prepare("SELECT * FROM users where username=:username");
    $select->bindParam(':username', $username);
    $select->execute();
    $user_data = $select->fetch(PDO::FETCH_ASSOC);
    $error[] = array();
    if ($user_data)
    {
        if (password_verify($_POST['password'], $user_data['password']))
        {
            $_SESSION['username'] = $_POST['username'];

            header("location: account.php");
        }
        else
        {
            $error[] = '<div class="rus_lang error">Неверный пароль</div><br>';
            $error[] = '<div class="en_lang error">Incorrect password</div><br>';
        }

    }
    else
    {
        $error[] = '<div class="rus_lang error">Такой аккаунт не существует</div><br>';
        $error[] = '<div class="en_lang error">This account does not exist.</div><br>';
    }
}
$db = null;
?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link href="icon.png" rel="icon" type="image/png">
    <script src="change_lang.js"></script>
    <title>BodyRebirth: авторизация</title>
</head>
<body>
<div class="form_background">
    <br>
    <?php
    if (!empty($error))
        foreach ($error as $er)
        {
            print ($er);
        }
    ?>
    <div class="small_buttons">
        <!-- Возврат на главную -->
        <div class="back small_buttons__but">
            <a href="index.php">
                <img class="rus_lang" src="back.png" alt="Вернуться на главную" title="Вернуться на главную">
                <img class="en_lang" src="back.png" alt="Go back to the main page" title="Go back to the main page">
            </a>
        </div>

        <!-- Кнопка смены языка -->
        <div class="change_lang small_buttons__but">
            <span id="change_lang" type="button" onclick="change_lang()">English</span>
        </div>
    </div>

    <!-- Русскоязычная форма -->
    <div class="rus_lang form--div">
        <h1>Авторизация</h1>
        <form class="form" action="sign_in.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <label>
                <input class="input_user1" type="text" placeholder="Имя на сайте" name="username" required />
            </label>
            <label>
                <input class="input_user1" type="password" placeholder="Пароль" name="password" required />
            </label>
            <button class="btn" type="submit" name="register">
                <img alt="регистрация" src="menu/menu4.png" onmouseover="this.src='menu/menu4h.png'" onmouseout="this.src='menu/menu4.png'">
            </button>
        </form>
        <a href="sign_up.php">Зарегистрироваться</a>
    </div>

    <!-- Англоязычная форма -->
    <div class="en_lang form--div">
        <h1>Sign in</h1>
        <form class="form" action="sign_in.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <label>
                <input class="input_user1" type="text" placeholder="Nickname" name="username" required />
            </label>
            <label>
                <input class="input_user1" type="password" placeholder="Password" name="password" required />
            </label>
            <button class="btn" type="submit" name="register">
                <img alt="регистрация" src="menu_en/menu4.png" onmouseover="this.src='menu_en/menu4h.png'" onmouseout="this.src='menu_en/menu4.png'">
            </button>
        </form>
        <div><a href="sign_up.php">Sign Up</a></div>
    </div>
</div>
</body>