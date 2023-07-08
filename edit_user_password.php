<?php
  $page_title = 'Editar Usuario';
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
  // Checkin What level user has permission to view this page
    
?>
<?php
  $e_user = find_by_id('users',(int)$_GET['id']);
  $groups  = find_all('user_groups');
  if(!$e_user){
    $session->msg("d","Missing user id.");
    redirect('detallesusuarios.php');
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
          //redirect('edit_user_password.php?id='.(int)$e_user['id'], false);
          redirect('detallesusuarios.php', false);
        } else {
          $session->msg('d','No se pudo actualizar la contraseña de usuario..');
          //redirect('edit_user_password.php?id='.(int)$e_user['id'], false);
          redirect('detallesusuarios.php', false);
        }
  } else {
    $session->msg("d", $errors);
    //redirect('edit_user_password.php?id='.(int)$e_user['id'],false);
    redirect('detallesusuarios.php', false);
  }
}

if(isset($_POST['regresar'])) {
        redirect('detallesusuarios.php', false);
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
<!--
<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
    <script language="JavaScript" src="libs/js/jquery-3.3.1.min.js"></script>
</head>-->
<body>
<?php include_once('layouts/header_in.php'); ?>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <!--<div class="row">-->
          <div class="col-lg-4 col-6">
            <div class="text-center">
               <h3>Cambiar de contraseña</h3>
             </div>
             <?php echo display_msg($msg); ?>
          </div>
        <!--</div>-->
        <!--<div class="row">-->
              <form action="edit_user_password.php?id=<?php echo (int)$e_user['id'];?>" method="post" class="clearfix">
                  <div class="col-lg-4 col-6">
                   <!-- <div class="form-group">-->
                          <label for="password" class="control-label">Contraseña*</label>
                          <input type="password" class="form-control" name="password" placeholder="Ingresa la nueva contraseña">
                    <!--</div>-->
                  </div>
                  <br>
                  <div class="col-lg-4 col-6">
                    <!-- <div class="form-group">-->
                            <button type="submit" name="update-pass" class="btn btn-primary pull-left">Cambiar</button><form method="post" action="regresar"><button type="submit" name="regresar" class="btn btn-danger">Regresar</button></form>
                    <!--</div>-->
                  </div>
            </form>
        <!--</div>-->
     </div>
</section>
<!--<?php //include_once('layouts/footer.php'); ?>-->
