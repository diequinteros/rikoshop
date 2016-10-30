<?php
    require('../bibliotecas/fpdf181/fpdf.php');
    require("../bibliotecas/database.php");
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Cell(50, 20,$pdf->Image('../img/lenny.png',30,12,30),0,'C');
    $pdf->Cell(50, 10, 'RikoShop', 0,0, 'C');
    $pdf->Ln(20);
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(200, 10, 'Reporte de Ventas', 0, 1, 'C');
    $sql = "SELECT * FROM ventas, usuarios WHERE ventas.id_usuario = usuarios.id_usuario ORDER BY id_venta";
    $params = null;
    $data = Database::getRows($sql, $params);
    $pdf->Cell(60, 5, "Realizada por", 0, 'R', 'C');
    $pdf->Cell(60, 5, "Total", 0, 'R', 'C');
    $pdf->Cell(60, 5, "Fecha", 0, 'R', 'C');
    $pdf->Ln(10);
    foreach($data as $row){
        $usuario = $row['usuario'];
        $total = $row['total'];
        $fecha = $row['Fecha'];
        $pdf->SetFont('Arial', 'B', '10', 'C');
        $pdf->Cell(60, 5, $usuario, 0, 'R', 'C');
        $pdf->Cell(60, 5, $total, 0, 'R', 'C');
        $pdf->Cell(60, 5, $fecha, 0, 'R', 'C');
        $pdf->Ln(10);
    }
    $pdf->Output('Reporte_Ventas.pdf', 'd');
?>