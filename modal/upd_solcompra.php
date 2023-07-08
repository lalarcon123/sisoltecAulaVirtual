<?php
    require_once('includes/load.php');
    $p_user   = $_SESSION['user_id'];
    $all_proveedores = find_all('proveedores');
?>
<?php

 if(isset($_POST['upd'])) {
     $req_fields = array('id',
                'id_proveedor',
                'forma_pago',
                'observacion',
                'estado');

     validate_fields($req_fields);

     if(empty($errors)) {

         $id            = (int)$db->escape($_POST['id']);
         $id_proveedor  = remove_junk($db->escape($_POST['id_proveedor']));
         $forma_pago    = remove_junk($db->escape($_POST['forma_pago']));
         $observacion   = remove_junk($db->escape($_POST['observacion']));
         $status        = remove_junk($db->escape($_POST['estado']));

         if ($status=="ACTIVO")
         {
             $estado ="1";
         } else {
             $estado ="0";
         }

         $query = "UPDATE solicitudcompra SET";
         $query .= " id_proveedor     ='{$id_proveedor}',";
         $query .= " forma_pago       ='{$forma_pago}',";
         $query .= " observacion      ='{$observacion}',";
         $query .= " estado           ='{$estado}'";
         $query .= " WHERE id         = {$id}";

         $result   = $db->query($query);
         if($result && $db->affected_rows() === 1){
            $session->msg('s',"Solicitud ha sido actualizado. ");
         } else {
             $session->msg('d',' Lo siento, actualización falló.');
         }

     } else{
         $session->msg("d", $errors);
}
}

?>
    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"> Editar Solicitud de Compra</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd" enctype="multipart/form-data">
                        <div id="result2"></div>
                        <input type="hidden" name="id" id="id" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Proveedor<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control" name="id_proveedor" id="id_proveedor">
                                  <?php foreach ($all_proveedores as $proveedores ):?>
                                   <option value="<?php echo $proveedores['id'];?>"><?php echo ucwords($proveedores['descripcion']);?></option>
                                <?php endforeach;?>
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Forma de pago<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control" name="forma_pago" id="forma_pago">
                                   <option value="1">Efectivo</option>
                                   <option value="2">Crédito Directo</option>
                                   <option value="3">Tarjeta de Crédito</option>
                                   <option value="4">Cheque</option>
                                   <option value="5">Transferencia Bancaria</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Observación<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea class="form-control" name="observacion" id="observacion" rows="4" cols="80" placeholder="Observación" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="estado" id="estado" required>
                                    <option value="ACTIVO"> ACTIVO</option>
                                    <option value="INACTIVO"> INACTIVO</option>  
                                </select>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <input name="upd" type="submit" class="btn btn-success" value="Guardar"></input>
                            </div>
                        </div>
                    </form>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->