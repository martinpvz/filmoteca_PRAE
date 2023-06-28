<?php 
session_start(); 
if ($_SESSION['role'] == 1) {
    $name = $_SESSION['name'];
    $surname = $_SESSION['surname'];
    $role = $_SESSION['role_id'];
    $cdc = $_SESSION['cdc_id'];

    $arrayRol = $_SESSION['roles'];
    $roles = json_encode($arrayRol);

    $arrayCDC = $_SESSION['sedes'];
    $sedes = json_encode($arrayCDC);
    if (!isset($name) || !isset($surname) || !isset($role)) {
        require_once './backend/API/admin.php';
        $admin = new \DataBase\Admin();
        $admin->indexCambioRol($_POST);
        $name = $_SESSION['name'];
        $surname = $_SESSION['surname'];
        $role = $_SESSION['role_id'];
        $cdc = $_SESSION['cdc_id'];
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <title>ADMIN | Filmoteca PRAE</title>
</body>
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
            <a class="profile__info1--edit" href="./firstPage.php">Inicio</a>
            <a class="" href="./dashboard.php">Administración de usuarios</a>
            <a class="" href="./token.php">Clave de acceso</a>
            <a class="profile__info1--close" href="./logout.php">Cerrar sesión</a>
        </div>
    </section>

    <main class="main__media">
        <section class="formRol">
            <div class="formRol__form">
                <p class="formRol__form--title">Asignación de Nuevo Rol de Usuario</p>
                <p class="formRol__form--subtitle"><?php echo $name . ' ' . $surname;?></p>
                <div class="form__formRol--form">
                <form method="POST" action=./backend/admin/admin-cambioRol.php>
                    <!-- SELECT de la base de datos role-->
                        <div class="formRol__input">
                            <label for="role">Selecciona el nuevo rol del usuario:</label>
                            <select id="role" name="role" onchange="habilita()">
                                <?php while ($rol = array_shift($arrayRol)): ?>
                                    <?php $selected = ($role == $rol['id_role']) ? 'selected' : ''; ?>
                                    <option value="<?php echo $rol['id_role']; ?>" <?php echo $selected; ?>>
                                        <?php echo $rol['role_name']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- SELECT de la base de datos "cdc"-->
                        <div class="formRol__input" id="CDCGroup" hidden>
                            <label for="cdc"> Asignar un Centro de Desarrollo Comunitario:</label>
                            <select class="form-control" id="cdc" name="cdc">
                                <?php while ($sede = array_shift($arrayCDC)): ?>
                                    <?php $selected = ($cdc == $sede['id_cdc']) ? 'selected' : ''; ?>
                                    <option value="<?php echo $sede['id_cdc']; ?>" <?php echo $selected; ?>>
                                        <?php echo $sede['cdc_name']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <input type="submit" value="Guardar" class="submit__saveRol" />
                    </form>
                </div>
            </div>
        </section>

    </main>

    <footer class="footer__home">
        <p class="footer__home--text">© 2023 Copyright: PROYECTO ROBERTO ALONSO ESPINOSA </p>
    </footer>

    <script src="./js/main.js"></script>
    <script src="./js/admin.js"></script>
</body>
</html>