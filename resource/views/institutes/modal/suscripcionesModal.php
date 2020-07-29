<div class="modal fade" id="modal_paquetes" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_modal">Paquetes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="text" id="id_user" hidden>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paquete">Selecciona un paquete:</label>
                            <select id="paquete" class="form-control">
                                <option value="0">-Selecciona-</option>
                                <?php
                                    include_once 'app/paquetes.php';
                                    foreach($this->paquetes as $row){
                                        $paq = new paquetes_adapter();
                                        $paq = $row;
                                    ?>
                                <option value="<?php echo $paq->id_paquete;?>"><?php echo $paq->nombre; ?></option>
                                <?php      
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_guardar">Suscribirse</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>