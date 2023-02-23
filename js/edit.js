const form = document.getElementById("submit__edit");

form.addEventListener("click", function(event) {
    const error = document.getElementById('form__error')
    const name = document.getElementById("name").value;
    const surname = document.getElementById("surname").value;
    const email = document.getElementById("email").value;
    const user = document.getElementById("user").value;

    if (name === "" || surname === "" || email === "" || user === "") {
        error.style.display = "flex"
        event.preventDefault();
    }
});