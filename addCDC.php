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
    <title>Add | Filmoteca PRAE</title>
</head>
<body class="body__add">
    <header class="header__home">
        <div class="header__home--img">
            <img src="./img/logo.png" alt="Logo">
        </div>
        <h1 class="header__home--title title__small" id="title-desktop">Añadir CDC</h1>
        <div class="profile">
            <div class="profile__circle" id="profile">
                <p class="profile__circle--text"> </p>
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
            <h1 id="title-mobile">Añadir CDC</h1>
        </div>
    </header>

    <section id="options" class="options">
        <div class="options__header">
            <button type="button" class="options__close" onclick="mostrarPantalla()"></button>
        </div>
        <div class="options__menu">
            <a href="./editProfile.php">Editar perfil</a>
            <a href="./logout.php">Cerrar sesion</a>
        </div>
    </section>

    <main class="main__media">
        <section class="addCDC">
            <div class="addCDC__form">
                <p class="addCDC__form--title">Datos generales</p>
                <div class="form__addCDC--form">
                    <form action="" method="post">
                        <div class="addCDC__input">
                            <input required type="text" name="nameCDC" id="nameCDC" placeholder="Nombre"/>
                        </div>
                        <div class="addCDC__input">
                            <input required type="text" name="addressCDC" id="addressCDC" placeholder="Dirección"/>
                        </div>
                        <div class="addCDC__input">
                            <input required type="tel" name="phoneCDC" id="phoneCDC" placeholder="Teléfono"/>
                        </div>
                        <div class="addCDC__input">                           
                                <input class="inputCDC" required type="file" name="imageCDC" id="imageCDC" accept="image/png, image/jpeg, image/jpg"/>                           
                        </div>
                        
                        <div class="form__error" id="form__error">
                            <p id="form__error--text">Existen campos vacíos</p>
                        </div>

                        <input type="submit" value="Guardar" class="submit__addCDC" id="createCDC">
                    </form>
                </div>
            </div>
        </section>

    </main>


    <footer class="footer__home" id="footer__media">
        <p class="footer__home--text">© 2023 Copyright: PROYECTO ROBERTO ALONSO ESPINOSA </p>
    </footer>

    <script src="./js/main.js"></script>
</body>
</html>