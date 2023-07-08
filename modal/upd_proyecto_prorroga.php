<?php
    require_once('includes/load.php');
    $p_user   = $_SESSION['user_id'];
    $all_tipo_proyecto = find_all('tipo_proyecto');
    $all_users = find_all_responsables('users');
    $all_clientes = find_all('clientes');
?>
<?php

 if(isset($_POST['upd'])) {
    $req_fields = array('id',
         'fecha_fin');
    
    validate_fields($req_fields);
 
        $documento_respaldo = $_FILES['archivo']['name'];
        $ruta = $_FILES['archivo']['tmp_name'];
        $destino = "uploads/documentos/".$documento_respaldo;
        if ($documento_respaldo != ""){         
            if (copy($ruta,$destino)){
        }}

        if(empty($errors)) {

             $id                = (int)$db->escape($_POST['id']);
             $fecha_fin         = remove_junk($db->escape($_POST['fecha_fin']));
             $fecha_fin_anterior= remove_junk($db->escape($_POST['fecha_fin_anterior']));

             $query = "UPDATE proyectos SET";
             $query .= " fecha_fin     ='{$fecha_fin}'";
             $query .= " WHERE id = {$id}";

             $result   = $db->query($query);
             if($result && $db->affected_rows() === 1){

                $query = "INSERT INTO prorroga_proyecto (id_proyecto, 
                                                         fecha_fin_anterior, 
                                                         fecha_fin, 
                                                         archivo )";
                $query .= " VALUES ('{$id}', '{$fecha_fin_anterior}', '{$fecha_fin}', '{$destino}')";
                $result   = $db->query($query);

                $session->msg('s',"Proyecto ha sido actualizado. ");
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
                    <h4 class="modal-title" id="myModalLabel"> Prorroga Proyecto</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd" enctype="multipart/form-data">
                        <div id="result2"></div>
                        <input type="hidden" name="id" id="id" >
                        <input type="hidden" name="fecha_fin_anterior" id="fecha_fin_anterior" >
                        <div class="form-group">
                           <label for="qty" class="control-label col-md-3 col-sm-6 col-xs-12">Prorroga Proyecto<span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="file" name="archivo"  id="archivo" class="form-control">
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Fin<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" placeholder="Fecha Fin" >
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