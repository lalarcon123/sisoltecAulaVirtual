<?php
  $id = (int)$_GET['id'];
  require_once('includes/load.php');
  $users = find_by_id_user('users', $id); 
  $titulos = find_all_titulos('titulos_docente', $id); 
  $user = $_SESSION['user_id'];
?>
<?php

if(isset($_POST['regresar'])) {
  redirect('detallesmecarts.php', false);
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
    <div class="contenedor">
            <form method="post" action="ConsultaDocenteInfome.php?id=<?php echo (int)$users['id'] ?>" >
                <section class="main">
                    <header>                        
                        <h1><?php echo remove_junk($users['nombre_completo']);?></h1>
                    </header>
                        <input type="hidden" id="id" value="<?php echo (int)$users['id'];?>">
                        <br>
                        <br>
                        <img src="uploads/users/<?php echo remove_junk($users['image']);?>"/>
                        <table width="100%">
                            <?php  foreach ($titulos as $titulos): ?>
                              <tr width="100%">  
                                <td width="100%">
                                    <h2><?php echo remove_junk($titulos['descripcion']);?></h2>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                        </table>
                </section>
                <div>
                    <form method="post" action="detallesmecarts.php"><button type="submit" name="regresar" class="btn btn-danger">Regresar</button></form>
                </div>
                
            </form>
            <footer>
            </footer>
    </div>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>