<?php
  $id = (int)$_GET['id'];
  require_once('includes/load.php');
  $curso = find_by_id_course('curso', $id); 
  $capitulos_cursos = find_all_capitulos('capitulos_curso', $id); 
  $comparar = true;
  $comparar_js = "<script type='text/javascript'>confirm('Desea registrarse en el curso?')</script>";
  $user = $_SESSION['user_id'];
  $existe = find_by_id_registro($user,$id);

  $productName = $curso['product_name'];
  $currency = "USD";
  $productPrice = $curso['product_price'];
  $productId = $curso['id'];
  $orderNumber = $curso['id'].$user;

  include('contenedor.php');
?>
<?php
if(isset($_POST['registro'])){
    if  (empty($existe['id'])){
        echo($comparar_js);
        if($comparar==$comparar_js){
            $id_curso  = (int)$_GET['id'];

            $insert  = "INSERT INTO estudiante_curso (id_user, id_curso) VALUES (";
            $insert .=" '{$user}', '{$id_curso}'";
            $insert .=")";
            $result = $db->query($insert);
            $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('estudiante_curso', ".$user.",'Ingreso')";
            $result_aud = $db->query($query_aud);
        }
    } else {
      echo "<script type='text/javascript'>alert('Ud ya se encuentra registrado')</script>";   
    }
}
if(isset($_POST['regresar'])) {
  redirect('detallescarts.php', false);
}


?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/jquery.bxslider.css">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="libs/js/jquery.bxslider.js"></script>
    <style>
        body{
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background: #ffffff;
        }.contenedor{
              width: 90%;
              margin: 0 auto;
        }.input-res{   
              width: 100%;
              max-width: 500px;
              box-sizing: border-box;
        }header{
               background: #343a40;
               width: 100%;
               height: 100px;
        }header h1{
                font-style: normal;
                font-family: Helvetica;
                font-size: x-large;
                color: #FFF;
                padding: 2% 0;
                text-align: center;
        }.main{
            width: 100%;
            background: #FFF;
            padding: 20px;
            float: left;
            box-sizing: border-box;
        }.main img{
             width: 20%;
             height: auto;
        }aside {
              width: 30%;
              padding: 20px;
              box-sizing: border-box;
        }footer{
            clear:both;
            float: left;
            margin-top: 20px;
            box-sizing: border-box;
            width: 100%;
            padding: 20px;
            color: #fff;
            background: #ffffff;
        }footer h3{
            font: normal;
            font-style: oblique;
            font-size: 18px;
            font-family: Helvetica;
        }footer textarea{
             font: normal;
             font-style: oblique;
             font-family: Helvetica;
             color: #0f0f0f;
             resize: none;
             width: 25%;
        }footer label{
             font: normal;
             font-style: oblique;
             font-family: Helvetica;
             color: #0f0f0f;
        }footer input{
            font: normal;
            font-family: Helvetica;
            color: #0f0f0f;
        }.comment-text-area {
            float: left;
            width: 100%;
            height: auto;
        }
        .textinput {
            float: left;
            width: 100%;
            min-height: 75px;
            outline: none;
            resize: none;
            border: 1px solid grey;
        }footer table{
            border: 1px;
            font: normal;
            font-style: italic;
            font-size: medium;
            font-family: 'Courier New', Courier, monospace;
            color: #7b868d;
        }footer td{
            border: 10px;
            }footer a{
                  }.ec-stars-wrapper {
                 /* Espacio entre los inline-block (los hijos, los `a`)
                    http://ksesocss.blogspot.com/2012/03/display-inline-block-y-sus-empeno-en.html */
                 font-size: 0;
                /* Podríamos quitarlo,
                   pero de esta manera (siempre que no le demos padding),
                   sólo aplicará la regla .ec-stars-wrapper:hover a cuando
                   también se esté haciendo hover a alguna estrella */
                display: inline-block;
               }@media screen and (max-width: 400px){
                  .contenedor{
                       width: 100%;
                   }aside{
                       display:none;
                   }
               }@media screen and (max-width: 800px){
                   .main{
                        width: 100%;
                    }
                   .main img{
                        width: 100%;
                        height: auto;
                }aside{
                     width: 100%;
                }
            }.ec-stars-wrapper a {
               text-decoration: none;
               display: inline-block;
               /* Volver a dar tamaño al texto */
               font-size: 32px;
               font-size: 2rem;

               color: #888;
            }.ec-stars-wrapper:hover a {
               color: rgb(39, 130, 228);
            }
            /*
             * El selector de hijo, es necesario para aumentar la especifidad
            */
            .ec-stars-wrapper > a:hover ~ a {
               color: #888;
            }
    </style>

</head>
<body>
    <!-- /.content-wrapper -->
    <div class="contenedor">
            <form method="post" action="ConsultaCursoInfo.php?id=<?php echo (int)$curso['id'] ?>" >
                <section class="main">
                    <header>                        
                        <h1><?php echo remove_junk($curso['product_name']);?></h1>
                    </header>
                        <input type="hidden" id="id" value="<?php echo (int)$curso['id'];?>">
                        <br>
                        <br>
                        <img src="<?php echo remove_junk($curso['product_image']);?>"/>
                        <h1><?php echo remove_junk($curso['objetivo']);?></h1>
                        <h3><b>Duración:</b> <?php echo remove_junk($curso['duracion']);?></h3>
                        <h3><b>Dictado por:</b>  <?php echo remove_junk($curso['docente']);?>  </h3>
                        <h3><b>Desde</b>  <?php echo remove_junk($curso['fecha_inicio']);?> <b>Hasta</b>  <?php echo remove_junk($curso['fecha_fin']);?>  </h3>

                        <table width="100%">
                            <?php  foreach ($capitulos_cursos as $capitulos_curso): ?>
                              <tr width="100%">  
                                <td width="100%">
                                    <h2><?php echo remove_junk($capitulos_curso['descripcion']);?></h2>
                                </td>
                              </tr>
                              <tr>
                                <td width="100%" align="left">
                                    <h3><?php echo remove_junk($capitulos_curso['objetivo']);?></h3>
                                </td>
                              </tr>
                              <?php
                                   $contenido_capitulos  = find_all_contenido('contenido_capitulo',$capitulos_curso['id']);
                                 foreach ($contenido_capitulos as $contenido_capitulo): 
                              ?>
                              <tr width="100%">
                                <td width="100%" align="left">
                                    <p><b>Descripción: </b><?php echo remove_junk($contenido_capitulo['descripcion']); ?></p>
                                </td>
                              </tr>
                              <tr width="100%">
                                <td width="100%" align="left">
                                    <p><b>Objetivo: </b><?php echo remove_junk($contenido_capitulo['objetivo']); ?></p>
                                </td>
                              </tr>

                              <?php endforeach; ?>
                            <?php endforeach; ?>
                        </table>
                </section>
                <div>
                   <button type="submit" name="registro" id="registro" class="btn btn-primary">Registro</button>
                   <form method="post" action="detallescarts.php"><button type="submit" name="regresar" class="btn btn-danger">Regresar</button></form> 
                </div>
                <br>
                <br>
                <div>
                  <?php include 'paypalCheckout.php'; ?>
                </div>
            </form>
            <footer>
            </footer>
    </div>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>