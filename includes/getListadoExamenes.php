<?php
   require_once('config.php');
   $id_examen = $_POST["id_examen"];

   $query = "SELECT l.id, l.descripcion as name FROM listado_examenes l WHERE l.id_examen = '$id_examen'";
   $html = "<option value='0'>Seleccionar Listado de exámenes</option>";
   if ($resultado = $con->query($query)) {
        while ($row = $resultado->fetch_assoc()) {
            $html.= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
        }
        echo $html;
        $resultado->close();
   }else{
       printf ("No hay datos");
   }
   $con->close();
?>