<?php
require('fpdf/fpdf.php');

// Cria uma instância da classe FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Cabeçalho do relatório
$pdf->Cell(0, 10, 'Relatorio de Estoque', 0, 1, 'C');
$pdf->Ln(10);

// Cabeçalho da tabela
$pdf->Cell(40, 10, 'ID', 1);
$pdf->Cell(80, 10, 'SKU', 1);
$pdf->Cell(40, 10, 'Quantidade', 1);
$pdf->Ln();

// Conexão com o banco de dados
$link = mysqli_connect('localhost', 'root', 'breitkopf', 'testes');
mysqli_set_charset($link, "utf8mb4");

if (!$link) {
    die('Erro na conexão: ' . mysqli_connect_error());
}

// Consulta ao banco de dados
$sql = "SELECT * FROM estoque ORDER BY id ASC";
$consulta = mysqli_query($link, $sql);

if (!$consulta) {
    die('Erro na consulta: ' . mysqli_error($link));
}

// Preenchimento da tabela com os dados
while ($registro = mysqli_fetch_assoc($consulta)) {
    $pdf->Cell(40, 10, $registro["id"], 1);
    $pdf->Cell(80, 10, $registro["sku"], 1);
    $pdf->Cell(40, 10, $registro["quantidade"], 1);
    $pdf->Ln();
}

// Fecha a conexão com o banco de dados
mysqli_close($link);

// Gera e envia o PDF para o navegador
$pdf->Output();
?>
