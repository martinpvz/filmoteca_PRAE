const passwordInput = document.getElementById('password');
const showPasswordButton = document.getElementById('show__password');

const passwordInputR = document.getElementById('passwordR');
const showPasswordButtonR = document.getElementById('show__passwordR');

const passwordConfirmation = document.getElementById('confirmation');
const showPasswordConfirmation = document.getElementById('show__confirmation');


// LOGIC FOR THE REGISTER PART
function register() {
    let activados = document.getElementsByClassName('enabled')
    let desactivados = document.getElementsByClassName('disabled')
    var url = window.location.href;
    url = url.replace(/(\?|\&)error=1/, ''); 
    url = url.replace(/(\?|\&)token=0/, ''); 
    url = url.replace(/(\?|\&)user=0/, ''); 
    url = url.replace(/(\?|\&)registered=1/, ''); 
    url = url.replace(/(\?|\&)registered=0/, ''); 
    window.history.replaceState(null, '', url);
    document.getElementById("form__error").style.backgroundColor = "#e83845";
    for (input of activados) {
        input.style.display = 'none'
        input.firstElementChild.value = ""
    }
    for (input of desactivados) {
        input.style.display = 'inline-block'
    }
    document.getElementById('submit').value = "Registrar"
    document.getElementById('forgot-password').style.display = "none"

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

    document.getElementById('form__error').style.display = "none"

    // return passwordInputR and passwordConfirmation type to password
    passwordInputR.type = 'password';
    showPasswordButtonR.style.backgroundImage="url(img/show.png)";
    passwordConfirmation.type = 'password';
    showPasswordConfirmation.style.backgroundImage="url(img/show.png)";
}

// LOGIC FOR THE LOGIN PART
function login() {
    let activados = document.getElementsByClassName('enabled')
    let desactivados = document.getElementsByClassName('disabled')
    var url = window.location.href;
    url = url.replace(/(\?|\&)error=1/, ''); 
    url = url.replace(/(\?|\&)token=0/, ''); 
    url = url.replace(/(\?|\&)user=0/, ''); 
    url = url.replace(/(\?|\&)registered=1/, ''); 
    url = url.replace(/(\?|\&)registered=0/, ''); 
    window.history.replaceState(null, '', url);
    document.getElementById("form__error").style.backgroundColor = "#e83845";
    for (input of activados) {
        input.style.display = 'inline-block'
        input.setAttribute("required", "");
    }
    for (input of desactivados) {
        input.style.display = 'none'
        input.removeAttribute("required");
        input.firstElementChild.value = ""
    }
    document.getElementById('submit').value = "Acceder"
    document.getElementById('forgot-password').style.display = "block"

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
    document.getElementById('form__error').style.display = "none"

    // return passwordInput type to password
    passwordInput.type = 'password';
    showPasswordButton.style.backgroundImage="url(img/show.png)";

}



const form = document.getElementById("submit");

form.addEventListener("click", function(event) {
    let activados = document.getElementsByClassName('enabled')
    const error = document.getElementById('form__error')
    document.getElementById("form__error").style.backgroundColor = "#e83845";
    if (activados[0].style.display != 'none') {
        const user = document.getElementById("user").value;
        const password = document.getElementById("password").value;
    
        if (user === "" || password === "") {
            document.getElementById("error__text").innerText = "Existen campos vacíos";
            error.style.display = "flex"
            event.preventDefault();
        }
    } else {
        const name = document.getElementById("name").value;
        const surname = document.getElementById("surname").value;
        const email = document.getElementById("email").value;
        const user = document.getElementById("userR").value;
        const password = document.getElementById("passwordR").value;
        const confirmation = document.getElementById("confirmation").value;
        const key = document.getElementById("key").value;

        if (name === "" || surname === "" || email === "" || user === "" || password === "" || confirmation === "" || key === "") {
            document.getElementById("error__text").innerText = "Existen campos vacíos";
            error.style.display = "flex"
            event.preventDefault();
        } else if (password != confirmation) {
            document.getElementById("error__text").innerText = "Las contraseñas no coinciden";
            error.style.display = "flex"
            event.preventDefault();
        }
    }
});


// Obtener la URL actual
const url = new URL(window.location.href);
// Obtener el valor de "error" de la URL
const error = url.searchParams.get("error");

if (error != null) {
    document.getElementById("form__error").style.backgroundColor = "#e83845";
    document.getElementById("error__text").innerText = "Usuario o contraseña incorrectos";
    document.getElementById("form__error").style.display = "flex";
}

// get the value of "token" from the URL    
const token = url.searchParams.get("token");

if (token != null) {
    register();
    document.getElementById("error__text").innerText = "Clave de acceso incorrecta";
    document.getElementById("form__error").style.display = "flex";
}

// get the value of "user" from the URL
const user = url.searchParams.get("user");

if (user != null) {
    register();
    document.getElementById("error__text").innerText = "El usuario / correo ya existe";
    document.getElementById("form__error").style.display = "flex";
}

// get the value of "registered" from the URL
const registered = url.searchParams.get("registered");

if (registered == '1') {
    document.getElementById("form__error").style.backgroundColor = "#228B22";
    document.getElementById("error__text").innerText = "Usuario registrado correctamente";
    document.getElementById("form__error").style.display = "flex";
} else if (registered == '0') {
    register();
    document.getElementById("error__text").innerText = "Error al registrar el usuario";
    document.getElementById("form__error").style.display = "flex";
}



// logic for the view password button

showPasswordButton.addEventListener('click', function() {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        showPasswordButton.style.backgroundImage="url(img/hide.png)";
    } else {
        passwordInput.type = 'password';
        showPasswordButton.style.backgroundImage="url(img/show.png)";
    }
});

showPasswordButtonR.addEventListener('click', function() {
    if (passwordInputR.type === 'password') {
        passwordInputR.type = 'text';
        showPasswordButtonR.style.backgroundImage="url(img/hide.png)";
    } else {
        passwordInputR.type = 'password';
        showPasswordButtonR.style.backgroundImage="url(img/show.png)";
    }
});

showPasswordConfirmation.addEventListener('click', function() {
    if (passwordConfirmation.type === 'password') {
        passwordConfirmation.type = 'text';
        showPasswordConfirmation.style.backgroundImage="url(img/hide.png)";
    } else {
        passwordConfirmation.type = 'password';
        showPasswordConfirmation.style.backgroundImage="url(img/show.png)";
    }
})