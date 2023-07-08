<?php
    require_once('includes/load.php');
    $p_user   = $_SESSION['user_id']; 
    $user = $_SESSION['user_id'];
    $groups = find_all('user_groups');
?>
<?php

if(isset($_POST['add'])) {
   $req_fields = array('full-name','last-name','cedula', 'e-mail','telefono','movil','username','password','level');
   validate_fields($req_fields);
   
   $valida    = find_by_usuario('users', $_POST['username'], $_POST['cedula']);
  
   if ($valida===1) {
     echo "<script>alert('El usuario que intenta crear ya se encuentra registrado en el sistema.');</script>";
     //$session->msg('d','<b>Error!</b> El usuario que intenta crear ya se encuentra registrado en el sistema.');
   }else{
           if(empty($errors)){
                $name       = remove_junk($db->escape($_POST['full-name']));
                $last_name  = remove_junk($db->escape($_POST['last-name']));
                $cedula     = remove_junk($db->escape($_POST['cedula']));
                $mail       = remove_junk($db->escape($_POST['e-mail']));
                $telefono   = remove_junk($db->escape($_POST['telefono']));
                $movil      = remove_junk($db->escape($_POST['movil']));
                $username   = remove_junk($db->escape($_POST['username']));
                $password   = remove_junk($db->escape($_POST['password']));
                $user_level = (int)$db->escape($_POST['level']);
                $password = sha1($password);
                $query = "INSERT INTO users (";
                $query .="name,username,password,user_level, status, last_name, mail, phone, movil, ci ";
                $query .=") VALUES (";
                $query .=" '{$name}', '{$username}', '{$password}', '{$user_level}', '1','{$last_name}','{$mail}','{$telefono}','{$movil}','{$cedula}' ";
                $query .=")";
                if($db->query($query)){
                  //sucess
                  $session->msg('s'," Cuenta de usuario ha sido creada");
                  
                  $from = "Administrador@sisoltec.site";
                  $to =   $mail;
                  $subject = "Usuario creado";
                  $message = "Su Usuario ha sido creado Exitosamente";
                  $headers = "From:" . $from;
                  //mail($to,$subject,$message, $headers);
                  $session->msg('s',"Usuario ingresado exitosamente. ");
                } else {
                  //failed
                  //$session->msg('d',' No se pudo crear la cuenta.');
                  echo "<script>alert('No se pudo crear la cuenta.');</script>";

                  //redirect('detallesusuarios.php', false);
                }
           } else {
             $session->msg("d", $errors);
              //redirect('detallesusuarios.php',false);
           }
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
                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Usuario <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
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
                    <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add" enctype="multipart/form-data">
                        <div id="result"></div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="full-name" placeholder="Nombres" maxlength="50" required onKeyUp="this.value=this.value.toUpperCase();" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="last-name" placeholder="Apellidos" maxlength="50" onKeyUp="this.value=this.value.toUpperCase();" required>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">E-mail<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="email" class="form-control" name="e-mail" placeholder="Correo" maxlength="50" onKeyUp="this.value=this.value.toUpperCase();" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="telefono" placeholder="Telefono" required onkeyup="this.value=Num(this.value)" maxlength="10" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Celular<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="movil" placeholder="Celular" required onkeyup="this.value=Num(this.value)" maxlength="10" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuario<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" class="form-control" name="username" placeholder="Nombre de usuario" onKeyUp="this.value=this.value.toUpperCase();" maxlength="25" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="password" class="form-control" name ="password"  placeholder="Contraseña">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Perfil de usuario<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="level">
                                  <?php foreach ($groups as $group ):?>
                                   <option value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
                                <?php endforeach;?>
                                </select>
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
