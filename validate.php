<?php
//проверяем, совпадают ли пароли
if (!($_POST['password'] == $_POST['confirm_password']))
{
    $error[] = '<div class="rus_lang error">Пароли не совпадают</div><br>';
    $error[] = '<div class="en_lang error">Password mismatch</div><br>';
}
else
{
    //массив ошибок
    $error = array();
    //подключаемся к базе данных
    require 'db_connect.php';
    $username = $_POST['username'];

    $select = $db->prepare("SELECT * FROM users where username=:username");
    $select->bindParam(':username', $username);
    $select->execute();
    $user_data = $select->fetch(PDO::FETCH_ASSOC);

    if(!preg_match("/^[a-zA-Z0-9]{1,20}$/", $username))
    {
        $error[] = '<div class="rus_lang error">В имени пользователя допускается только латиница и цифры,
            <br>лимит символов - 20</div><br>';
        $error[] = '<div class="en_lang error">Only Latin characters and numbers are allowed in the username,
            <br>the character limit is 20</div><br>';
    }

    //проверяем, существует ли пользователь с таким же именем
    elseif ($user_data)
    {
        $error[] = '<div class="rus_lang error">Пользователь с таким именем уже существует</div><br>';
        $error[] = '<div class="en_lang error">A user with the same nickname already exists</div><br>';
    }

    else
    {
        //хэшируем пароль
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //сохраняем email
        $email = $_POST['email'];

        //Устанавливаем шаблонную аватарку
        $avatar_path = "avatars/No_Name.jpg";
        //вносим данные в базу
        try
        {
            $insert = $db->prepare("INSERT INTO users (username, email, password, avatar)
                VALUES (:username, :email, :password, :avatar)");
            $insert->bindParam(':username', $username);
            $insert->bindParam(':email', $email);
            $insert->bindParam(':password', $password);
            $insert->bindParam(':avatar', $avatar_path);
            $insert->execute();
        }
        catch(PDOException $e)
        {
            $error[] = "<div class='rus_lang error'>Не удалось записать данные в базу: $e</div><br>";
            $error[] = "<div class='en_lang error'>Failed to write data to the database: $e</div><br>";
        }
    }
}
$db = null;