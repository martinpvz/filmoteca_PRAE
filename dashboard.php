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

    <!--Datatables styles-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="./js/admin.js"></script>
    
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
                <a class="profile__info1--edit" href="">Inicio</a>
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
            <a class="profile__info1--edit" href="">Inicio</a>
            <a class="" href="./dashboard.php">Administración de usuarios</a>
            <a class="" href="./token.php">Clave de acceso</a>
            <a class="profile__info1--close" href="./logout.php">Cerrar sesión</a>
        </div>
    </section>

    <main class="dashboard_mainPage">
        <div class="dashboard_card">
            <div class="dashboard_card-body">
                <div class="dashboard_mainPage--title">
                    <h2>Administración de usuarios</h2>
                </div>
                <br />
                <div class="dashboard_table--text table-responsive">
                    <table id="users" class="display" style="width: 100%;">
                        <thead class="dashboard_table--thead">
                            <tr>
                                <th>Usuario</th>
                                <th>Nombre(s)</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Estado</th>
                                <th>Tipo de usuario</th>
                                <th>CDC</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="dashboard_table--tbody">
                            <tr>
                                <td>userR</td>
                                <td>name</td>
                                <td>surname</td>
                                <td>email</td>
                                <td class="text">
                                    <div class="text-on">Activo</div>
                                    <div class="text-off">Desactivado</div>
                                </td>
                                <td>rol</td>
                                <td>id_sede</td>
                                <td class="text">
                                    <a class="text-acciones" href="">
                                        <i class="fas fa-user-tag"></i> Cambiar rol
                                    </a>
                                    <br>
                                    <a class="text-acciones" href="#">
                                        <i class="fas fa-key"></i> Cambiar contraseña
                                    </a>
                                    <br>
                                    <a class="text-acciones" href="#">
                                        <i class="fas fa-toggle-off"></i> Descativar
                                        <i class="fas fa-toggle-on"></i> Activar
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer__home">
        <p class="footer__home--text">© 2023 Copyright: PROYECTO ROBERTO ALONSO ESPINOSA </p>
    </footer>

    <script src="./js/main.js"></script>
</body>
</html>