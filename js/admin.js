$(document).ready(function () {
    $("#users").DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
        }
    });
});

//Función para habilitar el segundo select del formulario en roles.php
function habilita() {
    var x = document.getElementById("Rol").value;
    if (x == 3) {
        document.getElementById("CDCGroup").removeAttribute("hidden");
    } else {
        document.getElementById("CDCGroup").setAttribute("hidden", "True");
    }
}