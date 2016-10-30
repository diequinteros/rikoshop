<?php
    require('../../bibliotecas/fpdf181/fpdf.php');
    require("../../bibliotecas/database.php");
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Cell(50, 20,$pdf->Image('../../img/lenny.png',30,12,30),0,'C');
    $pdf->Cell(50, 10, 'RikoShop', 0,0, 'C');
    $pdf->Ln(20);
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(200, 10, 'Reporte de Marcas', 0, 1, 'C');
    $sql = "SELECT * FROM marcas ORDER BY id_marca";
    $params = null;
    $data = Database::getRows($sql, $params);
    foreach($data as $row){
        $marca = $row['marca'];
        $pdf->SetFont('Arial', 'B', '10', 'C');
        $pdf->Cell(200, 5, $marca, 0, 1, 'C');
    }
    $pdf->Output('Reporte_Marcas.pdf', 'd');
?>