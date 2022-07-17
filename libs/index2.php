<?php
require('mysql_table.php');
include("../db.php");
class PDF extends PDF_MySQL_Table
{
function Header()
{
    // Title
    $this->SetFont('Arial','',18);
    $this->Cell(0,6,'Books in circular',0,1,'C');
    $this->Ln(10);
    // Ensure table header is printed
    parent::Header();
}
}


$sql = "SELECT `books`.`book_id` AS BOOK_ID, 
                `books`.`author` AS AUTHOR, 
                `issue`.`issue_date` AS ISSUE_DATE
        FROM `issue` 
        INNER JOIN users 
            ON issue.borrower_id=users.id 
        INNER JOIN books
            ON issue.book_id=books.book_id 
        WHERE `date_returned` IS NULL";


$pdf = new PDF();
$pdf->AddPage();
$pdf->Table($conn, $sql);
$pdf->Output();
?>