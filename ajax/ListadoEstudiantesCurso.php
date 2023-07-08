<?php
    $id_curso = $_GET['id_curso'];

    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $query = "select ec.id_user, 
                     concat(u.name, ' ', u.last_name) as nombre, 
                     u.ci, 
                     u.mail, ";
    $query  .= "    (case u.status WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as status,  
                    ec.fecha_registro, ";
    $query  .= "    IFNULL(ec.fecha_pago , p.fecha_pago) as pago, 
                    co.id_curso, 
                    convert(cast(convert(c.descripcion using latin1) as binary) using utf8) AS 
                    descripcion, 
                    convert(cast(convert(c.objetivo using latin1) as binary) using utf8) AS objetivo, ";
    $query  .= "    co.id  as curso_oferta,  
                    co.id_docente, ";
    $query  .= " concat(s.name,' ',s.last_name) as nombre_docente ";
    $query  .= " from estudiante_curso ec, curso_oferta co, users u, ";
    $query  .= " curso c, pagos p, users s ";
    $query  .= " where co.id = ec.id_curso ";
    $query  .= " and u.id = ec.id_user ";
    $query  .= " and c.id = co.id_curso ";
    $query  .= " and p.id_user = ec.id_user ";
    $query  .= " and p.id_curso = co.id ";
    $query  .= " and s.id = co.id_docente ";
    //$query  .= " and (co.id_docente = '{$id_user}'  or 1 = '{$id_user}') ";
    $query  .= " and co.id = '{$id_curso}'"; 

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
