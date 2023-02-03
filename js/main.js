function mostrarMenu() {
    document.getElementById('options').style.display = 'block'
}

function mostrarPantalla() {
    document.getElementById('options').style.display = 'none'
}

function register() {
    let activados = document.getElementsByClassName('enabled')
    let desactivados = document.getElementsByClassName('disabled')
    for (input of activados) {
        input.style.display = 'none'
    }
    for (input of desactivados) {
        input.style.display = 'inline-block'
    }
    document.getElementById('submit').value = "Registrar"

    let requeridos = document.getElementsByClassName('required')
    let norequeridos = document.getElementsByClassName('norequired')
    for (input of requeridos) {
        input.removeAttribute("required");
    }
    for (input of norequeridos) {
        input.setAttribute("required", "");
    }

    document.getElementById('register').style.backgroundColor = "#0759E6"
    document.getElementById('login').style.backgroundColor = "#043B9C"

}

function login() {
    let activados = document.getElementsByClassName('enabled')
    let desactivados = document.getElementsByClassName('disabled')
    for (input of activados) {
        input.style.display = 'inline-block'
        input.setAttribute("required", "");
    }
    for (input of desactivados) {
        input.style.display = 'none'
        input.removeAttribute("required");
    }
    document.getElementById('submit').value = "Acceder"

    let requeridos = document.getElementsByClassName('required')
    let norequeridos = document.getElementsByClassName('norequired')
    for (input of requeridos) {
        input.setAttribute("required", "");
    }
    for (input of norequeridos) {
        input.removeAttribute("required");
    }

    document.getElementById('login').style.backgroundColor = "#0759E6"
    document.getElementById('register').style.backgroundColor = "#043B9C"
}

document.getElementById('profile').onclick = function(){
    toggleProfileInfo();
};

document.addEventListener('click', function(event) {
    if (!event.target.closest('#profile')) {
        document.getElementById('profile-info').style.display = 'none';
    }
});

function toggleProfileInfo() {
    if (document.getElementById('profile-info').style.display == 'flex') {
        document.getElementById('profile-info').style.display = 'none';
    } else {
        document.getElementById('profile-info').style.display = 'flex';
    }
}