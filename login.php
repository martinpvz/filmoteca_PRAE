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
        <a href="./mainPage.php"><img src="./img/return.png" class="header__login--return" alt="Return"></a>
        <img src="./img/logo.png" alt="Logo" class="header__login--logo">
    </header>

    <main class="main__login">
        <div class="form__login">
            <div class="form__login--buttons">
                <button id="login">Iniciar sesión</button>
                <button id="register">Registrarse</button>
            </div>
            <div class="form__login--form">
                <form action="" method="post">
                    <div class="form__input">
                        <input type="text" name="user" id="user" placeholder="Usuario">
                        <span class="form__input--img"></span>
                    </div>

                    <input type="submit" value="Acceder">
                </form>
            </div>
        </div>
    </main>

    <footer class="footer__login">
        <p class="footer__login--text">© 2023 Copyright: PROYECTO ROBERTO ALONSO ESPINOSA </p>
    </footer>
</body>
</html>