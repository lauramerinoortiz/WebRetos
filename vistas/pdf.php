<?php
require_once('../controladores/controladorcategorias.php');
$controladorCategorias=new ControladorCategorias();
$datos=$controladorCategorias->consultar();

require_once('../fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Categorías', 1, 1, 'C');

while($linea = $datos ->fetch_assoc()){
    $nombre=$linea['nombre'];
    $id=$linea['idcategoria'];
    $pdf->Cell(40,10,$nombre, 1, 1, 'C');
}
$pdf->Output();
?>