<?php
    require_once('includes/load.php');
?>
<?php
  if(isset($_POST['upd'])) {
    $req_fields = array('descripcion','estado');

    validate_fields($req_fields);
    if(empty($errors)){
         $id              = remove_junk($db->escape($_POST['id']));
         $identificacion  = remove_junk($db->escape($_POST['identificacion']));
         $descripcion     = remove_junk($db->escape($_POST['descripcion']));
         $mail            = remove_junk($db->escape($_POST['mail']));
         $direccion       = remove_junk($db->escape($_POST['direccion']));
         $telefono        = remove_junk($db->escape($_POST['telefono']));
         $responsable     = remove_junk($db->escape($_POST['responsable']));

         $estado          = remove_junk($db->escape($_POST['estado']));
         if ($estado=='ACTIVO'){
             $estado= '1';
         } else {
             $estado= '0';
         }

         $sql  = "UPDATE clientes SET descripcion ='{$descripcion}', ";
         $sql .=                " identificacion='{$identificacion}', ";
         $sql .=                " direccion='{$direccion}', ";
         $sql .=                " mail='{$mail}', ";
         $sql .=                " telefono='{$telefono}', ";
         $sql .=                " responsable='{$responsable}', ";
         $sql .=                " estado='{$estado}' ";
         $sql .=                " WHERE id ='{$db->escape($id)}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){            
            $session->msg('s',"Cliente Actualizado");
          } else {
            $session->msg('d',' Lo siento no se actualizó los datos.');
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
                    <h4 class="modal-title" id="myModalLabel"> Editar Cliente</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd" enctype="multipart/form-data">
                        <div id="result2"></div>
                        <input type="hidden" name="id" id="id" >

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Identificación<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="identificacion" id="identificacion" placeholder="Identificación" required onkeyup="this.value=Num(this.value)" maxlength="13" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Nombre"  required onKeyUp="this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección"  onKeyUp="this.value=this.value.toUpperCase();" required ></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mail<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="mail" id="mail" placeholder="Mail"  onKeyUp="this.value=this.value.toUpperCase();" required />
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" required onkeyup="this.value=Num(this.value)" maxlength="10" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Contacto<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="responsable" id="responsable" placeholder="Responsable"  onKeyUp="this.value=this.value.toUpperCase();" required >
                            </div>
                        </div>

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