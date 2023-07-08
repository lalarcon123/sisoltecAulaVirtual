<?php
  $page_title = 'Editar Docente';
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
?>
<?php
  $e_user = find_by_id('users',(int)$_GET['id']);
  $groups  = find_all('user_groups');
  if(!$e_user){
    $session->msg("d","Missing user id.");
    redirect('detallesdocentes.php');
  }
?>
<?php
//Update User basic info
  if(isset($_POST['update'])) {
    $req_fields = array('name','last-name','cedula','e-mail','telefono','movil');

    validate_fields($req_fields);
    if(empty($errors)){

         $id       = (int)$e_user['id'];
         $name     = remove_junk($db->escape($_POST['name']));

         $last_name   = remove_junk($db->escape($_POST['last-name']));
         $cedula      = remove_junk($db->escape($_POST['cedula']));
         $mail        = remove_junk($db->escape($_POST['e-mail']));
         $telefono   = remove_junk($db->escape($_POST['telefono']));
         $movil      = remove_junk($db->escape($_POST['movil']));

         $sql = "UPDATE users SET name ='{$name}', last_name ='{$last_name}' , mail='{$mail}', phone='{$telefono}', movil='{$movil}', ci='{$cedula}'  WHERE id='{$db->escape($id)}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Cuenta Actualizada ");
            //redirect('edit_user.php?id='.(int)$e_user['id'], false);
            $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('users', ".$user.",'Actualiza Docente')";
            $result_aud = $db->query($query_aud);
            if($result_aud && $db->affected_rows() === 1){
               redirect('detallesdocentes.php', false);
            }
          } else {
            $session->msg('d',' Lo siento no se actualizó los datos.');
            //redirect('edit_user.php?id='.(int)$e_user['id'], false);
            redirect('detallesdocentes.php', false);
          }
    } else {
      $session->msg("d", $errors);
      //redirect('edit_user.php?id='.(int)$e_user['id'],false);
      redirect('detallesdocentes.php', false);
    }
  }
?>
<?php
// Update user password
if(isset($_POST['update-pass'])) {
  $req_fields = array('password');
  validate_fields($req_fields);
  if(empty($errors)){
           $id = (int)$e_user['id'];
     $password = remove_junk($db->escape($_POST['password']));
     $h_pass   = sha1($password);
          $sql = "UPDATE users SET password='{$h_pass}' WHERE id='{$db->escape($id)}'";
       $result = $db->query($sql);
        if($result && $db->affected_rows() === 1){
          $session->msg('s',"Se ha actualizado la contraseña del usuario. ");
          redirect('edit_docente.php?id='.(int)$e_user['id'], false);
        } else {
          $session->msg('d','No se pudo actualizar la contraseña de usuario..');
          redirect('edit_docente.php?id='.(int)$e_user['id'], false);
        }
  } else {
    $session->msg("d", $errors);
    redirect('edit_docente.php?id='.(int)$e_user['id'],false);
  }
}

?>

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    #map {
        width: 80%;
        height: 50%;
    }
    #coords{width: 100px;}
</style>
<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
    <script language="JavaScript" src="libs/js/jquery-3.3.1.min.js"></script>
</head>
<body>
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
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          Actualiza cuenta <?php echo remove_junk(ucwords($e_user['name'])); ?>
        </strong>
       </div>
       <div class="panel-body">
          <form method="post" action="edit_docente.php?id=<?php echo (int)$e_user['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="name" class="control-label">Nombres*</label>
                  <input type="name" class="form-control" name="name" value="<?php echo remove_junk(ucwords($e_user['name'])); ?>" onKeyUp="this.value=this.value.toUpperCase();" maxlength="50"/>
            </div>
            <div class="form-group">
                  <label for="name">Apellido*</label>
                  <input type="text" class="form-control" name="last-name" value="<?php echo remove_junk(ucwords($e_user['last_name'])); ?>" required onKeyUp="this.value=this.value.toUpperCase();"  maxlength="50"/>
            </div>
            <div class="form-group">
              <label for="name">Cédula*</label>
              <input type="text" class="form-control" name="cedula" id="cedula" maxlength="10" value="<?php echo remove_junk(ucwords($e_user['ci'])); ?>" onkeyup="this.value=Num(this.value)">
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
            <div class="form-group">
                  <label for="name">E-mail*</label>
                  <input type="text" class="form-control" name="e-mail" maxlength="50" value="<?php echo remove_junk(ucwords($e_user['mail'])); ?>" onKeyUp="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group">
                  <label for="name">Teléfono*</label>
                  <input type="text" class="form-control" name="telefono" maxlength="10" value="<?php echo remove_junk(ucwords($e_user['phone'])); ?>" required onkeyup="this.value=Num(this.value)" />
            </div>
            <div class="form-group">
                  <label for="name">Celular*</label>
                  <input type="text" class="form-control" name="movil" maxlength="10" value="<?php echo remove_junk(ucwords($e_user['movil'])); ?>" required onkeyup="this.value=Num(this.value)" />
            </div>
            <div class="form-group clearfix">
                    <button type="submit" name="update" class="btn btn-info">Actualizar</button>
            </div>
        </form>
       </div>
     </div>
  </div>
  <!-- Change password form -->
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          Cambiar <?php echo remove_junk(ucwords($e_user['name'])); ?> contraseña
        </strong>
      </div>
      <div class="panel-body">
        <form action="edit_user.php?id=<?php echo (int)$e_user['id'];?>" method="post" class="clearfix">
          <div class="form-group">
                <label for="password" class="control-label">Contraseña*</label>
                <input type="password" class="form-control" name="password" placeholder="Ingresa la nueva contraseña" required>
          </div>
          <div class="form-group clearfix">
                  <button type="submit" name="update-pass" class="btn btn-danger pull-right">Cambiar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

 </div>
