<?php
  $id = (int)$_GET['id'];
  $page_title = 'Editar Foto Docente';
  require_once('includes/load.php');
  $e_user = find_by_id('users',$id);
  //$user = $_SESSION['user_id'];
?>
<?php include_once('layouts/header.php'); ?>
<?php
//update user image
  if(isset($_POST['submit'])) {
  $photo = new Media();
  
  $user_id = remove_junk($db->escape($_POST['user_id']));
  $photo->upload($_FILES['file_upload']);
  if($photo->process_user($user_id)){
    $session->msg('s','La foto fue subida al servidor.');
    $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('users', ".$id.",'Actualiza Foto Docente')";
    $result_aud = $db->query($query_aud);
    if($result_aud && $db->affected_rows() === 1){
        redirect('detallesdocentes.php');}
    } else{
      $session->msg('d',join($photo->errors));
      redirect('detallesdocentes.php');
    }     
  }
if(isset($_POST['regresar'])) {
        redirect('detallesdocentes.php', false);
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
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-heading clearfix">
            <span class="glyphicon glyphicon-camera"></span>
            <span>Cambiar foto Docente</span>
          </div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
                <img class="img-circle img-size-2" src="uploads/users/<?php echo $e_user['image'];?>" alt="">
            </div>
            <div class="col-md-8">
              <form class="form" action="edit_accountdocente.php?id=<?php echo $id ?>"  method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <input type="file" name="file_upload" multiple="multiple" class="btn btn-default btn-file" />
              </div>
              <div class="form-group">
                 <input type="hidden" name="user_id" value="<?php echo (int)$e_user['id'];?>">
                 <button type="submit" name="submit" class="btn btn-primary">Cambiar</button>
                 <form method="post" action="regresar"><button type="submit" name="regresar" class="btn btn-danger">Regresar</button></form>
              </div>
             </form>
            </div>
          </div>
        </div>
      </div>
  </div>

</div>


<?php include_once('layouts/footer.php'); ?>
