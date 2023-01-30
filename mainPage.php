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
    <title>Filmoteca PRAE</title>
</head>
<body class="body__mainpage">
    <header class="header__mainpage">
        <nav class="nav__mainpage">
            <img class="nav__mainpage--img" src="./img/logo.png" alt="Logo de la empresa">
            <div class="login__mainpage">
                <a href="#" class="login__mainpage--text">Acceder</a>
            </div>
            <button type="button" class="login__mainpage--button" onclick="mostrarMenu()"></button>
        </nav>
    </header>

    <section id="options" class="options">
        <div class="options__header">
            <button type="button" class="options__close" onclick="mostrarPantalla()"></button>
        </div>
        <div class="options__menu">
            <a href="#">Iniciar sesión</a>
        </div>
    </section>

    <main class="main__mainpage">
        <p class="main__mainpage--title">Filmoteca PRAE</p>
        <p class="main__mainpage--text">
            Este es el repositorio oficial para almacenar el contenido multimedia
            generado por los Centros de Desarrollo Comunitarios pertenecientes
            al Proyecto Roberto Alonso Espinosa
        </p>
    </main>

    <footer class="footer__mainpage">
        <p class="footer__mainpage--text">© 2023 Copyright: PROYECTO ROBERTO ALONSO ESPINOSA </p>
    </footer>

    <script src="./js/main.js"></script>
</body>
</html>