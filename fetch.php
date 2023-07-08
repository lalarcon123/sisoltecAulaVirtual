<?php
 $id_curso = $_GET['id_curso'];
 require_once('includes/config.php');
    
   
//fetch.php



$columns = array('id','id_curso','descripcion','id_docente','id_actividad','desc_acti','fecha_maxima','calificable','id_user','estudiante','descrip_actividad_est','fecha_carga','documento','calificacion');


$query = "SELECT co.id, co.id_curso, c.descripcion,  co.id_docente, ac.id as id_actividad, ac.descripcion as desc_acti, 
 ac.fecha_maxima, ac.calificable, ace.id_user , concat(e.name,' ',e.last_name) as estudiante, 
 ace.descripcion as descrip_actividad_est, ace.fecha_carga, ace.documento, ace.calificacion
 from curso_oferta co LEFT JOIN estudiante_curso ec on (ec.id_curso = co.id) 
 left JOIN curso c on (c.id = co.id_curso) 
     left JOIN users u on (u.id = ec.id_user) 
     left join actividades_curso ac on (ac.id_curso_oferta = co.id) 
     left join actividades_curso_estudiante ace on (ace.id_actividad=ac.id) 
     left join users e on (e.id = ace.id_user) 
 where co.status = 1  and (co.id = '{$id_curso}') ";
 order by co.id, ac.id

if(isset($_POST["search"]["value"]))
{
 $query .= 'and (co.id_curso LIKE "%'.$_POST["search"]["value"].'%" OR c.descripcion LIKE "%'.$_POST["search"]["value"].'%" OR desc_acti LIKE "%'.$_POST["search"]["value"].'%" OR ac.fecha_maxima LIKE "%'.$_POST["search"]["value"].'%" OR ac.calificable LIKE "%'.$_POST["search"]["value"].'%" OR estudiante LIKE "%'.$_POST["search"]["value"].'%" OR descrip_actividad_est LIKE "%'.$_POST["search"]["value"].'%" OR ace.fecha_carga LIKE "%'.$_POST["search"]["value"].'%" )';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

//echo $query;

$number_filter_row = mysqli_num_rows(mysqli_query($con,$query));

$result=$con->query($query);

$data = array();


while($row = $result->fetch_assoc()){ 
 $sub_array = array();
 $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-column="id">' . $row["id"] . '</div>';
 $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-column="name_proy">' . $row["name_proy"] . '</div>';
 $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-column="name_plantilla">' . $row["name_plantilla"] . '</div>';
 $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-column="name_norma">' . $row["name_norma"] . '</div>';
 $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-column="name_criterio">' . $row["name_criterio"] . '</div>';
 $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-column="name_subcriterio">' . $row["name_subcriterio"] . '</div>';
 $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-column="name_metrica">' . $row["name_metrica"] . '</div>';
 $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-column="valor_meta">' . $row["valor_meta"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="valor_obtenido">' . $row["valor_obtenido"] . '</div>';
 $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-column="brecha">' . $row["brecha"] . '</div>';
 $data[] = $sub_array;
}

function get_all_data($connect,$id)
{


 $query = "SELECT  e.id, e.proyecto, p.name_proy, e.plantilla, l.name as name_plantilla, e.norma, t.name as name_norma, e.criterio, c.name as name_criterio, e.subcriterio, s.name as name_subcriterio, e.metricas, m.name as name_metrica, e.valor_meta, e.valor_obtenido, e.brecha, e.ponderado 
from evaluacion_calidad e, proyecto p, plantilla l, tipo_norma t, criterios_norma c, subcriterio s, metricas m
where p.id          = e.proyecto
  and l.id          = e.plantilla
  and t.id          = e.norma
  and c.id          = e.criterio
  and c.norma       = e.norma
  and s.id          = e.subcriterio
  and s.criterio    = e.criterio
  and m.id          = e.metricas
  and m.subcriterio = e.subcriterio  
  and e.id_cab      =";
    $query .= " '{$id}' ";

 $result=$connect->query($query);

 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($con,$id),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
