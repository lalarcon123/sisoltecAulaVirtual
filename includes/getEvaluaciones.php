<?php
   require_once('config.php');
   $id_curso = $_POST["id_curso"];

   $queryevaluac = "SELECT cc.id, cc.descripcion FROM contenido_curso cc where cc.estado = 1 and cc.id_curso = $id_curso";

   $html = "<option value='0'>Seleccionar Evaluación</option>";
   if ($resultado = $con->query($queryevaluac)) {
        while ($row = $resultado->fetch_assoc()) {
            $html.= "<option value='" . $row['id'] . "'>" . $row['descripcion'] . "</option>";
        }
        echo $html;
        $resultado->close();
   }else{
       printf ("No hay datos");
   }
   $con->close();
?>