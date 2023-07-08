<?php
    $id_curso = $_GET['id_curso'];
    //$id = $_GET['id'];

    include "../includes/config.php";//Contiene funcion que conecta a la base de datos


    $query = "SELECT ace.id_curso_oferta as id, ace.id_actividad, convert(cast(convert(ace.descripcion using latin1) as binary) using utf8) AS desc_acti, ";
    $query  .= "ace.id_user, concat(u.name, ' ', u.last_name) as estudiante, ace.fecha_maxima, ";
    $query  .= "ac.calificable,  ace.documento, ace.fecha_carga, ace.calificacion ";
    $query  .= "FROM actividades_curso_estudiante ace LEFT JOIN actividades_curso ac "; 
    $query  .= "ON (ac.id = ace.id_actividad and ac.id_curso_oferta = ace.id_curso_oferta) ";
    $query  .= " LEFT JOIN users u on (u.id = ace.id_user) ";
    $query  .= "where (ace.id_curso_oferta = '{$id_curso}') ";
    
    //$query = "select co.id, co.id_curso, c.descripcion,  co.id_docente, ";
    //$query  .= " concat(u.name,' ', u.last_name) as nombre_estudiante, ac.id as id_actividad, ac.descripcion as desc_acti, ";
    //$query  .= " ac.fecha_maxima, ac.calificable, ace.id_user, concat(e.name,' ',e.last_name) as estudiante, ";
    //$query  .= " ace.descripcion as descrip_actividad_est, ace.fecha_carga, ace.documento, ace.calificacion ";
    //$query  .= " from curso_oferta co LEFT JOIN estudiante_curso ec on (ec.id_curso = co.id) ";
    //$query  .= " left JOIN curso c on (c.id = co.id_curso) ";
    //$query  .= "     left JOIN users u on (u.id = ec.id_user) ";
    //$query  .= "     left join actividades_curso ac on (ac.id_curso_oferta = co.id) ";
    //$query  .= "     left join actividades_curso_estudiante ace on (ace.id_actividad=ac.id) ";
    //$query  .= "     left join users e on (e.id = ace.id_user) ";
    //$query  .= " where co.status = 1 ";
    //$query  .= " and (co.id = '{$id_curso}') ";
    //$query  .= " and (ac.id = '{$id}') ";
    //$query  .= " order by co.id, ac.id ";

    //echo $query;
    $resultado = mysqli_query($con,$query);

    if ($resultado){
        while($data = mysqli_fetch_assoc($resultado)){
            $arreglo["data"][] = array_map("utf8_encode",$data);
        }
        echo json_encode($arreglo);
    }
    mysqli_free_result($resultado);
    mysqli_close($con);
?>
