<?php
  $id         = (int)$_GET['id'];
  $id_curso   = (int)$_GET['id_curso'];
  $id_docente = (int)$_GET['id_docente'];
  $page_title = 'Duplicar';
  require_once('includes/load.php');
  $nombre_curso =find_by_id_descripcion('curso', $id);
  $user = $_SESSION['user_id'];
  $all_cursos = find_all_curso_oferta('curso_oferta',$id, $id_curso,$id_docente);
?>

<?php

if(isset($_POST['duplicar'])) {//5
            $req_fields = array('id_curso_oferta');

            validate_fields($req_fields);

            if (empty($errors)) {//4
                $id           = remove_junk($db->escape($_POST['id']));
                $id_curso     = remove_junk($db->escape($_POST['id_curso_oferta']));
                $queryvalidacion = "select count(*) cantidad from material_curso where id_curso_oferta = ".$id;
                $all_material = find_by_sql($queryvalidacion);
                foreach ($all_material as $material){
                    if ($material['cantidad']==0){
                            $query = "insert into material_curso (id_curso_oferta, id_tipo_material, descripcion, enlace, documento, estado, id_docente) select ".$id.", id_tipo_material, descripcion, enlace, documento, estado, id_docente from material_curso where id_curso_oferta = ".$id_curso." and estado =1";
                            if ($db->query($query)) {//2
                                $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('material_curso', ".$user.",'Ingreso')";
                                $result_aud = $db->query($query_aud);
                                if($result_aud && $db->affected_rows() === 1){//1

                                    $sql =  "SELECT * FROM capitulos_curso where id_curso = ".$id_curso." and estado = 1"; 
                                    $all_capitulo = find_by_sql($sql);
                                    foreach ($all_capitulo as $results)
                                    {
                                       $query = "insert into capitulos_curso (id_curso, descripcion, objetivo, duracion, estado) values (".$id.",
                                                   '".$results['descripcion']."',
                                                   '".$results['objetivo']."',
                                                   '".$results['duracion']."',
                                                   ".$results['estado'].")";
                                       if ($db->query($query)) {
                                          $sqlcontenido = "select * from contenido_capitulo where id_capitulo = ".$results['id']." and estado = 1";
                                          $all_contenido = find_by_sql($sqlcontenido);
                                          foreach ($all_contenido as $resultscontenido) {
                                              $querycontenido = "insert into contenido_capitulo (id_curso, id_capitulo, descripcion, objetivo, duracion, multimedia, tema, estado) values (
                                                  ".$id.",
                                                  (select id from capitulos_curso where id_curso = ".$id." and descripcion ='".$results['descripcion']."'
                                                                                    and objetivo = '".$results['objetivo']."'
                                                                                    and duracion = '".$results['duracion']."'
                                                                                    and estado = ".$results['estado']."),
                                                  '".$resultscontenido['descripcion']."',
                                                  '".$resultscontenido['objetivo']."',
                                                  '".$resultscontenido['duracion']."',
                                                  '".$resultscontenido['multimedia']."',
                                                  '".$resultscontenido['tema']."',
                                                   ".$resultscontenido['estado'].")";
                                              if ($db->query($querycontenido)) {
                                                 $session->msg('s', "Curso duplicado exitosamente ");
                                              }
                                          }
                                       }
                                    }
                                    redirect('detallescursoofertaAdm.php', false);
                        } //1

                    }//2 
                    else {
                        $session->msg('d', ' Lo siento, registro falló.');
                        redirect('edit_duplicar.php?id='.$id.'&id_curso='.$id_curso.'&id_docente='.$id_docente, false);
                    }
                 }else{
                    //$session->msg('d', $id."Curso ya contiene Bibliografía y Capítulos".$material['cantidad']);
                    $session->msg('d', "Curso ya contiene Bibliografía y Capítulos");
                    redirect('detallescursoofertaAdm.php', false);
                 }    

                }

    }//4 
    else {
        $session->msg("d", $errors);
        redirect('edit_duplicar.php?id='.$id.'&id_curso='.$id_curso.'&id_docente='.$id_docente, false);
    }

}//5
if(isset($_POST['regresar'])) {
        redirect('detallescursoofertaAdm.php', false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- Datatables -->
    <link href="css/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="css/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="css/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="css/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="css/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="css/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

    <!-- bootstrap-daterangepicker -->
    <link href="css/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.min.css" rel="stylesheet">

    <!-- MICSS button[type="file"] -->
    <link rel="stylesheet" href="css/micss.css">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


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
</script>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Agregar Capitulos y Bibliografía <?php echo remove_junk(ucwords($nombre_curso['descripcion'])); ?></span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="panel-body">
                    <div class="col-md-12">
                        <form method="post" action="edit_duplicar.php?id=<?php echo $id ?>&id_curso=<?php echo $id_curso?>&id_docente=<?php echo $id_docente?>" enctype="multipart/form-data">
                          <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
                          <div class="row">
                              <div class="col-md-5">
                                  <div class="form-group">
                                      <label for="qty">Curso Oferta*</label>
                                      <div class="input-group">
                                      <span class="input-group-addon">
                                          <i class="glyphicon glyphicon-th-large"></i>
                                      </span>
                                          <select class="form-control"  style="height:2.6em;" name="id_curso_oferta">
                                              <option value="">Selecciona Curso Oferta</option>
                                              <?php  foreach ($all_cursos as $curso_oferta): ?>
                                                  <option value="<?php echo (int)$curso_oferta['id']; ?>">
                                                      <?php echo remove_junk($curso_oferta['descripcion']); ?>
                                                  </option>
                                              <?php endforeach; ?>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          </div>

                            <div><button type="submit" name="duplicar" class="btn btn-primary">Cargar Capítulos y  Bibliografía</button><form method="post" action="regresar"><button type="submit" name="regresar" class="btn btn-danger">Regresar</button></form></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>
</html>
    <!-- jQuery -->
    <script src="js/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="css/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="js/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="css/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="css/iCheck/icheck.min.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="css/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>



    <!-- Datatables-->

    <script src="js/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="css/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="js/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="css/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="js/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="js/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="js/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="js/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="js/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="js/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="css/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="js/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="js/jszip/dist/jszip.min.js"></script>
    <script src="js/pdfmake/build/pdfmake.min.js"></script>
    <script src="js/pdfmake/build/vfs_fonts.js"></script>

    <!-- DateJS -->
    <script src="js/moment/min/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>


<?php if(isset($db)) { $db->db_disconnect(); } ?>
