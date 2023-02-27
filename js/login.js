const form = document.getElementById("submit");

form.addEventListener("click", function(event) {
    let activados = document.getElementsByClassName('enabled')
    const error = document.getElementById('form__error')
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
            }
    }
});


// Obtener la URL actual
const url = new URL(window.location.href);
// Obtener el valor de "error" de la URL
const error = url.searchParams.get("error");

if (error != null) {
    document.getElementById("error__text").innerText = "Usuario o contraseña incorrectos";
    document.getElementById("form__error").style.display = "flex";
}
