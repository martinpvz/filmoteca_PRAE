<?php 
session_start(); 
$name = $_SESSION['name'];
$surname = $_SESSION['surname'];

include './backend/admin/admin-cambioRol.php';
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

    <main class="main__media">
        <section class="formRol">
            <div class="formRol__form">
            <p class="formRol__form--title">Asignación de Nuevo Rol de Usuario</p>
            <p class="formRol__form--subtitle"><?php echo $name . ' ' . $surname;?> </p>
                <div class="form__formRol--form">
                    <form method="POST" action="<?php echo route('rol', ['id' => $usuario['id']]); ?>">
                        <div class="formRol__input">
                            <label for="RolSelected">Selecciona el nuevo rol del usuario:</label>
                            <select id="Rol" name="rol" onchange="habilita()">
                                <?php foreach ($roles as $rol): ?>
                                    <option value="<?php echo $rol['id']; ?>" <?php echo ($usuario['id_role'] == $rol['id']) ? 'selected' : ''; ?>>
                                        <?php echo $rol['id']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="formRol__input" id="CDCGroup">
                            <label for="SedeSelected"> Asignar un Centro de Desarrollo Comunitario:</label>
                            <select class="form-control" id="CDC" name="cdc">
                                <?php foreach ($sedes as $sede): ?>
                                    <option value="<?php echo $sede['id']; ?>" <?php echo ($usuario['id_sede'] == $sede['id']) ? 'selected' : ''; ?>>
                                        <?php echo $sede->nombre; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="submit" value="Guardar" class="submit__saveRol" id="cambiarRol"/>
                    </form>
                </div>
            </div>
        </section>

    </main>


    <footer class="footer__home">
        <p class="footer__home--text">© 2023 Copyright: PROYECTO ROBERTO ALONSO ESPINOSA </p>
    </footer>

    <script src="./js/main.js"></script>
</body>
</html>