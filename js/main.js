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
}

function login() {
    let activados = document.getElementsByClassName('enabled')
    let desactivados = document.getElementsByClassName('disabled')
    for (input of activados) {
        input.style.display = 'inline-block'
    }
    for (input of desactivados) {
        input.style.display = 'none'
    }
    document.getElementById('submit').value = "Acceder"
}