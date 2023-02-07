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
    <title>Media | Filmoteca PRAE</title>
</head>
<body>
    <header class="header__home">
        <div class="header__home--img">
            <img src="./img/logo.png" alt="Logo">
        </div>
        <h1 class="header__home--title title__small">CDC Zacatlan</h1>
        <div class="profile">
            <div class="profile__circle" id="profile">
                <p class="profile__circle--text">MP</p>
            </div>
            <div class="profile__info" id="profile-info">
                <a class="profile__info--edit" href="#">Editar perfil</a>
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
            <h1>Filmoteca</h1>
        </div>
    </header>

    <section id="options" class="options">
        <div class="options__header">
            <button type="button" class="options__close" onclick="mostrarPantalla()"></button>
        </div>
        <div class="options__menu">
            <a href="#">Editar perfil</a>
            <a href="./mainPage.php">Cerrar sesion</a>
        </div>
    </section>

    <main class="main__media">
        <section class="classify">
            <div class="filter">
                <p class="filter__title">Filtros</p>
                <hr>
                <div class="filter__category">
                    <p class="filter__category--title">Año</p>
                    <div class="category">
                        <div class="category__option">
                            <input type="checkbox" name="" id="anteriores">
                            <label for="anteriores">Años anteriores</label>
                            <span>(12)</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="gallery">
            <section class="media">
                <div class="media__img">
                    <img src="./img/zacatlan.jpeg" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
                <div class="media__img">
                    <img src="./img/foto1.png" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
                <div class="media__img">
                    <img src="./img/eventos.jpg" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
                <div class="media__img">
                    <img src="./img/historia.jpeg" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
                <div class="media__img">
                    <img src="./img/foto2.png" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
                <div class="media__img">
                    <img src="./img/foto7.png" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
                <div class="media__img">
                    <img src="./img/foto3.png" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
                <div class="media__img">
                    <img src="./img/foto6.png" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
                <div class="media__img">
                    <img src="./img/foto4.png" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
                <div class="media__img">
                    <img src="./img/foto5.png" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
                <div class="media__img">
                    <img src="./img/foto8.png" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
                <div class="media__img">
                    <img src="./img/foto12.png" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
                <div class="media__img">
                    <img src="./img/foto9.png" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
                <div class="media__img">
                    <img src="./img/foto11.png" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
                <div class="media__img">
                    <img src="./img/foto10.png" alt="">
                    <div class="media__img--button">
                        <div class="download">
                            <span class="download__img"></span>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <footer class="footer__home">
        <p class="footer__home--text">© 2023 Copyright: PROYECTO ROBERTO ALONSO ESPINOSA </p>
    </footer>

    <script src="./js/main.js"></script>
</body>
</html>