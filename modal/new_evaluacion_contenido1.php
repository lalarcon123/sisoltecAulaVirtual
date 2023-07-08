<?php
    require_once('includes/load.php');
    $user         = $_SESSION['user_id'];
?>
<?php

if(isset($_POST['add'])) {

            $req_fields = array(
                'id_curso',
                'fecha_inicio',
                'fecha_fin',
                'maximo_estudiantes');

            validate_fields($req_fields);

            if(empty($errors)) {
                $id_curso           = remove_junk($db->escape($_POST['id_curso']));
                $fecha_inicio       = remove_junk($db->escape($_POST['fecha_inicio']));
                $fecha_fin          = remove_junk($db->escape($_POST['fecha_fin']));
                $cantidad_preguntas = remove_junk($db->escape($_POST['cantidad_preguntas']));
                $p_user             = $_SESSION['user_id'];
                $fecha_i_entrada    = strtotime($fecha_inicio);
                $fecha_f_entrada    = strtotime($fecha_fin);

                if($fecha_i_entrada < $fecha_f_entrada){
                    $query = "INSERT INTO contenido_curso (id_curso, fecha_inicio, fecha_fin, cantidad_preguntas) values (";
                    $query .=" '{$id_curso}', '{$fecha_inicio}', '{$fecha_fin}', '{$cantidad_preguntas}'";
                    $query .=")";

                    $result   = $db->query($query);
                    if($result && $db->affected_rows() === 1){
                        $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('contenido_curso', ".$user.",'Ingreso')";
                        $result_aud = $db->query($query_aud);
                        if($result_aud && $db->affected_rows() === 1){
                            //$session->msg('s','Evaluación Contenido curso ingresado exitosamente. ');
                        }
                    } else {
                        //$session->msg('d','Lo siento, el ingreso falló.');
                    }
                 } else{
                    echo "<script>alert('La fecha Inicio no puede ser mayor a la fecha fin');</script>";
                }    
            } else{
                //$session->msg("d", $errors);
            }
}

if(isset($_POST['regresar'])) {
        redirect('detallescursooferta.php', false);
}
?>
    <div> <!-- Modal -->
        <div class="panel-heading clearfix">
            <div class="pull-left">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Evaluación <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                </button>
            </div>
            <div class="pull-left">
                <form class="form-horizontal form-label-left input_mask" method="post" action="regresar" id="regresar" name="regresar">
                    <input name="regresar" type="submit" class="btn btn-danger" value="Regresar"></input>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Evaluación Contenido Curso</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--<form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add" enctype="multipart/form-data">
                            <div id="result"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12">-->
                                  <input type="hidden" name="id_curso" id="id_curso" value="<?php echo $id;?>">
                            <!--    </div>
                            </div>
                            <div class="form-group">-->
                                <table class="tbl-registro" width="100%">
                                  <tr><td>   
                                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción<span class="required">*</span></label>
                                    <!--<div class="col-md-9 col-sm-9 col-xs-12">-->
                                      <textarea class="form-control" name="descripcion" rows="4" cols="80" placeholder="Descripción" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                                  </td></tr>
                            <!--    </div>
                            </div>
                            <div class="form-group">-->
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Inicio<span class="required">*</span></label>
                                <!--<div class="col-md-9 col-sm-9 col-xs-12">-->
                                  <input type="date" name="fecha_inicio" class="form-control" placeholder="Fecha Inicio" >
                            <!--    </div>
                            </div>
                            <div class="form-group">-->
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Fin<span class="required">*</span></label>
                                <!--<div class="col-md-9 col-sm-9 col-xs-12">-->
                                  <input type="date" name="fecha_fin" class="form-control" placeholder="Fecha Fin" >
                            <!--    </div>
                            </div>

                            <div class="form-group">-->
                                <label class="control-label col-md-6 col-sm-6 col-xs-12">Cantidad Preguntas<span class="required">*</span></label>
                            <!--    <div class="col-md-9 col-sm-9 col-xs-12">-->
                                  <input type="text" name="cantidad_preguntas" class="form-control" placeholder="Cantidad de Preguntas" maxlength="3">
                            <!--    </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">-->
                                  <input name="add" type="submit" class="btn btn-success" value="Guardar Evaluación Contenido"></input>
                            <!--    </div>
                            </div>
                        </form>-->
                    </fieldset>
                    <fieldset><legend>Evaluación Preguntas</legend>
                    <table class="tbl-registro" width="100%">
                        <tr>
                            <td><input type="text" placeholder="Escriba el nombre y apellido del estudiante..." class="form-control" id="nombEstudiante" disabled="disabled"/></td>
                            <td><input type="button" id="regEstudiante" class="btn btn-primary" value="+" disabled="disabled"/></td>
                        </tr>
                    </table>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" id="btn_cerrar" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->
