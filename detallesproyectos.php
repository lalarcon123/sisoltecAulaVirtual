<?php
    require_once('includes/load.php');
    $title ="Proyectos";
    $id_user = $_SESSION['user_id'];
    $current_user = current_user();
    $login_level = find_by_groupLevel($current_user['user_level']);
    $level = $current_user['user_level'];
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
  <div class="">
    <div class="panel-body">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
      <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                    include("modal/upd_proyecto.php");
                    include("modal/new_proyecto.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Proyectos</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                           <table id="Dt_detalleproyecto" class="table table-bordered table-hover" cellpadding="0" width="100%">
                               <thead>
                                    <tr>
                                        <!--<th>id</th>-->
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Tipo Proyecto</th>
                                        <th>Lìder de Proyecto</th>
                                        <th>Cliente</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Plan Proyecto</th>
                                        <th>Cronograma</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                               </thead>
                           </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->

    </div>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

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
        <script src="js/datepicker/daterangepicker.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="js/moment/min/moment.min.js"></script>
        <script src="css/bootstrap-daterangepicker/daterangepicker.js"></script>

<script>
    $(document).on("ready",function(){
        detalleuser();
    });
    var detalleuser = function(){
           var id  = <?php echo $id_user;?>;
           var table =$("#Dt_detalleproyecto").DataTable({
               "responsive":true,
               "destroy":true,
               "ajax":{
                   "method":"POST",
                   "url":"ajax/ListadoProyectos.php?id="+id,
                   error: function (result){
                     null;
                   }
               },
               "columns":[
                   //{"data":"id"},
                   {"data":"codigoproy"},
                   {"data":"nombre"},
                   {"data":"descripcion"},
                   {"data":"tipo_proy_desc"},
                   {"data":"nombre_responsable"},
                   {"data":"nombre_cliente"},
                   {"data":"fecha_inicio"},
                   {"data":"fecha_fin"},
                   {"defaultContent":"<button type='button'  class='descargar1 btn btn-xs btn-info' onclick='descargar_archivo1();' title='Descargar Plan Proyecto'><i class='fa fa-pencil-square-o'></i>Plan Proyecto <span class='glyphicon glyphicon-download-alt'></span></button>"},
                   {"defaultContent":"<button type='button'  class='descargar2 btn btn-xs btn-info' onclick='descargar_archivo2();' title='Descargar Cronograma'><i class='fa fa-pencil-square-o'></i>Cronograma <span class='glyphicon glyphicon-download-alt'></span></button>"},
                   {"data":"estado"},
                   {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' onclick='obtener_data_editar();' data-toggle='modal' data-target='.bs-example-modal-lg-udp' title='Editar'><i class='fa fa-pencil-square-o'></i><span class='glyphicon glyphicon-edit'></span><button type='button' class='recursos btn btn-info btn-xs' onclick='agrega_recursos();' title='Recursos'><i class='fa fa-pencil-square-o'></i><span class='glyphicon glyphicon-list'></span></button></button><button type='button' class='tareas btn btn-info btn-xs' onclick='agrega_tareas();' title='Tareas'><i class='fa fa-pencil-square-o'></i><span class='glyphicon glyphicon-list'></span></button>"}
               ],
               "language": idioma_espanol
           });
        obtener_data_editar("#Dt_detalleproyecto tbody",table);
        agrega_tareas("#Dt_detalleproyecto tbody",table);
        descargar_archivo1("#Dt_detalleproyecto tbody",table);
        descargar_archivo2("#Dt_detalleproyecto tbody",table);
        agrega_recursos("#Dt_detalleproyecto tbody",table);
    }

    var descargar_archivo1 = function(tbody,table) {
        $(tbody).on("click","button.descargar1",function() {
            var data = table.row( $(this).parents("tr")).data();
            var planproyecto = data.planproyecto;
            var myWindow = window.open(planproyecto, "SISOLTEC", "width=500,height=500");
        });
    }

    var descargar_archivo2 = function(tbody,table) {
        $(tbody).on("click","button.descargar2",function() {
            var data = table.row( $(this).parents("tr")).data();
            var cronograma = data.cronograma;
            var myWindow = window.open(cronograma, "SISOLTEC", "width=500,height=500");
        });
    }


    var obtener_data_editar = function(tbody,table) {
    $(tbody).on("click", "button.editar", function () {
        var data = table.row($(this).parents("tr")).data();
        var id            = $("#id").val(data.id),
            codigoproy    = $("#codigoproy").val(data.codigoproy),
            nombre        = $("#nombre").val(data.nombre),
            descripcion   = $("#descripcion").val(data.descripcion),
            tipo_proyecto = $("#tipo_proyecto").val(data.tipo_proyecto),
            responsable   = $("#responsable").val(data.responsable),
            id_cliente    = $("#id_cliente").val(data.id_cliente),
            fecha_inicio  = $("#fecha_inicio").val(data.fecha_inicio),
            fecha_fin     = $("#fecha_fin").val(data.fecha_fin),
            estado        = $("#estado").val(data.estado);
    });
    }

    var agrega_tareas = function(tbody,table){
    $(tbody).on("click","button.tareas",function() {
            var data         = table.row($(this).parents("tr")).data();
            var id           = data.id;
            var descripcion  = data.descripcion+"-"+data.nombre_responsable;
            window.location.href="edit_tareas_proyectos.php?id="+id+"&descripcion="+descripcion;
    });
    }   

    var agrega_recursos = function(tbody,table){
    $(tbody).on("click","button.recursos",function() {
            var login_level      = <?php echo $level;?>;
            var data         = table.row($(this).parents("tr")).data();
            var id           = data.id;
            var descripcion  = data.descripcion+"-"+data.nombre_responsable;
            if (login_level!=5){
                window.location.href="edit_proyectos_recursos.php?id="+id+"&descripcion="+descripcion;
            }else{
                alert(" Opción no permitida ");
            }
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

