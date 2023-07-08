<?php
    require_once('includes/load.php');
    $title ="Docentes";
    $user = $_SESSION['user_id'];
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
                <?php
                include("modal/upd_password.php");
                include("modal/upd_docente.php");
                ?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Docentes</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                           <table id="Dt_detalledocentes" class="table table-bordered table-hover" cellpadding="0" width="100%">
                               <thead>
                                    <tr>
                                        <!--<th>id</th>-->
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Identificación</th>
                                        <th>Correo</th>
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
        detalledocente();
    });
    var detalledocente = function(){
           var id_user  = <?php echo $user;?>;
           var table =$("#Dt_detalledocentes").DataTable({
               "destroy":true,
               "ajax":{
                   "method":"POST",
                   "url":"ajax/ListadoDocentes.php?id="+id_user,
                   error: function (result){
                     null;
                   }
               },
               "columns":[
                   //{"data":"id_titulo"},
                   {"data":"name"},
                   {"data":"last_name"},
                   {"data":"ci"},
                   {"data":"mail"},
                   {"data":"status"},
                   {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' onclick='obtener_data_editar();' data-toggle='modal' data-target='.bs-example-modal-lg-udp' title='Editar'>  <i class='fa fa-pencil-square-o'></i><span class='glyphicon glyphicon-edit'></span></button><button type='button' class='reseteo btn btn-warning btn-xs' onclick='reseteo_password();' data-toggle='modal' data-target='.bs-example-modal-lg-udp1' title='Reseteo Password'>  <i class='fa fa-pencil-square-o'></i><span class='glyphicon glyphicon-user'></span></button><button type='button' class='agregar btn btn-info btn-xs' onclick='agregar_titulo();'><span class='    glyphicon glyphicon-education'></span></button>"}
               ],
               "language": idioma_espanol
           });
        obtener_data_editar("#Dt_detalledocentes tbody",table);
        reseteo_password("#Dt_detalledocentes tbody",table);
        agregar_titulo("#Dt_detalledocentes tbody",table);
    }

    var reseteo_password = function(tbody,table) {
    $(tbody).on("click", "button.reseteo", function () {
        var data = table.row($(this).parents("tr")).data();
        var id_user     = $("#id_user").val(data.id_user);
    });
    }

    var obtener_data_editar = function(tbody,table) {
    $(tbody).on("click", "button.editar", function () {
        var data = table.row($(this).parents("tr")).data();
        var id_usuario = $("#id_usuario").val(data.id_user),
            name       = $("#name").val(data.name),
            last_name  = $("#last_name").val(data.last_name),
            cedula     = $("#cedula").val(data.ci),
            mail       = $("#mail").val(data.mail),
            phone      = $("#phone").val(data.phone),
            movil      = $("#movil").val(data.movil),
            //username   = $("#username").val(data.username),
            //user_level = $("#user_level").val(data.user_level),
            //imagen     = $("#imagen").val(data.imagen),
            status     = $("#status").val(data.status);
    });
    }

    //var obtener_data_editar = function(tbody,table) {
    //    $(tbody).on("click", "button.editar", function () {
    //        var data = table.row($(this).parents("tr")).data();
    //        var id   = data.id;
    //        window.location.href="edit_docente.php?id="+id;
    //    });
    //}
    //var obtener_data_perfil = function(tbody,table) {
    //    $(tbody).on("click", "button.perfil", function () {
    //        var data = table.row($(this).parents("tr")).data();
    //        var id   = data.id;
    //        window.location.href="edit_accountdocente.php?id="+id;
    //    });
    //}
    var agregar_titulo = function(tbody,table) {
        $(tbody).on("click", "button.agregar", function () {
            var data = table.row($(this).parents("tr")).data();
            var id   = data.id;
            window.location.href="edit_docente_titulo.php?id="+id;
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

