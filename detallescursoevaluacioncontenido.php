<?php
    require_once('includes/load.php');
    $title ="Evalución Contenido Curso";
    //$user = $_SESSION['user_id'];
    $id      = (int)$_GET['id'];
?>
<?php

if(isset($_POST['regresar'])) {
        redirect('detallescursooferta.php', false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/myjava.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>

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
    <div> <!-- Modal -->
        <div class="panel-heading clearfix">
            <div class="pull-left">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg-add" id="nuevaEvaluacion"><i class="fa fa-plus-circle"></i> Agregar Evaluación <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                </button>
            </div>
            <div class="pull-left">
                <form class="form-horizontal form-label-left input_mask" method="post" action="regresar" id="regresar" name="regresar">
                    <input name="regresar" type="submit" class="btn btn-danger" value="Regresar"></input>
                </form>
            </div>
        </div>
    </div>
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
                    //include("modal/upd_curso_oferta.php");
                    //include("modal/new_evaluacion_contenido.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Evaluación contenido curso</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                           <table id="Dt_detalleevaluacioncontenido" class="table table-bordered table-hover" cellpadding="0" width="100%">
                               <thead>
                                    <tr>
                                        <!--<th>id</th>-->
                                        <th>Descripción</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Preguntas</th>
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
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="js/moment/min/moment.min.js"></script>
        <script src="css/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="js/detalle.js"></script>
<script>
    $(document).on("ready",function(){
        detallecursoevaluacioncontenido();
    });
    var detallecursoevaluacioncontenido = function(){
           var table =$("#Dt_detalleevaluacioncontenido").DataTable({
               "destroy":true,
               "ajax":{
                   "method":"POST",
                   "url":"ajax/ListadoCursoEvaluacionContenido.php?id="+<?php echo $id;?>,
                   error: function (result){
                     null;
                   }
               },
               "columns":[
                   //{"data":"id_titulo"},
                   {"data":"descripcion"},
                   {"data":"fecha_inicio"},
                   {"data":"fecha_fin"},
                   {"data":"cantidad_preguntas"},
                   {"data":"estado"},
                   {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' onclick='obtener_data_editar();' data-toggle='modal' data-target='.bs-example-modal-lg-udp'>Editar  <i class='fa fa-pencil-square-o'></i><span class='glyphicon glyphicon-edit'></span></button><button type='button' class='material btn btn-warning btn-xs' onclick='agrega_material();'>Material  <i class='fa fa-pencil-square-o'></i><span class='glyphicon glyphicon-book'></span></button>"}
               ],
               "language": idioma_espanol
           });
        obtener_data_editar("#Dt_detalleevaluacioncontenido tbody",table);
        agrega_material("#Dt_detalleevaluacioncontenido tbody",table);
    }
    var obtener_data_editar = function(tbody,table) {
    $(tbody).on("click", "button.editar", function () {
        var data = table.row($(this).parents("tr")).data();
        var id                 = $("#id").val(data.id),
            id_curso           = $("#id_curso").val(data.id_curso),
            id_docente         = $("#id_docente").val(data.id_docente),
            fecha_inicio       = $("#fecha_inicio").val(data.fecha_inicio),
            fecha_fin          = $("#fecha_fin").val(data.fecha_fin),
            maximo_estudiantes = $("#maximo_estudiantes").val(data.maximo_estudiantes),
            estado             = $("#estado").val(data.estado);
    });
    }
    var agrega_material = function(tbody,table){
    $(tbody).on("click","button.material",function() {
            var data         = table.row($(this).parents("tr")).data();
            var id           = data.id_curso;
            var id_docente   = data.id_docente;
            //alert(id_docente);
            window.location.href="edit_material_curso.php?id="+id+"&id_docente="+id_docente;
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

