<?php
    require_once('includes/load.php');
    $p_user    = $_SESSION['user_id'];
    $all_tipo_proyecto = find_all('tipo_proyecto');
    $all_users    = find_all_responsables('users');
    $all_clientes = find_all('clientes');
?>
<?php

if(isset($_POST['add'])) {
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
            $req_fields = array(
                'codigoproy',
                'nombre',
                'descripcion',
                'tipo_proyecto',
                'responsable',
                'id_cliente',
                'fecha_inicio',
                'fecha_fin');

            validate_fields($req_fields);
            if(empty($errors)) {
                $codigoproy       = remove_junk($db->escape($_POST['codigoproy']));
                $nombre           = remove_junk($db->escape($_POST['nombre']));
                $descripcion      = remove_junk($db->escape($_POST['descripcion']));
                $tipo_proyecto    = (int)$db->escape($_POST['tipo_proyecto']);
                $responsable      = (int)$db->escape($_POST['responsable']);
                $cliente          = (int)$db->escape($_POST['id_cliente']);
                $fecha_inicio     = remove_junk($db->escape($_POST['fecha_inicio']));
                $fecha_fin        = remove_junk($db->escape($_POST['fecha_fin']));
                $query = "INSERT INTO proyectos (codigoproy, nombre, descripcion, tipo_proyecto, responsable, id_cliente, fecha_inicio, fecha_fin, planproyecto, cronograma) VALUES (";
                $query .=" '{$codigoproy}','{$nombre}','{$descripcion}', '{$tipo_proyecto}', '{$responsable}','{$cliente}','{$fecha_inicio}', '{$fecha_fin}', '{$destino1}', '{$destino2}'";
                $query .=")";

                $result   = $db->query($query);
                if($result && $db->affected_rows() === 1){
                    $session->msg('s',"Proyecto ingresado exitosamente. ");
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
                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Proyecto <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
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
                    <h4 class="modal-title" id="myModalLabel">Agregar Proyecto</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add" enctype="multipart/form-data">
                        <div id="result"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Código Proyecto<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="codigoproy" id="codigoproy" class="form-control" placeholder="Código Proyecto" onKeyUp="this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre"  onKeyUp="this.value=this.value.toUpperCase();" maxlength="250">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="descripcion" class="form-control" placeholder="Descripción" >-->
                              <textarea class="form-control" name="descripcion" rows="4" cols="80" placeholder="Descripción" onKeyUp="this.value=this.value.toUpperCase();" maxlength="250"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Proyecto<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="tipo_proyecto" id="tipo_proyecto">
                                   <option value="">Selecciona un Tipo Proyecto</option>
                                  <?php foreach ($all_tipo_proyecto as $tipo_proyecto ):?>
                                   <option value="<?php echo $tipo_proyecto['id'];?>"><?php echo ucwords($tipo_proyecto['descripcion']);?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Líder de Proyecto<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="responsable" id="responsable">
                                   <option value="">Selecciona Líder Responsable</option>
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
                                   <option value="">Selecciona un Cliente</option>
                                  <?php foreach ($all_clientes as $clientes ):?>
                                   <option value="<?php echo $clientes['id'];?>"><?php echo ucwords($clientes['descripcion']);?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Inicio<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="date" name="fecha_inicio" class="form-control" placeholder="Fecha Inicio" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Fin<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="date" name="fecha_fin" class="form-control" placeholder="Fecha Fin" >
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
