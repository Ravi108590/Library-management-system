<?php
    
include('cookie_checker.php');
require('../libs/mc_table.php');
include("../db.php");

$id = $_COOKIE['id'];

$sql = "SELECT * 
FROM `issue`
INNER JOIN books
    ON issue.book_id=books.book_id 
WHERE `borrower_id` = '$id' AND `date_returned` IS NOT NULL";

$result = mysqli_query($conn, $sql);

$no_of_rows = mysqli_num_rows($result);

$pdf=new PDF_MC_Table();
$pdf->AddPage();

//Table with 20 rows and 4 columns
$pdf->SetWidths(array(15, 60, 40, 25, 25, 15));

$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 6, 'Issue History', 0, 1, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Row(array("ID", "Book Name", "Author", "Issued", "Returned", "Fine"));

$pdf->SetFont('Arial', '', 12);
while($row = mysqli_fetch_array($result))
{
    $book_id = $row["book_id"]."\n";
    $book_name = $row["book_name"]."\n";
    $author = $row["author"]."\n";
    $quantity = $row["issue_date"]."\n";
    $issued = $row["date_returned"]."\n";
    $fine = $row["fine"]."\n";

    $pdf->Row(array($book_id, $book_name, $author, $quantity, $issued, $fine));
}
$pdf->Output();
