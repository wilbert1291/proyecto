var tabla;
$(document).ready(function () {
    tabla = $('#tabla_suscripciones').DataTable({
        "destroy": true,
        "ajax": "suscripcion/cargar_tabla",
        "columns": [{
            "data": "clave_historial",
            'visible': false
        }, {
            "data": "nombre_metodo"
        }, {
            "data": "nombre_paquete"
        }, {
            "data": "fecha_pago",
            "render": function (data) {
                var elem = data.split('-');
                var dia = elem[2];
                var mes = elem[1];
                var ano = elem[0];
                var fecha = dia + "/" + mes + "/" + ano;
                return fecha;
            }
        }, {
            "data": "fecha_vencimiento",
            "render": function (data) {
                var elem = data.split('-');
                var dia = elem[2];
                var mes = elem[1];
                var ano = elem[0];
                var fecha = dia + "/" + mes + "/" + ano;
                return fecha;
            }
        }, {
            "data": "clave_metodo_pago",
            "visible": false
        }, {
            "data": "clave_paquete",
            "visible": false
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


$('#nuevo_paquete').click(function () {
    $("#paquete").val(0);
});

$('#btn_guardar').click(function () {
    $.ajax({
        url: "suscripcion/insertar",
        method: "POST",
        dataType: 'html',
        data: {
            "paquete": $('#paquete').val(),
        },
        success: function (result) {
            if (result == "Datos insertados") {
                swal({
                    title: "Excelente!",
                    text: "Suscripcion realizada exitosamente!",
                    icon: "success",
                    button: "Continuar",
                });
                $('#modal_paquetes').modal('hide');
                tabla.ajax.reload();
            } else {
                swal({
                    title: "Ohh ohh!",
                    text: result,
                    icon: "error",
                    button: "Ok",
                });
            }
        }
    })
});
