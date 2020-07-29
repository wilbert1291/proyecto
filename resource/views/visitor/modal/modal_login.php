<!-- Modal -->
<div class="modal fade" id="modal_login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inicio de sesión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5>Ingresa tus datos para iniciar sesión</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="clave_institucional">Usuario/Clave institucional:</label>
                            <input type="text" class="form-control" id="user_login" placeholder="Usuario o Clave institucional">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="clave_institucional">Contraseña:</label>
                            <input type="password" class="form-control" id="pass_login" placeholder="Contraseña">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <label for="">¿Haz olvidado tu contraseña? <a href="<?php echo constant('URL'); ?>request_password" target="_blank">Click aquí</a></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_iniciar">Iniciar sesión</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
