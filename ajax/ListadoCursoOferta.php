<?php
    $id = $_GET['id'];
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos
    if ($id==1){
        $query  = "SELECT co.id, 
                          co.id_curso, 
                          convert(cast(convert(c.descripcion using latin1) as binary) using utf8) AS descripcion,
                          co.id_docente , 
                          convert(cast(convert(concat(u.name,' ',u.last_name) using latin1) as binary) using utf8) as docente, 
                          co.fecha_registro";
        $query  .= " ,    co.fecha_inicio, 
                          co.fecha_fin, 
                          co.maximo_estudiantes, 
                          co.precio, ";
        $query  .= "      co.id_usuario, 
                          concat(s.name,' ',s.last_name) as usuario_ingresa, ";
        $query  .= "      (case co.estado WHEN 1 THEN 'ACTIVO' WHEN 0  THEN 'INACTIVO' ELSE 'FINALIZADO' END) as estado  ";
        $query  .= "  FROM curso_oferta co, curso c, users u, users s";
        $query  .= " WHERE c.id = co.id_curso";
        $query  .= "   and u.id = co.id_docente";
        $query  .= "   and u.user_level = 2";
        $query  .= "   and s.id = co.id_usuario";
    }else{
        $query  = "SELECT co.id, 
                          co.id_curso, 
                          convert(cast(convert(c.descripcion using latin1) as binary) using utf8) AS descripcion,
                          co.id_docente , 
                          convert(cast(convert(concat(u.name,' ',u.last_name) using latin1) as binary) using utf8) as docente,  
                          co.fecha_registro";
        $query  .= " ,    co.fecha_inicio, 
                          co.fecha_fin, 
                          co.maximo_estudiantes, 
                          co.precio, ";
        $query  .= "      co.id_usuario, 
                          concat(s.name,' ',s.last_name) as usuario_ingresa, ";
        $query  .= "      (case co.estado WHEN 1 THEN 'ACTIVO' WHEN 0 THEN 'INACTIVO' ELSE 'FINALIZADO' END) as estado  ";
        $query  .= "  FROM curso_oferta co, curso c, users u, users s";
        $query  .= " WHERE c.id = co.id_curso";
        $query  .= "   and u.id = co.id_docente";
        $query  .= "   and u.user_level = 2";
        $query  .= "   and s.id = co.id_usuario";
        $query  .= "   and co.id_docente =";
        $query  .= " '{$id}'";

    }

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
