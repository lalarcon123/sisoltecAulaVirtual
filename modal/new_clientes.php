<?php
    require_once('includes/load.php');
?>
<?php

if(isset($_POST['add'])) {
   $req_fields = array('descripcion');
   validate_fields($req_fields);
  
   if(empty($errors)){
        $identificacion  = remove_junk($db->escape($_POST['identificacion']));
        $descripcion     = remove_junk($db->escape($_POST['descripcion']));
        $mail            = remove_junk($db->escape($_POST['mail']));
        $direccion       = remove_junk($db->escape($_POST['direccion']));
        $telefono        = remove_junk($db->escape($_POST['telefono']));
        $responsable     = remove_junk($db->escape($_POST['responsable']));

       // $hoy   = Date("Y-m-d H:i:s");        
        $query = "INSERT INTO clientes (";
        $query .="identificacion, descripcion, mail, direccion, telefono, responsable";
        $query .=") VALUES (";
        $query .=" '{$identificacion}', '{$descripcion}', '{$mail}', '{$direccion}','{$telefono}','{$responsable}'";
        $query .=")";
        //echo $query;
        if($db->query($query)){
          //sucess
          $session->msg('s',"Cliente creado exitosamente");
      
        } else {
          echo "<script>alert('No se pudo crear el Clientes.');</script>";
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
    function aMayusculas(obj,id){
        obj = obj.toUpperCase();
        document.getElementById(id).value = obj;
    }
</script>
    <div> <!-- Modal -->

        <div class="panel-heading clearfix">
            <div class="pull-left">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Cliente <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
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
                    <h4 class="modal-title" id="myModalLabel">Agregar Cliente</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add" enctype="multipart/form-data">
                        <div id="result"></div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Identificación<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="identificacion" id="identificacion" placeholder="Identificación" required onkeyup="this.value=Num(this.value)" maxlength="13" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="descripcion" placeholder="Nombre"  onKeyUp="this.value=this.value.toUpperCase();" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea type="text" class="form-control" name="direccion" placeholder="Dirección"  onKeyUp="this.value=this.value.toUpperCase();" required ></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mail<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="mail" placeholder="Mail"  onKeyUp="this.value=this.value.toUpperCase();" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="telefono" placeholder="Teléfono" required onkeyup="this.value=Num(this.value)" maxlength="10" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Contacto<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="responsable" placeholder="Responsable"  onKeyUp="this.value=this.value.toUpperCase();" required >
                            </div>
                        </div>
                        <!--<div class="ln_solid"></div>-->
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
