<?php
include('../php/conexion.php');
$ValorDe = $conn->real_escape_string($_POST['valorDe']);
$ValorA = $conn->real_escape_string($_POST['valorA']);
$Usuario = $conn->real_escape_string($_POST['valorUsuario']);

$usuario = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$Usuario'"));
?>

<h3 class="hide-on-med-and-down"><?php echo $usuario['firstname'].' '.$usuario['lastname'];?></h3>
<h5 class="hide-on-large-only"><?php echo $usuario['firstname'].' '.$usuario['lastname'];?></h5>

<table class="bordered highlight responsive-table">
	<thead>
		<tr>
			<th>Id Corte</th>
	        <th>Efectivo</th>
	        <th>Banco</th>
	        <th>Credito</th>
	        <th>Cantidad deducibles</th>
			<th>Descripcion deducibles</th>
	        <th>Recibio</th>
	        <th>Fecha</th>
	        <th>Hora</th>
	        <th>Clientes</th>
	        <th>Detalles</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$resultado_cortes = mysqli_query($conn, "SELECT * FROM cortes WHERE fecha>='$ValorDe' AND fecha<='$ValorA' AND usuario='$Usuario' ORDER BY id_corte DESC");
	$aux = mysqli_num_rows($resultado_cortes);
	if($aux>0){
	$total = 0;
	$totalClientes= 0;
	$totalbanco = 0;
	$totalcredito = 0;
	$totaldeducible = 0;
	while($cortes = mysqli_fetch_array($resultado_cortes)){
		$id_corte =$cortes['id_corte'];
		$pagos = mysqli_fetch_array(mysqli_query($conn,"SELECT count(*) FROM detalles WHERE id_corte = $id_corte"));
		#TOMAMOS LA INFORMACION DEL DEDUCIBLE CON EL ID GUARDADO EN LA VARIABLE $corte QUE RECIBIMOS CON EL GET
	    $sql_Deducible = mysqli_query($conn, "SELECT * FROM deducibles WHERE id_corte = '$id_corte'");  
	    if (mysqli_num_rows($sql_Deducible) > 0) {
	        $Deducible = mysqli_fetch_array($sql_Deducible);
	        $Deducir = $Deducible['cantidad'];
			$descripcionDeducible  = $Deducible['descripcion'];
	    }else{
	        $Deducir = 0;
			$descripcionDeducible = "N/A";
	    }
	  ?>
	  <tr>
	    <td><b><?php echo $id_corte;?></b></td>
	    <td>$<?php echo $cortes['cantidad'];?></td>
	    <td>$<?php echo $cortes['banco'];?></td>
	    <td>$<?php echo $cortes['credito'];?></td>
	    <td>$<?php echo ($Deducir == 0)? 0:$Deducir;?></td>
		<td><?php echo $descripcionDeducible;?></td>
	    <td><?php echo $cortes['recibio'];?></td>
	    <td><?php echo $cortes['fecha'];?></td>
	    <td><?php echo $cortes['hora'];?></td>
	    <td><?php echo $pagos['count(*)'];?></td>
	    <td><form method="post" action="../views/detalle_corte.php"><input id="id_corte" name="id_corte" type="hidden" value="<?php echo $cortes['id_corte']; ?>"><button class="btn-floating btn-tiny waves-effect waves-light pink"><i class="material-icons">credit_card</i></button></form></td>
	  </tr>
	  <?php
	  $total = $total+$cortes['cantidad'];
	  $totalbanco = $totalbanco+$cortes['banco'];
	  $totalcredito = $totalcredito+$cortes['credito'];
	  $totaldeducible = $totaldeducible+$Deducir;
	  $totalClientes = $totalClientes+$pagos['count(*)'];
	  $aux--;
	}
	?>
	  <tr>
	  	<td><h5>TOTAL:</h5></td>
	  	<td><h5>$<?php echo $total; ?></h5></td>
	  	<td><h5>$<?php echo $totalbanco; ?></h5></td>
	  	<td><h5>$<?php echo $totalcredito; ?></h5></td>
	  	<td><h5>$<?php echo $totaldeducible; ?></h5></td><td></td><td></td>
	  	<td><h5>TOTAL:</h5></td>
	  	<td><h5><?php echo $totalClientes;?></h5></td>
	  	<td></td>
	  </tr>
	<?php
	}else{
	  echo "<center><b><h5>Este usuario aún no ha registrado cortes</h5></b></center>";
	}
	?>
	<?php 
	mysqli_close($conn);
	?> 
		
	</tbody>
</table><br><br>