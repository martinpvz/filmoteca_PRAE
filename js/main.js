
// SHOW MENU ON ALMOST ALL PAGES
function mostrarMenu() {
    document.getElementById('options').style.display = 'block'
    document.body.style.overflow = "hidden";
}

// QUIT MENU AND SHOW REGULAR PAGE IN ALMOST ALL PAGES
function mostrarPantalla() {
    document.getElementById('options').style.display = 'none'
    document.body.style.overflow = "auto";
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
    toggleModal()
    document.querySelector(".gallery").style.display = "none"
    document.querySelector(".modify").style.display = "flex"
    document.querySelector(".filter__button").style.display = "none"
    window.scrollTo(0, 0);
}

const edit = document.querySelector(".content__edit");
edit.addEventListener("click", toggleEdit);



function closeModify() {
    document.querySelector(".gallery").style.display = "flex"
    document.querySelector(".modify").style.display = "none"
    if (window.innerWidth < 880) {
        document.querySelector(".filter__button").style.display = "flex"
    }
    window.scrollTo(0, 0);
}