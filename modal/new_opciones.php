<?php
    require_once('includes/load.php');
?>
<?php

if(isset($_POST['add'])) {
   $req_fields = array('descripcion', 'observacion');
   validate_fields($req_fields);
  
   if(empty($errors)){
        $descripcion     = remove_junk($db->escape($_POST['descripcion']));
        $observacion     = remove_junk($db->escape($_POST['observacion']));
        $pagina          = remove_junk($db->escape($_POST['pagina']));
        if (empty($pagina)){
           $pagina  = "#";  
        }
       // $hoy   = Date("Y-m-d H:i:s");        
        $query = "INSERT INTO menu (";
        $query .="descripcion, observacion, pagina";
        $query .=") VALUES (";
        $query .=" '{$descripcion}', '{$observacion}', '{$pagina}' ";
        $query .=")";
        //echo $query;
        if($db->query($query)){
          //sucess
          $session->msg('s'," Menú creado exitosamente");
      
        } else {
          //failed
          //$session->msg('d',' No se pudo crear la cuenta.');
          echo "<script>alert('No se pudo crear el Menú.');</script>";

          //redirect('detallesusuarios.php', false);
        }
   } else {
     $session->msg("d", $errors);
      //redirect('detallesusuarios.php',false);
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
                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Módulos <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
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
                    <h4 class="modal-title" id="myModalLabel">Agregar Módulos</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add" enctype="multipart/form-data">
                        <div id="result"></div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="descripcion" placeholder="Descripción"  onKeyUp="this.value=this.value.toUpperCase();" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Observación<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea class="form-control" name="observacion" placeholder="Observación"  onKeyUp="this.value=this.value.toUpperCase();" required=""></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Página<span></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="pagina" placeholder="Página"  onKeyUp="this.value=this.value.toUpperCase();">
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
