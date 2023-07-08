<?php
    $id      = $_GET['id'];
    $id_docente = $_GET['id_docente'];

    include "../includes/config.php";//Contiene funcion que conecta a la base de   datos

    $query   = "SELECT m.id, 
                       m.id_curso_oferta, 
                       convert(cast(convert(c.descripcion using latin1) as binary) using utf8) AS descripcion_curso,
                       m.id_tipo_material, 
                       convert(cast(convert(t.descripcion using latin1) as binary) using utf8) AS descripcion_tipo_material, 
                       m.id_docente, ";
    $query  .= "       convert(cast(convert(m.descripcion using latin1) as binary) using utf8) AS 
                       descripcion, 
                       m.enlace, 
                       m.documento, 
                       (case m.estado WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado ";
    $query  .= " FROM material_curso m , curso_oferta o, curso c, tipo_material t ";
    $query  .= " WHERE o.id = m.id_curso_oferta and c.id = o.id_curso and t.id = m.id_tipo_material";
    $query  .= "   and m.id_curso_oferta = ";
    $query  .= " '{$id}'";
    //$query  .= "   and m.id_docente = ";
    //$query  .= " '{$id_docente}'";
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
