const form = document.getElementById("submit__edit");

form.addEventListener("click", function(event) {

    const error = document.getElementById('form__error')
    const name = document.getElementById("name").value;
    const surname = document.getElementById("surname").value;
    const email = document.getElementById("email").value;
    const user = document.getElementById("user").value;

    var loader = document.querySelector('.loader');
    loader.style.visibility = 'visible';
    loader.style.opacity = '1';

    if (name === "" || surname === "" || email === "" || user === "") {
        event.preventDefault();
        setTimeout(function() {
            loader.style.visibility = 'hidden';
            loader.style.opacity = '0';
            error.style.backgroundColor = "#e83845";
            document.getElementById('error__p').innerText = "Existen campos vacíos"
            error.style.display = "flex"
        }, 1000);
    } else {
        event.preventDefault();

        const info = new FormData(document.getElementById("edit__profile"));
        for (var pair of info.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }

        fetch('./backend/user/user-edit.php', {
            method: 'POST',
            body: info
        })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                setTimeout(function() {
                    if(data.estatus === 'Correcto') {
                        error.style.display = "flex"
                        document.getElementById('error__p').innerText = "Perfil actualizado correctamente"
                        error.style.backgroundColor = "#228B22";
                    } else {
                        error.style.display = "flex"
                        document.getElementById('error__p').innerText = "Usuario o correo ya existentes"
                        error.style.backgroundColor = "#e83845";
                    }
                    loader.style.visibility = 'hidden';
                    loader.style.opacity = '0';
                }, 1000);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
});
