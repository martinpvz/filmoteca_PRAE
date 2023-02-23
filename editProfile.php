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
</head>
<body>
    <header class="header__home">
        <div class="header__home--img">
            <img src="./img/logo.png" alt="Logo">
        </div>
        <h1 class="header__home--title title__small">Editar Perfil</h1>
        <div class="profile">
            <div class="profile__circle" id="profile">
                <p class="profile__circle--text">MP</p>
            </div>
            <div class="profile__info" id="profile-info">
                <a class="profile__info--edit" href="./editProfile.php">Editar perfil</a>
                <a class="profile__info--close" href="./mainPage.php">Cerrar sesión</a>
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
            <form action="./firstPage.php">
                <input class="edit__profile--input" type="text" name="name" id="name" placeholder="Nombre">
                <input class="edit__profile--input" type="text" name="surname" id="surname" placeholder="Apellidos">
                <input class="edit__profile--input" type="text" name="email" id="email" placeholder="Correo electrónico">
                <input class="edit__profile--input" type="text" name="user" id="user" placeholder="Usuario">
                <div class="form__error" id="form__error">
                        <p>Existen campos vacíos</p>
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
            <a href="./mainPage.php">Cerrar sesion</a>
        </div>
    </section>

    <main>

    </main>

    <footer class="footer__home" id="footer__edit">
        <p class="footer__home--text">© 2023 Copyright: PROYECTO ROBERTO ALONSO ESPINOSA </p>
    </footer>

    <script src="./js/main.js"></script>
    <script src="./js/edit.js"></script>
</body>
</html>