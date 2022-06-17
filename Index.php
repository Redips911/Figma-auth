<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main page</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    
    <div class="background">
        <div class="pattern">
            <div class="rectangle rectangle1"></div>
            <div class="rectangle rectangle2"></div>
            <div class="rectangle rectangle3"></div>
        </div>
        
        <?php
            $title="Главная страница";
            require __DIR__ . '/header.php';
            require "db.php";
        ?>
        
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

    <div class="container_login">
        <div class="login_panel">
            <div class="login_panel2">
                <p>Welcome!👋</p>
                <h1 class="h1">Добро пожаловать</h1>
                
                <?php if(isset($_SESSION['logged_user'])) : ?>
                <?php echo $_SESSION['logged_user']->name ;?>
                <?php echo $_SESSION['logged_user']->family; ?>
                <img src="img/che.png" alt="che">

                <p style="text-align: center;">
                    Тут нихуя нету)))<br>
                    но ты авторизовался))
                </p>
                <br>

                <a href="logout.php">выйти</a>
                <?php else : ?>
                    
                <a href="login.php">Авторизоваться</a><br>
                <a href="signup.php">Зарегистрироваться</a>
                <?php endif; ?>
                
            </div>
            <div class="footer_login">
            </div>
        </div>
    </div>
    <?php require __DIR__ . '/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>