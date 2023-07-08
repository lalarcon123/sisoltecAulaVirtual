<?php
  $page_title = 'Mi perfil';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>
  <?php
  $id = (int)$_GET['id'];
  if(empty($id)):
    redirect('home.php',false);
  else:
    $user_p = find_by_id('users',$id);
  endif;
?>
<?php //include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-4">
       <div class="panel profile">
         <div class="jumbotron text-center bg-red">
            <img class="img-circle img-size-2" src="uploads/users/<?php echo $user_p['image'];?>" alt="">
           <h3><?php echo first_character($user_p['name']); ?></h3>
         </div>
        <?php if( (int)$user_p['id'] === (int)$id):?>
         <ul class="nav nav-pills nav-stacked">
          <li><a href="edit_account.php?id=<?php echo (int)$id ?>"> <i class="glyphicon glyphicon-edit"></i> Editar perfil</a></li>
         </ul>
       <?php endif;?>
       </div>
   </div>
</div>
<?php //include_once('layouts/footer.php'); ?>
