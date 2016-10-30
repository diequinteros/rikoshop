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
    $pdf->Cell(200, 10, 'Reporte de Productos', 0, 1, 'C');
    $sql = "SELECT * FROM productos ORDER BY id_producto";
    $params = null;
    $data = Database::getRows($sql, $params);
    $pdf->Cell(50, 5, "Nombre", 0, 'R', 'C');
    $pdf->Cell(50, 5, "Descripcion", 0, 'R', 'C');
    $pdf->Cell(50, 5, "Precio", 0, 'R', 'C');
    $pdf->Cell(50, 5, "Existencias", 0, 'R', 'C');
    $pdf->Ln(10);
    foreach($data as $row){
        $nombre = $row['nombre_producto'];
        $descripcion = $row['descripcion_pro'];
        $precio = $row['precio'];
        $existencia = $row['existencia'];
        $pdf->SetFont('Arial', 'B', '10', 'C');
        $pdf->Cell(50, 5, $nombre, 0, 'R', 'C');
        $pdf->Cell(50, 5, $descripcion, 0, 'R', 'C');
        $pdf->Cell(50, 5, $precio, 0, 'R', 'C');
        $pdf->Cell(50, 5, $existencia, 0, 'R', 'C');
        $pdf->Ln(10);
    }
    $pdf->Output('Reporte_Productos.pdf', 'd');
?>