<?php
  $id = (int)$_GET['id']; 
  $objetivo = $_GET['objetivo'];
  $tema = $_GET['tema'];
  $video = $_GET['video'];
  $id_contenido = $_GET['id_contenido']; 

  require_once('includes/load.php');
  $curso_info = find_by_id_course('curso', $id); 
  $capitulos_cursos = find_all_capitulos('capitulos_curso',$id); 
  $evaluaciones_cursos = find_all_evaluaciones('contenido_curso',$id); 
  $comparar = true;
  $user = $_SESSION['user_id'];
  if ($id_contenido!="0"){
     $query   = "UPDATE estudiante_avance_curso SET  fecha_actividad = CURDATE() WHERE id_contenido =".$id_contenido." and id_user=".$user;
    $result = $db->query($query);
    if($result && $db->affected_rows() === 1){
        null;
    }
  }

?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="css/bootstrap-4.3.1.css" rel="stylesheet">


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
        }p.italic {
              font-family: "Latin Modern Roman 10";
              font-style: italic;
        }p.oblique {
              font-family: "Latin Modern Roman 10";
              font-style: oblique;
        }.sinborde {
              border: 0;
              width: 100%;
              height: 20%;
        }.boton_personalizado{
              text-decoration: none;
              padding: 10px;
              font-weight: 400;
              font-size: 15px;
              color: #ffffff;
              background-color: #E74C3C;
              border-radius: 6px;
              border: 2px solid #E74C3C;
        }.boton_evaluacion{
              text-decoration: none;
              padding: 10px;
              font-weight: 400;
              font-size: 15px;
              color: #ffffff;
              background-color: #00BFFF;
              border-radius: 6px;
              border: 2px solid #00BFFF;
        }.btn {
               background: #FFFFFF;
               background-image: url("images/imagen3.jpg");
               background-size: cover;
               background-position: center;
               display: inline-block;
               border: none;
               padding: 10px;
               width: 125px;
               height: 82px;
               transition: all 0.5s;
               cursor: pointer;
        }btn:hover {
               width: 75px;
               height: 75px;
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
    <div class="contenedor">
            <form method="post" action="ConsultaCursoInfoDesarrollo.php?id=<?php echo (int)$curso_info['id'] ?>">
                <section class="main">
                    <header>                        
                        <h1><?php echo remove_junk(ucwords($curso_info['product_name']));?></h1>
                    </header>
                        <input type="hidden" id="id" value="<?php echo (int)$curso_info['id'];?>">
                        <br>
                        <br>
                        
                        <div class="row">
                        <div class="col-md-6 embed-responsive embed-responsive-21by9">
                        <video controls autoplay> <source src="uploads\multimedia\<?php echo $video; ?>" type="video/mp4"> </video>
                         </div>
                        <div class="col-md-6">&nbsp;
                        <h2 align="center"><?php echo $tema;?></h2>
                        <h3 align="justify">Objetivo:</h3> 
                        <p align="justify"><?php echo $objetivo;?></p>
                        </div>
                        </div>
                        
                    
                        <br><br>
                        <TABLE width="100%" bgcolor="#C78904">
                          <TR>
                            <td align="center" style="color:#FFFFFF">CAPITULOS</td>
                            <td align="center" style="color:#FFFFFF">MATERIAL</td>
                            <td align="center" style="color:#FFFFFF">TEMA</td>
                            <td align="center" style="color:#FFFFFF">FECHA VISUALIZACION</td>
                          </TR>
                        </TABLE>
                        <TABLE  width="100%">
                          <?php  foreach ($capitulos_cursos as $cap_curso):
                               $cantidad  = find_by_count_contenidos('contenido_capitulo',$cap_curso['id']);
                               $descripcion_capitulo = $cap_curso['descripcion'];
                               $cant = $cantidad['cantidad'];
                               $element = "
                               <TR>
                                 <TD ROWSPAN=$cant width=\"20%\"><h3>$descripcion_capitulo</h3></TD>";
                               $primer_vez = 1;
                               $contenido_capitulos  = find_all_contenido('contenido_capitulo',$cap_curso['id']);
                               foreach ($contenido_capitulos as $contenido_capitulo): 
                                  $id_contenido = $contenido_capitulo['id']; 
                                  $objetivo     = $contenido_capitulo['objetivo']; 
                                  $video        = $contenido_capitulo['multimedia']; 
                                  $tema         = $contenido_capitulo['tema'];
                                  $fecha_visto  = find_by_id_contenido('estudiante_avance_curso',$id_contenido,$user);
                                  if(!$fecha_visto){ 
                                    $fecha_act = null;
                                  }else{
                                    $fecha_act =  $fecha_visto['fecha_actividad'];
                                  }

                                  if ($primer_vez=1){
                                      $element = $element . "
                                      <TD width=\"30%\"><a href=\"ConsultaCursoInfoDesarrollo.php?id=$id&id_contenido=$id_contenido&objetivo=$objetivo&video=$video&id_contenido=$id_contenido&tema=$tema\" class=\"btn\"></a></TD> <TD>$tema</TD><TD>$fecha_act</TD></TR>";
                                      echo $element;
                                      $primer_vez = 0;
                                      $element = "";
                                  } else {
                                      $elementos = " <TR>
                                                      <TD width=\"30%\"><a href=\"ConsultaCursoInfoDesarrollo.php?id=$id&id_contenido=$id_contenido&objetivo=$objetivo&video=$video&id_contenido=$id_contenido&tema=$tema\" class=\"btn\"></a></TD><TD>$tema</TD><TD>$fecha_act</TD> 
                                                    </TR>";
                                      echo $elementos;
                                      $elementos = "";
                                  }
                               endforeach;
                               echo "<tr width=\"100%\"><td><hr /></td><td><hr /></td><td><hr /></td><td><hr /></td></tr> ";  
                            endforeach;

                          ?>
                        </TABLE>
                        <TABLE width="100%">
                          <TR bgcolor="#C78904">
                            <td align="center" style="color:#FFFFFF">EVALUACIONES</td>
                          </TR>
                           <?php  foreach ($evaluaciones_cursos as $contenido_curso):
                                $descripcion_evaluacion = $contenido_curso['descripcion'];
                                $id       = $contenido_curso['id'];
                                $id_curso = $contenido_curso['id_curso'];
                                $evaluaciones ="
                                        <TR>
                                          <td><a href=\"javascript:funcion($id,$id_curso);\" style=\"color:hsla(240,0%,50%,1);\">$descripcion_evaluacion</a></td>
                                        </TR>";
                                echo $evaluaciones;
                                  endforeach;
                          ?>
                          <script>
                            function funcion(id,id_curso){
                              var txt;
                              var r = confirm("Esta seguro de efectuar la Evaluación!");
                              if (r == true) {
                                <?php  echo $graba_evaluacion = insertar_evaluacion($user,$id);?>
                                window.location.href="RealizarEvaluacion.php?id="+id+"&id_curso="+id_curso+"&id_pregunta=0&id_respuesta=";
                                } 

                            }
                          </script>
                        </TABLE>
                        <TABLE width="100%">
                          <TR bgcolor="#C78904">
                            <td align="center" style="color:#FFFFFF">ACTIVIDADES</td>
                          </TR>
                          <TR>
                            <td><a href="javascript:funcion_actividades(<?php echo $id_curso?>)" style="color:hsla(240,0%,50%,1)">Cargar las Actividades</a></td>
                          </TR>
                          <script>
                            function funcion_actividades(id_curso){
                                <?php  echo $graba_actividades = insertar_actividades($user,$id_curso);?>
                                window.location.href="actividadescurso.php?id_curso="+id_curso;
                            }
                          </script>
                        </TABLE>

                </section> 
                <div class="row">
                  <div class="col-md-1">
                   <form method="post" action="ConsultaCursoInfoDesarrollo.php?id=<?php echo (int)$curso_info['id'] ?>&objetivo=&video=&id_contenido=0&tema=">
                    <a href="detallesmecarts.php" class="boton_personalizado">Regresar</a></form> 
                  </div>
                </div>
                <br>
                <br>
                <div>
                </div>
            </form>
            <footer>
            </footer>
    </div>

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed --> 
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.3.1.js"></script>

</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>