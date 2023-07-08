<?php
  $page_title = 'Registro';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>
<?php
  if(isset($_POST['add_user'])){

   $req_fields = array('full-name','last-name','cedula','e-mail','telefono','movil','username','password');
   validate_fields($req_fields);

   if(find_by_username('users',$_POST['username']) === false ){
     $session->msg('d','<b>Error!</b> El usuario que intenta crear ya se encuentra registrado en el sistema.');
     redirect('add_user_visitante.php', false);
   }

   if(empty($errors)){
        $name       = remove_junk($db->escape($_POST['full-name']));
        $last_name  = remove_junk($db->escape($_POST['last-name']));
        $cedula     = remove_junk($db->escape($_POST['cedula']));
        $mail       = remove_junk($db->escape($_POST['e-mail']));
        $telefono   = remove_junk($db->escape($_POST['telefono']));
        $movil      = remove_junk($db->escape($_POST['movil']));
        $username   = remove_junk($db->escape($_POST['username']));
        $password   = remove_junk($db->escape($_POST['password']));

        $password   = sha1($password);
        
        $valida    = find_by_usuario('users', $username, $cedula);
        
        if ($valida===0) {
            $query = "INSERT INTO users (";
            $query .="name,username,password,user_level,status, last_name, mail, phone, movil, ci";
            $query .=") VALUES (";
            $query .=" '{$name}', '{$username}', '{$password}', '6','3','{$last_name}','{$mail}','{$telefono}','{$movil}','{$cedula}' ";
            $query .=")";

            if($db->query($query)){
              //sucess
              $session->msg('s'," Cuenta de usuario ha sido creada");
              
              $from = "Administrador@urocorp.com";
              $to =   $mail;
              $subject = "Usuario creado";
              $message = "Usted se ha registrado en el Sistema de Gestion de Riesgos. Su cuenta será validada por un administrador que se contactará con usted antes de activarse. ";
              $headers = "From:" . $from;
              mail($to,$subject,$message, $headers);
              redirect('index.php', false);
            } else {
              //failed
              $session->msg('d',' No se pudo crear la cuenta.');
              redirect('index.php', false);
            }
        } else{
        $session->msg("d", "Cédula o Usuario ya existe");
        redirect('add_user_visitante.php',false);          
        }
   } else {
      $session->msg("d", "mensaje".$errors);
      redirect('add_user_visitante.php',false);

   }
 }
if(isset($_POST['regresar'])) {
        redirect('index.php', false);
}
?>
<?php include_once('layouts/header_.php'); ?>
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
  <?php echo display_msg($msg); ?>
<table style="width:30%;height: 200px;" align="center">
  <tr>
    <td>



  <!--<div class="row">-->
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Registro usuario</span>
       </strong>
      </div>

      <div class="modal-body">

      <div class="panel-body">
        <div class="col-md-12">
          <form method="post" action="add_user_visitante.php" class="form-horizontal form-label-left input_mask">            
            <div class="form-group">
                <label for="name" class="col-md-12">Nombre<span class="required">*</span></label>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="full-name" placeholder="Nombres"  onkeyup="this.value=NumText(this.value)" maxlength="50" />
                </div>
            </div>
            <div class="form-group">
                  <label for="name" class="col-md-12">Apellido<span class="required">*</span></label>
                  <div class="col-md-12">
                    <input type="text" class="form-control" name="last-name" placeholder="Apellidos"  onkeyup="this.value=NumText(this.value)" maxlength="50" />
                  </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-md-12">Cédula<span class="required">*</span></label></label>
              <div class="col-md-12">
                <input type="text" class="form-control" name="cedula" id="cedula" placeholder="cedula"  onkeyup="this.value=Num(this.value)" maxlength="10">
                <button type="button" name="button" onclick="validar()">Validar</button>
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
                      document.getElementById("salida").innerHTML = ("Cedula Válida");
                    }else{
                      document.getElementById("salida").innerHTML = ("Cedula Inválida");
                    }
                  }
                }
                </script>
              </div>
            </div>
            <div class="form-group">
                  <label for="name" class="col-md-12">E-mail<span class="required">*</span></label></label>
                  <div class="col-md-12">
                    <input type="email" class="form-control" name="e-mail" placeholder="Correo" maxlength="50">
                  </div>
            </div>
            <div class="form-group">
                  <label for="name" class="col-md-12">Teléfono<span class="required">*</span></label></label>
                  <div class="col-md-12">
                    <input type="text" class="form-control" name="telefono" placeholder="Telefono" maxlength="10" onkeyup="this.value=Num(this.value)" />
                  </div> 
            </div>
            <div class="form-group">
                  <label for="name" class="col-md-12">Celular<span class="required">*</span></label></label>
                  <div class="col-md-12">
                    <input type="text" class="form-control" name="movil" placeholder="Celular"  onkeyup="this.value=Num(this.value)" maxlength="10" />
                  </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-md-12">Usuario<span class="required">*</span></label></label>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="username" placeholder="Nombre de usuario" onkeyup="this.value=NumText(this.value)" maxlength="25" />
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-12">Contraseña<span class="required">*</span></label></label>
                <div class="col-md-12">
                  <input type="password" class="form-control" name ="password"  placeholder="Contraseña">
                </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
              <button type="submit" name="add_user" class="btn btn-primary">Guardar</button>
              <form method="post" action="regresar"><button type="submit" name="regresar" class="btn btn-danger">Regresar</button></form>
              </div>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>

  </div>


    </td>
  <tr>
</table>  

