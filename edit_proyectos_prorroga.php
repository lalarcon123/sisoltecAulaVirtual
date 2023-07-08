<?php
  $id         = (int)$_GET['id'];
  $nombre     = $_GET['nombre'];
  $page_title = 'Proyecto Prorroga';
  require_once('includes/load.php');
   
  $all_trabajadores = find_all_trabajadores('users');

  $user = $_SESSION['user_id'];
?>

<?php
if(isset($_POST['proyecto_prorroga'])) {

    $req_fields = array('id_proyecto',
                        'id_user');
    validate_fields($req_fields);

    if (empty($errors)) {

        $proyecto            = remove_junk($db->escape($_POST['id_proyecto']));
        $trabajador          = remove_junk($db->escape($_POST['id_user']));

        $query = "INSERT  proyecto_prorroga (id_proyecto, id_user) VALUES (";
        $query .= " '{$proyecto}','{$trabajador}'";
        $query .= ")";
        if ($db->query($query)) {
            $session->msg('s', "Recurso agregado exitosamente. ");
            redirect('edit_proyectos_recursos.php?id='.$id.'&descripcion='.$descripcion, false);
        } else {
            $session->msg('d', ' Lo siento, registro falló.');
            redirect('edit_proyectos_recursos.php?id='.$id.'&descripcion='.$descripcion, false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('edit_proyectos_recursos.php?id='.$id.'&descripcion='.$descripcion, false);
    }

}

if(isset($_POST['regresar'])) {
        redirect('detallesproyectosprorroga.php', false);
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
  <section class="content">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Prorroga de Proyecto <?php echo $nombre ?></span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="panel-body">
                    <div class="col-md-12">
                        <form method="post" action="edit_proyectos_prorroga.php?id=<?php echo $id ?>&nombre=<?php echo $nombre ?>" enctype="multipart/form-data">
                            <input type="hidden" name="id_proyecto" id="id_proyecto" value="<?php echo $id;?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo $nombre;?>">

                            <div><form method="post" action="regresar"><button type="submit" name="regresar" class="btn btn-danger">Regresar</button></form></div>
                            <?php
                                //include("modal/upd_tarea.php");
                            ?>
                            <div class="x_content">
                                <table id="Dt_detallerecursosproyecto" class="table table-bordered table-hover" cellpadding="0" width="100%">
                                    <thead>
                                    <tr>
                                        <!--<th>id</th>-->
                                        <th>Fecha Fin Anterior</th>
                                        <th>Fecha Fin</th>
                                        <th>Documento Prorroga</th>
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
  </section>
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
            var id  = $("#id_proyecto").val();//<?php //echo $id;?>;
            //alert(id);
            var table =$("#Dt_detallerecursosproyecto").DataTable({
                "responsive":true,
                "destroy":true,
                "ajax":{
                    "method":"POST",
                    "url":"ajax/ListadoProrrogaProyectos.php?id="+id,
                   error: function (result){
                     null;
                   }
                },
                "columns":[
                    //{"data":"id"},
                    {"data":"fecha_fin_anterior"},
                    {"data":"fecha_fin"},
                    {"defaultContent":"<button type='button'  class='descargar btn btn-xs btn-info' onclick='descargar_archivo();' title='Descargar Documento Prorroga'><i class='fa fa-pencil-square-o'></i>Documento de Prorroga <span class='glyphicon glyphicon-download-alt'></span></button>"},
                    {"data":"estado"},
                    {"defaultContent":"<button type='button'  class='eliminar btn btn-xs btn-danger' onclick='rechazaprorroga();' title='Inactivar'><i class='fa fa-pencil-square-o'></i> <span class='glyphicon glyphicon-remove'></span></button><button type='button'  class='activar btn btn-xs btn-primary' onclick='apruebaprorroga();' title='Activar'><i class='fa fa-pencil-square-o'></i><span class='glyphicon glyphicon-ok'></span></button>"}
                ],
                "language": idioma_espanol
            });
            rechazaprorroga("#Dt_detallerecursosproyecto tbody",table);
            descargar_archivo("#Dt_detallerecursosproyecto tbody",table);
            apruebaprorroga("#Dt_detallerecursosproyecto tbody",table);
        }

        var descargar_archivo = function(tbody,table) {
            $(tbody).on("click","button.descargar",function() {
                var data = table.row( $(this).parents("tr")).data();
                var archivo = data.archivo;
                var myWindow = window.open(archivo, "SISOLTEC", "width=500,height=500");
            });
        }

        var rechazaprorroga = function(tbody,table) {
           $(tbody).on("click","button.eliminar",function() {
                var data               = table.row( $(this).parents("tr")).data();
                var id                 = data.id;
                var id_proyecto        = data.id_proyecto;
                var nombre             = data.nombre;
                var fecha_fin_anterior = data.fecha_fin_anterior;
                window.location.href="rechazaprorroga.php?id="+id+"&id_proyecto="+id_proyecto+"&nombre="+nombre+"&fecha_fin_anterior="+fecha_fin_anterior;
            });
        }
        var apruebaprorroga = function(tbody,table) {
           $(tbody).on("click","button.activar",function() {
                var data               = table.row( $(this).parents("tr")).data();
                var id                 = data.id;
                var id_proyecto        = data.id_proyecto;
                var nombre             = data.nombre;
                var fecha_fin          = data.fecha_fin;
                window.location.href="apruebaprorroga.php?id="+id+"&id_proyecto="+id_proyecto+"&nombre="+nombre+"&fecha_fin="+fecha_fin;
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
