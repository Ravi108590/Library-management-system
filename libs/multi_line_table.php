<?php
require('mc_table.php');
include("../db.php");

//Select the Products you want to show in your PDF file
$sql = "SELECT *
        FROM `books`";

$result = mysqli_query($conn, $sql);

$no_of_rows = mysqli_num_rows($result);

$pdf=new PDF_MC_Table();
$pdf->AddPage();
//Table with 20 rows and 4 columns
$pdf->SetWidths(array(15, 80, 40, 25, 25));
srand(1000000);

$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 6, 'Statistics', 0, 1, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Row(array("ID", "Book Name", "Author", "Quantity", "Issued"));

$pdf->SetFont('Arial', '', 12);
while($row = mysqli_fetch_array($result))
{
    $book_id = $row["book_id"]."\n";
    $book_name = $row["book_name"]."\n";
    $author = $row["author"]."\n";
    $quantity = $row["quantity"]."\n";
    $issued = $row["issued"]."\n";

    $pdf->Row(array($book_id, $book_name, $author, $quantity, $issued));
}
$pdf->Output();
?>