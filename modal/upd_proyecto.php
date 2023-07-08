<?php
    require_once('includes/load.php');
    $p_user   = $_SESSION['user_id'];
    $all_tipo_proyecto = find_all('tipo_proyecto');
    $all_users = find_all_responsables('users');
    $all_clientes = find_all('clientes');
?>
<?php

 if(isset($_POST['upd'])) {
    $documento_respaldo1 = $_FILES['planproyecto']['name'];
    $ruta1 = $_FILES['planproyecto']['tmp_name'];
    $destino1 = "uploads/documentos/".$documento_respaldo1;
    if ($documento_respaldo1 != ""){         
        if (copy($ruta1,$destino1)){
    }}

    $documento_respaldo2 = $_FILES['cronograma']['name'];
    $ruta2 = $_FILES['cronograma']['tmp_name'];
    $destino2 = "uploads/documentos/".$documento_respaldo2;
    if ($documento_respaldo2 != ""){         
        if (copy($ruta2,$destino2)){
    }}

    if (empty($documento_respaldo1)){$destino1="";}
    if (empty($documento_respaldo2)){$destino2="";}

    $req_fields = array('id',
         'codigoproy',
         'nombre',
         'descripcion',
         'tipo_proyecto',
         'responsable',
         'id_cliente',
         'fecha_inicio',
         'fecha_fin',
         'estado');
    
    validate_fields($req_fields);
 
         if(empty($errors)) {

             $id               = (int)$db->escape($_POST['id']);
             $codigoproy       = remove_junk($db->escape($_POST['codigoproy']));
             $nombre           = remove_junk($db->escape($_POST['nombre']));
             $descripcion      = remove_junk($db->escape($_POST['descripcion']));
             $tipo_proyecto    = (int)$db->escape($_POST['tipo_proyecto']);
             $responsable      = (int)$db->escape($_POST['responsable']);
             $cliente          = (int)$db->escape($_POST['id_cliente']);
             $fecha_inicio     = remove_junk($db->escape($_POST['fecha_inicio']));
             $fecha_fin        = remove_junk($db->escape($_POST['fecha_fin']));
             $status           = remove_junk($db->escape($_POST['estado']));

             if ($status=="ACTIVO")
             {
                 $estado ="1";
             } else {
                 $estado ="0";
             }

             $query = "UPDATE proyectos SET";
             $query .= " codigoproy    ='{$codigoproy}',";
             $query .= " nombre        ='{$nombre}',";
             $query .= " descripcion   ='{$descripcion}',";
             $query .= " tipo_proyecto ='{$tipo_proyecto}',";
             $query .= " responsable   ='{$responsable}',";
             $query .= " id_cliente    ='{$cliente}',";
             $query .= " fecha_inicio  ='{$fecha_inicio}',";
             $query .= " fecha_fin     ='{$fecha_fin}',";
             if ($destino1!=""){
             $query .= " planproyecto  ='{$destino1}',";
             }
             if ($destino2!=""){
             $query .= " cronograma    ='{$destino2}',";
             }
             $query .= " estado        ='{$estado}'";
             $query .= " WHERE id = {$id}";

             $result   = $db->query($query);
             if($result && $db->affected_rows() === 1){
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
                    <h4 class="modal-title" id="myModalLabel"> Editar Proyecto</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd" enctype="multipart/form-data">
                        <div id="result2"></div>
                        <input type="hidden" name="id" id="id" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Código Proyecto<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="codigoproy" id="codigoproy" class="form-control" placeholder="Código Proyecto" onKeyUp="this.value=this.value.toUpperCase();">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" onKeyUp="this.value=this.value.toUpperCase();" maxlength="250">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción" >-->
                              <textarea class="form-control" name="descripcion" id="descripcion" rows="4" cols="80" placeholder="Descripción" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Proyecto<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="tipo_proyecto" id="tipo_proyecto">
                                  <?php foreach ($all_tipo_proyecto as $tipo_proyecto ):?>
                                   <option value="<?php echo $tipo_proyecto['id'];?>"><?php echo ucwords($tipo_proyecto['descripcion']);?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Líder del Proyecto<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="responsable" id="responsable">
                                  <?php foreach ($all_users as $users ):?>
                                   <option value="<?php echo $users['id'];?>"><?php echo ucwords($users['name']).' '.ucwords($users['last_name']);?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="id_cliente" id="id_cliente">
                                  <?php foreach ($all_clientes as $clientes ):?>
                                   <option value="<?php echo $clientes['id'];?>"><?php echo ucwords($clientes['descripcion']);?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Inicio<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" placeholder="Fecha Inicio" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Fin<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" placeholder="Fecha Fin" >
                            </div>
                        </div>
                        <div class="form-group">
                           <label for="qty" class="control-label col-md-3 col-sm-6 col-xs-12">Plan Proyecto<span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="file" name="planproyecto"  id="planproyecto" class="form-control">
                           </div>
                        </div>

                        <div class="form-group">
                           <label for="qty" class="control-label col-md-3 col-sm-6 col-xs-12">Cronograma<span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="file" name="cronograma"  id="cronograma" class="form-control">
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