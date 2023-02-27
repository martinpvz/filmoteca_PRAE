<?php
session_start();
if(isset($_SESSION['sesion']) != true) {
    header("location:./mainPage.php"); 
}
if(isset($_SESSION['username']) == true) {
    echo "Bienvenido " . $_SESSION['username'];
} else {
    echo "No hay sesión iniciada";
}
$nombre = $_SESSION['name'];
$apellido = $_SESSION['surname'];
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
    <title>Home | Filmoteca PRAE</title>
</head>
<body>
    <header class="header__home">
        <div class="header__home--img">
            <img src="./img/logo.png" alt="Logo">
        </div>
        <h1 class="header__home--title">Filmoteca</h1>
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
            <a href="./editProfile.php">Editar perfil</a>
            <a href="./mainPage.php">Cerrar sesion</a>
        </div>
    </section>

    <main class="main__home">
        <div class="cards">
            <!-- <a href="#" class="card">  
                <img src="./img/newCDC.jpeg" alt="cdc">
                <div class="card--text card--add">
                    <div class="card--add__img"></div>
                    <span>Agregar CDC</span>
                </div>
            </a> -->
            <a href="./media.php" class="card">  
                <img src="./img/chamontoya.jpeg" alt="cdc">
                <div class="card--text">
                    CDC Chamontoya
                </div>
            </a>
            <a href="./media.php" class="card">
                <img src="./img/zacatlan.jpeg" alt="cdc">
                <div class="card--text">
                    CDC Zacatlán
                </div>
            </a>
            <a href="./media.php" class="card">
                <img src="./img/cuacuila.jpeg" alt="cdc">
                <div class="card--text">
                    CDC Zacatlán
                </div>
            </a>
            <a href="./media.php" class="card">
                <img src="./img/eventos.jpeg" alt="cdc">
                <div class="card--text">
                    Multimedia PRAE
                </div>
            </a>
            <a href="./media.php" class="card">
                <img src="./img/eventos.jpg" alt="cdc">
                <div class="card--text">
                    Eventos institucionales
                </div>
            </a>
            <a href="./media.php" class="card">
                <img src="./img/historia.jpeg" alt="cdc">
                <div class="card--text">
                    Historia PRAE
                </div>
            </a>
        </div>
    </main>

    <footer class="footer__home">
        <p class="footer__home--text">© 2023 Copyright: PROYECTO ROBERTO ALONSO ESPINOSA </p>
    </footer>

    <script src="./js/main.js"></script>
</body>
</html>