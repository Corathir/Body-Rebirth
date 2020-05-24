<?php
//копируем имя пользователя из сессии
$username = $_SESSION['username'];

//массив ошибок
$error = array();

//подключаемся к базе данных
require 'db_connect.php';

//проверяем, был ли запрос на смену пароля
if ($_POST['password'])
{
    //совпадают ли пароли
    if (!($_POST['password'] == $_POST['confirm_password']))
    {
        $error[] = '<div class="rus_lang error">Пароли не совпадают</div><br>';
        $error[] = '<div class="en_lang error">Password mismatch</div><br>';
    }
    //верен ли старый пароль
    elseif (!password_verify($_POST['old_password'], $user_data['password']))
    {
        $error[] = '<div class="rus_lang error">Неверный пароль!</div><br>';
        $error[] = '<div class="en_lang error">Incorrect password!</div><br>';
    }
    else
    {
        //если ошибок не было, хэшируем новый пароль и заносим его в базу
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        try
        {
            $update = $db->prepare("UPDATE users SET password = :password WHERE username=:username");
            $update->bindParam(':password', $password);
            $update->bindParam(':username', $username);
            $update->execute();
        }
        catch(PDOException $e)
        {
            $error[] = 'Error : ' . $e->getMessage();
        }
    }
}

//проверим, обновлял ли пользователь аватарку
if (is_uploaded_file($_FILES['avatar']['tmp_name']))
{
    //проверяем тип файла
    if (!preg_match("!image!", $_FILES['avatar']['type']))
    {
        $error[] = '<div class="rus_lang error">Не удалось загрузить изображение</div><br>';
        $error[] = '<div class="en_lang error">Failed to upload image.</div><br>';
    }
    else
    {
        //определяем тип изображения
        $image_type = getimagesize($_FILES['avatar']['tmp_name']) [2];
        switch ($image_type)
        {
            case 1:
                $image_type = 'gif';
                break;
            case 2:
                $image_type = 'jpg';
                break;
            case 3:
                $image_type = 'png';
                break;
            default:
                $error[] = '<div class="rus_lang error">Изображение должно быть в формате jpg, png или gif</div><br>';
                $error[] = '<div class="en_lang error">Image must be in jpg, png or gif format</div><br>';
        }

        //имя файла будет переименовано в соответствии с именем пользователя
        $avatar_path = "avatars/" . $_POST['username'] . '.' . $image_type;

        //сохраняем аватарку в папку avatars
        if (!rename($_FILES['avatar']['tmp_name'], $avatar_path))
        {
            $error[] = '<div class="rus_lang error">Не удалось загрузить изображение</div><br>';
            $error[] = '<div class="en_lang error">Failed to upload image.</div><br>';
        }
        else {
            //обновляем данные
            $update = $db->prepare("UPDATE users SET avatar = :avatar WHERE username=:username");
            $update->bindParam(':avatar', $avatar_path);
            $update->bindParam(':username', $username);
            $update->execute();
            unlink($_FILES['avatar']);
        }
    }
}

//копируем остальные данные пользователя из массива $_POST
$email = $_POST['email'];
$name = $_POST['name'];
$birth = $_POST['birth'];
$region = $_POST['region'];
$biography = $_POST['biography'];

if(empty($error)) {
    try {
        //обновляем данные
        $update = $db->prepare("UPDATE users
        SET email = :email, name = :name, birth = :birth, region = :region, biography = :biography
        WHERE username=:username");
        $update->bindParam(':email', $email);
        $update->bindParam(':name', $name);
        $update->bindParam(':birth', $birth);
        $update->bindParam(':region', $region);
        $update->bindParam(':biography', $biography);
        $update->bindParam(':username', $username);
        $update->execute();
        //обновляем страницу
        header('Location: account.php');
    } catch (PDOException $e) {
        $error[] = 'Error : ' . $e->getMessage();
    }
}

$db = null;