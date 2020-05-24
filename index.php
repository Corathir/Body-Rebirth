<?php
session_start();
?>
<!doctype html>

<html lang="ru">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="icon.png" type="image/png">
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="slick/slick.css">
    <link rel="stylesheet" href="slick/slick-theme.css">
    <!-- JavaScript -->
    <script src="jquery-3.4.1.min.js" defer></script>
    <script src="slick/slick.min.js" defer></script>
    <script src="calc.js" defer></script>

    <title>BodyRebirth: главная</title>
</head>

<body>

<header>
    <div class="max-width"><img alt="шапка" src="header.gif"></div>
</header>

<!-- Меню -->
<nav class="max-width">
    <ul id="menu">
        <li><a href="#prosthesis"><img alt="протезы" src="menu/menu1.png" onmouseover="this.src='menu/menu1h.png'" onmouseout="this.src='menu/menu1.png'"></a></li>
        <li><a href="#chips"><img alt="чипы" src="menu/menu2.png" onmouseover="this.src='menu/menu2h.png'" onmouseout="this.src='menu/menu2.png'"></a></li>
        <li><a href="<?php print ('sign_in.php'); ?>"><img alt="аккаунт" src="menu/menu3.png" onmouseover="this.src='menu/menu3h.png'" onmouseout="this.src='menu/menu3.png'"></a></li>
    </ul>
</nav>

<div class="max-width main_div">
    <h1>Каталог товаров</h1>
    <h2 id="prosthesis">Протезы</h2>
    <div class="product">
        <table class="product__element">
            <tr>
                <th><img alt="протезы ног" src="prosthesis/legs.jpg"></th>
            </tr>
            <tr>
                <th class="product__name">Протезы ног Sarif</th>
            </tr>
            <tr>
                <th>Размер: под заказ<br>Функции: амортизация</th>
            </tr>
            <tr>
                <th>Стоимость: 30000 RUB</th>
            </tr>
        </table>
        <table class="product__element">
            <tr>
                <th><img alt="протез руки" src="prosthesis/hand.jpg"></th>
            </tr>
            <tr>
                <th class="product__name">Протез руки Isolay</th>
            </tr>
            <tr>
                <th>Размер: под заказ<br>Функции: V.A.T.S.,<br>встроенные<br>клинки-богомолы</th>
            </tr>
            <tr>
                <th>Стоимость: 40000 RUB</th>
            </tr>
        </table>
        <table class="product__element">
            <tr>
                <th><img alt="глазной протез" src="prosthesis/eyez.jpg"></th>
            </tr>
            <tr>
                <th class="product__name">Глазной протез Sarif TI Z10x M</th>
            </tr>
            <tr>
                <th>Размер: 25мм в диаметре<br>Функции: тепловизор, 10х Zoom,<br>интерфейс аугментаций</th>
            </tr>
            <tr>
                <th>Стоимость: 60000 RUB</th>
            </tr>
        </table>
    </div>

    <h2 id="chips">Чипы</h2>
    <div class="product">
        <table class="product__element">
            <tr>
                <th><img alt="MTOD12 CONTROL CHIP" src="chips/chip1.jpg"></th>
            </tr>
            <tr>
                <th class="product__name">MTOD12 CONTROL CHIP Isolay</th>
            </tr>
            <tr>
                <th>Функции: позволяет<br>контролировать MTOD12</th>
            </tr>
            <tr>
                <th>Стоимость: 50000 RUB</th>
            </tr>
        </table>
        <table class="product__element">
            <tr>
                <th><img alt="C.A.S.L.E." src="chips/chip2.jpg"></th>
            </tr>
            <tr>
                <th class="product__name">C.A.S.L.E. Sharif</th>
            </tr>
            <tr>
                <th>Характеристики: RAM - 1tb<br>Частота процессора - 35ghz x5</th>
            </tr>
            <tr>
                <th>Стоимость: 70000 RUB</th>
            </tr>
        </table>
    </div><br><br>

    <h2 id="gallery">Галерея</h2>
    <div class="gallery">
        <div><img src="gallery/01.jpg" alt="Картинка 1"></div>
        <div><img src="gallery/02.jpg" alt="Картинка 2"></div>
        <div><img src="gallery/03.jpg" alt="Картинка 3"></div>
        <div><img src="gallery/04.jpg" alt="Картинка 4"></div>
        <div><img src="gallery/05.jpg" alt="Картинка 5"></div>
        <div><img src="gallery/06.jpg" alt="Картинка 6"></div>
        <div><img src="gallery/07.jpg" alt="Картинка 7"></div>
        <div><img src="gallery/08.jpg" alt="Картинка 8"></div>
        <div><img src="gallery/09.jpg" alt="Картинка 9"></div>
    </div>

    <div>
        <h2>Расчет стоимости глазного протеза<br>(под заказ)</h2>
        <div id="prodPrice">Выберите тип товара</div>
        Цвет радужки:
        <form onkeypress="return event.keyCode != 13">
            <label>
                <select name="color">
                    <option value="1">Карий</option>
                    <option value="2">Голубой</option>
                    <option value="3">Красный</option>
                </select>
            </label>
            <label for="kolvo"><input type="number" id="kolvo" value="1"></label>
            <div id="zoom">
                <label><input type="radio" name="zoomx" value="x10">Zoom x10</label>
                <label><input type="radio" name="zoomx" value="x15">Zoom x15</label>
                <label><input type="radio" name="zoomx" value="x25">Zoom x25</label>
            </div>
            <div id="functions">
                <label><input type="checkbox" name="thermalImager">Тепловизор</label>
                <label><input type="checkbox" name="interface">Интерфейс аугментаций</label>
            </div>
        </form>
    </div>
</div>

<footer>
    <div>(с) Василин Юрий 2020</div>
</footer>
</body>
</html>