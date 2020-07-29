var tabla;
$(document).ready(function () {
    
    tabla = $('#tabla_metodos_pago').DataTable({
        "destroy": true,
        "ajax": "metodos_pago/cargar_tabla",
        "columns": [{
            "data": "clave_metodo_pago"
        }, {
            "data": "nombre_metodo_pago",
        }, {
            "defaultContent": "<button class='btn btn-warning editar' data-toggle='modal' data-target='#modal_metodos_pago'><i class='far fa-edit'></i></button><button class='btn btn-danger eliminar'><i class='far fa-trash-alt'></i></button>"
        }],
        "language": idioma
    });

    $('#tabla_metodos_pago tbody').on("click", "button.editar", function () {
        var data = tabla.row($(this).parents("tr")).data();
        $('#btn_editar').show();
        $('#btn_guardar').hide();

        limpiar();
        llenar_campos(data);
    });

    $('#tabla_metodos_pago tbody').on("click", "button.eliminar", function () {
        var data = tabla.row($(this).parents("tr")).data();
        var id = (data.clave_metodo_pago);
        eliminar(id);
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

function limpiar() {
    $('input[type=text]').val("");
}

function llenar_campos(data) {
    $('#id_metodo_pago').val(data.clave_metodo_pago);
    $('#nombre_metodo_pago').val(data.nombre_metodo_pago);
}


function eliminar(id) {
    swal({
            title: "¿Estas seguro que deseas eliminarlo?",
            text: "No podras recuperar esta información",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "metodos_pago/eliminar",
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        "id": id
                    },
                    success: function (result) {
                        console.log(result);
                        if (result.error) {
                            swal({
                                title: "Oh oh!",
                                text: result.mensaje,
                                icon: "error",
                                button: "Ok",
                            });
                        } else {
                            tabla.ajax.reload();
                            swal("Metodo de pago eliminado correctamente!", {
                                icon: "success",
                            });
                        }
                    }
                });
            }
        });
}

$('#nuevo_metodo_pago').click(function () {
    $('#btn_editar').hide();
    $('#btn_guardar').show();
    limpiar();
})

$('#btn_guardar').click(function () {
    if (validar('guardar')) {
        $.ajax({
            url: "metodos_pago/insertar",
            method: "POST",
            dataType: 'html',
            data: {
                "nombre": $('#nombre_metodo_pago').val()
            },
            success: function (result) {
                if (result == "Datos insertados") {
                    swal({
                        title: "Excelente!",
                        text: "Metodo de pago registrado exitosamente!",
                        icon: "success",
                        button: "Continuar",
                    });
                    $('#modal_metodos_pago').modal('hide');
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
    }

})

$('#btn_editar').click(function () {
    if (validar('editar')) {
        $.ajax({
            url: "metodos_pago/modificar",
            method: "POST",
            dataType: 'html',
            data: {
                "id": $('#id_metodo_pago').val(),
                "nombre": $('#nombre_metodo_pago').val(),
            },
            success: function (result) {
                if (result == "Datos guardados") {
                    swal({
                        title: "Excelente!",
                        text: "Metodo de pago actualizado exitosamente!",
                        icon: "success",
                        button: "Continuar",
                    });
                    $('#modal_metodos_pago').modal('hide');
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
    }
})

function validar(form) {
    if (form == 'editar') {
        if ($('#id_metodo_pago').val() == "") {
            swal({
                title: "Ohh ohh!",
                text: "Existen campos vacios",
                icon: "error",
                button: "Ok",
            });
            return false;
        }
    }

    if ($('#nombre_metodo_pago').val() == "") {
        swal({
            title: "Ohh ohh!",
            text: "Existen campos vacios",
            icon: "error",
            button: "Ok",
        });
        return false;
    }

    return true;
}
