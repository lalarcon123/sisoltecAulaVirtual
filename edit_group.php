<?php
  $page_title = 'Editar Perfil';
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
?>
<?php
  $e_group = find_by_id('user_groups',(int)$_GET['id']);
  if(!$e_group){
    $session->msg("d","Missing Group id.");
    redirect('group.php');
  }
?>
<?php
  if(isset($_POST['update'])){

   $req_fields = array('group-name','group-level');
   validate_fields($req_fields);
   if(empty($errors)){
         $name = remove_junk($db->escape($_POST['group-name']));
         $level = remove_junk($db->escape($_POST['group-level']));
         $estado = remove_junk($db->escape($_POST['estado']));

         $query  = "UPDATE user_groups SET ";
         $query .= "group_name='{$name}',group_level='{$level}',estado='{$estado}'";
         $query .= "WHERE ID='{$db->escape($e_group['id'])}'";
         $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
          //sucess
          $session->msg('s',"Grupo se ha actualizado! ");

          if($result_aud && $db->affected_rows() === 1){
            redirect('edit_group.php?id='.(int)$e_group['id'], false);
          }
        } else {
          //failed
          $session->msg('d','Lamentablemente no se ha actualizado el grupo!');
          redirect('edit_group.php?id='.(int)$e_group['id'], false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('edit_group.php?id='.(int)$e_group['id'], false);
   }
 }
?>
<?php include_once('layouts/header_in.php'); ?>
<div class="login-page">
    <section class="content">
    <div class="text-center">
       <h3>Editar Perfil</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="edit_group.php?id=<?php echo (int)$e_group['id'];?>" class="clearfix">
        <div class="form-group">
              <label for="name" class="control-label">Nombre del Perfil*</label>
              <input type="name" class="form-control" name="group-name" value="<?php echo remove_junk(ucwords($e_group['group_name'])); ?>">
        </div>
        <div class="form-group">
              <label for="level" class="control-label">Nivel del Perfil*</label>
              <select class="form-control" name="group-level">
                <option value="1" <?php if($e_group['group_level'] === '1'): echo "selected"; endif;?> > 1 </option>
                <option value="2" <?php if($e_group['group_level'] === '2'): echo "selected"; endif;?> > 2 </option>
                <option value="3" <?php if($e_group['group_level'] === '3'): echo "selected"; endif;?> > 3 </option>
              </select>
              <!--<input type="number" class="form-control" name="group-level" value="<?php //echo (int)$e_group['group_level']; ?>">-->
        </div>
        <div class="form-group">
          <label for="status">Estado*</label>
              <select class="form-control" name="estado">
                <option <?php if($e_group['estado'] === '1') echo 'selected="selected"';?> value="1"> Activo </option>
                <option <?php if($e_group['estado'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
              </select>
        </div>
        <div class="form-group clearfix">
                <button type="submit" name="update" class="btn btn-info">Actualizar</button>
        </div>
    </form>
  </section>
</div>

<?php include_once('layouts/footer.php'); ?>
