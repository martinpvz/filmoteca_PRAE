const form = document.getElementById("submit");

form.addEventListener("click", function(event) {
    let activados = document.getElementsByClassName('enabled')
    const error = document.getElementById('form__error')
    if (activados[0].style.display != 'none') {
        const user = document.getElementById("user").value;
        const password = document.getElementById("password").value;
    
        if (user === "" || password === "") {
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
                error.style.display = "flex"
                event.preventDefault();
            }
    }
});