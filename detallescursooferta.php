<?php
    require_once('includes/load.php');
    $title ="Oferta de Cursos";
    $user = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>


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
                      include("modal/upd_curso_oferta.php");
                      include("modal/new_curso_oferta.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Curso Oferta</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                           <table id="Dt_detallecurso" class="table table-bordered table-hover" cellpadding="0" width="100%">
                               <thead>
                                    <tr>
                                        <!--<th>id</th>-->
                                        <th>Descripción</th>
                                        <th>Docente</th>
                                        <!--<th>Fecha Regristro</th>-->
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
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

<script>
    $(document).on("ready",function(){
        detallecursooferta();
    });
    var detallecursooferta = function(){
           var table =$("#Dt_detallecurso").DataTable({
               "destroy":true,
               "order": [2, 'desc'],
               "ajax":{
                   "method":"POST",
                   "url":"ajax/ListadoCursoOferta.php?id="+<?php echo $user;?>,
                   error: function (result){
                     null;
                   }
               },
               "columns":[
                   //{"data":"id_titulo"},
                   {"data":"descripcion"},
                   {"data":"docente"},
                   //{"data":"fecha_registro"},
                   {"data":"fecha_inicio"},
                   {"data":"fecha_fin"},
                   {"data":"estado"},
                   {"defaultContent":"<button type='button' class='agrega btn btn-primary btn-xs' onclick='agrega_capitulo();' title='Capítulos'><span class='glyphicon glyphicon-list-alt'></span></button><button type='button' class='material btn btn-warning btn-xs' onclick='agrega_material();' title='Bibliografía'><span class='glyphicon glyphicon-book'></span></button><button type='button' class='actividades btn btn-info btn-xs' onclick='agrega_actividades();' title='Actividades'><span class='glyphicon glyphicon-duplicate'></span></button><button type='button' class='evaluacioncontenido btn btn-success btn-xs' onclick='evaluacion_contenido();' title='Evaluación'><span class='glyphicon glyphicon-hourglass'></span></button><button type='button' class='finalizar btn btn-danger btn-xs' onclick='finalizar_cruso();' title='Finalizar'><span class='glyphicon glyphicon-pushpin'></span></button>"}
               ],
               "language": idioma_espanol
           });
        obtener_data_editar("#Dt_detallecurso tbody",table);
        agrega_material("#Dt_detallecurso tbody",table);
        agrega_actividades("#Dt_detallecurso tbody",table);
        evaluacion_contenido("#Dt_detallecurso tbody",table);
        agrega_capitulo("#Dt_detallecurso tbody",table);
        finalizar_cruso("#Dt_detallecurso tbody",table);
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
            precio             = $("#precio").val(data.precio),
            estado             = $("#estado").val(data.estado);
    });
    }
    var agrega_material = function(tbody,table){
    $(tbody).on("click","button.material",function() {
            var data         = table.row($(this).parents("tr")).data();
            var id           = data.id;
            var id_docente   = data.id_docente;
            //alert(id_docente);
            window.location.href="edit_material_curso.php?id="+id+"&id_docente="+id_docente;
    });
    }
    var agrega_actividades = function(tbody,table){
    $(tbody).on("click","button.actividades",function() {
            var data         = table.row($(this).parents("tr")).data();
            var id           = data.id;
            window.location.href="edit_actividades_curso.php?id="+id;
    });
    }    
    var evaluacion_contenido = function(tbody,table){
    $(tbody).on("click","button.evaluacioncontenido",function() {
            var data         = table.row($(this).parents("tr")).data();
            var id           = data.id;
            window.location.href="edit_curso_evaluacion.php?id="+id;
    });
    }    
    var agrega_capitulo = function(tbody,table) {
    $(tbody).on("click", "button.agrega", function () {
            var data         = table.row($(this).parents("tr")).data();
            var id           = data.id;
            var id_capitulo  = 0;
            window.location.href="edit_curso_capitulos.php?id="+id;
            //window.location.href="edit_curso_capitulos.php?id="+id+"&id_capitulo=0";
    });
    }
    var finalizar_cruso = function(tbody,table) {
    $(tbody).on("click", "button.finalizar", function () {
            var data         = table.row($(this).parents("tr")).data();
            var id           = data.id;
            var estado       = data.estado;
            if (estado != "FINALIZADO"){
                if (confirm("Esta seguro de Finalizar el curso")){
                    window.location.href="edit_finalizar_curso.php?id="+id;
                }
            }else{
               alert("El Curso ha sido Finalizado o se encuentra Inactivo");
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

