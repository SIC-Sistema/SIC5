<?php
include('../php/conexion.php');
$id_orden = $_GET['Id'];

//Incluimos la libreria fpdf
include("../fpdf/fpdf.php");
include("is_logged.php");

class PDF extends FPDF{
	function folioCliente(){
		global $id_orden;
		global $conn;

		$fila = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM orden_servicios WHERE id = $id_orden"));
        $id_user = $_SESSION['user_id'];
        $user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE user_id=$id_user"));
		$id_cliente = $fila['id_cliente'];
        $cliente = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM especiales WHERE id_cliente = $id_cliente"));
        

		 // Colores de los bordes, fondo y texto
            $this->SetFillColor(255,255,255);
            $this->SetTextColor(0,0,0);
            $this->AddPage();
            global $title;
            global $pass;
            $this->Image('../img/logo_ticket.jpg',28,4,20);
            $this->SetFont('Arial','B',13);
            $this->SetY(30);
            $this->Cell(90,4,'Fecha: '.$fila['fecha_s'],0,0,'C',true);
            $this->SetFont('Arial','B',10);
            $this->Ln(5);
            $this->Cell(20,4,utf8_decode('Folio: '.$id_orden),0,0,'L',true);$this->SetFont('Arial','',10);
            $this->Ln(5);
            $this->Cell(20,4,utf8_decode('No. Cliente: '.$fila['id_cliente']),0,0,'L',true);
            $this->Ln(5);
            $this->MultiCell(60,4,utf8_decode('Nombre:'.$cliente['nombre']),0,'L',true);
            $this->Ln(1);
            $this->MultiCell(60,4,utf8_decode('Trabajo: '.$fila['trabajo']),0,'L',true);
            $this->Ln(1);
            $totalE = 0;
            $desE = '';
            $Extras = mysqli_query($conn, "SELECT * FROM orden_extras WHERE id_orden = $id_orden");
            if (mysqli_num_rows($Extras) > 0) {
                while ($extra = mysqli_fetch_array($Extras)) {
                    $totalE += $extra['cantidad'];
                    $desE .= '; '.$extra['descripcion'];
             
               }
               $this->MultiCell(60,4,utf8_decode('Trabajo Extra: '.$desE),0,'L',true);
               $this->Ln(1);
            }

            $this->Cell(20,4,utf8_decode('Cotizacion: $'.$fila['precio'].'.00'),0,0,'L',true);
            $this->Ln(5);
            $this->Cell(20,4,utf8_decode('Extras: $'.$totalE.'.00'),0,0,'L',true);
            $this->Ln(6);
            $TOTAL = $fila['precio']+$totalE;
            $this->Cell(90,4,utf8_decode('Total: $'.$TOTAL.'.00'),0,0,'C',true);
            $this->Ln(6);
            
            $this->MultiCell(60,4,utf8_decode('Atendi??: '.$user['firstname'].' '.$user['lastname']),0,'L',true);
            $this->Ln(5);
            $this->MultiCell(70,4,utf8_decode('_________________________________'),0,'L',false);
            $this->SetX(6);
            $this->MultiCell(70,7,utf8_decode('Firma de Conformidad'),0,'C',false);
            $this->SetFont('Arial','B',9);
            $this->MultiCell(60,7,utf8_decode('GRACIAS POR SU PREFERENCIA; M??S QUE TECNOLOG??A SOMOS COMUNICACI??N.'),1,'C',true); 
            mysqli_close($conn);
        }
    }
    $pdf = new PDF('P', 'mm', array(80,297));
    $pdf->SetTitle('Orden');
    $pdf->folioCliente();
    $pdf->Output('Orden','I');
?>