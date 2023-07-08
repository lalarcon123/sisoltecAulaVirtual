<?php
    require_once('includes/load.php');
    $p_user   = $_SESSION['user_id'];
    $all_tipo_proyecto = find_all('tipo_proyecto');
    $all_users = find_all_responsables('users');
?>
<?php

 if(isset($_POST['upd'])) {
    $documento_respaldo = $_FILES['documento']['name'];
    $ruta = $_FILES['documento']['tmp_name'];
    $destino = "uploads/img/".$documento_respaldo;

    if ($documento_respaldo != ""){
      if (copy($ruta,$destino)){ 
         $req_fields = array('id',
                    'nombre',
                    'especificaciones',
                    'color',
                    'precio',
                    'cantidad',
                    'estado');
        
         validate_fields($req_fields);

         if(empty($errors)) {

             $id               = (int)$db->escape($_POST['id']);
             $nombre           = remove_junk($db->escape($_POST['nombre']));
             $especificaciones = remove_junk($db->escape($_POST['especificaciones']));
             $color            = remove_junk($db->escape($_POST['color']));
             $precio           = remove_junk($db->escape($_POST['precio']));
             $cantidad         = remove_junk($db->escape($_POST['cantidad']));
             $status           = remove_junk($db->escape($_POST['estado']));

             if ($status=="ACTIVO")
             {
                 $estado ="1";
             } else {
                 $estado ="0";
             }

             $query = "UPDATE productos SET";
             $query .= " nombre           ='{$nombre}',";
             $query .= " especificaciones ='{$especificaciones}',";
             $query .= " color            ='{$color}',";
             $query .= " precio           ='{$precio}',";
             $query .= " cantidad         ='{$cantidad}',";
             $query .= " documento        ='{$destino}',";
             $query .= " estado           ='{$estado}'";
             $query .= " WHERE id         = {$id}";

             $result   = $db->query($query);
             if($result && $db->affected_rows() === 1){
                $session->msg('s',"Producto ha sido actualizado. ");
             } else {
                 $session->msg('d',' Lo siento, actualización falló.');
             }

         } else{
             $session->msg("d", $errors);
         }
         }
 } else {
    echo "<script>alert('Debe cargar una imagen');</script>";
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
                    <h4 class="modal-title" id="myModalLabel"> Editar Producto</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd" enctype="multipart/form-data">
                        <div id="result2"></div>
                        <input type="hidden" name="id" id="id" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="descripcion" class="form-control" placeholder="Descripción" >-->
                              <textarea class="form-control" name="nombre" id="nombre" rows="4" cols="80" placeholder="Nombre" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Especificaciones Técnicas<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="descripcion" class="form-control" placeholder="Descripción" >-->
                              <textarea class="form-control" name="especificaciones" id="especificaciones" rows="4" cols="80" placeholder="Especificaciones" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Color<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="descripcion" class="form-control" placeholder="Descripción" >-->
                              <textarea class="form-control" name="color" id="color" rows="4" cols="80" placeholder="Color" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                           <label for="qty" class="control-label col-md-3 col-sm-6 col-xs-12">Documento<span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="file" name="documento"  id="documento" class="form-control">
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Precio <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="precio"  id="precio" placeholder="Precio" required onkeyup="this.value=Num(this.value)" maxlength="10" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="cantidad"  id="cantidad" placeholder="Cantidad" required onkeyup="this.value=Num(this.value)" maxlength="10" />
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