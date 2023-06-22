const form = document.getElementById("submit");

form.addEventListener("click", function(event) {
    const error = document.getElementById('form__error')
    document.getElementById("form__error").style.backgroundColor = "#e83845";
    const email = document.getElementById("email").value;
    if (email === "") {
        document.getElementById("error__text").innerText = "Existen campos vacíos";
        error.style.display = "flex"
        event.preventDefault();
    }
});