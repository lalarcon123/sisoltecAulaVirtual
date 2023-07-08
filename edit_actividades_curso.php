<?php
  $id      = (int)$_GET['id'];
  $page_title = 'Actividades Curso';
  require_once('includes/load.php');
  $nombre_curso =find_by_id_descripcion('curso', $id);
  $descripcion_curso = "";
  if (!empty($nombre_curso)){
     $descripcion_curso = $nombre_curso['descripcion'];
  }
  $user = $_SESSION['user_id'];
?>

<?php

if(isset($_POST['actividades_curso'])) {
    $documento_respaldo = $_FILES['name-foto']['name'];
    $ruta = $_FILES['name-foto']['tmp_name'];
    $destino = "uploads/img/" . $documento_respaldo;

    if ($documento_respaldo != "") {
        if (copy($ruta, $destino)) {

    $req_fields = array('id_curso_oferta',
                        'descripcion',
                        'fecha_maxima',
                        'calificable');

    validate_fields($req_fields);

    if (empty($errors)) {

        $id_curso_oferta     = remove_junk($db->escape($_POST['id_curso_oferta']));
        $descripcion         = remove_junk($db->escape($_POST['descripcion']));
        $fecha_maxima        = remove_junk($db->escape($_POST['fecha_maxima']));
        $calificable         = remove_junk($db->escape($_POST['calificable']));

        $query = "INSERT  actividades_curso (id_curso_oferta, descripcion, fecha_maxima, calificable, documento) VALUES (";
        $query .= " '{$id_curso_oferta}', '{$descripcion}','{$fecha_maxima}', '{$calificable}', '{$destino}'";
        $query .= ")";
        if ($db->query($query)) {
            $session->msg('s', "Material agregado exitosamente. ");
            $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('actividades_curso', ".$user.",'Ingreso')";
            $result_aud = $db->query($query_aud);
            if($result_aud && $db->affected_rows() === 1){
                redirect('edit_actividades_curso.php?id='.$id_curso_oferta, false);
            }
        } else {
            $session->msg('d', ' Lo siento, registro falló.');
            redirect('edit_actividades_curso.php?id='.$id_curso_oferta, false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('edit_actividades_curso.php?id='.$id_curso_oferta, false);
    }
}
}}

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

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Agregar Actividades <?php echo $descripcion_curso ?></span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="panel-body">
                    <div class="col-md-12">
                        <form method="post" action="edit_actividades_curso.php?id=<?php echo $id ?>" enctype="multipart/form-data">
                            <input type="hidden" name="id_curso_oferta" id="id_curso_oferta" value="<?php echo $id;?>">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="qty">Descripción*</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                            <!--<input type="text" class="form-control" name="descripcion" id="descripcion" value="" />-->
                                            <textarea class="form-control" name="descripcion"  id="descripcion" rows="4" cols="80" placeholder="Descripción" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="qty">Fecha Máxima*</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                            <input type="date" class="form-control" name="fecha_maxima" id="fecha_maxima" value="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="qty">Calificable*</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                                <select class="form-control" name="calificable" id="calificable" required>
                                                    <option value="SI"> SI</option>
                                                    <option value="NO"> NO</option>  
                                                </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="qty">Documento*</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                            <input type="file" class="form-control" name="name-foto" value="" >
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div><button type="submit" name="actividades_curso" class="btn btn-primary">Cargar Actividades</button><form method="post" action="regresar"><button type="submit" name="regresar" class="btn btn-danger">Regresar</button></form></div>
                            <div class="x_content">
                                <table id="Dt_detalleactividades" class="table table-bordered table-hover" cellpadding="0" width="100%">
                                    <thead>
                                    <tr>
                                        <!--<th>id</th>-->
                                        <th>Descripción</th>
                                        <th>Fecha Máxima</th>
                                        <th>Calificable</th>
                                        <th>Estado</th>
                                        <th>Eliminar</th>
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
            detalleactividades();
        });
        var detalleactividades = function(){
            var id          = <?php echo $id;?>;
            var table =$("#Dt_detalleactividades").DataTable({
                "destroy":true,
                "ajax":{
                    "method":"POST",
                    "url":"ajax/ListadoCursoActividades.php?id="+id,
                   error: function (result){
                     null;
                   }
                },
                "columns":[
                    //{"data":"id"},
                    {"data":"descripcion"},
                    {"data":"fecha_maxima"},
                    {"data":"calificable"},
                    {"data":"estado"},
                    {"defaultContent":"<button type='button'  class='descargar btn btn-xs btn-info' onclick='descargar_archivo();' title='Descargar'><span class='glyphicon glyphicon-cloud-download'></span></button><button type='button'  class='activar btn btn-xs btn-primary' onclick='activar_material();' title='Activar'><span class='glyphicon glyphicon-check'></span></button><button type='button'  class='eliminar btn btn-xs btn-danger' onclick='eliminar_material();' title='Inactivar'> <span class='glyphicon glyphicon-remove'></span></button>"}
                ],
                "language": idioma_espanol
            });
            descargar_archivo("#Dt_detalleactividades tbody",table);
            eliminar_material("#Dt_detalleactividades tbody",table);
            activar_material("#Dt_detalleactividades tbody",table);
        }
        var descargar_archivo = function(tbody,table) {
            $(tbody).on("click","button.descargar",function() {
                var data = table.row( $(this).parents("tr")).data();
                var imagen = data.documento;
                var myWindow = window.open(imagen, "Sistema Sisoltec Aula Virtual", "width=500,height=500");
            });
        }
        var eliminar_material = function(tbody,table) {
           $(tbody).on("click","button.eliminar",function() {
                var data            = table.row( $(this).parents("tr")).data();
                var id              = data.id;
                var id_curso        = data.id_curso_oferta;
                //alert(id+" "+id_curso);
                window.location.href="deleteactividades.php?id="+id+"&id_curso="+id_curso;
            });
        }
        var activar_material = function(tbody,table) {
           $(tbody).on("click","button.activar",function() {
                var data            = table.row( $(this).parents("tr")).data();
                var id              = data.id;
                var id_curso        = data.id_curso_oferta;
                //alert(id+" "+id_curso);
                window.location.href="activaactividades.php?id="+id+"&id_curso="+id_curso;
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
