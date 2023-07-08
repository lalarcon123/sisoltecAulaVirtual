<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $query = "SELECT u.id id_user,u.name,u.last_name,u.username,u.user_level, u.phone, u.movil, (case u.status WHEN 1 THEN 'ACTIVO' WHEN 3 THEN 'PENDIENTE' ELSE 'INACTIVO' END) as status ,u.last_login,";
    $query .="g.group_name, u.ci, u.mail, u.creation_date, u.image, u.start_date, u.end_date ";
    $query .="FROM users u ";
    $query .="LEFT JOIN user_groups g ";
    $query .="ON g.group_level=u.user_level ";
    $query .="ORDER BY u.name ASC";
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
