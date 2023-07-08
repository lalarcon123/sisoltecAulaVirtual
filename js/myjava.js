$(function() {
	$('#guardar').on('click', function(){
		var url = document.URL;
		location.href=url;
	});
	
	$('#nuevaEvaluacion').on('click', function(){
		$('#modalEvaluacion').modal({	
			show:true,
			backdrop:'static',
		});
	});
	
	
	$('#generarEvaluacion').on('click', function(){
		var id_curso           = $('#id_curso').val();
		var descripcion        = $('#descripcion').val();
		var fecha_inicio       = $('#fecha_inicio').val();
        var fecha_fin          = $('#fecha_fin').val();
        var cantidad_preguntas = $('#cantidad_preguntas').val();

		if(id_curso.length>0){
			$.ajax({
				type: 'POST',
				data: 'id_curso='+id_curso+'&descripcion='+descripcion+'&fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin+'&cantidad_preguntas='+cantidad_preguntas,
				//data: 'id_curso='+id_curso+
				//      'descripcion='+descripcion+
				//      'fecha_inicio='+fecha_inicio+
				//      'fecha_fin='+fecha_fin+
				//      'cantidad_preguntas='+cantidad_preguntas,
				//data: {id_curso : id_curso, descripcion : descripcion, fecha_inicio : fecha_inicio, fecha_fin : fecha_fin, cantidad_preguntas : cantidad_preguntas},
				url: 'generarRegistro.php',
				success: function(data){
					alert('La fecha Inicio no puede ser mayor a la fecha fin');
					$('#numero_pregunta').removeAttr('disabled').focus();
					$('#pregunta').removeAttr('disabled');
					$('#regPreguntas').removeAttr('disabled');
					
					$('#descripcion').attr('disabled','disabled');
					$('#fecha_inicio').attr('disabled','disabled');
					$('#fecha_fin').attr('disabled','disabled');
                    $('#cantidad_preguntas').attr('disabled','disabled');
					$('#generarEvaluacion').attr('disabled','disabled');
				}
			});
		}else{
			$('#mensaje').html('<p class="alert alert-warning">Espere!!, tiene que ingresar el curso.</p>');
		}
	});
	
	

});


