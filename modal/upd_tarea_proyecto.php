<?php
    require_once('includes/load.php');
    $p_user   = $_SESSION['user_id'];
?>
<?php

 if(isset($_POST['upd'])) {

    $estado      = remove_junk($db->escape($_POST['estado']));
    if ($estado!='FINALIZADA'){
        $documento_respaldo = $_FILES['documento']['name'];
        $ruta = $_FILES['documento']['tmp_name'];
        $destino = "uploads/documentos/".$documento_respaldo;
        $req_fields = array('observacion','avance');
        
        validate_fields($req_fields);

            if ($documento_respaldo != ""){
              if (copy($ruta,$destino)){ 
            }}  
            if(empty($errors)) {

                 $id_proyecto = (int)remove_junk($db->escape($_POST['id_proy']));
                 $id          = (int)remove_junk($db->escape($_POST['id']));
                 $observacion = remove_junk($db->escape($_POST['observacion']));
                 $avance      = remove_junk($db->escape($_POST['avance']));

                 $query = "UPDATE registro_tarea SET";
                 if ($destino){
                    $query .= " evidencia    ='{$destino}', ";
                 }
                 $query .= " observacion  = '{$observacion}',";
                 $query .= " avance       = '{$avance}',";
                 $query .= " fecha_modificacion  = now() ";
                 $query .= " WHERE id_proyecto = '{$id_proyecto}' and id = '{$id}'";
                 $result   = $db->query($query);
                 if($result && $db->affected_rows() === 1){
                    $session->msg('s',"Tarea ha sido actualizada. ");
                 } else {
                     $session->msg('d',' Lo siento, actualización falló.');
                 }

            } else{
                $session->msg("d", $errors);
            }
    }else{
        $session->msg('d',' Lo siento, la tarea se encuentra finalizada');
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
                    <h4 class="modal-title" id="myModalLabel"> Modificar Tarea</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd" enctype="multipart/form-data">
                        <div id="result2"></div>
                        <input type="hidden" name="id_proy" id="id_proy" >
                        <input type="hidden" name="id" id="id" >
                        <input type="hidden" name="estado" id="estado" >
                        <div class="form-group">
                           <label for="qty" class="control-label col-md-3 col-sm-6 col-xs-12">Documento</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="file" name="documento"  id="documento" class="form-control">
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Observación<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea class="form-control" name="observacion" id="observacion" rows="4" cols="80" placeholder="Observación" onKeyUp="this.value=this.value.toUpperCase();" maxlength="200"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Porcentaje<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="avance" id="avance" placeholder="% avance" required onkeyup="this.value=Num(this.value)" maxlength="3" />
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