<?php
date_default_timezone_set('America/Mexico_City');
include('../php/conexion.php');
include('../php/is_logged.php');;
$folio = $conn->real_escape_string($_POST['folio']);
$Fecha_hoy = date('Y-m-d');//CREAMOS UNA FECHA DEL DIA EN CURSO SEGUN LA ZONA HORARIA
$user_id = $_SESSION['user_id'];
$hora = date('H:i:s');

if(mysqli_query($conn, "UPDATE pedidos SET estatus = 'Autorizado', fecha_autorizado = '$Fecha_hoy', id_autorizacion = '$user_id', hora_aut_director = '$hora' WHERE folio = '$folio'")){
		echo '<script>M.toast({html:"Pedido actualizado correctamente..", classes: "rounded"})</script>';
}else{
		echo '<script>M.toast({html:"Ocurrio un error!", classes: "rounded"})</script>';
}
?>
<script>
	var a = document.createElement("a");
	 a.href = "../views/pedidos.php";
	 a.click();
</script>  


        