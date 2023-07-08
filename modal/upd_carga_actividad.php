<?php
    require_once('includes/load.php');
    $p_user   = $_SESSION['user_id'];
?>
<?php

 if(isset($_POST['upd'])) {
    $fecha_maxima    = remove_junk($db->escape($_POST['fecha_maxima']));
    $fecha_i_maxima  = strtotime($fecha_maxima);

    $hoy=Date("Y-m-d H:i:s");

    $fechaHoy2 = strtotime("$hoy"); 

    if($fecha_i_maxima > $fechaHoy2){

        $documento_respaldo = $_FILES['documento']['name'];
        $ruta = $_FILES['documento']['tmp_name'];
        $destino = "uploads/curso/".$documento_respaldo;    

        if ($documento_respaldo != ""){
          if (copy($ruta,$destino)){   
             if(empty($errors)) {
                 $id_curso_oferta = remove_junk($db->escape($_POST['id_curso_oferta']));
                 $id_actividad    = remove_junk($db->escape($_POST['id_actividad']));
                 $query = "UPDATE actividades_curso_estudiante SET";
                 $query .= " documento    ='{$destino}', ";
                 $query .= " fecha_carga  = now() ";
                 $query .= " WHERE id_user = '{$p_user}' and id_curso_oferta = '{$id_curso_oferta}' and id_actividad = '{$id_actividad}'";
                 $result   = $db->query($query);
                 if($result && $db->affected_rows() === 1){
                    $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('actividades_curso_estudiante', ".$p_user.",'Actualizar')";
                    $result_aud = $db->query($query_aud);
                    if($result_aud && $db->affected_rows() === 1){
                        $session->msg('s',"Actividad ha sido actualizado. ");
                    }
                 } else {
                     $session->msg('d',' Lo siento, actualización falló.');
                 }

             } else{
                 $session->msg("d", $errors);
             }}
         } else {
            echo "<script>alert('Debe cargar un documento');</script>";
         }
    } else {
        echo "<script>alert('La fecha máxima ha concluido');</script>";
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
                    <h4 class="modal-title" id="myModalLabel"> Cargar Actividad</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd" enctype="multipart/form-data">
                        <div id="result2"></div>
                        <input type="hidden" name="id_curso_oferta" id="id_curso_oferta" >
                        <input type="hidden" name="id_actividad" id="id_actividad" >
                        <input type="hidden" name="fecha_maxima" id="fecha_maxima" >
                        <div class="form-group">
                           <label for="qty" class="control-label col-md-3 col-sm-6 col-xs-12">Documento</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="file" name="documento"  id="documento" class="form-control">
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