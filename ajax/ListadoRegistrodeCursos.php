<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $query   = "select o.id,
               convert(cast(convert(c.descripcion using latin1) as binary) using utf8) AS descripcion,
               concat(u.name,' ',u.last_name) as docente, 
               o.fecha_inicio, 
               o.fecha_fin, 
               o.precio,
               e.id_user,
               concat(i.name,' ',i.last_name) as estudiante,
               e.fecha_registro, 
               pagos.fecha_registro as fecha_pago
          from curso c, curso_oferta o, users u, users i, estudiante_curso e
          left join pagos on pagos.id_curso = e.id_curso and pagos.id_user = e.id_user
         where o.id_curso = c.id
           and u.id = o.id_docente
           and e.id_curso = o.id
           and e.id_user = i.id
           and e.estado = 1
        order by e.fecha_registro ";

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
