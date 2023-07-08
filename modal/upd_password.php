<?php
    require_once('includes/load.php');
?>
<?php
  if(isset($_POST['updp'])) {
          $req_fields = array('clave');
          validate_fields($req_fields);
          if(empty($errors)){
               $usuario_id = (int)$db->escape($_POST['id_user']);
               $clave      = remove_junk($db->escape($_POST['clave']));
               $h_pass     = sha1($clave);
               $sql = "UPDATE users SET password ='{$h_pass}' WHERE id='{$db->escape($usuario_id)}'";
               //echo $sql;
               $result = $db->query($sql);
               if($result && $db->affected_rows() === 1){
                  echo "<script>alert('Se ha actualizado la contraseña del usuario.');</script>";
                  //$session->msg('s',"Se ha actualizado la contraseña del usuario. ");
               } else {
                  echo "<script>alert('No se pudo actualizar la contraseña de usuario..');</script>";
                  //$session->msg('d','No se pudo actualizar la contraseña de usuario..');
               }
          } else {
            $session->msg("d", $errors);
          }
  }
?>
    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg-udp1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"> Cambiar la Clave</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="updp" name="updp" enctype="multipart/form-data">
                        <div id="result2"></div>
                        <input type="hidden" name="id_user" id="id_user" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Clave<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="password" class="form-control" name="clave" id="clave" placeholder="" required>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <input name="updp" type="submit" class="btn btn-success" value="Guardar">
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