<?php
  $id               = (int)$_GET['id'];
  $id_curso         = (int)$_GET['id_curso'];

  $page_title = 'Contenido Capítulo';
  require_once('includes/load.php');
  //$all_tipo_material = find_all('tipo_material');
  $nombre_curso =find_by_id_descripcion('curso', $id_curso);
  $descripcion  =find_by_id('capitulos_curso', $id);
  $user = $_SESSION['user_id'];
?>


<?php


//vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
// You may change maxsize, and allowable upload file types.
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
//Maximum file size. You may increase or decrease.
$MAX_SIZE = 10000000;

//Allowable file Mime Types. Add more mime types if you want
$FILE_MIMES = array('video/mpeg mpeg mpg mpe');

//Allowable file ext. names. you may add more extension names.
$FILE_EXTS = array('.mpg', '.MPG', '.mpeg', '.MPEG', '.mpe', '.MPE','.mp4','.MP4','.avi','.AVI', '.asf','.ASF','.m4v','.M4V','.mov','.MOV','.wmv','.WMV','.pdf');

//Allow file delete? no, if only allow upload only
$DELETABLE = true;

/************************************************************
* Setup variables
************************************************************/

if(isset($_POST['capitulo_contenido'])) {

    $file_type_video = $_FILES['multimedia']['type'];
    $file_name_video = $_FILES['multimedia']['name'];
    $file_ext_video = strtolower(substr($file_name_video,strrpos($file_name_video,".")));
    $uploadDir_video = "uploads/multimedia/";
    $uploadFile_video = $uploadDir_video . $file_name_video;

    if ($_FILES['multimedia']['size'] <= $MAX_SIZE) {
        if (in_array($file_ext_video, $FILE_EXTS)){
            $move = move_uploaded_file($_FILES['multimedia']['tmp_name'], $uploadFile_video);
            //echo "<script>alert(\"$uploadFile_video\");</script>";
            if ($file_name_video != "" && $move)  {

                        $req_fields = array('tema',
                                            'descripcion',
                                            'objetivo',
                                            'duracion');

                        validate_fields($req_fields);

                        if (empty($errors)) {

                            $id_curso     = remove_junk($db->escape($_POST['id_curso']));
                            $id_capitulo  = remove_junk($db->escape($_POST['id']));
                            $tema         = remove_junk($db->escape($_POST['tema']));
                            $descripcion  = remove_junk($db->escape($_POST['descripcion']));
                            $objetivo     = remove_junk($db->escape($_POST['objetivo']));
                            $duracion     = remove_junk($db->escape($_POST['duracion']));

                            $query = "INSERT INTO  contenido_capitulo (id_capitulo, id_curso, descripcion, objetivo, duracion, multimedia, tema) VALUES (";
                            $query .= " '{$id_capitulo}', '{$id_curso}', '{$descripcion}', '{$objetivo}','{$duracion}','{$file_name_video}',";
                            $query .= "'{$tema}')";
                            if ($db->query($query)) {
                                $session->msg('s', "Contenido agregado exitosamente. ");
                                $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('contenido_capitulo', ".$user.",'Ingreso')";
                                $result_aud = $db->query($query_aud);
                                if($result_aud && $db->affected_rows() === 1){
                                    redirect('edit_capitulos_contenido.php?id='.$id.'&id_curso='.$id_curso, false);
                                }
                            } else {
                                $session->msg('d', ' Lo siento, registro falló.');
                                redirect('edit_capitulos_contenido.php?id='.$id.'&id_curso='.$id_curso, false);
                            }
                        } else {
                            $session->msg("d", $errors);
                            redirect('edit_capitulos_contenido.php?id='.$id.'&id_curso='.$id_curso, false);
                        }
            }

        }else{
            echo "<script language=\"javascript\">
                          alert('Tipo de Archivo no permitido');
                          </script> ";    
        }
    } else {
        echo "<script language=\"javascript\">
              alert('El video es demasiado grande, debe reducir su tamaño');
              </script> ";
    }
}
if(isset($_POST['regresar'])) {
        redirect('edit_curso_capitulos.php?id='.$id_curso, false);
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
                        <span>Agregar Contenido del Curso <?php echo remove_junk(ucwords($nombre_curso['descripcion'])); ?> del capítulo <?php echo remove_junk(ucwords($descripcion['descripcion'])); ?></span>
                    </strong>
                </div>
                <div class="panel-body">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form method="post" action="edit_capitulos_contenido.php?id=<?php echo $id ?>&id_curso=<?php echo $id_curso ?>" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
                                <input type="hidden" name="id_curso" id="id_curso" value="<?php echo $id_curso;?>">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="qty">Tema*</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                                <textarea class="form-control" name="tema"  id="tema" rows="2" cols="80" placeholder="Tema" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="qty">Multimedia*</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                                <input type="file" class="form-control" name="multimedia" value="" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div><button type="submit" name="capitulo_contenido" class="btn btn-primary">Cargar Contenido</button><form method="post" action="regresar"><button type="submit" name="regresar" class="btn btn-danger">Regresar</button></form></div>
                                <div class="x_content">
                                    <table id="Dt_detallecontenido" class="table table-bordered table-hover" cellpadding="0" width="100%">
                                        <thead>
                                        <tr>
                                            <!--<th>id</th>-->
                                            <th>Tema</th>
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
            detallecontenido();
        });
        var detallecontenido = function(){
            var id          = <?php echo $id;?>;
            var table =$("#Dt_detallecontenido").DataTable({
                "destroy":true,
                "ajax":{
                    "method":"POST",
                    "url":"ajax/ListadoCursoCapituloContenido.php?id="+id,
                   error: function (result){
                     null;
                   }
                },
                "columns":[
                    //{"data":"id"},
                    {"data":"tema"},
                    {"data":"descripcion"},
                    {"data":"objetivo"},
                    {"data":"duracion"},
                    {"data":"status"},                    
                    {"defaultContent":"<button type='button'  class='descargar btn btn-xs btn-warning' onclick='descargar_archivo();' title='Visualizar'> <span class='glyphicon glyphicon-cloud-download'></span></button><button type='button'  class='activar btn btn-xs btn-primary' onclick='activar_contenido();' title='Activar'><span class='glyphicon glyphicon-check'></span></button><button type='button'  class='eliminar btn btn-xs btn-danger' onclick='eliminar_contenido();' title='Inactivar'><span class='glyphicon glyphicon-remove'></span></button>"}
                ],
                "language": idioma_espanol
            });
            descargar_archivo("#Dt_detallecontenido tbody",table);
            eliminar_contenido("#Dt_detallecontenido tbody",table);
            activar_contenido("#Dt_detallecontenido tbody",table);
            obtener_data_editar("#Dt_detallecontenido tbody",table);
        }

        var activar_contenido = function(tbody,table) {
           $(tbody).on("click","button.activar",function() {
                var data            = table.row( $(this).parents("tr")).data();
                var id              = data.id;
                var id_curso        = data.id_curso;
                var id_capitulo     = data.id_capitulo;
                window.location.href="activacontenido.php?id="+id+"&id_curso="+id_curso+"&id_capitulo="+id_capitulo;
            });
        }
        var eliminar_contenido = function(tbody,table) {
           $(tbody).on("click","button.eliminar",function() {
                var data            = table.row( $(this).parents("tr")).data();
                var id              = data.id;
                var id_curso        = data.id_curso;
                var id_capitulo     = data.id_capitulo;
                window.location.href="deletecontenido.php?id="+id+"&id_curso="+id_curso+"&id_capitulo="+id_capitulo;
            });
        }
        var descargar_archivo = function(tbody,table) {
            $(tbody).on("click","button.descargar",function() {
                var data = table.row( $(this).parents("tr")).data();
                var imagen = "uploads/multimedia/"+data.multimedia;
                var myWindow = window.open(imagen, "Sistema Sisoltec Aula Virtual", "width=500,height=500");
            });
        }

        var obtener_data_editar = function(tbody,table) {
        $(tbody).on("click", "button.editar", function () {
            var data = table.row($(this).parents("tr")).data();
            var id = $("#id").val(data.id),
                descripcion    = $("#descripcion").val(data.descripcion),
                objetivo       = $("#objetivo").val(data.objetivo),
                tema           = $("#tema").val(data.tema);
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
