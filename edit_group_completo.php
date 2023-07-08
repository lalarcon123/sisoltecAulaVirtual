<?php
  $page_title = 'Editar Perfil';
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
  // Checkin What level user has permission to view this page
   
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

         $menues        = array();
         $name          = remove_junk($db->escape($_POST['group-name']));
         $level         = remove_junk($db->escape($_POST['group-level']));
         $status        = remove_junk($db->escape($_POST['status']));
         $menues        = $_POST['menu'];

         $query  = "UPDATE user_groups SET ";
         $query .= "group_name='{$name}',group_level='{$level}',estado='{$status}'";
         $query .= "WHERE ID='{$db->escape($e_group['id'])}'";
         $result = $db->query($query);
         if($result && $db->affected_rows() === 1){      
          $session->msg('s',"Grupo se ha actualizado! ");
         } else {
          //failed
          if (empty($menues)){
              $session->msg('d','Lamentablemente no se ha actualizado el grupo!');
              redirect('edit_group.php?id='.(int)$e_group['id'], false);
          }
         }

        //sucess
        if (!empty($menues)){
           $query  = "UPDATE usuario_menu SET estado =0  where grupo_id = '{$db->escape($e_group['id'])}'";
           $result = $db->query($query);
           if($result && $db->affected_rows() === 1){

           }
          foreach ($menues  as $opc) {
            $consulta = $db->query("SELECT * FROM usuario_menu WHERE det_menu_id = '{$opc}' and grupo_id = '{$db->escape($e_group['id'])}'");
            if($result1 = $db->fetch_assoc($consulta)){
                $query_menu = "UPDATE usuario_menu SET estado = 1  WHERE det_menu_id = '{$opc}'  and grupo_id = '{$db->escape($e_group['id'])}'";
                $result2 = $db->query($query_menu);
            }else{
                $query_menu = "INSERT INTO usuario_menu SELECT id_menu, det_menu_id, '{$db->escape($e_group['id'])}', 1, descripcion  FROM det_menu where det_menu_id ='{$opc}'";
                $result3 = $db->query($query_menu);
            }

          }   
        }
   } else {
     $session->msg("d", $errors);
    redirect('edit_group.php?id='.(int)$e_group['id'], false);
   }
 }
?>
<?php include_once('layouts/header_in.php'); ?>


    <!-- Main content -->
    <section class="content">
        <div class="login-page">
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
                      <select class="form-control" name="status">
                        <option <?php if($e_group['estado'] === '1') echo 'selected="selected"';?> value="1"> Activo </option>
                        <option <?php if($e_group['estado'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
                      </select>
                </div>
                <div class="form-group">
                  <label for="opciones_menu">Opciones Menú*<br><br>
                      <?php 
                            $result  = find_all_menu('menu',$user);   

                      ?>


                      <?php  foreach ($result as $row): 

                          $element = "<label>".$row['descripcion']."<br>";

                          echo $element;
                                 $resultado  = find_all_submenu_perfil('det_menu',$row['id_menu'],$db->escape($e_group['id']));
                                 foreach ($resultado as $row_detalle):

                                      if($row_detalle['estado']==1){
                                        $element_submenu = "<input type=\"checkbox\" id=\"".$row_detalle['det_menu_id']."\" name=\"menu[]\" value=\"".$row_detalle['det_menu_id']."\" checked> ".$row_detalle['descripcion']."<br>";                                      
                                      } else{
                                        $element_submenu = "<input type=\"checkbox\" id=\"".$row_detalle['det_menu_id']."\" name=\"menu[]\" value=\"".$row_detalle['det_menu_id']."\"> ".$row_detalle['descripcion']."<br>";
                                      }
                                      echo $element_submenu;
                                 endforeach;
                          $element_fin = "</label>";

                          echo $element_fin;

                        endforeach; ?>
                  </label>
                </div>
                <div class="form-group clearfix">
                        <button type="submit" name="update" class="btn btn-info">Actualizar</button>
                </div>
            </form>
        </div>

  </section>
<?php include_once('layouts/footer.php'); ?>
