<?php
    require_once('includes/load.php');
    $p_user   = $_SESSION['user_id'];
    $all_categorias = find_all('categoria');
?>
<?php

 if(isset($_POST['upd'])) {
    $req_fields = array('id',
         'descripcion',
         'objetivo',
         'id_categoria',
         'duracion',
         'estado');
    
    validate_fields($req_fields);
    if(empty($errors)) {

         $documento_respaldo = $_FILES['imagen']['name'];
         $ruta = $_FILES['imagen']['tmp_name'];
         $destino = "uploads/curso/".$documento_respaldo;
         if ($documento_respaldo != ""){
           if (copy($ruta,$destino)){  
           }
         }else{
            $destino="";
         }

         $id              = remove_junk($db->escape($_POST['id']));
         $descripcion     = remove_junk($db->escape($_POST['descripcion']));
         $objetivo        = remove_junk($db->escape($_POST['objetivo']));
         $id_categoria    = remove_junk($db->escape($_POST['id_categoria']));
         $duracion        = remove_junk($db->escape($_POST['duracion']));
         $puntaje_minimo  = remove_junk($db->escape($_POST['puntaje_minimo']));
         $estado          = remove_junk($db->escape($_POST['estado']));

         if ($estado=="ACTIVO")
         {
             $estado ="1";
         } else {
             $estado ="0";
         }

         $query = "UPDATE curso SET";
         $query .= " descripcion   ='{$descripcion}',";
         $query .= " objetivo      ='{$objetivo}',";
         $query .= " duracion      ='{$duracion}',";
         $query .= " id_categoria  ='{$id_categoria}',";
         $query .= " puntaje_minimo='{$puntaje_minimo}',";
         if (empty($destino)){
         }else{
            $query .= " imagen        ='{$destino}',";
         }

         $query .= " estado        ='{$estado}'";
         $query .= " WHERE id      = {$id}";

         $result   = $db->query($query);
         if($result && $db->affected_rows() === 1){
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
}

?>
    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"> Editar Curso</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd" enctype="multipart/form-data">
                        <div id="result2"></div>
                        <input type="hidden" name="id" id="id" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción" >-->
                              <textarea class="form-control" name="descripcion" id="descripcion" rows="4" cols="80" placeholder="Descripción" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Objetivo<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="objetivo" id="objetivo" class="form-control" placeholder="Objetivo" >-->
                              <textarea class="form-control" name="objetivo" id="objetivo" rows="4" cols="80" placeholder="Objetivo"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoría<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="id_categoria" id="id_categoria">
                                  <?php foreach ($all_categorias as $categorias ):?>
                                   <option value="<?php echo $categorias['id'];?>"><?php echo ucwords($categorias['descripcion']);?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Duración<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="duracion" id="duracion" class="form-control" placeholder="Duración" >
                            </div>
                        </div>
                         <!--<div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Puntaje Mínimo<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">-->
                              <input type="hidden" name="puntaje_minimo" id="puntaje_minimo" class="form-control" placeholder="Puntaje Mínimo" >
                            <!--</div>
                        </div>-->
                       <div class="form-group">
                           <label for="qty" class="control-label col-md-3 col-sm-6 col-xs-12">Imagen</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="file" name="imagen"  id="imagen" class="form-control">
                           </div>
                       </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="estado" id="estado" required>
                                    <option value="ACTIVO"> Activo</option>
                                    <option value="INACTIVO"> Inactivo</option>  
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