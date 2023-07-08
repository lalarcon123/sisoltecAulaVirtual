<?php
   require_once('config.php');
   $id_tipo = $_POST["id_tipo"];

   //$query = "SELECT c.id, c.name FROM ciudades c where c.status = 1 and c.pais ='$id_pais'";
   $query = "SELECT e.id, e.descripcion as name FROM examen e ";
   $html = "<option value='0'>Seleccionar Exámenes</option>";
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