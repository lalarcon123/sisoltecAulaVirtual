<?php
   require_once('config.php');
   $id_curso = $_POST["id_curso"];

   $queryevaluac = "SELECT ec.id_user as id, concat(u.name,' ', u.last_name) as estudiante FROM estudiante_curso ec LEFT JOIN users u on (u.id = ec.id_user) where ec.id_curso = $id_curso";

   $html = "<option value='0'>Seleccionar Estudiante</option>";
   if ($resultado = $con->query($queryevaluac)) {
        while ($row = $resultado->fetch_assoc()) {
            $html.= "<option value='" . $row['id'] . "'>" . $row['estudiante'] . "</option>";
        }
        echo $html;
        $resultado->close();
   }else{
       printf ("No hay datos");
   }
   $con->close();
?>