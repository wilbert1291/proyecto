var tabla;
$(document).ready(function () {
    tabla = $('#tabla_instituciones').DataTable({
        "destroy": true,
        "ajax": "instituciones/cargar_tabla",
        "columns": [{
            "data": "clave_institucion",
            "visible": false
        }, {
            "data": "clave_estado",
            "visible": false
        }, {
            "data": "clave_municipio",
            "visible": false
        }, {
            "data": "clave_localidad",
            "visible": false
        }, {
            "data": "clave_nivel_escolar",
            "visible": false
        }, {
            "data": "clave_turno",
            "visible": false
        }, {
            "data": "nombre_institucion"
        }, {
            "data": "calle"
        }, {
            "data": "colonia"
        }, {
            "data": "codigo_postal"
        }, {
            "data": "fecha_registro"
        }, {
            "data": "codigo_institucion",
            "visible": false
        }, {
            "data": "contrasenia",
            "visible": false
        }, {
            "data": "correo",
            "visible": false
        }, {
            "data": "activo",
            "visible": false
        }, {
            "defaultContent": "<button class='btn btn-warning editar' data-toggle='modal' data-target='#modal_institucion'><i class='far fa-edit'></i></button><button class='btn btn-danger eliminar'><i class='far fa-trash-alt'></i></button>"
        }],
        "language": idioma
    });

    $('#tabla_instituciones tbody').on("click", "button.editar", function () {
        var data = tabla.row($(this).parents("tr")).data();
        $('#btn_editar').show();
        $('#btn_guardar').hide();

        limpiar();
        llenar_campos(data);
    });

    $('#tabla_instituciones tbody').on("click", "button.eliminar", function () {
        var data = tabla.row($(this).parents("tr")).data();
        var id = (data.clave_institucion);
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
    $('input[type="text"]').val('');
    $('input[type="email"]').val('');
    $('input[type="password"]').val('');
    $('#estado').val(0);
    $('#municipio').val(0);
    $('#localidad').val(0);
    $('#turno').val(0);
    $('#nivel_escolar').val(0);
    $('#acceso').val(0);
}

function llenar_campos(data) {
    $('#id_institucion').val(data.clave_institucion);
    $('#nivel_escolar').val(data.clave_nivel_escolar);
    $('#turno').val(data.clave_turno);
    $('#nombre_institucion').val(data.nombre_institucion);
    $('#calle').val(data.calle);
    $('#colonia').val(data.colonia);
    $('#codigo_postal').val(data.codigo_postal);
    $('#fecha_registro').val(data.fecha_registro);
    $('#clave_institucional').val(data.codigo_institucion);
    $('#password').val(data.contrasenia);
    $('#correo').val(data.correo);
    $('#acceso').val(data.activo);
    $('#estado').val(data.clave_estado);
    cargar_municipios(data.clave_municipio);
    $('#municipio').val(data.clave_municipio);
    cargar_localidades(data.clave_municipio, data.clave_localidad);
    $('#localidad').val(data.clave_localidad);
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
                    url: "instituciones/eliminar",
                    type: 'POST',
                    dataType: 'JSON',
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
                            swal("Empleado eliminado correctamente!", {
                                icon: "success",
                            });
                        }
                    }
                });
            }
        });
}

function cargar_municipios(id_municipio) {
    if ($('#estado').val() != 0) {
        $.ajax({
            url: "instituciones/combo_municipios",
            type: 'POST',
            dataType: 'html',
            data: {
                "id_estado": $('#estado').val(),
                "id_municipio": id_municipio,
            },
            success: function (result) {
                $('#municipio').html('');
                $('#municipio').append("<option value='0'>-Selecciona-</option>");
                $('#municipio').append(result);
            }
        });
    } else {
        $('#municipio').html('');
        $('#municipio').append("<option value='0' selected>-Selecciona-</option>");
        $('#localidad').html('');
        $('#localidad').append("<option value='0' selected>-Selecciona-</option>");
    }
}

function cargar_localidades(id_municipio, id_localidad) {
    if ($('#municipio').val() != 0) {
        $.ajax({
            url: "instituciones/combo_localidades",
            type: 'POST',
            dataType: 'html',
            data: {
                "id_municipio": id_municipio,
                "id_estado": $('#estado').val(),
                "id_localidad": id_localidad,
            },
            success: function (result) {
                $('#localidad').html('');
                $('#localidad').append("<option value='0' selected>-Selecciona-</option>");
                $('#localidad').append(result);
            }
        });
    } else {
        $('#localidad').html('');
        $('#localidad').append("<option value='0' selected>-Selecciona-</option>");
    }
}

$('#btn_editar').click(function () {
    if (validar()) {
        $.ajax({
            url: "instituciones/modificar",
            method: "POST",
            dataType: 'html',
            data: {
                "id": $('#id_institucion').val(),
                "usuario": $('#clave_institucional').val(),
                "contrasenia": $('#password').val(),
                "nombre": $('#nombre_institucion').val(),
                "turno": $('#turno').val(),
                "nivel_escolar": $('#nivel_escolar').val(),
                "estado": $('#estado').val(),
                "municipio": $('#municipio').val(),
                "localidad": $('#localidad').val(),
                "calle": $('#calle').val(),
                "colonia": $('#colonia').val(),
                "codigo_postal": $('#codigo_postal').val(),
                "acceso": $('#acceso').val(),
                "fecha_registro": $('#fecha_registro').val(),
                "correo": $('#correo').val(),
            },
            success: function (result) {
                if (result == "Datos guardados") {
                    swal({
                        title: "Excelente!",
                        text: "Institucion actualizada exitosamente!",
                        icon: "success",
                        button: "Continuar",
                    });
                    $('#modal_institucion').modal('hide');
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

function validar() {

    if ($('#id_institucion').val() == "" || $('#clave_institucional').val() == "" || $('#password').val() == "" || $('#nombre_institucion').val() == "" || $('#calle').val() == "" || $('#colonia').val() == "" || $('#codigo_postal').val() == "" || $('#correo').val() == "" || $('#acceso').val() == "" || $('#fecha_registro').val() == "") {
        swal({
            title: "Ohh ohh!",
            text: "Existen campos vacios",
            icon: "error",
            button: "Ok",
        });
        return false;
    }

    if ($('#turno').val() == 0 || $('#turno').val() == 0 || $('#estado').val() == 0 || $('#municipio').val() == 0 || $('#localidad').val() == 0 || $('#acceso').val() == 0) {
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
