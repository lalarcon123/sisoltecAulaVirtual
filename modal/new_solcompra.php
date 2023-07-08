<?php
    require_once('includes/load.php');
    $p_user    = $_SESSION['user_id'];
    $all_proveedores = find_all('proveedores');
?>
<?php

if(isset($_POST['add'])) {
    $req_fields = array(
        'id_proveedor',
        'forma_pago',
        'observacion');

    validate_fields($req_fields);
    if(empty($errors)) {
        $id_proveedor  = remove_junk($db->escape($_POST['id_proveedor']));
        $forma_pago    = remove_junk($db->escape($_POST['forma_pago']));
        $observacion   = remove_junk($db->escape($_POST['observacion']));
        $query = "insert into solicitudcompra (id_proveedor, forma_pago, id_user, observacion) values (";
        $query .=" '{$id_proveedor}', '{$forma_pago}', '{$p_user}', '{$observacion}'";
        $query .=")";

        $result   = $db->query($query);
        if($result && $db->affected_rows() === 1){
            $session->msg('s',"Solicitud ingresada exitosamente. ");
        } else {
            $session->msg('d',' Lo siento, el ingreso falló.');
        }

    } else{
        $session->msg("d", $errors);
    }
}

?>

    <div> <!-- Modal -->

        <div class="panel-heading clearfix">
            <div class="pull-left">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Solicitud de compra <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                </button>
            </div>
        </div>


    </div>
    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Solicitud de Compra</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add" enctype="multipart/form-data">
                        <div id="result"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Proveedor<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control" name="id_proveedor" id="id_proveedor">
                                          <option value="0">Seleccione el proveedor</option>
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
                                  <option value="0">Seleccione la forma de pago</option>
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
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <input name="add" type="submit" class="btn btn-success" value="Guardar"></input>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn_cerrar" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->
