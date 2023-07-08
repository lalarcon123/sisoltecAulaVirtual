<?php
    require_once('includes/load.php');
    $p_user   = $_SESSION['user_id'];
?>
<?php

if(isset($_POST['add'])) {
    //$documento_respaldo = $_FILES['imagen']['name'];
    //$ruta = $_FILES['imagen']['tmp_name'];
    //$destino = "uploads/curso/".$documento_respaldo;
    //if ($documento_respaldo != ""){         
    //    if (copy($ruta,$destino)){
            $req_fields = array(
                'descripcion');

            validate_fields($req_fields);
            if(empty($errors)) {
                $descripcion      = remove_junk($db->escape($_POST['descripcion']));
                $query = "insert into tipo_proyecto (descripcion) values (";
                $query .=" '{$descripcion}'";
                $query .=")";

                $result   = $db->query($query);
                if($result && $db->affected_rows() === 1){
                    $session->msg('s',"Tipo Proyecto ingresado exitosamente. ");
                } else {
                    $session->msg('d',' Lo siento, el ingreso falló.');
                }

            } else{
                $session->msg("d", $errors);
            }
    //}
//}
}

?>

    <div> <!-- Modal -->

        <div class="panel-heading clearfix">
            <div class="pull-left">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Tipo Proyecto <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
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
                    <h4 class="modal-title" id="myModalLabel">Agregar Tipo Proyecto</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add" enctype="multipart/form-data">
                        <div id="result"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea class="form-control" name="descripcion" rows="4" cols="80" placeholder="Descripción" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
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
