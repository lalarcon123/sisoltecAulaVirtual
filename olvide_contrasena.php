<?php
  $page_title = 'Olvide mi Contraseña';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>
<?php

if(isset($_POST['olvidecontasena'])){
    
    $req_fields = array('username');
    validate_fields($req_fields);
    if(empty($errors)){
        $usuario  = remove_junk($db->escape($_POST['username']));
        $pass     = sha1($usuario);
        $sql = "SELECT mail FROM users WHERE username = '$usuario' LIMIT 1 ";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $from = "Administrador@urocorp.com";
                $to =   $row["email"];
                $subject = "Olvido su contraseña";
                $message = "Su nueva contraseña es ".$usuario;
                $headers = "From:" . $from;
                mail($to,$subject,$message, $headers);

               $sql = "UPDATE users SET password='{$pass}' WHERE username='{$usuario}'";
               $result = $db->query($sql);
                if($result && $db->affected_rows() === 1){
                  $session->msg('s','Su contraseña fue actualizada correctamente');
                  redirect('olvide_contrasena.php', false);
                } else {
                  redirect('index.php', false);
                }
            }
        } else {
            echo "0 results";
        }
    } else {
      redirect('index.php', false);
    }
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
</script>
 <div class="modal-body">
  <div class="row">
     <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-12">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Olvide mi contraseña</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
          <form method="post" action="olvide_contrasena.php">
            <div class="form-group">
                <label for="username">Usuario*</label>
                <input type="text" class="form-control" name="username" placeholder="Ingrese su usuario" onkeyup="this.value=NumText(this.value)" maxlength="25"  />
            </div>
            <div class="form-group clearfix">
              <button type="submit" name="olvidecontasena" class="btn btn-primary">Enviar</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>

