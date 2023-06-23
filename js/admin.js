function actualizar() {
    fetch('./backend/admin/admin-dashboard.php')
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "") {
                $("#users").DataTable().clear().draw();
            } else {
                $("#users").DataTable().draw();
            }
        })
        .then(data => {
            verificarValorInicial();
        })
        .catch(error => {
            console.log('Ocurrió un error:', error);
        });
}

//Datatable dashboard
$(document).ready(function () {
    $("#users").DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
        }
    });
    actualizar();
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
    fetch('./backend/admin/admin-changePassword.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + userId
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

//Funcion para pasar el ID del usuario a admin-disable.php
function toggleUser_disable(userId) {
    fetch('./backend/admin/admin-disable.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + userId
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            actualizar();
        })
        .catch(error => {
            console.error('Error:', error);
        })
}

//Funcion para pasar el ID del usuario a admin-enable.php
function toggleUser_enable(userId) {
    fetch('./backend/admin/admin-enable.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + userId
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            actualizar();
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

//Funcion para pasar el ID del usuario a admin-delete.php
function toggleUser_delete(userId) {
    fetch('./backend/admin/admin-delete.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + userId
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

//Función para habilitar el segundo select del formulario en roles.php
function habilita() {
    var x = document.getElementById("role").value;
    if (x == 3) {
        document.getElementById("CDCGroup").removeAttribute("hidden");
    } else {
        document.getElementById("CDCGroup").setAttribute("hidden", "true");
    }
}
//funcion para verificar el valor incial es igual o distinto al rol 3
function verificarValorInicial() {
    var roleSelect = document.getElementById("role");
    if (roleSelect) {
        var valorInicial = roleSelect.value;

        if (valorInicial === "3") {
            document.getElementById("CDCGroup").removeAttribute("hidden");
        } else {
            document.getElementById("CDCGroup").setAttribute("hidden", "true");
        }
    }
}

document.addEventListener("DOMContentLoaded", function () {
    verificarValorInicial();

    var roleSelect = document.getElementById("role");
    roleSelect.addEventListener("change", habilita);
});

//Funcion para pasar el ID del usuario a admin-cambioRol.php
function toggleUser_changeRol(userId) {
    fetch('./backend/admin/admin-cambioRol.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + userId
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
