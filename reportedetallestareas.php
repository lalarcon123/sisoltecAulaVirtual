<?php
    require_once('includes/load.php');
    $user           = $_SESSION['user_id'];
    $title          ="Reporte de Tareas";
    $fecha_inicio   = $_GET['fecha_inicio'];
    $fecha_fin      = $_GET['fecha_fin'];
    $id_proyecto    = $_GET['id_proyecto'];
    $all_proyecto   = find_all('proyectos');
?>
<?php

if(isset($_POST['consultar'])) {
        $fecha_inicio  = remove_junk($db->escape($_POST['fecha_inicio']));
        $fecha_fin     = remove_junk($db->escape($_POST['fecha_fin']));
        $id_proyecto   = remove_junk($db->escape($_POST['id_proyecto']));
        redirect('reportedetallestareas.php?id_proyecto='.$id_proyecto.'&fecha_inicio='.$fecha_inicio.'&fecha_fin='.$fecha_fin, false);
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
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


      <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

      <style type="text/css">
          body {  }
          h1 { font-size: xx-large;
              font-weight: bold;
              border-bottom: 1px solid black; }
          div.note {
              position: relative;
              display: block;
              padding: 5pt;
              margin: 5pt;
              white-space: -moz-pre-wrap; /* Mozilla */
              white-space: -pre-wrap;     /* Opera 4 - 6 */
              white-space: -o-pre-wrap;   /* Opera 7 */
              white-space: pre-wrap;      /* CSS3 */
              word-wrap: break-word;      /* IE 5.5+ */ }
      </style>


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
                <form method="post" action="reportedetallestareas.php?id_proyecto=<?php echo $id_proyecto ?>&fecha_inicio=<?php echo $fecha_inicio ?>&fecha_fin=<?php echo $fecha_fin ?>" enctype="multipart/form-data">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Reporte de Tareas</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="qty">Proyecto*</label>
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                    <select class="form-control" name="id_proyecto" id="id_proyecto">
                                        <option value="0">Seleccione el Proyecto</option>
                                        <?php foreach ($all_proyecto as $proyectos ):?>
                                         <option <?php if($proyectos['id'] === $id_proyecto) echo 'selected="selected"';?> value="<?php echo $proyectos['id'];?>"> <?php echo ucwords($proyectos['nombre']);?> </option>
                                      <?php endforeach;?>
                                    </select>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="qty">Fecha Desde*</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                      <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo $fecha_inicio;?>" />
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="qty">Fecha Hasta*</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                      <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo $fecha_fin;?>" />
                                  </div>
                              </div>
                          </div>

                        </div>

                        <div>
                          <button type="submit" name="consultar" class="btn btn-primary">Consultar</button>
                        </div>
                        <div class="x_content">
                           <table id="Dt_detalletareas" class="table table-bordered table-hover" cellpadding="0" width="100%">
                               <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Máxima</th>
                                        <th>Tipo Tarea</th>
                                        <th>Porcentaje avance</th>
                                        <th>Responsable</th>
                                        <th>Estado</th>
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
        <!--<script src="js/jszip/dist/jszip.min.js"></script>-->
        <script src="js/pdfmake/build/pdfmake.min.js"></script>
        <script src="js/pdfmake/build/vfs_fonts.js"></script>

        <!-- DateJS -->
        <script src="js/datepicker/daterangepicker.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="js/moment/min/moment.min.js"></script>
        <script src="css/bootstrap-daterangepicker/daterangepicker.js"></script>

<script>

        $(document).on("ready",function(){
            detalletramites();
        });
        var detalletramites = function(){
            var fecha_inicio = $('#fecha_inicio').val().split("/").toString();
            var fecha_fin    = $('#fecha_fin').val().split("/").toString();
            var id           = <?php echo $id_proyecto;?>;//$("#id_proyecto").val();
            //alert(id);
            var id_usuario   = <?php echo $user;?>;
            var table =$("#Dt_detalletareas").DataTable({
                "responsive":true,
                "destroy":true,
                "ajax":{
                    "method":"POST",
                    "url":"ajax/ListadoRegistroTareasR.php?id="+id+"&id_usuario="+id_usuario+"&fecha_inicio="+fecha_inicio+"&fecha_fin="+fecha_fin,
                   error: function (result){
                     null;
                   }
                },
                "columns":[
                    {"data":"descripcion"},
                    {"data":"fecha_inicio"},
                    {"data":"fecha_entrega"},
                    {"data":"desc_tipo_tarea"},
                    {"data":"avance"},
                    {"data":"nombre_responsable"},
                    {"data":"estado"}
                ],
                "language": idioma_espanol,
                dom: 'Bfrtip',
                buttons: [
                     {
                     extend:    'pdfHtml5',
                     titleAttr: 'excel',
                     extend: 'excel',
                     title: 'Reporte de Tareas',
                     exportOptions:{
                         columns: [0,1,2,3,4,5,6]
                       }
                     },
                     {
                     extend:    'pdfHtml5',
                     titleAttr: 'pdf',
                     extend: 'pdf',
                     title: 'Reporte de Tareas',
                     exportOptions:{
                         columns: [0,1,2,3,4,5,6]
                       }
                     }
                ]
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