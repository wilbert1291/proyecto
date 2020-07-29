var tabla;
$(document).ready(function () {
    tabla = $('#tabla_categorias').DataTable({
        "destroy": true,
        "ajax": "categorias/cargar_tabla",
        "columns": [{
            "data": "clave_categoria",
            "visible": false
        }, {
            "data": "nombre_categoria"
        }, {
            "data": "activo",
            "render": function (data) {
                if (data == 1) {
                    return "Si";
                } else {
                    return "No";
                }
            }
        }, {
            "data": "imagen",
            "visible": false
        }, {
            "defaultContent": "<button class='btn btn-warning editar' data-toggle='modal' data-target='#modal_categorias'><i class='far fa-edit'></i></button><button class='btn btn-danger eliminar'><i class='far fa-trash-alt'></i></button>"
        }],
        "language": idioma
    });

    $('#tabla_categorias tbody').on("click", "button.editar", function () {
        var data = tabla.row($(this).parents("tr")).data();
        $('#btn_editar').show();
        $('#btn_guardar').hide();

        limpiar();
        llenar_campos(data);
    });

    $('#tabla_categorias tbody').on("click", "button.eliminar", function () {
        var data = tabla.row($(this).parents("tr")).data();
        var id = (data.clave_categoria);
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
    $('#nombre_imagen').val("");
    $('#imagen_categoria').val(null);
    $('input[type="text"]').val('');
    $('#activo').val(0);
}

function llenar_campos(data) {
    $('#id_categoria').val(data.clave_categoria);
    $('#activo').val(data.activo);
    $('#nombre_categoria').val(data.nombre_categoria);
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
                    url: "categorias/eliminar",
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
                            swal("Categoria eliminada correctamente!", {
                                icon: "success",
                            });
                        }
                    }
                });
            }
        });
}

$('#nueva_categoria').click(function () {
    $('#btn_editar').hide();
    $('#btn_guardar').show();
    limpiar();
})

$('#btn_guardar').click(function () {
    if (validar('guardar')) {
        $.ajax({
            url: "categorias/insertar",
            method: "POST",
            dataType: 'html',
            data: {
                "nombre_categoria": $('#nombre_categoria').val(),
                "activo": $('#activo').val(),
            },
            success: function (result) {
                if (result == "Datos insertados") {
                    swal({
                        title: "Excelente!",
                        text: "Categoria registrada exitosamente!",
                        icon: "success",
                        button: "Continuar",
                    });
                    $('#modal_categorias').modal('hide');
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
            url: "categorias/modificar",
            method: "POST",
            dataType: 'html',
            data: {
                "id": $('#id_categoria').val(),
                "nombre_categoria": $('#nombre_categoria').val(),
                "activo": $('#activo').val(),
            },
            success: function (result) {
                if (result == "Datos guardados") {
                    swal({
                        title: "Excelente!",
                        text: "Categoria actualizada exitosamente!",
                        icon: "success",
                        button: "Continuar",
                    });
                    $('#modal_categorias').modal('hide');
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
        if ($('#id_categoria').val() == "") {
            swal({
                title: "Ohh ohh!",
                text: "Existen campos vacios",
                icon: "error",
                button: "Ok",
            });
            return false;
        }
    }

    if ($('#nombre_categoria').val() == "") {
        swal({
            title: "Ohh ohh!",
            text: "Existen campos vacios",
            icon: "error",
            button: "Ok",
        });
        return false;
    }

    if ($('#activo').val() == 0) {
        swal({
            title: "Ohh ohh!",
            text: "Tienes que seleccionar todos los campos",
            icon: "error",
            button: "Ok",
        });
        return false;
    }

    return true;
}