
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
function toggleFilter() {
    if (window.innerWidth < 880) {
    document.getElementById('main__media').style.display = 'none'
    document.getElementById('footer__media').style.display = 'none'
    document.getElementById('filter__responsive').style.display = 'block'
    window.scrollTo(0, 0);
    }
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

const file = document.getElementById("rute_input");
file.addEventListener("click", toggleFilter);

// FUNCTION TO DISABLE SCROLL WHEN MENU SOMEONE´S INSIDE THE MENU
function disableScroll(){  
    window.scrollTo(0, 0);
}


const update = document.getElementById("submit");

update.addEventListener("click", function(event) {
    const error = document.getElementById('form__error')
    const date = document.getElementById("date").value;
    const description = document.getElementById("description").value;
    const rute = document.getElementById("rute").value;
    const file = document.getElementById("file").value;

    if (date === "" || description === "" || rute === "" || file === "") {
        error.style.display = "flex"
        event.preventDefault();
    }
});


// Logic for filter section (so it can appear in the rute form)
// Obtener los elementos de radio
/*const anios = document.getElementsByName("anio");
const area = document.getElementsByName("area");
const category = document.getElementsByName("category");

const rute = document.getElementById("rute");
// Verificar qué elemento está seleccionado
for (let i = 0; i < anios.length; i++) {
    anios[i].addEventListener("click", function() {
        console.log("El elemento seleccionado es " + anios[i].id);
        rute.value = anios[i].id + ", "
    });
}

let selected = true
for (let i = 0; i < area.length; i++) {
    area[i].addEventListener("click", function() {
        if (selected) {
            console.log("El elemento seleccionado es " + area[i].id);
            rute.value += area[i].id + ", "
            selected = false
        }
    });
}

for (let i = 0; i < category.length; i++) {
    category[i].addEventListener("click", function() {
        if (selected) {
            console.log("El elemento seleccionado es " + category[i].id);
            rute.value += category[i].id + ", "
            selected = false
        }
    });
}*/