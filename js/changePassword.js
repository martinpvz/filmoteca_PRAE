
const passwordInputR = document.getElementById('passwordR');
const showPasswordButtonR = document.getElementById('show__passwordR');

const passwordConfirmation = document.getElementById('confirmation');
const showPasswordConfirmation = document.getElementById('show__confirmation');


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

document.getElementById("recover").addEventListener("click", function(e) {
    e.preventDefault();

    // Obtiene los valores de los campos del formulario
    let code = document.getElementById("code").value.trim();
    let password = document.getElementById("passwordR").value.trim();
    let confirmation = document.getElementById("confirmation").value.trim();
    let email = new URLSearchParams(window.location.search).get("email");

    // Verifica si todos los campos están llenos
    if (code && password && confirmation && email) {
        // Verifica si las contraseñas coinciden
        if (password === confirmation) {
        // Realiza una solicitud usando fetch al archivo 'user-recover.php' en el backend
        const formData = new FormData();
        formData.append('code', code);
        formData.append('password', password);
        formData.append('email', email);
        fetch("./backend/user/change-password.php", {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if(data.estatus == "Correcto") {
                    alert("Contraseña cambiada correctamente");
                    window.location.href = "login.php";
                } else {
                    document.getElementById("error__text").textContent = "El código es incorrecto";
                    document.getElementById("form__error").style.display = "block";
                }
            })
            .catch(error => {
                console.log(error);
            });
        } else {
        // Muestra un mensaje de error si las contraseñas no coinciden
        document.getElementById("error__text").textContent = "Las contraseñas no coinciden";
        document.getElementById("form__error").style.display = "block";
        }
    } else {
        // Muestra un mensaje de error si no se completaron todos los campos
        document.getElementById("error__text").textContent = "Todos los campos son obligatorios";
        document.getElementById("form__error").style.display = "block";
    }
});