<?php
session_start();
if(isset($_SESSION['sesion']) != true) {
    header("location:./mainPage.php"); 
} else {
    if($_SESSION['role'] != 1 && $_SESSION['role'] != 2 && $_SESSION['role'] != 3) {
        header("location:./firstPage.php"); 
    }
}
$nombre = $_SESSION['name'];
$apellido = $_SESSION['surname'];
$role = $_SESSION['role'];
$inicialN = strtoupper(substr($nombre, 0, 1));
$inicialA = strtoupper(substr($apellido, 0, 1));
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
    <title>Add | Filmoteca PRAE</title>
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
<body class="body__add">
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
        <h1 class="header__home--title title__small" id="title-desktop"></h1>
        <div class="profile">
            <div class="profile__circle" id="profile">
                <p class="profile__circle--text"> <?php echo "$inicialN$inicialA" ?> </p>
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
            <h1 id="title-mobile"></h1>
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

    <main class="main__media" id="main__media">
        <section class="classify" id="classify-regular">
                <div class="loaderText">
                    <div class="wrapperText">
                        <div class="circle"></div>
                        <div class="line-1"></div>
                        <div class="line-2"></div>
                        <div class="line-3"></div>
                        <div class="line-4"></div>
                    </div>
                </div>

                <div class="loaderText">
                    <div class="wrapperText">
                        <div class="circle"></div>
                        <div class="line-1"></div>
                        <div class="line-2"></div>
                        <div class="line-3"></div>
                        <div class="line-4"></div>
                    </div>
                </div>
            <div class="filter" id="filter">
                <p class="filter__title">Filtros</p>
                <div class="filter__category">
                    <hr>
                    <p class="filter__category--title">Año</p>
                    <div class="category" id="category-year"></div>
                </div>
                <div class="filter__category">
                    <hr>
                    <p class="filter__category--title">Área</p>
                    <div class="category" id="category-area"></div>
                </div>
                <div class="filter__category" id="category">
                    <hr>
                    <p class="filter__category--title">Categoría</p>
                    <div class="category" id="category-category"></div>
                    <div class="see__more" onclick="changeCategory('category')" id="see-more-category">
                        <p id="see-more-category-text">Ver más</p>
                        <div class="see__more--img" id="see-more-img-category"></div>
                    </div>
                </div>
                <div class="filter__category" id="subcategory">
                    <hr>
                    <p class="filter__category--title">Subcategoría</p>
                    <div class="category" id="category-subcategory"></div>
                    <div class="see__more" onclick="changeCategory('subcategory')" id="see-more-subcategory">
                        <p id="see-more-subcategory-text">Ver más</p>
                        <div class="see__more--img" id="see-more-img-subcategory"></div>
                    </div>
                </div>
                <div class="filter__category" id="type">
                    <hr>
                    <p class="filter__category--title">Tipo</p>
                    <div class="category" id="category-type"></div>
                    <div class="see__more" onclick="changeCategory('type')" id="see-more-type">
                        <p id="see-more-type-text">Ver más</p>
                        <div class="see__more--img" id="see-more-img-type"></div>
                    </div>
                </div>
                <div class="filter__category" id="subtype">
                    <hr>    
                    <p class="filter__category--title">Subtipo</p>
                    <div class="category" id="category-subtype"></div>
                    <div class="see__more" onclick="changeCategory('subtype')" id="see-more-subtype">
                        <p id="see-more-subtype-text">Ver más</p>
                        <div class="see__more--img" id="see-more-img-subtype"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="add">
            <div class="add__form">
                <p class="add__form--title">Agregar nuevo contenido</p>
                <div class="form__add--form">
                    <form id="form__add" action="./firstPage.php" method="post" enctype="multipart/form-data">
                        <div class="add__input">
                            <input required class="date" type="date" name="date" id="date" placeholder="Fecha">
                        </div>
                        <div class="add__input">
                            <input required type="text" name="description" id="description" placeholder="Descripción">
                        </div>
                        <div class="add__input">
                            <select class="input__option">
                                <option value="" disabled selected>Selecciona un tipo</option>
                                <option value="image">Imagen</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                        <div class="add__input" id="rute_input">
                            <input type="text" disabled name="rute" id="rute" placeholder="Ruta (selección en filtros)">
                        </div>
                        <div class="add__input input__file">
                            <input type="file" name="file" id="file" accept="image/png, image/jpeg, image/jpg, video/mp4">
                        </div>

                        <div class="form__error" id="form__error">
                            <p id="form__error--text">Existen campos vacíos</p>
                        </div>

                        <input type="button" value="Registrar" class="submit submit__add" id="submit">
                    </form>
                </div>
            </div>
        </section>

    </main>


    <section id="filter__responsive" class="filter__responsive">
        <div class="filter__responsive--header">
            <button type="button" class="filter__close" onclick="mostrarMedia()"></button>
        </div>
        <section class="classify" id="filter__responsive--section">
            <div class="loaderText">
                <div class="wrapperText">
                    <div class="circle"></div>
                    <div class="line-1"></div>
                    <div class="line-2"></div>
                    <div class="line-3"></div>
                    <div class="line-4"></div>
                </div>
            </div>

            <div class="loaderText">
                <div class="wrapperText">
                    <div class="circle"></div>
                    <div class="line-1"></div>
                    <div class="line-2"></div>
                    <div class="line-3"></div>
                    <div class="line-4"></div>
                </div>
            </div>    
            <div class="filter" id="filter">
                <p class="filter__title">Filtros</p>
                <!-- <hr> -->
                <div class="filter__category">
                    <hr>
                    <p class="filter__category--title">Año</p>
                    <div class="category" id="category-year"></div>
                </div>
                <!-- <hr> -->
                <div class="filter__category">
                    <hr>
                    <p class="filter__category--title">Área</p>
                    <div class="category" id="category-area"></div>
                </div>
                <!-- <hr> -->
                <div class="filter__category" id="category">
                    <hr>
                    <p class="filter__category--title">Categoría</p>
                    <div class="category" id="category-category"></div>
                    <div class="see__more" onclick="changeCategory('category')" id="see-more-category">
                        <p id="see-more-category-text">Ver más</p>
                        <div class="see__more--img" id="see-more-img-category"></div>
                    </div>
                </div>
                <!-- <hr> -->
                <div class="filter__category" id="subcategory">
                    <hr>
                    <p class="filter__category--title">Subcategoría</p>
                    <div class="category" id="category-subcategory"></div>
                    <div class="see__more" onclick="changeCategory('subcategory')" id="see-more-subcategory">
                        <p id="see-more-subcategory-text">Ver más</p>
                        <div class="see__more--img" id="see-more-img-subcategory"></div>
                    </div>
                </div>
                <!-- <hr> -->
                <div class="filter__category" id="type">
                    <hr>
                    <p class="filter__category--title">Tipo</p>
                    <div class="category" id="category-type"></div>
                    <div class="see__more" onclick="changeCategory('type')" id="see-more-type">
                        <p id="see-more-type-text">Ver más</p>
                        <div class="see__more--img" id="see-more-img-type"></div>
                    </div>
                </div>
                <!-- <hr> -->
                <div class="filter__category" id="subtype">
                    <hr>    
                    <p class="filter__category--title">Subtipo</p>
                    <div class="category" id="category-subtype"></div>
                    <div class="see__more" onclick="changeCategory('subtype')" id="see-more-subtype">
                        <p id="see-more-subtype-text">Ver más</p>
                        <div class="see__more--img" id="see-more-img-subtype"></div>
                    </div>
                </div>
            </div>
        </section>
    </section>


    <footer class="footer__home" id="footer__media">
        <p class="footer__home--text">© 2023 Copyright: PROYECTO ROBERTO ALONSO ESPINOSA </p>
    </footer>

    <!-- <script src="./js/main.js"></script> -->
    <script src="./js/add.js"></script>
</body>
</html>