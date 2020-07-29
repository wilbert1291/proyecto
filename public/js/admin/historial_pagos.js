var tabla;
$(document).ready(function () {
    tabla = $('#tabla_historial').DataTable({
        "destroy": true,
        "ajax": "historial_pagos/cargar_tabla",
        "columns": [{
            "data": "clave_historial",
            "visible": false
        }, {
            "data": "clave_institucion"
        }, {
            "data": "clave_metodo_pago"
        }, {
            "data": "clave_paquete"
        }, {
            "data": "fecha_pago"
        }, {
            "data": "fecha_vencimiento"
        }],
        "language": idioma
    });
    tabla.order([0,'desc']);
});

var idioma = {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "No hay resultados",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}