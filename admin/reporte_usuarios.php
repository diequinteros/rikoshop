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
    $pdf->Cell(200, 10, 'Reporte de Usuarios', 0, 1, 'C');
    $sql = "SELECT * FROM usuarios ORDER BY id_usuario";
    $params = null;
    $data = Database::getRows($sql, $params);
    $pdf->Cell(60, 5, "ID", 0, 'R', 'C');
    $pdf->Cell(60, 5, "Usuario", 0, 'R', 'C');
    $pdf->Cell(60, 5, "Correo", 0, 'R', 'C');
    $pdf->Ln(10);
    foreach($data as $row){
        $id = $row['id_usuario'];
        $usuario = $row['usuario'];
        $correo = $row['email'];
        $pdf->SetFont('Arial', 'B', '10', 'C');
        $pdf->Cell(60, 5, $id, 0, 'R', 'C');
        $pdf->Cell(60, 5, $usuario, 0, 'R', 'C');
        $pdf->Cell(60, 5, $correo, 0, 'R', 'C');
        $pdf->Ln(10);
    }
    $pdf->Output('Reporte_Usuarios.pdf', 'd');
?>