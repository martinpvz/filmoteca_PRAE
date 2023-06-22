<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Login | Filmoteca PRAE</title>
</head>
<body>
    <header class="header__login">
        <a href="./login.php"><img src="./img/return.png" class="header__login--return" alt="Return"></a>
        <img src="./img/logo.png" alt="Logo" class="header__login--logo">
    </header>

    <main class="main__login">
        <div class="form__login">
            <div class="form__login--form">
                <form action="./backend/user/user-recover.php" method="post">
                    <div class="form__input">
                        <input required class="required" type="email" name="email" id="email" placeholder="Ingrese su correo electrónico">
                    </div>

                    <div class="form__error" id="form__error">
                        <p id="error__text">El correo es obligatorio</p>
                    </div>

                    <input type="submit" value="Recuperar" class="submit" id="submit">
                </form>
            </div>
        </div>
    </main>

    <script src="./js/recover.js"></script>
</body>
</html>