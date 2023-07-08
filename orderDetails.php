<?php
include('header.php');
require_once('includes/load.php');
$user = $_SESSION['user_id'];
?>
<title></title>
<?php include('container.php');?>
<div class="container">
	<h2>Paypal Express</h2>	
	<?php 
	$orderNumber = 000999;
	if(!empty($_GET['paymentID']) && !empty($_GET['payerID']) && !empty($_GET['token']) && !empty($_GET['pid']) ){
		$paymentID = $_GET['paymentID'];
		$payerID = $_GET['payerID'];
		$token = $_GET['token'];
		$pid = $_GET['pid']; 

        $insert  = "INSERT INTO pagos (id_user, id_curso, valor_pago ) VALUES (";
        $insert .=" '{$user}', '{$productId}', '{$productPrice}'";
        $insert .=")";
        $result = $db->query($insert);
        
        $insert_contenido = "insert into estudiante_avance_curso (id_user, id_curso, id_capitulo, id_contenido) select ".$user.", id_curso, id_capitulo, id from contenido_capitulo where id_curso = '{$productId}'";
        $result_contenido = $db->query($insert_contenido); 

        $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('pagos', ".$user.",'Ingreso')";
        $result_aud = $db->query($query_aud);

		?>
		<div class="alert alert-success">
		  <strong>Success!</strong> Su orden ha sido procesada con éxito.
		</div>
		<table>       
			<tr>
			  <td>Payment Id:  <?php echo $paymentID; ?></td>
			  <td>Payer Id: <?php echo $payerID; ?></td>
			  <td>product Id: <?php echo $pid; ?></td>
			  <td><?php echo ; ?></td>
			</tr>       
		</table>
	<?php	
	} else {
		header('Location:ConsultaCursoInfo.php');
	}
	?>
</div>
<?php include('footer.php');?>