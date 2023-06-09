$(document).ready(function () {
    $("#users").DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
        }
    });
});

//Funcion para asignar una contraseña temporal a un usuario
function toggleUser_newpass(userId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText;
            console.log(response);
        }
    };
     // Configurar y enviar la solicitud AJAX
    xhttp.open("POST", "./backend/admin/admin-changePassword.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + userId);
    actualizar();
}

//Funcion para pasar el ID del usuario a admin-changePassword.php
function toggleUser_newpass(userId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText;
            console.log(response);
        }
    };
    xhttp.open("POST", "./backend/admin/admin-changePassword.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + userId);
    actualizar();
}

//Funcion para pasar el ID del usuario a admin-disable.php
function toggleUser_disable(userId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText;
            console.log(response);
            // Actualizar la interfaz según el estado del usuario
            //if (response === 'success') {
                // Actualizar la interfaz para reflejar el usuario desactivado
                //userStatusElement.innerHTML = '<i class="fas fa-toggle-off"></i>Desactivado';
            //}
        }
    };
    
    xhttp.open("POST", "./backend/admin/admin-disable.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + userId);

    actualizar();
}

function actualizar(){
    fetch('./backend/admin/admin-dashboard.php')
  .then(response => response.text())
  .then(data => {})
  .catch(error => {
    console.log('Ocurrió un error:', error);
  });

}

actualizar();

//Funcion para pasar el ID del usuario a admin-enable.php
function toggleUser_enable(userId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText;
            console.log(response);
            if (response === 'success') {
                userStatusElement.innerHTML = '<i class="fas fa-toggle-on"></i>Activado';
            }

        }
    };
    xhttp.open("POST", "./backend/admin/admin-enable.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + userId);
    actualizar();
}

//Función para habilitar el segundo select del formulario en roles.php
function habilita() {
    var x = document.getElementById("Rol").value;
    if (x == 3) {
        document.getElementById("CDCGroup").removeAttribute("hidden");
    } else {
        document.getElementById("CDCGroup").setAttribute("hidden", "True");
    }
}
//Funcion para pasar el ID del usuario a admin-cambioRol.php
function toggleUser_changeRol(userId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText;
            console.log(response);
        }
    };
    xhttp.open("POST", "./backend/admin/admin-cambioRol.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + userId);
}