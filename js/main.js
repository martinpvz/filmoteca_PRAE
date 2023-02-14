
// SHOW MENU ON ALMOST ALL PAGES
function mostrarMenu() {
    document.getElementById('options').style.display = 'block'
}

// QUIT MENU AND SHOW REGULAR PAGE IN ALMOST ALL PAGES
function mostrarPantalla() {
    document.getElementById('options').style.display = 'none'
}

// SHOW FILTERS, IT DISABLES THE MAIN AND THE FOOTER AND SHOWS THE FILTER
function mostrarFiltros() {
    document.getElementById('main__media').style.display = 'none'
    document.getElementById('footer__media').style.display = 'none'
    document.getElementById('filter__responsive').style.display = 'block'
    window.scrollTo(0, 0);
}

// SHOW MEDIA WHEN DE X BUTTON OF THE FILTER IS PUSHED
function mostrarMedia() {
    document.getElementById('main__media').style.display = 'flex'
    document.getElementById('footer__media').style.display = 'block'
    document.getElementById('filter__responsive').style.display = 'none'
    window.scrollTo(0, 0);
}

// LOGIC FOR THE REGISTER PART
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

// LOGIC FOR THE LOGIN PART
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



// LOGIC FOR THE PROFILE MENU WHEN CLICKED ON FULL SCREEN
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

// VARIABLES FOR SOME BUTTONS
const modal = document.querySelector(".modal__section");
const triggers = document.getElementsByClassName("trigger");
const closeButton = document.querySelector(".modal__header--img");
const file = document.getElementById("rute_input");

// FUNCTION TO DISABLE SCROLL WHEN MENU SOMEONE´S INSIDE THE MENU
function disableScroll(){  
    window.scrollTo(0, 0);
}

// LOGIC FOR THE VISUALIZATION OF AN IMAGE OR VIDEO
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


function toggleEdit() {
    console.log("voy a editar")
    toggleModal()
    document.querySelector(".gallery").style.display = "none"
    document.querySelector(".modify").style.display = "flex"
}

const edit = document.querySelector(".content__edit");
edit.addEventListener("click", toggleEdit);