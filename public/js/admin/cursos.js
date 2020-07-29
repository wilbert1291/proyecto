var tabla;
$(document).ready(function () {
    tabla = $('#tabla_cursos').DataTable({
        "destroy": true,
        "ajax": "cursos/cargar_tabla",
        "columns": [{
            "data": "clave_curso"
        }, {
            "data": "clave_categoria",
            "visible": false
        }, {
            "data": "nombre_curso",
        }, {
            "data": "descripcion",
            "visible": false
        }, {
            "defaultContent": "<button class='btn btn-warning editar' data-toggle='modal' data-target='#modal_cursos'><i class='far fa-edit'></i></button><button class='btn btn-danger eliminar'><i class='far fa-trash-alt'></i></button>"
        }],
        "language": idioma
    });

    $('#tabla_cursos tbody').on("click", "button.editar", function () {
        var data = tabla.row($(this).parents("tr")).data();
        $('#btn_editar').show();
        $('#btn_guardar').hide();

        limpiar();
        llenar_campos(data);
    });

    $('#tabla_cursos tbody').on("click", "button.eliminar", function () {
        var data = tabla.row($(this).parents("tr")).data();
        var id = (data.clave_curso);
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
    $('#descripcion').val("");
    $('#categoria').val(0);
    
}

function llenar_campos(data) {
    $('#id_curso').val(data.clave_curso);
    $('#nombre_curso').val(data.nombre_curso);
    $('#categoria').val(data.clave_categoria);
    $('#descripcion').val(data.descripcion);
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
                    url: "cursos/eliminar",
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
                            swal("Curso eliminado correctamente!", {
                                icon: "success",
                            });
                        }
                    }
                });
            }
        });
}

$('#nuevo_curso').click(function () {
    $('#btn_editar').hide();
    $('#btn_guardar').show();
    limpiar();
})

$('#btn_guardar').click(function () {
    if (validar('guardar')) {
        $.ajax({
            url: "cursos/insertar",
            method: "POST",
            dataType: 'html',
            data: {
                "nombre": $('#nombre_curso').val(),
                "categoria": $('#categoria').val(),
                "descripcion": $('#descripcion').val(),
            },
            success: function (result) {
                if (result == "Datos insertados") {
                    swal({
                        title: "Excelente!",
                        text: "Curso registrado exitosamente!",
                        icon: "success",
                        button: "Continuar",
                    });
                    $('#modal_cursos').modal('hide');
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
            url: "cursos/modificar",
            method: "POST",
            dataType: 'html',
            data: {
                "id": $('#id_curso').val(),
                "nombre": $('#nombre_curso').val(),
                "categoria": $('#categoria').val(),
                "descripcion": $('#descripcion').val(),
            },
            success: function (result) {
                if (result == "Datos guardados") {
                    swal({
                        title: "Excelente!",
                        text: "Curso actualizado exitosamente!",
                        icon: "success",
                        button: "Continuar",
                    });
                    $('#modal_cursos').modal('hide');
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
        if ($('#id_curso').val() == "") {
            swal({
                title: "Ohh ohh!",
                text: "Existen campos vacios",
                icon: "error",
                button: "Ok",
            });
            return false;
        }
    }

    if ($('#nombre_curso').val() == "" || $('#descripcion').val() == "") {
        swal({
            title: "Ohh ohh!",
            text: "Existen campos vacios",
            icon: "error",
            button: "Ok",
        });
        return false;
    }

    if ($('#categoria').val() == 0) {
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