<?php
    require_once('includes/load.php');
    $p_user   = $_SESSION['user_id'];
    $all_categorias = find_all('categoria');
?>
<?php
//vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
// You may change maxsize, and allowable upload file types.
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
//Maximum file size. You may increase or decrease.
$MAX_SIZE = 10000000;

//Allowable file Mime Types. Add more mime types if you want
$FILE_MIMES = array('video/mpeg mpeg mpg mpe');

//Allowable file ext. names. you may add more extension names.
$FILE_EXTS = array('.mpg', '.MPG', '.mpeg', '.MPEG', '.mpe', '.MPE','.mp4','.MP4','.avi','.AVI', '.asf','.ASF','.m4v','.M4V','.mov','.MOV','.wmv','.WMV','.pdf');

//Allow file delete? no, if only allow upload only
$DELETABLE = true;


 if(isset($_POST['upd'])) {
    $req_fields = array('id',
         'descripcion',
         'objetivo',
         'tema');
    
    validate_fields($req_fields);

         $file_type_video = $_FILES['multimedia']['type'];
         $file_name_video = $_FILES['multimedia']['name'];
         $file_ext_video = strtolower(substr($file_name_video,strrpos($file_name_video,".")));
         $uploadDir_video = "uploads/multimedia/";
         $uploadFile_video = $uploadDir_video . $file_name_video;

         if (empty($file_name_video)){
            $file_name_video = "";
         }else{
             if ($_FILES['multimedia']['size'] <= $MAX_SIZE) {
                if (in_array($file_ext_video, $FILE_EXTS)){
                    $move = move_uploaded_file($_FILES['multimedia']['tmp_name'], $uploadFile_video);
                    //echo "<script>alert(\"$uploadFile_video\");</script>";
                    if ($file_name_video != "" && $move)  {
                
                   }
                }else{
                    echo "<script language=\"javascript\">
                                  alert('Tipo de Archivo no permitido');
                                  </script> ";    
                }
             } else {
                echo "<script language=\"javascript\">
                      alert('El video es demasiado grande, debe reducir su tamaño');
                      </script> ";
             } 
         }
         if(empty($errors)) {

             $id              = remove_junk($db->escape($_POST['id']));
             $descripcion     = remove_junk($db->escape($_POST['descripcion']));
             $objetivo        = remove_junk($db->escape($_POST['objetivo']));
             $tema            = remove_junk($db->escape($_POST['tema']));

             $query = "UPDATE contenido_capitulo SET";
             $query .= " descripcion   ='{$descripcion}',";
             $query .= " objetivo      ='{$objetivo}',";
             $query .= " tema          ='{$tema}'";
            if (empty($file_name_video)){
             }else{
                $query .= " , multimedia    ='{$file_name_video}'";
             }
             $query .= " WHERE id = '{$id}'";

             $result   = $db->query($query);
             if($result && $db->affected_rows() === 1){
                $session->msg('s',"Contenido ha sido actualizado. ");
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
                    <h4 class="modal-title" id="myModalLabel"> Editar Contenido Capitulo</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd" enctype="multipart/form-data">
                        <div id="result2"></div>
                        <input type="hidden" name="id" id="id" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción" >-->
                              <textarea class="form-control" name="descripcion" id="descripcion" rows="4" cols="80" placeholder="Descripción" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Objetivo<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="objetivo" id="objetivo" class="form-control" placeholder="Objetivo" >-->
                              <textarea class="form-control" name="objetivo" id="objetivo" rows="4" cols="80" placeholder="Objetivo"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tema<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <!--<input type="text" name="objetivo" id="objetivo" class="form-control" placeholder="Objetivo" >-->
                              <textarea class="form-control" name="tema" id="tema" rows="4" cols="80" placeholder="Tema"></textarea>
                            </div>
                        </div>
                       <div class="form-group">
                           <label for="qty" class="control-label col-md-3 col-sm-6 col-xs-12">Multimedia</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="file" name="multimedia"  id="multimedia" class="form-control">
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