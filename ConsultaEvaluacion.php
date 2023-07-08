<?php
  $id = (int)$_GET['id'];
  $id_curso = (int)$_GET['id_curso'];
  require_once('includes/load.php');
  $Preguntas  = find_all_preguntas('contenido_curso',$id);
  $Evaluacion = find_by_id('contenido_curso',$id);
?>
<?php //include_once('layouts/header.php'); ?>
<?php 
if(isset($_POST['regresar'])) {
      echo $id_curso;
      redirect('edit_curso_evaluacion.php?id='.$id_curso, false);
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
               width: 100%;
               height: 100px;
        }header h1{
                font-style: normal;
                font-family: Helvetica;
                font-size: x-large;
                color: #000000;
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
    <div class="contenedor">
            <div><br><br></div>
            <div>
                <!--<form method="post"><button type="submit" name="regresar" class="btn btn-danger">Regresar</button></form>-->
                <a href="edit_curso_evaluacion.php?id=<?php echo $id_curso; ?>" style="color:#FFFFFF;"><h3>Regresar</h3></a>
            </div>
            <form>
                <section class="main">
                    <!--<img src="/uploads/img/logo 1.jpg"/>-->
                    <header>                        
                        <h1><?php echo remove_junk(ucwords($Evaluacion['descripcion'])); ?></h1>
                    </header>
                        <table width="100%">
                            <?php  foreach ($Preguntas as $contenido_curso): ?>
                              <tr width="100%">  
                                <td width="3%">
                                    <h3><?php echo remove_junk($contenido_curso['numero_pregunta']);?></h3>
                                </td>
                                <td width="97%" align="left">
                                    <h3><?php echo remove_junk($contenido_curso['pregunta']);?></h3>
                                </td>
                              </tr>
                              <?php
                                   $Respuestas  = find_all_respuestas('evaluacion_preguntas',$contenido_curso['id']);
                                 foreach ($Respuestas as $evaluacion_preguntas): 
                              ?>
                              <tr width="100%">
                                <td width="3%"></td>
                                <td width="97%" align="left">
                                    <p><?php echo remove_junk($evaluacion_preguntas['descripcion']); 
                                       if ($evaluacion_preguntas['valida']=="SI") 
                                        {echo "      (X)";};?>
                                            
                                    </p>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            <?php endforeach; ?>
                        </table>

                </section>
            </form>
            <footer>
            </footer>
    </div>

</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>
<?php //include_once('layouts/footer.php'); ?>