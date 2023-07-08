<?php
    require_once('includes/load.php');
    $p_user   = $_SESSION['user_id'];
    $all_categorias = find_all('categoria');
?>
<?php

if(isset($_POST['add'])) {
    $documento_respaldo = $_FILES['imagen']['name'];
    $ruta = $_FILES['imagen']['tmp_name'];
    $destino = "uploads/curso/".$documento_respaldo;
    if ($documento_respaldo != ""){         
        if (copy($ruta,$destino)){
            $req_fields = array(
                'descripcion',
                'objetivo',
                'categoria',
                'duracion');

            validate_fields($req_fields);
            if(empty($errors)) {
                $descripcion      = remove_junk($db->escape($_POST['descripcion']));
                $objetivo         = remove_junk($db->escape($_POST['objetivo']));
                $id_categoria     = (int)$db->escape($_POST['categoria']);
                $duracion         = remove_junk($db->escape($_POST['duracion']));
                $p_user           = $_SESSION['user_id'];
                $puntaje_minimo   = remove_junk($db->escape($_POST['puntaje_minimo']));
                $query = "insert into curso (descripcion, objetivo, id_categoria, duracion, puntaje_minimo, id_usuario, imagen) values (";
                $query .=" '{$descripcion}', '{$objetivo}', '{$id_categoria}', '{$duracion}', '{$puntaje_minimo}', '{$p_user}', '{$destino}'";
                $query .=")";

                $result   = $db->query($query);
                if($result && $db->affected_rows() === 1){
                    $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('curso', ".$p_user.",'Ingreso')";
                    $result_aud = $db->query($query_aud);
                    if($result_aud && $db->affected_rows() === 1){
                        $session->msg('s',"Curso ingresado exitosamente. ");
                    }
                } else {
                    $session->msg('d',' Lo siento, el ingreso falló.');
                }

            } else{
                $session->msg("d", $errors);
            }
    }
}}

?>

    <div> <!-- Modal -->

        <div class="panel-heading clearfix">
            <div class="pull-left">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Curso <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
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
                    <h4 class="modal-title" id="myModalLabel">Agregar Curso</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="descripcion" class="form-control" placeholder="Descripción" >-->
                              <textarea class="form-control" name="descripcion" rows="4" cols="80" placeholder="Descripción" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Objetivo<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="objetivo" class="form-control" placeholder="Objetivo" >-->
                              <textarea class="form-control" name="objetivo" rows="4" cols="80" placeholder="Objetivo" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoría<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="categoria" id="categoria">
                                   <option value="">Selecciona un Categoría</option>
                                  <?php foreach ($all_categorias as $categorias ):?>
                                   <option value="<?php echo $categorias['id'];?>"><?php echo ucwords($categorias['descripcion']);?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Duración<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="duracion" class="form-control" placeholder="Duración" >
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Puntaje Mínimo<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">-->
                              <input type="hidden" name="puntaje_minimo" class="form-control" placeholder="Puntaje Mínimo" maxlength="3">
                            <!--</div>
                        </div>-->

                       <div class="form-group">
                           <label for="qty" class="control-label col-md-3 col-sm-6 col-xs-12">Imagen</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="file" name="imagen"  id="imagen" class="form-control">
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
