<?php
session_start();
if(isset($_SESSION['sesion']) != true) {
    header("location:./index.php"); 
}
$nombre = $_SESSION['name'];
$apellido = $_SESSION['surname'];
$email = $_SESSION['email'];
$usuario = $_SESSION['username'];
$id = $_SESSION['id'];
?>


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
    <title>Profile | Filmoteca PRAE</title>
    <style>
        .loader {
            visibility: hidden;
            opacity: 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(20, 20, 20, 0.95);
            z-index: 5;
            display: flex;
            justify-content: center;
            align-items: center;
            transition:all .3s ease;
        }

        .spinner {
            width: 44px;
            height: 44px;
            animation: spinner-y0fdc1 2s infinite ease;
            transform-style: preserve-3d;
        }

        .spinner > div {
            background-color: rgba(0,77,255,0.2);
            height: 100%;
            position: absolute;
            width: 100%;
            border: 2px solid #004dff;
        }

        .spinner div:nth-of-type(1) {
            transform: translateZ(-22px) rotateY(180deg);
        }

        .spinner div:nth-of-type(2) {
            transform: rotateY(-270deg) translateX(50%);
            transform-origin: top right;
        }

        .spinner div:nth-of-type(3) {
            transform: rotateY(270deg) translateX(-50%);
            transform-origin: center left;
        }

        .spinner div:nth-of-type(4) {
            transform: rotateX(90deg) translateY(-50%);
            transform-origin: top center;
        }

        .spinner div:nth-of-type(5) {
            transform: rotateX(-90deg) translateY(50%);
            transform-origin: bottom center;
        }

        .spinner div:nth-of-type(6) {
            transform: translateZ(22px);
        }

        @keyframes spinner-y0fdc1 {
            0% {
            transform: rotate(45deg) rotateX(-25deg) rotateY(25deg);
            }

            50% {
            transform: rotate(45deg) rotateX(-385deg) rotateY(25deg);
            }

            100% {
            transform: rotate(45deg) rotateX(-385deg) rotateY(385deg);
            }
        }

    </style>
</head>
<body>
    <div class="loader">
        <div class="spinner">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <header class="header__home">
        <div class="header__home--img">
            <img src="./img/logo.png" alt="Logo">
        </div>
        <h1 class="header__home--title title__small">Editar Perfil</h1>
        <div class="profile">
            <div class="profile__circle" id="profile">
                <p class="profile__circle--text" id="username-text"></p>
            </div>
            <div class="profile__info" id="profile-info">
                <a class="profile__info--edit" href="./editProfile.php">Editar perfil</a>
                <a class="profile__info--close" href="./logout.php">Cerrar sesión</a>
            </div>
        </div>
    </header>

    <header class="header__home--mobile">
        <div class="img-mobile">
            <img src="./img/logo.png" alt="Logo">
            <button class="menu" onclick="mostrarMenu()"></button>
            <a href="./firstPage.php" class="return"></a>
        </div>
        <div class="title-mobile">
            <h1>Editar Perfil</h1>
        </div>
    </header>

    <main class="edit">
        <div class="edit__profile">
            <img src="./img/user_edit.png" alt="User">
            <form method="post" id="edit__profile">
                <input class="edit__profile--input" type="text" name="name" id="name" value="<?php echo $nombre ?>" placeholder="Nombre">
                <input class="edit__profile--input" type="text" name="surname" id="surname" value="<?php echo $apellido ?>" placeholder="Apellidos">
                <input class="edit__profile--input" type="text" name="email" id="email" value="<?php echo $email ?>" placeholder="Correo electrónico">
                <input class="edit__profile--input" type="text" name="user" id="user" value="<?php echo $usuario ?>" placeholder="Usuario">
                <div class="form__error" id="form__error">
                        <p id="error__p"></p>
                </div>
                <input class="edit__profile--save" type="submit" value="Guardar" id="submit__edit">
            </form>
        </div>
    </main>

    <section id="options" class="options">
        <div class="options__header">
            <button type="button" class="options__close" onclick="mostrarPantalla()"></button>
        </div>
        <div class="options__menu">
            <a href="#">Editar perfil</a>
            <a href="./logout.php">Cerrar sesion</a>
        </div>
    </section>

    <footer class="footer__home" id="footer__edit">
        <p class="footer__home--text">© 2023 Copyright: PROYECTO ROBERTO ALONSO ESPINOSA </p>
    </footer>

    <script src="./js/main.js"></script>
    <script src="./js/edit.js"></script>
</body>
</html>