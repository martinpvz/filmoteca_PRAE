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

    <script src="./js/admin.js"></script>
</head>
<body class="body__add">
    <header class="header__home">
        <div class="header__home--img">
            <img src="./img/logo.png" alt="Logo">
        </div>
        <h1 class="header__home--title title__small" id="title-desktop">Cambiar rol</h1>
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
            <h1 id="title-mobile">Cambiar rol</h1>
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
        <section class="formRol">
            <div class="formRol__form">
            <p class="formRol__form--title">Asignación de Nuevo Rol de Usuario</p>
            <p class="formRol__form--subtitle">{{$usuario->full_name}}</p>
                <div class="form__formRol--form">
                    <form method="POST" action="{{route('rol',['id' => $usuario->id])}}">
                        <!--@csrf-->
                        <div class="formRol__input">
                            <label for="RolSelected">Selecciona el nuevo rol del usuario:</label>
                            <select id="Rol" name="rol" onchange="habilita()">
                            <option value="1">De consulta</option>
                            <option value="2">Rol 2</option>
                            <option value="3">Generador de contenido</option>
                            <option value="4">Rol 4</option>
                            <!--@foreach-->
                            <!--
                                <option value="{{$rol->id}}" {{($usuario ->
                                id_role == $rol->id)?'selected':''}}
                                >{{$rol->rol}}</option
                            -->
                            >
                            <!--@endforeach-->
                            </select>
                        </div>
                        <div class="formRol__input" id="CDCGroup">
                            <label for="SedeSelected"> Asignar un Centro de Desarrollo Comunitario:</label>
                            <select class="form-control" id="CDC" name="cdc">
                            <!--@foreach ($sedes as $sede) {{($usuario-
                                >id_sede == $sede->id)?'selected':''}}
                                >{{$sede->nombre}}-->
                            <option value="{{$sede->id}}">CDC 1</option>
                            <option value="{{$sede->id}}">CDC 2</option>
                            <option value="{{$sede->id}}">CDC 3</option>
                            <!--@endforeach-->
                            </select>
                        </div>
                        <input type="submit" value="Guardar" class="submit__saveRol" id="cambiarRol"/>
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