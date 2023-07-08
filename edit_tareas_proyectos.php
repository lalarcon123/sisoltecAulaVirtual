<?php
  $id           = (int)$_GET['id'];
  $descripcion  = $_GET['descripcion'];
  $page_title = 'Registro de tareas proyectos';
  require_once('includes/load.php');
   
  $all_tipo_tarea = find_all('tipo_tarea');
  $user = $_SESSION['user_id'];
  //echo $id;
  //echo $user;
  $find_all_responsablesas = find_all_responsablesas('recursos_proyectos',$id,$user);
?>

<?php
if(isset($_POST['tarea_diaria'])) {
    $documento_respaldo = $_FILES['documento']['name'];
    $ruta = $_FILES['documento']['tmp_name'];
    $destino = "uploads/documentos/" . $documento_respaldo;


    $req_fields = array('id_proyecto',
                        'descripcion_pry',
                        'fecha_inicio',
                        'fecha_maxima',
                        'tipo_tarea',
                        'responsable');

    validate_fields($req_fields);

    if (empty($errors)) {

        if ($documento_respaldo != "") {
            if (copy($ruta, $destino)) {}
        }else{
            $destino ="";
        }
        $descripcion         = remove_junk($db->escape($_POST['descripcion_pry']));
        //$hora_inicio         = remove_junk($db->escape($_POST['hora_inicio']));
        //$hora_fin            = remove_junk($db->escape($_POST['hora_fin']));
        $fecha_inicio        = remove_junk($db->escape($_POST['fecha_inicio']));
        //$fecha_fin           = remove_junk($db->escape($_POST['fecha_fin']));
        $fecha_maxima        = remove_junk($db->escape($_POST['fecha_maxima']));
        $tipo_tarea          = remove_junk($db->escape($_POST['tipo_tarea']));
        $proyecto            = remove_junk($db->escape($_POST['id_proyecto']));
        $responsable         = remove_junk($db->escape($_POST['responsable']));

        $query = "INSERT  registro_tarea (descripcion, fecha_inicio, fecha_entrega, id_tipo_tarea, id_proyecto, documento, responsable) VALUES (";
        $query .= " '{$descripcion}','{$fecha_inicio}', '{$fecha_maxima}', '{$tipo_tarea}', '{$proyecto}', '{$destino}', '{$responsable}'";
        $query .= ")";
        if ($db->query($query)) {
            $session->msg('s', "Tarea agregada exitosamente. ");
            redirect('edit_tareas_proyectos.php?id='.$id.'&descripcion='.$descripcion, false);
        } else {
            $session->msg('d', ' Lo siento, registro falló.');
            redirect('edit_tareas_proyectos.php?id='.$id.'&descripcion='.$descripcion, false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('edit_tareas_proyectos.php?id='.$id.'&descripcion='.$descripcion, false);
    }

}

if(isset($_POST['regresar'])) {
        redirect('detallesproyectos.php', false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">-->


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
 <!--<section class="content">-->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Agregar Tareas <?php echo $descripcion ?></span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="panel-body">
                    <div class="col-md-12">
                        <form method="post" action="edit_tareas_proyectos.php?id=<?php echo $id ?>&descripcion=<?php echo $descripcion ?>" enctype="multipart/form-data">
                            <input type="hidden" name="id_proyecto" id="id_proyecto" value="<?php echo $id;?>">
                            <input type="hidden" name="descripcion" id="descripcion" value="<?php echo $descripcion;?>">
                              <div class="row">
                                  <div class="col-md-8">
                                      <div class="form-group">
                                          <label for="qty">Descripción de tarea*</label>
                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                              <!--<input type="text" class="form-control" name="descripcion" id="descripcion" value="" />-->
                                              <textarea class="form-control" name="descripcion_pry"  id="descripcion_pry" rows="4" cols="80" placeholder="Descripción" onKeyUp="this.value=this.value.toUpperCase();" maxlength="250"></textarea>
                                          </div>
                                      </div>
                                  </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="qty">Fecha Inicio*</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="" />
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="qty">Fecha Máxima de entrega*</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                            <input type="date" class="form-control" name="fecha_maxima" id="fecha_maxima" value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="qty">Tipo Tarea*</label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                            <select class="form-control" name="tipo_tarea" id="tipo_tarea">
                                              <option value="0">Seleccione el tipo tarea</option>
                                              <?php foreach ($all_tipo_tarea as $tipo_tarea ):?>
                                               <option value="<?php echo $tipo_tarea['id'];?>"><?php echo ucwords($tipo_tarea['descripcion']);?></option>
                                            <?php endforeach;?>
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
                                            <input type="file" class="form-control" name="documento" value="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="qty">Responsable*</label>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                            <select class="form-control" name="responsable" id="responsable">
                                              <option value="0">Seleccione el Responsable</option>
                                              <?php foreach ($find_all_responsablesas as $users ):?>
                                               <option value="<?php echo $users['id_user'];?>"><?php echo ucwords($users['nombre_trabajador']);?></option>
                                            <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </div>

                            <div><button type="submit" name="tarea_diaria" class="btn btn-primary">Cargar Tarea</button><form method="post" action="regresar"><button type="submit" name="regresar" class="btn btn-danger">Regresar</button></form></div>
                            <?php
                                include("modal/upd_tarea_proyecto.php");
                            ?>
                            <div class="x_content">
                                <table id="Dt_detalletareas" class="table table-bordered table-hover" cellpadding="0" width="100%">
                                    <thead>
                                    <tr>
                                        <!--<th>id</th>-->
                                        <th>Descripción</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Máxima</th>
                                        <th>Tipo Tarea</th>
                                        <th>Porcentaje avance</th>
                                        <th>Responsable</th>
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
  <!--</section>-->
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
            var id_usuario  = <?php echo $user;?>;
            var table =$("#Dt_detalletareas").DataTable({
                "responsive":true,
                "destroy":true,
                "ajax":{
                    "method":"POST",
                    "url":"ajax/ListadoRegistroTareas.php?id="+id+"&id_usuario="+id_usuario,
                   error: function (result){
                     null;
                   }
                },
                "columns":[
                    //{"data":"id_proy"},
                    {"data":"descripcion"},
                    {"data":"fecha_inicio"},
                    {"data":"fecha_entrega"},
                    {"data":"desc_tipo_tarea"},
                    {"data":"avance"},
                    {"data":"nombre_responsable"},
                    {"data":"estado"},
                    {"defaultContent":"<button type='button'  class='descargar btn btn-xs btn-info' onclick='descargar_archivo();' title='Descargar Soporte'><i class='fa fa-pencil-square-o'></i> <span class='glyphicon glyphicon-download-alt'></span></button><button type='button' class='editar btn btn-warning btn-xs' onclick='editar_tarea();' data-toggle='modal' data-target='.bs-example-modal-lg-udp' title='Editar'> <i class='fa fa-pencil-square-o'></i><span class='glyphicon glyphicon-edit'></span></button><button type='button'  class='eliminar btn btn-xs btn-danger' onclick='eliminar_tarea();' title='Inactivar'><i class='fa fa-pencil-square-o'></i> <span class='glyphicon glyphicon-remove'></span></button><button type='button'  class='activar btn btn-xs btn-primary' onclick='activar_tarea();' title='Activar'><i class='fa fa-pencil-square-o'></i><span class='glyphicon glyphicon-ok'></span></button><button type='button'  class='finalizar btn btn-xs btn-success' onclick='finalizar_tarea();' title='Finalizar'><i class='fa fa-pencil-square-o'></i> <span class='glyphicon glyphicon-pushpin'></span></button><button type='button'  class='evidencia btn btn-xs btn-default' onclick='descargar_evidencia();' title='Descargar Evidencia'><i class='fa fa-pencil-square-o'></i> <span class='glyphicon glyphicon-download-alt'></span></button>"}
                ],
                "language": idioma_espanol
            });
            descargar_archivo("#Dt_detalletareas tbody",table);
            descargar_evidencia("#Dt_detalletareas tbody",table);
            eliminar_tarea("#Dt_detalletareas tbody",table);
            activar_tarea("#Dt_detalletareas tbody",table);
            editar_tarea("#Dt_detalletareas tbody",table);
            finalizar_tarea("#Dt_detalletareas tbody",table);
        }
        var descargar_archivo = function(tbody,table) {
            $(tbody).on("click","button.descargar",function() {
                var data = table.row( $(this).parents("tr")).data();
                var imagen = data.documento;
                var myWindow = window.open(imagen, "Sistema Sisoltec", "width=500,height=500");
            });
        }
        var descargar_evidencia = function(tbody,table) {
            $(tbody).on("click","button.evidencia",function() {
                var data = table.row( $(this).parents("tr")).data();
                var imagen = data.evidencia;
                var myWindow = window.open(imagen, "Sistema Sisoltec", "width=500,height=500");
            });
        }

        var eliminar_tarea = function(tbody,table) {
           $(tbody).on("click","button.eliminar",function() {
                var data            = table.row( $(this).parents("tr")).data();
                var id              = data.id;
                var id_proyecto     = data.id_proy;
                var descripcion     = data.desc_proyecto+" - "+data.responsable_proyecto;
                var estado          = data.estado;
                //alert(id+" "+id_proyecto);
                if (estado != 'FINALIZADA'){
                  window.location.href="deletetareasdiarias.php?id="+id+"&id_proyecto="+id_proyecto+"&descripcion="+descripcion;
                }else{
                  alert("La tarea se encuentra finalizada, no puede ser modificada");
                }
            });
        }
        var activar_tarea = function(tbody,table) {
           $(tbody).on("click","button.activar",function() {
                var data            = table.row( $(this).parents("tr")).data();
                var id              = data.id;
                var id_proyecto     = data.id_proy;
                var descripcion     = data.desc_proyecto+" - "+data.responsable_proyecto;
                var estado          = data.estado;
                //alert(id+" "+id_curso);
                if (estado != 'FINALIZADA'){
                  window.location.href="activatareas.php?id="+id+"&id_proyecto="+id_proyecto+"&descripcion="+descripcion;
                }else{
                  alert("La tarea se encuentra finalizada, no puede ser modificada");
                }
            });
        }
        var editar_tarea = function(tbody,table) {
        $(tbody).on("click", "button.editar", function () {
            var data = table.row($(this).parents("tr")).data();
            var id           = $("#id").val(data.id),
                id_proy      = $("#id_proy").val(data.id_proy),
                estado       = $("#estado").val(data.estado),
                observacion  = $("#observacion").val(data.observacion),
                avance       = $("#avance").val(data.avance);
        });
        }
        var finalizar_tarea = function(tbody,table) {
           $(tbody).on("click","button.finalizar",function() {
                var data            = table.row( $(this).parents("tr")).data();
                var id              = data.id;
                var id_proyecto     = data.id_proy;
                var descripcion     = data.desc_proyecto+" - "+data.responsable_proyecto;
                //alert(id+" "+id_curso);
                window.location.href="finalizatareas.php?id="+id+"&id_proyecto="+id_proyecto+"&descripcion="+descripcion;
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
