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
    <title>Recover | Filmoteca PRAE</title>
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
                        <input required class="required" type="text" name="code" id="code" placeholder="Ingrese el código de 6 dígitos">
                    </div>
                    <div class="form__input">
                        <input type="password" name="password" id="passwordR" placeholder="Nueva contraseña">
                        <span class="form__input--show" id="show__passwordR"></span>
                    </div>
                    <div class="form__input">
                        <input type="password" name="confirmation" id="confirmation" placeholder="Confirmar contraseña">
                        <span class="form__input--show" id="show__confirmation"></span>
                    </div>

                    <div class="form__error" id="form__error">
                        <p id="error__text">El correo es obligatorio</p>
                    </div>

                    <input type="submit" value="Recuperar" class="submit" id="recover">
                </form>
            </div>
        </div>
    </main>

    <script src="./js/changePassword.js"></script>
</body>
</html>