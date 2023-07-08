<?php
    require_once('includes/load.php');
?>
<?php

  if(isset($_POST['upd'])) {
    $req_fields = array('cantidad_recibida');
    validate_fields($req_fields);

    if(empty($errors)){
         $id_detalle        = remove_junk($db->escape($_POST['id_detalle']));
         $cantidad_recibida = remove_junk($db->escape($_POST['cantidad_recibida']));
         $estado            = remove_junk($db->escape($_POST['estado']));
         if ($estado!='RECEPTADO'){
           $sql  = "UPDATE detalle_solicitud_compra SET cantidad_recibida ='{$cantidad_recibida}'";
           $sql .=                " WHERE id = '{$db->escape($id_detalle)}'";
           $result = $db->query($sql);
            if($result && $db->affected_rows() === 1){            
              $session->msg('s',"Cantidad actualizada ");
            } else {
              $session->msg('d',' Lo siento no se actualizó los datos.');
            }
         }else{
             echo "<script>alert('La cantidad no puede ser modificada');</script>";
         }
        }
    } else {
      $session->msg("d", $errors);
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
    <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"> Confirma Cantidad</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd" enctype="multipart/form-data">      
                       <div id="result2"></div>
                        <input type="hidden" name="id_detalle" id="id_detalle" >
                        <input type="hidden" name="id_proveedor" id="id_proveedor" >
                        <input type="hidden" name="id_solicitud_compra" id="id_solicitud_compra" >
                        <input type="hidden" name="estado" id="estado" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad" disabled="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad Recibida<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="cantidad_recibida" id="cantidad_recibida" placeholder="Cantidad recibida" required onkeyup="this.value=Num(this.value)">
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