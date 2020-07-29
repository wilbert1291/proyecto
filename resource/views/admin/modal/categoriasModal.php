<div class="modal fade" id="modal_categorias" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_modal">Categorias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="text" id="id_categoria" name="id_categoria" hidden>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categoria">Nombre de la categoria:</label>
                            <input type="text" class="form-control" placeholder="Nombre de la categoria" id="nombre_categoria" name="nombre_categoria" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mostrar">¿Mostrar categoria?</label>
                            <select class="form-control" id="activo">
                                <option value="0" selected>-Selecciona-</option>
                                <option value="1">-Si-</option>
                                <option value="2">-No-</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="btn_editar">Modificar</button>
                <button type="button" class="btn btn-success" id="btn_guardar">Gurdar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>


        </div>
    </div>
</div>
