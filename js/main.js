
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
