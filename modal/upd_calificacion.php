<?php
    require_once('includes/load.php');
    $user = $_SESSION['user_id'];
?>
<?php
  if(isset($_POST['upd'])) {
          $req_fields = array('calificacion');
          if(empty($errors)){
               $id = (int)$db->escape($_POST['id']);
               $id_actividad = (int)$db->escape($_POST['id_actividad']);
               $id_user = (int)$db->escape($_POST['id_user']);
               $calificacion = remove_junk($db->escape($_POST['calificacion']));
               $sql = "UPDATE actividades_curso_estudiante SET calificacion='{$calificacion}' WHERE id_user='{$db->escape($id_user)}' and id_curso_oferta='{$db->escape($id)}' and id_actividad='{$db->escape($id_actividad)}'";
               $result = $db->query($sql);
               if($result && $db->affected_rows() === 1){

                  $actividades_info = find_by_id('actividades_curso',$id);
                  if (isset($actividades_info['descripcion'])){
                      $descripcion = $actividades_info['descripcion'];
                      if (isset($descripcion)){
                        $sqlconsolidado = "INSERT into consolidado_estudiante(id_user, id_curso, descripcion, calificacion) values ('{$user}','{$id}','{$descripcion}','{$calificacion}')";
                        $result2 = $db->query($sqlconsolidado);   
                      }
                  }

                  $session->msg('s',"Se ha actualizado la calificación. ");
               } else {
                  $session->msg('d','No se pudo actualizar la calificación.');
               }
          } else {
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

    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"> Ingresar la calificación</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd" enctype="multipart/form-data">
                        <div id="result2"></div>
                        <input type="hidden" name="id" id="id" >
                        <input type="hidden" name="id_actividad" id="id_actividad" >
                        <input type="hidden" name="id_user" id="id_user" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Calificación<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="imput" class="form-control" name="calificacion" id="calificacion" placeholder="Ingresa la calificacion" maxlength="3" onkeyup="this.value=Num(this.value)" required>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <input name="upd" type="submit" class="btn btn-success" value="Guardar">
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