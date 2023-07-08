<?php
  $id               = (int)$_GET['id'];
  require_once('includes/load.php');
  $finalizar = promedio ($id);
  
  redirect('detallescursooferta.php', false);
if(isset($db)) { $db->db_disconnect(); } ?>
