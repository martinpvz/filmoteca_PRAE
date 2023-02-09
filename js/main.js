function mostrarMenu() {
    document.getElementById('options').style.display = 'block'
}

function mostrarPantalla() {
    document.getElementById('options').style.display = 'none'
}

function mostrarFiltros() {
    document.getElementById('main__media').style.display = 'none'
    document.getElementById('footer__media').style.display = 'none'
    document.getElementById('filter__responsive').style.display = 'block'
    window.scrollTo(0, 0);
}

function mostrarMedia() {
    document.getElementById('main__media').style.display = 'flex'
    document.getElementById('footer__media').style.display = 'block'
    document.getElementById('filter__responsive').style.display = 'none'
    window.scrollTo(0, 0);
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

const modal = document.querySelector(".modal__section");
const triggers = document.getElementsByClassName("trigger");
const closeButton = document.querySelector(".modal__header--img");

function disableScroll(){  
    window.scrollTo(0, 0);
}

function toggleModal() {
    modal.classList.toggle("show-modal");
    if (modal.classList.contains("show-modal")) {
        //window.addEventListener('scroll', disableScroll);
        document.body.style.overflow = "hidden";

    } else {
        //window.removeEventListener('scroll', disableScroll);  
        document.body.style.overflow = "auto";
    }
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal();
    }
}



console.log(triggers)
for (let trigger of triggers) {
    trigger.addEventListener("click", toggleModal);
}
closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);