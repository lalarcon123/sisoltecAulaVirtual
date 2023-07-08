<?php
    $id = $_GET['id'];
    include "../includes/config.php";//Contiene funcion que conecta a la base de   datos

    $query   = "SELECT td.id_titulo_docente, td.id_titulo, t.descripcion, td.id_usuario, td.codigo_senescyt, td.fecha_incorporacion, ";
    $query  .= " td.fecha_registro_senecyt, td.imagen, (case td.estado WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as status ";
    $query  .= " FROM titulos_docente td, titulos t where t.id_titulo = td.id_titulo and td.id_usuario =";
    $query  .= " '{$id}'";
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
