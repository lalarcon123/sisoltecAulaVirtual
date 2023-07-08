<?php
  $id               = (int)$_GET['id'];
  $id_curso         = (int)$_GET['id_curso'];
  //echo $id;
  $page_title = 'Preguntas Evaluación';
  require_once('includes/load.php');
  //$all_tipo_material = find_all('tipo_material');
  $nombre_curso =find_by_id_descripcion('curso', $id_curso);
  $descripcion  =find_by_id('contenido_curso', $id);
  $user = $_SESSION['user_id'];
?>

<?php

if(isset($_POST['evaluacion_preguntas'])) {

    $req_fields = array('id',
                        'pregunta');

    validate_fields($req_fields);

    if (empty($errors)) {

        $id                  = remove_junk($db->escape($_POST['id']));
        $numero_pregunta     = find_by_numero_pregunta('evaluacion_preguntas',$id);
        $ev_contenido_c      = find_by_id('contenido_curso', $id);
        $cantidad_preguntas  = $ev_contenido_c['cantidad_preguntas'];
        if ($cantidad_preguntas===$numero_pregunta['cantidad'])
        {
            $session->msg('d', ' Usted ha completado el numero de preguntas permitido');
            redirect('edit_evaluacion_preguntas.php?id='.$id.'&id_curso='.$id_curso, false);    
        }
        $numero              = $numero_pregunta['cantidad']+1;
        $pregunta            = remove_junk($db->escape($_POST['pregunta']));
        
        $query = "INSERT INTO  evaluacion_preguntas (id_evaluacion, numero_pregunta, pregunta) VALUES (";
        $query .= " '{$id}', '{$numero}', '{$pregunta}'";
        $query .= ")";
        if ($db->query($query)) {
            $session->msg('s', "Pregunta agregada exitosamente. ");
            $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('evaluacion_preguntas', ".$user.",'Ingreso')";
            $result_aud = $db->query($query_aud);
            if($result_aud && $db->affected_rows() === 1){
                redirect('edit_evaluacion_preguntas.php?id='.$id.'&id_curso='.$id_curso, false);
            }
        } else {
            $session->msg('d', ' Lo siento, registro falló.');
            redirect('edit_evaluacion_preguntas.php?id='.$id.'&id_curso='.$id_curso, false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('edit_evaluacion_preguntas.php?id='.$id.'&id_curso='.$id_curso, false);
    }
}
if(isset($_POST['regresar'])) {
        redirect('edit_curso_evaluacion.php?id='.$id_curso, false);
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
    function Num(string){//solo letras y numeros
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
</div>

<div id="Home" class="tabcontent">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Agregar Preguntas de la Evaluación <?php echo remove_junk(ucwords($descripcion['descripcion'])); ?> del curso <?php echo remove_junk(ucwords($nombre_curso['descripcion'])); ?></span>
                    </strong>
                </div>
                <div class="panel-body">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form method="post" action="edit_evaluacion_preguntas.php?id=<?php echo $id ?>&id_curso=<?php echo $id_curso ?>" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
                                <input type="hidden" name="id_curso" id="id_curso" value="<?php echo $id_curso;?>">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="qty">Pregunta*</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                                <textarea class="form-control" name="pregunta"  id="pregunta" rows="2" cols="500" placeholder="Pregunta" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div><button type="submit" name="evaluacion_preguntas" class="btn btn-primary">Cargar Pregunta</button><form method="post" action="regresar"><button type="submit" name="regresar" class="btn btn-danger">Regresar</button></form></div>
                                <div class="x_content">
                                    <table id="Dt_detallepreguntas" class="table table-bordered table-hover" cellpadding="0" width="100%">
                                        <thead>
                                        <tr>
                                            <!--<th>id</th>-->
                                            <th># Pregunta</th>
                                            <th>Pregunta</th>
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
            detallepreguntas();
        });
        var detallepreguntas = function(){
            var id          = <?php echo $id;?>;
            var table =$("#Dt_detallepreguntas").DataTable({
                "destroy":true,
                "ajax":{
                    "method":"POST",
                    "url":"ajax/ListadoCursoEvaluacionPreguntas.php?id="+id,
                   error: function (result){
                     null;
                   }
                },
                "columns":[
                    //{"data":"id"},
                    {"data":"numero_pregunta"},
                    {"data":"pregunta"},
                    {"data":"estado"},                    
                    {"defaultContent":"<button type='button'  class='respuestas btn btn-xs btn-info' onclick='ingresar_respuestas();' title='Respuestas'> <span class='glyphicon glyphicon-pencil'></span></button><button type='button'  class='activar btn btn-xs btn-primary' onclick='activar_preguntas();' title='Activar'><span class='glyphicon glyphicon-check'></span></button><button type='button'  class='eliminar btn btn-xs btn-danger' onclick='eliminar_preguntas();' title='Inactivar'><span class='glyphicon glyphicon-remove'></span></button>"}
                ],
                "language": idioma_espanol
            });
            activar_preguntas("#Dt_detallepreguntas tbody",table);
            eliminar_preguntas("#Dt_detallepreguntas tbody",table);
            ingresar_respuestas("#Dt_detallepreguntas tbody",table);
        }

        var activar_preguntas = function(tbody,table) {
           $(tbody).on("click","button.activar",function() {
                var data            = table.row( $(this).parents("tr")).data();
                var id              = data.id;
                var id_curso        = <?php echo $id_curso;?>;
                var id_evaluacion   = data.id_evaluacion;
                window.location.href="activapregunta.php?id="+id+"&id_curso="+id_curso+"&id_evaluacion="+id_evaluacion;
            });
        }

        var eliminar_preguntas = function(tbody,table) {
           $(tbody).on("click","button.eliminar",function() {
                var data            = table.row( $(this).parents("tr")).data();
                var id              = data.id;
                var id_curso        = <?php echo $id_curso;?>;
                var id_evaluacion   = data.id_evaluacion;
                window.location.href="deletepregunta.php?id="+id+"&id_curso="+id_curso+"&id_evaluacion="+id_evaluacion;
            });
        }
        var ingresar_respuestas = function(tbody,table) {
           $(tbody).on("click","button.respuestas",function() {
                var data            = table.row( $(this).parents("tr")).data();
                var id              = data.id;
                var id_curso        = <?php echo $id_curso;?>;
                var id_evaluacion   = <?php echo $id;?>;
                window.location.href="edit_evaluacion_respuestas.php?id="+id+"&id_curso="+id_curso+"&id_evaluacion="+id_evaluacion;
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
