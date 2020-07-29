$("#btn_registrar").click(function () {
    if (validaciones('register')) {
        var clave_institucional = $('#clave_institucional').val();
        var password = $('#password').val();
        var nombre = $('#nombre_institucion').val();
        var turno = $('#turno').val();
        var nivel_escolar = $('#nivel_escolar').val();
        var estado = $('#estado').val();
        var municipio = $('#municipio').val();
        var localidad = $('#localidad').val();
        var calle = $('#calle').val();
        var colonia = $('#colonia').val();
        var codigo_postal = $('#codigo_postal').val();
        var correo = $('#correo').val();
        $.ajax({
            url: "register_login/registrar_institucion",
            type: 'POST',
            dataType: 'html',
            data: {
                "clave_institucional": clave_institucional,
                "password": password,
                "nombre": nombre,
                "turno": turno,
                "nivel_escolar": nivel_escolar,
                "estado": estado,
                "municipio": municipio,
                "localidad": localidad,
                "calle": calle,
                "colonia": colonia,
                "codigo_postal": codigo_postal,
                "correo": correo
            },
            success: function (result) {
                if (result == "Datos insertados") {
                    swal({
                        title: "Excelente!",
                        text: "Haz completado tu registro",
                        icon: "success",
                        button: "Continuar",
                    });
                    $('#modal_register').modal('hide');
                } else {
                    swal({
                        title: "Ohh ohh!",
                        text: result,
                        icon: "error",
                        button: "Ok",
                    });
                }
            }
        });
    }

});

$('#estado').change(function () {
    if ($(this).val() != 0) {
        $.ajax({
            url: "inicio/combo_municipios",
            type: 'POST',
            dataType: 'html',
            data: {
                "id_estado": $(this).val()
            },
            success: function (result) {
                $('#municipio').html('');
                $('#municipio').append("<option value='0' selected>-Selecciona-</option>");
                $('#municipio').append(result);
            }
        });
    } else {
        $('#municipio').html('');
        $('#municipio').append("<option value='0' selected id='option_municipio'>-Selecciona-</option>");
        $('#localidad').html('');
        $('#localidad').append("<option value='0' selected>-Selecciona-</option>");
    }
});

$('#municipio').change(function () {
    if ($(this).val() != 0) {
        $.ajax({
            url: "inicio/combo_localidades",
            type: 'POST',
            dataType: 'html',
            data: {
                "id_municipio": $(this).val(),
                "id_estado": $('#estado').val()
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
});

$("#abrir_registro").click(function () {
    $('input[type="text"]').val('');
    $('input[type="password"]').val('');
    $('input[type="email"]').val('');
    $('select').val(0);
});

$("#abrir_login").click(function () {
    $('input[type="text"]').val('');
    $('input[type="password"]').val('');
});

$('#btn_iniciar').click(function () {
    if (validaciones('login')) {
        var user = $('#user_login').val();
        var password = $('#pass_login').val();
        $.ajax({
            url: "register_login/logear",
            type: 'POST',
            dataType: 'JSON',
            data: {
                "user": user,
                "password": password
            },
            success: function (result) {
                if (result.error) {
                    swal({
                        title: "Oh oh!",
                        text: result.mensaje,
                        icon: "error",
                        button: "Ok",
                    });
                } else {
                    switch (result.usuario) {
                        case "institute":
                            window.location.href = "institutes/inicio";
                            break;
                        case "students":
                            window.location.href = "students/inicio";
                            break;
                        case "teachers":
                            window.location.href = "teachers/inicio";
                            break;
                        case "admin":
                            window.location.href = "admin/inicio";
                            break;
                    }
                }
            }
        });
    }
});


function validaciones(form) {
    if (form == "login") {
        if ($('#user_login').val() == "" || $('#pass_login').val() == "") {
            swal({
                title: "Oh oh!",
                text: "Existen campos vacios",
                icon: "error",
                button: "Ok",
            });
            return false;
        } else {
            return true;
        }
    } else {
        if ($('#clave_institucional').val() == "" || $('#password').val() == "" || $('#nombre_institucion').val() == "" || $('#calle').val() == "" || $('#colonia').val() == "" || $('#codigo_postal').val() == "" || $('#correo').val() == "") {
            swal({
                title: "Oh oh!",
                text: "Existen campos vacios",
                icon: "error",
                button: "Ok",
            });
            return false;
        } else if ($('#turno').val() == 0 || $('#nivel_escolar').val() == 0 || $('#estado').val() == 0 || $('#municipio').val() == 0 || $('#localidad').val() == 0) {
            swal({
                title: "Oh oh!",
                text: "Algunos campos no han sido seleccionados",
                icon: "error",
                button: "Ok",
            });
            return false;
        } else {
            return true;
        }
    }
}


function ir_a(campo) {
    var element_to_scroll_to = document.getElementById(campo);
    element_to_scroll_to.scrollIntoView({
        behavior: "smooth",
        block: "end",
        inline: "nearest"
    });
}


$('#top').click(function () {
    $("html, body").animate({
        scrollTop: 0
    }, "slow");
    return false;
})
