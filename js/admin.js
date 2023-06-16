function actualizar(){
    fetch('./backend/admin/admin-dashboard.php')
    .then(response => response.text())
    .then(data => {})
    .catch(error => {
        console.log('Ocurrió un error:', error);
    });
}

//Datatable dashboard
actualizar();
$(document).ready(function () {
    $("#users").DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
        }
    });
});

//Button function
function toggleMenu(event) {
    var dropdownMenu = event.target.nextElementSibling;
    dropdownMenu.style.display = (dropdownMenu.style.display === "block") ? "none" : "block";
}

function closeMenus(event) {
    var dropdownMenus = document.getElementsByClassName("dashboard_btnContent");
    for (var i = 0; i < dropdownMenus.length; i++) {
        var dropdownMenu = dropdownMenus[i];
        var button = dropdownMenu.previousElementSibling;
        if (button !== event.target) {
            dropdownMenu.style.display = "none";
        }
    }
}

var buttons = document.getElementsByClassName("dashboard_dropbtn");
for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", toggleMenu);
}

document.addEventListener("click", closeMenus);

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
        }
    };
    xhttp.open("POST", "./backend/admin/admin-disable.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + userId);
    actualizar();
}

//Funcion para pasar el ID del usuario a admin-enable.php
function toggleUser_enable(userId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText;
            console.log(response);
        }
    };
    xhttp.open("POST", "./backend/admin/admin-enable.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + userId);
    actualizar();
}

//Funcion para pasar el ID del usuario a admin-delete.php
function toggleUser_delete(userId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText;
            console.log(response);
        }
    };
    xhttp.open("POST", "./backend/admin/admin-delete.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + userId);
    actualizar();
}

//Función para habilitar el segundo select del formulario en roles.php
function habilita() {
    var x = document.getElementById("role").value;
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
