<?php
    require_once('includes/load.php');
    $user = $_SESSION['user_id'];
?>
<?php
  $groups  = find_all('user_groups');

?>
<?php
  if(isset($_POST['upd'])) {
    $req_fields = array('name','last_name','cedula','mail','phone','movil','username','user_level');

    validate_fields($req_fields);
    if(empty($errors)){

         $id          = (int)remove_junk($db->escape($_POST['id_usuario']));
         $name        = remove_junk($db->escape($_POST['name']));

         $last_name   = remove_junk($db->escape($_POST['last_name']));
         $ci          = remove_junk($db->escape($_POST['cedula']));
         $mail        = remove_junk($db->escape($_POST['mail']));
         $phone       = remove_junk($db->escape($_POST['phone']));
         $movil       = remove_junk($db->escape($_POST['movil']));

         $username    = remove_junk($db->escape($_POST['username']));
         $user_level  = (int)$db->escape($_POST['user_level']);
         $status      = remove_junk($db->escape($_POST['status']));
         if ($status=="ACTIVO"){
             $estado ="1";
         } else {
             $estado ="0";
         }
         $sql = "UPDATE users SET name ='{$name}', last_name ='{$last_name}' , mail='{$mail}', phone='{$phone}', movil='{$movil}', username ='{$username}', user_level='{$user_level}', status='{$estado}', ci='{$ci}'  WHERE id='{$db->escape($id)}'";
         //echo $sql;
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){            
            $session->msg('s',"Cuenta Actualizada ");
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
                    <h4 class="modal-title" id="myModalLabel"> Editar Usuario</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="upd" name="upd" enctype="multipart/form-data">
                        <div id="result2"></div>
                        <input type="hidden" name="id_usuario" id="id_usuario" >
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="name" id="name" placeholder="Nombres" maxlength="50" required onKeyUp="this.value=this.value.toUpperCase();" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Apellidos" maxlength="50" required onKeyUp="this.value=this.value.toUpperCase();">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cédula<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="cedula"  id="cedula" placeholder="cédula" required onkeyup="this.value=Num(this.value)" maxlength="10">
                            <!--<button type="button" name="button" onclick="validar()">Validar</button>-->
                            <div id="salida"></div>
                            <script type="text/javascript">
                            function validar() {
                              //alert("hola");
                              var cad = document.getElementById("cedula").value.trim();
                              var total = 0;
                              var longitud = cad.length;
                              var longcheck = longitud - 1;

                              if (cad !== "" && longitud === 10){
                                for(i = 0; i < longcheck; i++){
                                  if (i%2 === 0) {
                                    var aux = cad.charAt(i) * 2;
                                    if (aux > 9) aux -= 9;
                                    total += aux;
                                  } else {
                                    total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar
                                  }
                                }

                                total = total % 10 ? 10 - total % 10 : 0;

                                if (cad.charAt(longitud-1) == total) {
                                  //document.getElementById("salida").innerHTML = ("Cedula Válida");
                                  alert("Cédula Válida");
                                }else{
                                  //document.getElementById("salida").innerHTML = ("Cedula Inválida");
                                  alert("Cédula inválida");
                                }
                              }
                            }
                            </script>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">mail<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="email" class="form-control" name="mail" id="mail" placeholder="Correo" maxlength="50" required onKeyUp="this.value=this.value.toUpperCase();">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="phone" id="phone" placeholder="phone" required onkeyup="this.value=Num(this.value)" maxlength="10" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Celular<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="movil" id="movil" placeholder="Celular" required onkeyup="this.value=Num(this.value)" maxlength="10" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuario<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="username" id="username" placeholder="Nombre de usuario" onkeyup="this.value=NumText(this.value)" maxlength="25" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Perfil de usuario<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="user_level" id="user_level">
                                  <?php foreach ($groups as $group ):?>
                                   <option value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="status" id="status" required>
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