<?php
    require_once('includes/load.php');
    $p_user       = $_SESSION['user_id'];
    $all_curso    = find_all_activos_estado('curso');
    $all_docentes = find_all_doc('users');
    $user         = $_SESSION['user_id'];
?>
<?php

if(isset($_POST['add'])) {

            $req_fields = array(
                'id_curso',
                'id_docente',
                'fecha_inicio',
                'fecha_fin',
                'maximo_estudiantes',
                'precio');

            validate_fields($req_fields);

            if(empty($errors)) {
                $id_curso           = remove_junk($db->escape($_POST['id_curso']));
                $id_docente         = remove_junk($db->escape($_POST['id_docente']));
                $fecha_inicio       = remove_junk($db->escape($_POST['fecha_inicio']));
                $fecha_fin          = remove_junk($db->escape($_POST['fecha_fin']));
                $maximo_estudiantes = remove_junk($db->escape($_POST['maximo_estudiantes']));
                $precio             = remove_junk($db->escape($_POST['precio']));
                $p_user             = $_SESSION['user_id'];
                $fecha_i_entrada    = strtotime($fecha_inicio);
                $fecha_f_entrada    = strtotime($fecha_fin);

                if($fecha_i_entrada < $fecha_f_entrada){
                    $query = "INSERT INTO curso_oferta (id_curso, id_docente, fecha_inicio, fecha_fin, maximo_estudiantes, precio, id_usuario) values (";
                    $query .=" '{$id_curso}', '{$id_docente}', '{$fecha_inicio}', '{$fecha_fin}', '{$maximo_estudiantes}', '{$precio}', '{$p_user}'";
                    $query .=")";

                    $result   = $db->query($query);
                    if($result && $db->affected_rows() === 1){
                        $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('curso_oferta', ".$user.",'Ingreso')";
                        $result_aud = $db->query($query_aud);
                        if($result_aud && $db->affected_rows() === 1){
                            $session->msg('s','Curso ingresado exitosamente. ');
                        }
                    } else {
                        $session->msg('d','Lo siento, el ingreso falló.');
                    }
                 } else{
                    echo "<script>alert('La fecha Inicio no puede ser mayor a la fecha fin');</script>";
                }    
            } else{
                $session->msg("d", $errors);
            }
}

?>
<script>
    function NumText(string){//solo letras y numeros
        var out = '';
        //Se añaden las letras validas
        var filtro = ' abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890';//Caracteres validos

        for (var i=0; i<string.length; i++)
            if (filtro.indexOf(string.charAt(i)) != -1)
                out += string.charAt(i);
        return out;
    }
    function Num(string){//solo numeros
        var out = '';
        //Se añaden las letras validas
        var filtro = '1234567890';//Caracteres validos

        for (var i=0; i<string.length; i++)
            if (filtro.indexOf(string.charAt(i)) != -1)
                out += string.charAt(i);
        return out;
    }
</script>
    <div> <!-- Modal -->
        <div class="panel-heading clearfix">
            <div class="pull-left">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Oferta Curso  <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
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
                    <h4 class="modal-title" id="myModalLabel">Agregar Oferta Curso</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add" enctype="multipart/form-data">
                        <div id="result"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Curso<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control"  style="height:2.6em;" name="id_curso">
                                  <option value="">Selecciona un Curso</option>
                                  <?php  foreach ($all_curso as $curso): ?>
                                      <option value="<?php echo (int)$curso['id']; ?>">
                                          <?php echo remove_junk($curso['descripcion']); ?>
                                      </option>
                                  <?php endforeach; ?>
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Docente<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control"  style="height:2.6em;" name="id_docente">
                                  <option value="">Selecciona un Docente</option>
                                  <?php  foreach ($all_docentes as $users): ?>
                                      <option value="<?php echo (int)$users['id']; ?>">
                                          <?php echo remove_junk($users['name'].' '.$users['last_name']); ?>
                                      </option>
                                  <?php endforeach; ?>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Máximo Estudiantes<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="maximo_estudiantes" class="form-control" placeholder="Máximo Estudiantes" maxlength="3" onkeyup="this.value=Num(this.value)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Precio<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="precio" class="form-control" placeholder="Precio" maxlength="4" onkeyup="this.value=Num(this.value)">
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
