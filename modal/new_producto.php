<?php
    require_once('includes/load.php');
    $p_user    = $_SESSION['user_id'];
    $all_users = find_all_responsables('users');
?>
<?php

if(isset($_POST['add'])) {
    $documento_respaldo = $_FILES['documento']['name'];
    $ruta = $_FILES['documento']['tmp_name'];
    $destino = "uploads/img/".$documento_respaldo;


    if ($documento_respaldo != ""){         
        if (copy($ruta,$destino)){
            $req_fields = array(
                'nombre',
                'especificaciones',
                'color',
                'precio',
                'cantidad');

            validate_fields($req_fields);
            if(empty($errors)) {
                $nombre           = remove_junk($db->escape($_POST['nombre']));
                $especificaciones = remove_junk($db->escape($_POST['especificaciones']));
                $color            = remove_junk($db->escape($_POST['color']));
                $precio           = remove_junk($db->escape($_POST['precio']));
                $cantidad         = remove_junk($db->escape($_POST['cantidad']));

                $query = "insert into productos (nombre, especificaciones, color, documento, precio, cantidad) values (";
                $query .=" '{$nombre}', '{$especificaciones}', '{$color}', '{$destino}', '{$precio}', '{$cantidad}'";
                $query .=")";

                $result   = $db->query($query);
                if($result && $db->affected_rows() === 1){
                    $session->msg('s',"Producto ingresado exitosamente. ");
                } else {
                    $session->msg('d',' Lo siento, el ingreso falló.');
                }

            } else{
                $session->msg("d", $errors);
            }
    }
}
}

?>

    <div> <!-- Modal -->

        <div class="panel-heading clearfix">
            <div class="pull-left">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Producto <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
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
                    <h4 class="modal-title" id="myModalLabel">Agregar Producto</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add" enctype="multipart/form-data">
                        <div id="result"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="descripcion" class="form-control" placeholder="Descripción" >-->
                              <textarea class="form-control" name="nombre" rows="4" cols="80" placeholder="Nombre" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Especificaciones Técnicas<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="descripcion" class="form-control" placeholder="Descripción" >-->
                              <textarea class="form-control" name="especificaciones" rows="4" cols="80" placeholder="Especificaciones" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Color<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="descripcion" class="form-control" placeholder="Descripción" >-->
                              <textarea class="form-control" name="color" rows="4" cols="80" placeholder="Color" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
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
                           <label for="qty" class="control-label col-md-3 col-sm-6 col-xs-12">Documento<span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="file" name="documento"  id="documento" class="form-control">
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
