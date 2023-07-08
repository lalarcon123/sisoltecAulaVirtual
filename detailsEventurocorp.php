<?php

// Conexion a la base de datos
require_once('includes/load.php');
//require_once('bdd.php');
                   
$id     = $_GET['id'];
$start  = $_GET['start'];
$titulo = $_GET['titulo'];
if (isset($id) && isset($id)){

			$horarios = find_by_agenda('agenda_medicos',$id,$start,$titulo);
                        $element = '';
                        foreach ($horarios as $horario):
                        	$id_horario_medico = $horario['id_horario_medico'];
                        	$hora_ini = $horario['hora_inicio'];
                        	$hora_fin = $horario['hora_fin'];
                            $element  = $element."<div class=\"col-sm-8 control-label\">$hora_ini - $hora_fin</div><div class=\"col-sm-2 control-label\"><input type=\"radio\" name=\"horario_medico\" id=\"horario_medico\" value=\"$id_horario_medico\"/></div>";
                        endforeach;
			
			if ($element===''){
				die ("<div class=\"col-sm-8 control-label\">No hay horario asignado</div>");
			   }else{
			   die ($element); 	
			   }	
			                        
} 
	
?>
