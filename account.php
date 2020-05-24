<?php
session_start();

if (empty($_SESSION['username']))
{
    // Если нет логина в сессии, то пользователь не авторизован.
    // Делаем перенаправление на его страницу авторизации.
    header('Location: sign_in.php');
}
//подключаемся к базе данных
require 'db_connect.php';
$username = $_SESSION['username'];

$select = $db->prepare("SELECT * FROM users where username=:username");
$select->bindParam(':username', $username);
$select->execute();
$user_data = $select->fetch(PDO::FETCH_ASSOC);

//отключаемся от базы
$db = null;

//проверяем и обрабатываем введённые данные через validate.php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    require 'update.php';
}
?>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link href="icon.png" rel="icon" type="image/png">
    <script src="change_lang.js"></script>
    <title>BodyRebirth: профиль</title>
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
        <div class="change_lang"><span id="change_lang" type="button" onclick="change_lang()">English</span></div>
    </div>

    <!-- Русскоязычная форма -->
    <div class="rus_lang form--div">
        <h1>Ваш профиль<br> <br></h1>
        <form action="account.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="user">
                <div class="user__data">
                    <img class="user__img" src="<?php print ($user_data['avatar']) ?>">
                    <label class="label_avatar">Заменить аватар: </label>
                    <input type="file" name="avatar" accept="image/*" />
                </div>
                <div class="user__data">
                    <label>
                        <input class="input_user1" type="text" name="username" value="<?php print ($user_data['username']); ?>" readonly/>
                    </label>
                    <label>
                        <input class="input_user1" type="email" placeholder="Email" name="email" value="<?php print ($user_data['email']); ?>" />
                    </label>
                    Сменить пароль:
                    <label>
                        <input class="input_user1" type="password" placeholder="Старый пароль" name="old_password" autocomplete="off" />
                    </label>
                    <label>
                        <input class="input_user1" type="password" placeholder="Новый пароль" name="password" autocomplete="off" />
                    </label>
                    <label>
                        <input class="input_user1" type="password" placeholder="Повторите пароль" name="confirm_password" autocomplete="off" />
                    </label>
                    Персональные данные:
                    <label>
                        <input class="input_user1" type="text" placeholder="ФИО" name="name" value="<?php print ($user_data['name']); ?>"  />
                    </label>
                    <label>
                        <input class="input_user1" type="date" placeholder="Дата рождения" name="birth" value="<?php print ($user_data['birth']); ?>" />
                    </label>
                    <label>
                        <select class="input_user2" name="region">
                            <option value="" <?php if ($user_data['region'] == '') print ('selected'); ?>>Штат (не выбран)</option>
                            <option value="Michigan" <?php if ($user_data['region'] == 'Michigan') print ('selected'); ?>>Мичиган</option>
                            <option value="Wisconsin" <?php if ($user_data['region'] == 'Wisconsin') print ('Wisconsin'); ?>>Висконсин</option>
                            <option value="Illinois" <?php if ($user_data['region'] == 'Illinois') print ('selected'); ?>>Иллинойс</option>
                            <option value="Indiana" <?php if ($user_data['region'] == 'Indiana') print ('selected'); ?>>Индиана</option>
                            <option value="Ohio" <?php if ($user_data['region'] == 'Ohio') print ('selected'); ?>>Огайо</option>
                            <option value="Pennsylvania" <?php if ($user_data['region'] == 'Pennsylvania') print ('selected'); ?>>Пенсильвания</option>
                            <option value="New York" <?php if ($user_data['region'] == 'New York') print ('selected'); ?>>Нью-Йорк</option>
                            <option value="Washington" <?php if ($user_data['region'] == 'Washington') print ('selected'); ?>>Вашингтон</option>
                        </select>
                    </label>
                    <label>
                        <textarea class="input_user3" placeholder="О себе" name="biography"><?php print ($user_data['biography']); ?></textarea>
                    </label>
                    <button class="btn" type="submit" name="register">
                        <img alt="регистрация" src="menu/menu4.png" onmouseover="this.src='menu/menu4h.png'" onmouseout="this.src='menu/menu4.png'">
                    </button>
                    <a class="btn" href="exit.php" type="submit" name="out">
                        <img alt="выход" src="menu/menu5.png" onmouseover="this.src='menu/menu5h.png'" onmouseout="this.src='menu/menu5.png'">
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Англоязычная форма -->
    <div class="en_lang form--div">
        <h1>Your profile<br> <br></h1>
        <form action="account.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="user">
                <div class="user__data">
                    <img class="user__img" src="<?php print ($user_data['avatar']) ?>">
                    <label class="label_avatar">Change avatar: </label>
                    <input type="file" name="avatar" accept="image/*" />
                </div>
                <div class="user__data">
                    <label>
                        <input class="input_user1" type="text" name="username" value="<?php print ($user_data['username']); ?>" readonly/>
                    </label>
                    <label>
                        <input class="input_user1" type="email" placeholder="Email" name="email" value="<?php print ($user_data['email']); ?>" />
                    </label>
                    Change password:
                    <label>
                        <input class="input_user1" type="password" placeholder="Old password" name="old_password" autocomplete="off" />
                    </label>
                    <label>
                        <input class="input_user1" type="password" placeholder="New password" name="password" autocomplete="off" />
                    </label>
                    <label>
                        <input class="input_user1" type="password" placeholder="Confirm password" name="confirm_password" autocomplete="off" />
                    </label>
                    Personal data:
                    <label>
                        <input class="input_user1" type="text" placeholder="Full name" name="name" value="<?php print ($user_data['name']); ?>"  />
                    </label>
                    <label>
                        <input class="input_user1" type="date" placeholder="Date of birth" name="birth" value="<?php print ($user_data['birth']); ?>" />
                    </label>
                    <label>
                        <select class="input_user2" name="region">
                            <option value="" <?php if ($user_data['region'] == '') print ('selected'); ?>>State (not selected)</option>
                            <option value="Michigan" <?php if ($user_data['region'] == 'Michigan') print ('selected'); ?>>Michigan</option>
                            <option value="Wisconsin" <?php if ($user_data['region'] == 'Wisconsin') print ('Wisconsin'); ?>>Wisconsin</option>
                            <option value="Illinois" <?php if ($user_data['region'] == 'Illinois') print ('selected'); ?>>Illinois</option>
                            <option value="Indiana" <?php if ($user_data['region'] == 'Indiana') print ('selected'); ?>>Indiana</option>
                            <option value="Ohio" <?php if ($user_data['region'] == 'Ohio') print ('selected'); ?>>Ohio</option>
                            <option value="Pennsylvania" <?php if ($user_data['region'] == 'Pennsylvania') print ('selected'); ?>>Pennsylvania</option>
                            <option value="New York" <?php if ($user_data['region'] == 'New York') print ('selected'); ?>>New York</option>
                            <option value="Washington" <?php if ($user_data['region'] == 'Washington') print ('selected'); ?>>Washington</option>
                        </select>
                    </label>
                    <label>
                        <textarea class="input_user3" placeholder="About myself" name="biography"><?php print ($user_data['biography']); ?></textarea>
                    </label>
                    <button class="btn" type="submit" name="register">
                        <img alt="registration" src="menu_en/menu4.png" onmouseover="this.src='menu_en/menu4h.png'" onmouseout="this.src='menu_en/menu4.png'">
                    </button>
                    <a class="btn" href="exit.php" type="submit" name="out">
                        <img alt="выход" src="menu_en/menu5.png" onmouseover="this.src='menu_en/menu5h.png'" onmouseout="this.src='menu_en/menu5.png'">
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
</body>