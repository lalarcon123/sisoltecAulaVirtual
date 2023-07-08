<?php
    require_once('includes/load.php');
    $page_title = 'Editar Perfil';
    $user = $_SESSION['user_id'];
?>
<?php
if(isset($_POST['upd'])) {
   $req_fields = array('group_name');
   validate_fields($req_fields);
   if(empty($errors)){
         $id     = (int)remove_junk($db->escape($_POST['id']));
         $name   = remove_junk($db->escape($_POST['group_name']));
         //$level  = remove_junk($db->escape($_POST['group_level']));
         $estado = remove_junk($db->escape($_POST['estado']));

         if ($estado=="ACTIVO"){
             $estado ="1";
         } else {
             $estado ="0";
         }


         $query  = "UPDATE user_groups SET ";
         $query .= "group_name='{$name}',estado='{$estado}'";
         $query .= "WHERE ID='{$db->escape($id)}'";
         $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
          //sucess
          $session->msg('s',"Grupo se ha actualizado! ");

        } else {
          //failed
          $session->msg('d','Lamentablemente no se ha actualizado el grupo!');
        }
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
                    <h4 class="modal-title" id="myModalLabel"> Editar Perfil</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="updp" name="updp" enctype="multipart/form-data">
                        <div id="result2"></div>
                        <input type="hidden" name="id" id="id" >

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre del Perfil<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="group_name" id="group_name"  />
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nivel del Perfil<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="group_level" id="group_level" required>
                                  <option value="1"> 1 </option>
                                  <option value="2"> 2 </option>
                                  <option value="3"> 3 </option>
                                  <option value="4"> 4 </option>
                                  <option value="5"> 5 </option>
                                  <option value="6"> 6 </option>
                                </select>
                            </div>
                        </div>
                        -->
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