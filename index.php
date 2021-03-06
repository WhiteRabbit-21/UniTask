<?php 
    session_start();

    if(!isset($_SESSION["session_email"])):
    header("location:php/login.php");
    else:
?> <!-- php-функция для проверки сессии пользователя. Если пользователь не авторизирован, то идет пересылка на login.php, страничка авторизации -->
<?php require_once("php/connection.php"); ?> <!-- Подключайм файл с подключением к БД -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>КУРСАЧ</title>
    <link href="css/style.css" media="screen" rel="stylesheet">
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script> <!-- Обьязательно подключаем jquery (ajax) -->
	<style> div.logo {margin-left: 30px; margin-right: 30px;}
	</style>
</head>
<body>
    <div id="heading" class="container">
        
	<div class="logo"> 
	<img src="LogoEU.png" width="90" alt="LOGO"></div>
	<h2>База даних студентів гуртожитку </br> Європейського університету</h2>
        <div id="menu">
            <div id="menuButton"  class="mBtnMain But">Головна</div>
            <div id="menuButton"  class="mBtnCtrl But">Керування</div>
            <div id="menuButton" class="mBtnExit But">Вихід</div>
        </div> <!-- Все кнопки в меню обрабатываются в button.js -->
    </div>
    <div id="workspace">
        <div id="infoBar">
            <div id="infoUser" class="container">
                <?php
                    $sessionEmail = $_SESSION["session_email"];
                    $result = mysqli_query($con, "SELECT * FROM user WHERE email = '$sessionEmail'");
                    $row = mysqli_fetch_array($result);
                    printf("<smth>Ласкаво просимо,<b> " .$row[name] . " " .$row[surname]. "!</b><smth>");
                ?> <!-- Функция выводит ФИО авторизированого пользователя на экран. Берет данные из БД -->
            </div>
            <div id="findField" class="container Find">
                Введіть прізвище та ім`я:
                <input type="text" name="name" class="name"></input>
                <button class="find">Пошук</button> 
            </div> <!-- Поиск студента за ФИО. Обрабатывается в button.js -->
        </div>
        <div id="result" class="container">
            <table cellspacing='10'>
                <caption><b>Особиста справа:</b></caption>
                <tr><td>Ім'я:</td><td id='pInfo'></td></tr>
                <tr><td>Призвіще:</td><td id='pInfo'></td></tr>
                <tr><td>По батькові:</td><td id='pInfo'></td></tr>
                <tr><td>Номер телефон:</td><td id='pInfo'></td></tr>
                <tr><td>Дата народження:</td><td id='pInfo'></td></tr>
                <tr><td>Номер телефону батьків:</td><td id='pInfo'></td></tr>
                <tr><td>Гуртожиток:</td><td id='pInfo'></td></tr>
                <tr><td>Кімната:</td><td id='pInfo'></td></tr>
                <tr><td>Дата заселелення:</td><td id='pInfo'></td></tr>
                <tr><td>Факультет:</td><td id='pInfo'></td></tr>
            </table> <!-- Просто поле с личным делом, где отображается информация по поиску студента. Заметка, после того, как была нажата кнопка "Пошук", данный div полностью переписывается на новый, в котором остаются поля, но добавляется информация. -->
        </div>

        <div id="commonList" class="container"> <!-- Информация в этом блоке обновляется автоматически из-за скрипта timer.js, который каждую минуту(наверное) обновляет и берет инфо через php-файл commonList  -->
        </div> 

        <div id="newStudent" class="container"> <!-- Данный div появляется когда пользователь нажимает кнопку "Керування", предыдущие блоки пропадают. -->
            <b><txtsize>Зареєструвати студента</txtsize></b>
            <p>Ім`я</p>
            <input type="text" name="nameStud" class="nameStud">

            <p>Призвіще</p>
            <input type="text" name="lastName" class="lastName">

            <p>По-Батькові</p>
            <input type="text" name="secondName" class="secondName">

            <p>Стать:</p>

            <label>Чоловіча
            <input type="checkbox" name="man" id="man">
	    </label>

            <label>Жіноча
            <input type="checkbox" name="woman" id="woman">
	    </label>

            <p>Дата народження:</p>
            <input type="date" name="birth" id="birth">

            <p>Дата заселення:</p>
            <input type="date" name="reg" id="reg">

	    <p>Гуртожиток:</p>
            <select id="selectDorm" class="selectDorm" onchange="fun2()">
	    <option value="SelectVar">Виберіть гутожиток</option>
            <option value=”Fst”>Перший</option>
            <option value=”Snd”>Другий</option>
            <option value=”Thd”>Третій</option>
            </select>
	

            <p>Факультет</p>
            <select id="selectFaculty" class="selectFaculty" onchange="fun1()">
		<option value="SelectVar">Виберіть факультет</option>
                <option value=”FIST”>ФІСТ</option>
                <option value=”FEM”>ФЕМ</option>
                <option value=”FBP”>ФБП</option>
                <option value="UF">ЮФ</option>
                <option value="BK">БК</option>
                <option value="other">Інший ВНЗ</option>
            </select>

            <p>Група</p>
            <input type="text" id="groupe" class="groupe">

            <p>Номер телефону</p>
            <input type="text" name="phone" class="phone">

            <p>Номер телефон батьків</p>
            <input type="text" name="parentsPhone" class="parentsPhone">

            <p>Кімната</p>
            <input type="text" name="room" class="room">

            <button class="create">Додати</button>
        </div>
    </div> <!-- Всю новую информацию обрабатывает button.js -->

    <div id="footer" class="container">
    <a href="http://127.0.0.1/openserver/phpmyadmin/index.php">
    <b><txt>База даних</txt></b></a></div>
    <script src="js/button.js"></script>
    <script src="js/timer.js"></script>
</body>
</html>
<?php endif; ?>