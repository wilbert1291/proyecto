var tabla;
$(document).ready(function () {
tabla = $('#tabla_calificaciones').DataTable({
        "destroy": true,
        "ajax": "calificaciones/cargar_tabla",
        "columns": [{
            "data": "clave_calificacion",
            "visible": false
        }, {
            "data": "clave_curso"
        }, {
            "data": "clave_alumno"
        }, {
            "data": "calificacion"
        }, {
            "data": "aciertos"
        }, {
            "data": "errores"
        }],
        "language": idioma
    });

    $('#tabla_calificaciones tbody').on("click", "button.ver", function () {
        var data = tabla.row($(this).parents("tr")).data();
        llenar_campos(data);
    });
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

function llenar_campos(data){
    
}