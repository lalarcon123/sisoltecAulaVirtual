<?php

include "includes/config.php";


$id_curso           = $_POST['id_curso'];
$descripcion        = $_POST['descripcion'];
$fecha_inicio       = $_POST['fecha_inicio'];
$fecha_fin          = $_POST['fecha_fin'];
$cantidad_preguntas = $_POST['cantidad_preguntas'];
$p_user             = $_SESSION['user_id'];
$fecha_i_entrada    = strtotime($fecha_inicio);
$fecha_f_entrada    = strtotime($fecha_fin);


if($fecha_i_entrada < $fecha_f_entrada){
    $query = "INSERT INTO contenido_curso (id_curso, descripcion, fecha_inicio, fecha_fin, cantidad_preguntas) values (";
    $query .=" '{$id_curso}', '{$descripcion', '{$fecha_inicio}', '{$fecha_fin}', '{$cantidad_preguntas}'";
    $query .=")";

    $result   = $db->query($query);
    if($result && $db->affected_rows() === 1){
        $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('contenido_curso', ".$user.",'Ingreso')";
        $result_aud = $db->query($query_aud);
        if($result_aud && $db->affected_rows() === 1){
            echo "<script>alert('Registro ingresado con éxito');</script>";
        }
    }
 } else{
    echo "<script>alert('La fecha Inicio no puede ser mayor a la fecha fin');</script>";
}    



?>