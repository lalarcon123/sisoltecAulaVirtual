<?php
  $id               = (int)$_GET['id'];
  //$id_capitulo      = (int)$_GET['id_capitulo'];
  //echo "codigo curso".$id;
  //$id_docente = (int)$_GET['id_docente'];
  //echo "codigo docente".$id_docente;
  $page_title = 'Capítulos Curso';
  require_once('includes/load.php');
  //$all_tipo_material = find_all('tipo_material');
  $nombre_curso =find_by_id_descripcion('curso', $id);
  $user = $_SESSION['user_id'];
?>

<?php

if(isset($_POST['curso_capitulo'])) {

    $req_fields = array('descripcion',
                        'objetivo',
                        'duracion');

    validate_fields($req_fields);

    if (empty($errors)) {

        $id_curso     = remove_junk($db->escape($_POST['id_curso']));
        $descripcion  = remove_junk($db->escape($_POST['descripcion']));
        $objetivo     = remove_junk($db->escape($_POST['objetivo']));
        $duracion     = remove_junk($db->escape($_POST['duracion']));

        $query = "INSERT INTO  capitulos_curso (id_curso, descripcion, objetivo, duracion) VALUES (";
        $query .= " '{$id_curso}', '{$descripcion}', '{$objetivo}','{$duracion}'";
        $query .= ")";
        if ($db->query($query)) {
            $session->msg('s', "Capítulo agregado exitosamente. ");
            $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('capitulos_curso', ".$user.",'Ingreso')";
            $result_aud = $db->query($query_aud);
            if($result_aud && $db->affected_rows() === 1){
                redirect('edit_curso_capitulos.php?id='.$id_curso, false);
            }
        } else {
            $session->msg('d', ' Lo siento, registro falló.');
            redirect('edit_curso_capitulos.php?id='.$id_curso, false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('edit_curso_capitulos.php?id='.$id_curso, false);
    }
}
if(isset($_POST['regresar'])) {
        redirect('detallescursooferta.php', false);
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

<div id="Home" class="tabcontent">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Agregar Capítulo <?php echo remove_junk(ucwords($nombre_curso['descripcion'])); ?></span>
                    </strong>
                </div>
                <div class="panel-body">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form method="post" action="edit_curso_capitulos.php?id=<?php echo $id ?>" enctype="multipart/form-data">
                                <input type="hidden" name="id_curso" id="id_curso" value="<?php echo $id;?>">
                                <div class="row">
                                    <div class="col-md-8">
                                       <div class="form-group"> 
                                            <label for="qty">Descripción<span class="required">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                                <textarea class="form-control" name="descripcion"  id="descripcion" rows="2" cols="80" placeholder="Descripción" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="qty">Objetivo*</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                                <textarea class="form-control" name="objetivo"  id="objetivo" rows="2" cols="500" placeholder="Objetivo" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="qty">Duración*</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                                <input type="text" class="form-control" name="duracion" id="duracion" value="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div><button type="submit" name="curso_capitulo" class="btn btn-primary">Cargar Capítulo</button>
                                    <form method="post" action="regresar"><button type="submit" name="regresar" class="btn btn-danger">Regresar</button></form>
                                </div>
                                <div class="x_content">
                                    <table id="Dt_detallecapitulo" class="table table-bordered table-hover" cellpadding="0" width="100%">
                                        <thead>
                                        <tr>
                                            <!--<th>id</th>-->
                                            <th>Descripción</th>
                                            <th>Objetivo</th>
                                            <th>Duración</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div><div><iframe src="detallesmaterialcapitulo.php?id=<?php echo $id_capitulo ?>" width="100%" height="300px" frameborder="0" allowtransparency="true" style="background-color: white"></iframe></div></div>-->

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

    <script>
        $(document).on("ready",function(){
            detallecapitulo();
        });
        var detallecapitulo = function(){
            var id          = <?php echo $id;?>;
            var table =$("#Dt_detallecapitulo").DataTable({
                "destroy":true,
                "ajax":{
                    "method":"POST",
                    "url":"ajax/ListadoCursoCapitulo.php?id="+id,
                   error: function (result){
                     null;
                   }
                },
                "columns":[
                    //{"data":"id"},
                    {"data":"descripcion"},
                    {"data":"objetivo"},
                    {"data":"duracion"},
                    {"data":"estado"},                    
                    {"defaultContent":"<button type='button'  class='contenido btn btn-xs btn-info' onclick='ingresar_contenido();' title='Contenido'><span class='glyphicon glyphicon-inbox'></span></button><button type='button'  class='activar btn btn-xs btn-primary' onclick='activar_capitulo();' title='Activar'> <span class='glyphicon glyphicon-check'></span></button><button type='button'  class='eliminar btn btn-xs btn-danger' onclick='eliminar_capitulo();' title='Inactivar'><span class='glyphicon glyphicon-remove'></span></button>"}
                ],
                "language": idioma_espanol
            });
            ingresar_contenido("#Dt_detallecapitulo tbody",table);
            eliminar_capitulo("#Dt_detallecapitulo tbody",table);
            activar_capitulo("#Dt_detallecapitulo tbody",table);
        }

        var activar_capitulo = function(tbody,table) {
           $(tbody).on("click","button.activar",function() {
                var data            = table.row( $(this).parents("tr")).data();
                var id              = data.id;
                var id_curso        = data.id_curso;
                window.location.href="activacapitulo.php?id="+id+"&id_curso="+id_curso;
            });
        }
        var eliminar_capitulo = function(tbody,table) {
           $(tbody).on("click","button.eliminar",function() {
                var data            = table.row( $(this).parents("tr")).data();
                var id              = data.id;
                var id_curso        = data.id_curso;
                window.location.href="deletecapitulo.php?id="+id+"&id_curso="+id_curso;
            });
        }

        var ingresar_contenido = function(tbody,table) {
           $(tbody).on("click","button.contenido",function() {
                var data            = table.row( $(this).parents("tr")).data();
                var id              = data.id;
                var id_curso        = data.id_curso;
                window.location.href="edit_capitulos_contenido.php?id="+id+"&id_curso="+id_curso;
            });
        }

        var idioma_espanol = {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    </script>
<?php if(isset($db)) { $db->db_disconnect(); } ?>
