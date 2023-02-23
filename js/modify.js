const update = document.querySelector(".submit__update");

update.addEventListener("click", function(event) {
    const error = document.getElementById('form__error')
    const date = document.getElementById("date").value;
    const description = document.getElementById("description").value;
    const rute = document.getElementById("rute").value;

    if (date === "" || description === "" || rute === "" ) {
        error.style.display = "flex"
        event.preventDefault();
    }
});