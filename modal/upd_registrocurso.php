<?php
    require_once('includes/load.php');
    $p_user   = $_SESSION['user_id'];
?>
<?php

 if(isset($_POST['upd'])) {
    if  (empty(remove_junk($db->escape($_POST['fecha_pago'])))){
         if(empty($errors)) {
             $id              = remove_junk($db->escape($_POST['id']));
             $descripcion     = remove_junk($db->escape($_POST['descripcion']));
             $docente         = remove_junk($db->escape($_POST['docente']));
             $estudiante      = remove_junk($db->escape($_POST['estudiante']));
             $fecha_registro  = remove_junk($db->escape($_POST['fecha_registro']));
             $id_user         = remove_junk($db->escape($_POST['id_user']));
             $precio          = remove_junk($db->escape($_POST['precio']));

             $query = "INSERT INTO pagos (id_user, id_curso, valor_pago ) VALUES (";
             $query .= "  '{$id_user}', '{$id}', '{$precio}') ";

             $result   = $db->query($query);
             if($result && $db->affected_rows() === 1){

                $insert_contenido = "insert into estudiante_avance_curso (id_user, id_curso, id_capitulo, id_contenido) select '{$id_user}', id_curso, id_capitulo, id from contenido_capitulo where id_curso = '{$id}'";
                $result_contenido = $db->query($insert_contenido); 

                $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('curso', ".$p_user.",'Actualizar')";
                $result_aud = $db->query($query_aud);
                if($result_aud && $db->affected_rows() === 1){
                    $session->msg('s',"Curso ha sido actualizado. ");
                }
             } else {
                 $session->msg('d',' Lo siento, actualización falló.');
             }

         } else{
             $session->msg("d", $errors);
         }
    } else {
        $session->msg('d',' El pago ya fue realizado');
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
                    <h4 class="modal-title" id="myModalLabel"> Registrar Pago</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd" enctype="multipart/form-data">
                        <div id="result2"></div>
                        <input type="hidden" name="id" id="id" >
                        <input type="hidden" name="id_user" id="id_user" >
                        <input type="hidden" name="precio" id="precio" >
                        <input type="hidden" name="fecha_pago" id="fecha_pago" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea class="form-control" name="descripcion" id="descripcion" rows="4" cols="80" placeholder="Descripción" readonly onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Docente<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea class="form-control" name="docente" id="docente" rows="4" cols="80" placeholder="Docente" readonly onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Estudiante<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="estudiante" id="estudiante" class="form-control" placeholder="Estudiante" readonly onKeyUp="this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Registro<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="fecha_registro" id="fecha_registro" class="form-control" placeholder="Fecha Registro" readonly>
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