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

    <main class="main__media" id="main__media">
        <section class="classify">
            <div class="filter">
                <p class="filter__title">Seleccione la ruta</p>
                <hr>
                <div class="filter__category">
                    <p class="filter__category--title">Año</p>
                    <div class="category">
                        <div class="category__option">
                            <input type="radio" name="anio" id="anteriores">
                            <label for="anteriores">Años anteriores</label>
                            <span>125</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="anio" id="2021">
                            <label for="2021">2021</label>
                            <span>15</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="anio" id="2020">
                            <label for="2020">2020</label>
                            <span>20</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="filter__category">
                    <p class="filter__category--title">Área</p>
                    <div class="category">
                        <div class="category__option">
                            <input type="radio" name="area" id="anteriores">
                            <label for="anteriores">Educación</label>
                            <span>87</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="area" id="anteriores">
                            <label for="anteriores">Salud</label>
                            <span>13</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="area" id="anteriores">
                            <label for="anteriores">Entorno</label>
                            <span>34</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="area" id="anteriores">
                            <label for="anteriores">Trabajo social</label>
                            <span>94</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="area" id="anteriores">
                            <label for="anteriores">Proyectos y convocatorias</label>
                            <span>94</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="area" id="anteriores">
                            <label for="anteriores">Entrega de donativos</label>
                            <span>32</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="filter__category">
                    <p class="filter__category--title">Categoría</p>
                    <div class="category">
                        <div class="category__option">
                            <input type="radio" name="category" id="anteriores">
                            <label for="anteriores">Atención primaria 
                            a la salud</label>
                            <span>87</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="category" id="anteriores">
                            <label for="anteriores">Prácticas de bienestar
                            comunitario</label>
                            <span>13</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="category" id="anteriores">
                            <label for="anteriores">Educación para la salud</label>
                            <span>34</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="filter__category">
                    <p class="filter__category--title">Subcategoría</p>
                    <div class="category">
                        <div class="category__option">
                            <input type="radio" name="subcategory" id="anteriores">
                            <label for="anteriores">Talleres y prácticas
                            saludables</label>
                            <span>87</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="subcategory" id="anteriores">
                            <label for="anteriores">Formación curricular</label>
                            <span>13</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="subcategory" id="anteriores">
                            <label for="anteriores">Capacitación en
                            seguridad y protección
                            escolar</label>
                            <span>34</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="filter__category">
                    <p class="filter__category--title">Tipo</p>
                    <div class="category">
                        <div class="category__option">
                            <input type="radio" name="type" id="anteriores">
                            <label for="anteriores">Seguridad y prevención
                            de accidentes</label>
                            <span>2</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="filter__category">
                    <p class="filter__category--title">Subtipo</p>
                    <div class="category">
                        <div class="category__option">
                            <input type="radio" name="subtype" id="anteriores">
                            <label for="anteriores">Actividades del área</label>
                            <span>12</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="add">
            <div class="add__form">
                <p class="add__form--title">Agregar nuevo contenido</p>
                <div class="form__add--form">
                    <form action="./firstPage.php" method="post">
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
                        <div class="add__input">
                            <input type="text" disabled name="file" id="file" placeholder="Fichero">
                        </div>

                        <input type="submit" value="Registrar" class="submit submit__add" id="submit">
                    </form>
                </div>
            </div>
        </section>

    </main>


    <section id="filter__responsive" class="filter__responsive">
        <div class="filter__responsive--header">
            <button type="button" class="filter__close" onclick="mostrarMedia()"></button>
        </div>
        <section class="classify">
            <div class="filter">
                <p class="filter__title">Filtros</p>
                <hr>
                <div class="filter__category">
                    <p class="filter__category--title">Año</p>
                    <div class="category">
                        <div class="category__option">
                            <input type="radio" name="anio" id="anteriores">
                            <label for="anteriores">Años anteriores</label>
                            <span>125</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="anio" id="2021">
                            <label for="2021">2021</label>
                            <span>15</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="anio" id="2020">
                            <label for="2020">2020</label>
                            <span>20</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="filter__category">
                    <p class="filter__category--title">Área</p>
                    <div class="category">
                        <div class="category__option">
                            <input type="radio" name="area" id="anteriores">
                            <label for="anteriores">Educación</label>
                            <span>87</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="area" id="anteriores">
                            <label for="anteriores">Salud</label>
                            <span>13</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="area" id="anteriores">
                            <label for="anteriores">Entorno</label>
                            <span>34</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="area" id="anteriores">
                            <label for="anteriores">Trabajo social</label>
                            <span>94</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="area" id="anteriores">
                            <label for="anteriores">Proyectos y convocatorias</label>
                            <span>94</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="area" id="anteriores">
                            <label for="anteriores">Entrega de donativos</label>
                            <span>32</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="filter__category">
                    <p class="filter__category--title">Categoría</p>
                    <div class="category">
                        <div class="category__option">
                            <input type="radio" name="category" id="anteriores">
                            <label for="anteriores">Atención primaria 
                            a la salud</label>
                            <span>87</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="category" id="anteriores">
                            <label for="anteriores">Prácticas de bienestar
                            comunitario</label>
                            <span>13</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="category" id="anteriores">
                            <label for="anteriores">Educación para la salud</label>
                            <span>34</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="filter__category">
                    <p class="filter__category--title">Subcategoría</p>
                    <div class="category">
                        <div class="category__option">
                            <input type="radio" name="subcategory" id="anteriores">
                            <label for="anteriores">Talleres y prácticas
                            saludables</label>
                            <span>87</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="subcategory" id="anteriores">
                            <label for="anteriores">Formación curricular</label>
                            <span>13</span>
                        </div>
                        <div class="category__option">
                            <input type="radio" name="subcategory" id="anteriores">
                            <label for="anteriores">Capacitación en
                            seguridad y protección
                            escolar</label>
                            <span>34</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="filter__category">
                    <p class="filter__category--title">Tipo</p>
                    <div class="category">
                        <div class="category__option">
                            <input type="radio" name="type" id="anteriores">
                            <label for="anteriores">Seguridad y prevención
                            de accidentes</label>
                            <span>2</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="filter__category">
                    <p class="filter__category--title">Subtipo</p>
                    <div class="category">
                        <div class="category__option">
                            <input type="radio" name="subtype" id="anteriores">
                            <label for="anteriores">Actividades del área</label>
                            <span>12</span>
                        </div>
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