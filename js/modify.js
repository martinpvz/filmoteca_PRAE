const update = document.querySelector(".submit__update");

update.addEventListener("click", function(event) {
    const error = document.getElementById('form__error')
    error.style.display = "none";
    error.style.backgroundColor = "#e83845";
    document.getElementById('form__error--p').innerText = "Existen campos vacíos";
    const date = document.getElementById("date").value;
    const description = document.getElementById("description").value;
    //const rute = document.getElementById("rute").value;

    if (date === "" || description === "") {
        error.style.display = "flex"
        event.preventDefault();
    } else {
        console.log("hola soy el update")
        event.preventDefault();
        const formData = new FormData();
        formData.append('description', description);
        formData.append('date', date);
        formData.append('id', selectedMedia);
        fetch(`./backend/media/media-edit.php?type=${type}`, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.estatus == "Correcto") {
                    // location.reload();
                    var loader = document.querySelector('.loader');
                    loader.style.visibility = 'visible';
                    loader.style.opacity = '1';
                    setTimeout(function() {
                        error.style.display = "flex"
                        document.getElementById('form__error--p').innerText = "Media actualizada correctamente"
                        error.style.backgroundColor = "#228B22";
                        loader.style.visibility = 'hidden';
                        loader.style.opacity = '0';
                        if (addMedia) {
                            var nextSibling = addMedia.nextSibling;
                            while (nextSibling) {
                                var toRemove = nextSibling;
                                nextSibling = nextSibling.nextSibling;
                                toRemove.remove();
                            }
                        } else {
                            document.getElementById('media').innerHTML = '';
                        }
                        listarMedia();
                    }, 1000);
                }
            })
            .catch(error => console.error('Error al realizar la petición', error));
        }
});