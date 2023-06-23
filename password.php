<?php 
    session_start(); 
    if ($_SESSION['role'] == 1) {
        $name = $_SESSION['name'];
        $surname = $_SESSION['surname'];
        $newPass = $_SESSION['password'];
        if (!isset($name) || !isset($surname) || !isset($newPass)) {
            require_once './backend/API/admin.php';
            $admin = new \DataBase\Admin();
            $admin->changePassword($_POST);
            $name = $_SESSION['name'];
            $surname = $_SESSION['surname'];
            $newPass = $_SESSION['password'];
        }
    } else {
        //redirigir a la página de inicio
        header("Location: index.php");
        exit;
    }
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
    <title>ADMIN | Filmoteca PRAE</title>
</head>
<body>
    <header class="header__home">
        <div class="header__home--img">
            <img src="./img/logo.png" alt="Logo">
        </div>
        <h1 class="header__home--title">Filmoteca</h1>
        <div class="profile">
            <div class="profile__circle" id="profile">
                <p class="profile__circle--text"> A </p>
            </div>
            <div class="profile__info1" id="profile-info">
                <a class="profile__info1--edit" href="./firstPage">Inicio</a>
                <a class="" href="./dashboard.php">Administración de usuarios</a>
                <a class="" href="./token.php">Clave de acceso</a>
                <a class="profile__info1--close" href="./logout.php">Cerrar sesión</a>
            </div>
        </div>
    </header>

    <header class="header__home--mobile">
        <div class="img-mobile">
            <img src="./img/logo.png" alt="Logo">
            <button class="menu" onclick="mostrarMenu()"></button>
        </div>
        <div class="title-mobile">
            <h1>Filmoteca</h1>
        </div>
    </header>

    <section id="options" class="options">
        <div class="options__header">
            <button type="button" class="options__close" onclick="mostrarPantalla()"></button>
        </div>
        <div class="options__menu">
            <a class="profile__info1--edit" href="./firstPage">Inicio</a>
            <a class="" href="./dashboard.php">Administración de usuarios</a>
            <a class="" href="./token.php">Clave de acceso</a>
            <a class="profile__info1--close" href="./logout.php">Cerrar sesión</a>
        </div>
    </section>

    <main class="token_main">
        <section class="token_section">
            <div class="token_section__form">
                <p class="token_section__form--title">Contraseña de Acceso Temporal</p>
                <br>
                <p class="token_section__form--user"><?php echo $name . ' ' . $surname;?> </p>
                <br><br>
                <p class="token_section__form--subtitle">La contraseña de acceso temporal es:</p>
                <p class="token_section__form--key"><?php echo $newPass; ?></p>
            </div>
        </section>
    </main>

    <footer class="footer__home">
        <p class="footer__home--text">© 2023 Copyright: PROYECTO ROBERTO ALONSO ESPINOSA </p>
    </footer>

    <script src="./js/main.js"></script>
</body>
</html>