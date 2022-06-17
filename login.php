<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>authorization</title>
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
        $title="Форма авторизации";
        require __DIR__ . '/header.php';
        require "db.php";
    ?>

    <?php
        $data = $_POST;
        if(isset($data['do_login'])) {

            $errors = array();
            $user = R::findOne('users', 'login = ?', array($data['login']));

            if($user) {
                if(password_verify($data['password'], $user->password)) {
                    $_SESSION['logged_user'] = $user;
                    header('Location: index.php');
                } 
                else {
                    $errors[] = 'Пароль неверно введен!';
                }
            }

            else {
                $errors[] = 'Пользователь с таким логином не найден!';
            }
    
            if(!empty($errors)) {
                echo '<div style="color: red; position: absolute; z-index:1; top: 0; left: 50%; width: auto; transform:translateX(-50%);">' . array_shift($errors). '</div>';
            }
        }
    ?>

    <div class="container_login">
        <div class="login_panel">
            <div class="login_panel2">
                <p>Welcome back! 👋</p>
                <h1 class="h1">Sign in to your account</h1>
                <form form action="login.php" method="post">
                    
                    <label for="text">Your login</label>
                    <input type="text" class="form-control" name="login" id="login" required>

                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="pass" required>

                    <button class="btn btn-success" name="do_login" type="submit"">CONTINUE</button>
                    <a href="#">Forget your password?</a>

                </form>
            </div>
            <div class="footer_login">
                <p>Don’t have an account? <a href="signup.php">Sign up</a></p>
                <p>Go back to the <a href="index.php">Main page</a></p>
            </div>
        </div>
    </div>

    <?php require __DIR__ . '/footer.php'; ?>
</body>
</html>