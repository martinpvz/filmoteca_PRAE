const nameCdc = document.getElementById('nameCDC');
const address = document.getElementById('addressCDC');
const phone = document.getElementById('phoneCDC');
const image = document.getElementById('imageCDC');
const error = document.getElementById('form__error');
const errorMsg = document.getElementById('form__error--text');
const loader = document.getElementById('loader');
const form = document.getElementById("form__add");

async function addCDC(data) {
    const response = await fetch('./backend/cdc/cdc-add.php', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json();
    console.log(result);
    loader.style.visibility = 'visible';
    loader.style.opacity = '1';
    if(result.estatus == "Correcto") {
        setTimeout(() => {
            error.style.backgroundColor = "#228B22";
            errorMsg.innerHTML = "CDC agregado correctamente";
            error.style.display = "flex";
            loader.style.visibility = 'hidden';
            loader.style.opacity = '0';
        }, 1000);
    } else {
        setTimeout(() => {
            error.style.backgroundColor = "#e83845";
            errorMsg.innerHTML = "Error al agregar el CDC";
            error.style.display = "flex";
            loader.style.visibility = 'hidden';
            loader.style.opacity = '0';
        }, 1000);
    }
}

function validateForm() {
    if(nameCdc.value === "" || address.value === "" || phone.value === "" || image.value === "") {
        error.style.backgroundColor = "#e83845";
        errorMsg.innerHTML = "Existen campos vacíos";
        error.style.display = "flex";
        return false;
    } else if (phone.value.length < 10) {
        error.style.backgroundColor = "#e83845";
        errorMsg.innerHTML = "Número inválido";
        error.style.display = "flex";
        return false;
    } else if ( isNaN(phone.value) ) {
        error.style.backgroundColor = "#e83845";
        errorMsg.innerHTML = "Número inválido";
        error.style.display = "flex";
        return false;
    } else {
        error.style.display = "none";
        return true;
    }
}


function Base64(imagen) {
    return new Promise((resolve, reject) => {
        var reader = new FileReader();
        reader.addEventListener('load', function() {
            var imagen_base64 = reader.result;
            resolve(imagen_base64);
        });
        reader.addEventListener('error', function(error) {
            reject(error);
        });
        reader.readAsDataURL(imagen);
    });
}

function agregarPrefijoCDC(nombre) {
    const prefijo = "CDC";
    nombre = nombre.trim();
    const partes = nombre.split(" ");
    if (partes[0].toUpperCase() !== prefijo) {
        nombre = `${prefijo} ${nombre}`;
    } else {
        partes[0] = prefijo; 
        nombre = partes.join(" ");
    } 
    return nombre;
}

document.getElementById('createCDC').addEventListener('click', (e) => {
    e.preventDefault();
    if(validateForm()) {
        const file = form.imageCDC.files[0];
        Base64(file)
        .then(function(imagen_base64) {
            console.log(imagen_base64);
            const data = {
                name: agregarPrefijoCDC(nameCdc.value),
                address: address.value,
                phone: phone.value,
                resource: imagen_base64
            }
            addCDC(data);
        })
        .catch(function(error) {
            console.log(error);
        });
    }
});