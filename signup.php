<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

    <div class="background">
        <div class="pattern">
            <div class="rectangle rectangle1"></div>
            <div class="rectangle rectangle2"></div>
            <div class="rectangle rectangle3"></div>
        </div>
        
        <div class="vertical_lines">
            <div class="lines">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>
    </div>

    <?php
        $title="Форма регистрации";
        require __DIR__ . '/header.php';
        require "db.php";
    ?>
    
    <?php

        $data = $_POST;

        if(isset($data['do_signup'])) {
            
            $errors = array ();

            if(trim($data['login']) == '') {
                $errors[] = "Введите логин!";
            }

            if(trim($data['email']) == '') {
                $errors[] = "Введите Email";
            }

            if(trim($data['name']) == '') {
                $errors[] = "Введите Имя";
            }

            if(trim($data['family']) == '') {
                $errors[] = "Введите фамилию";
            }

            if($data['password'] == '') {
                $errors[] = "Введите пароль";
            }

            if($data['password_2'] != $data['password']) {
                $errors[] = "Повторный пароль введен не верно!";
            }

            if(mb_strlen($data['login']) < 5 || mb_strlen($data['login']) > 90) {

                $errors[] = "Недопустимая длина логина";
            }
        
            if (mb_strlen($data['name']) < 3 || mb_strlen($data['name']) > 50){
                $errors[] = "Недопустимая длина имени";
            }
        
            if (mb_strlen($data['family']) < 5 || mb_strlen($data['family']) > 50){
                $errors[] = "Недопустимая длина фамилии";
            }
        
            if (mb_strlen($data['password']) < 2 || mb_strlen($data['password']) > 8){
                $errors[] = "Недопустимая длина пароля (от 2 до 8 символов)";
            }
        
            // проверка на правильность написания Email
            if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $data['email'])) {
                $errors[] = 'Неверно введен е-mail';
            }
        
            // Проверка на уникальность логина
            if(R::count('users', "login = ?", array($data['login'])) > 0) {
                $errors[] = "Пользователь с таким логином существует!";
            }
        
            // Проверка на уникальность email
            if(R::count('users', "email = ?", array($data['email'])) > 0) {
                $errors[] = "Пользователь с таким Email существует!";
            }
        
            if(empty($errors)) {
        
                // Все проверено, регистрируем
                // Создаем таблицу users
                $user = R::dispense('users');
        
                // добавляем в таблицу записи
                $user->login = $data['login'];
                $user->email = $data['email'];
                $user->name = $data['name'];
                $user->family = $data['family'];
        
                // Хешируем пароль
                $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        
                // Сохраняем таблицу
                R::store($user);
                echo '<div style="color: green; position: absolute; z-index:1; top: 0; left: 50%; width: auto; transform:translateX(-50%);">Вы успешно зарегистрированы! Можно <a href="login.php">авторизоваться</a>.</div>';
        
            } 
            else {
                // array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент. 
                echo '<div style="color: red; position: absolute; z-index:1; top: 0; left: 50%; width: auto; transform:translateX(-50%);">' . array_shift($errors). '</div>';
            }
        }
    ?>
    
    <div class="container_login">
        <div class="login_panel">
            <div class="login_panel2">
                <h1 class="h1">Registering your account</h1>
                <form action="signup.php" method="post">

                    <label for="login">Your login</label>
                    <input type="text" class="form-control" name="login" id="login" required>

                    <label for="email">Your Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>

                    <label for="name">Your name</label>
                    <input type="text" class="form-control" name="name" id="name">

                    <label for="family">Your last name</label>
                    <input type="text" class="form-control" name="family" id="family">
                    
                    <label for="password">Your password</label>
                    <input type="password" class="form-control" name="password" id="password" required>

                    <label for="password_2">Confirm password</label>
                    <input type="password" class="form-control" name="password_2" id="password_2" required>

                    <button class="btn btn-success" name="do_signup" type="submit">CONTINUE</button>


                    
                </form>
            </div>
            <div class="footer_login">
                <div id="err" name="err"></div>
                <p>Already have an account <a href="login.php">Sign in</a></p>
                <p>Go back to the <a href="index.php">Main page</a></p>
            </div>
        </div>
    </div>

    <?php require __DIR__ . '/footer.php'; ?> <!-- Подключаем подвал проекта -->
</body>
</html>