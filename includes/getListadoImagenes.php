<?php
   require_once('config.php');
   $id_imagen = $_POST["id_imagen"];

   $query = "SELECT l.id, l.descripcion as name FROM listado_imagenes l WHERE l.id_imagen = '$id_imagen'";
   $html = "<option value='0'>Seleccionar Listado de imágenes</option>";
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