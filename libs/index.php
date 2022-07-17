<?php
//SHOW A DATABASE ON A PDF FILE
//CREATED BY: Carlos Vasquez S.
//E-MAIL: cvasquez@cvs.cl
//CVS TECNOLOGIA E INNOVACION
//SANTIAGO, CHILE

require('fpdf.php');

//Connect to your database
include("../db.php");

//Select the Products you want to show in your PDF file
$sql = "SELECT *
        FROM `issue` 
        INNER JOIN users 
            ON issue.borrower_id=users.id 
        INNER JOIN books
            ON issue.book_id=books.book_id 
        WHERE `date_returned` IS NULL";

$result = mysqli_query($conn, $sql);

$no_of_rows = mysqli_num_rows($result);

//Initialize the 3 columns and the total
$column_code = "";
$column_name = "";
$column_price = "";
$total = 0;

//For each row, add the field to the corresponding column
while($row = mysqli_fetch_array($result))
{
    $book_name = $row["book_name"]."\n";
    $author = substr($row["author"], 0 ,20)."\n";
    $issued = $row["issue_date"]."\n";
    $returned = $row["date_returned"]."\n";
    $fine = $row["fine"]."\n";

    // $column_code = $column_code.$code."\n";
    // $column_name = $column_name.$name."\n";
    // $column_price = $column_price.$price_to_show."\n";

    //Sum all the Prices (TOTAL)
    // $total = $total+$real_price;
}
mysqli_close($conn);

//Convert the Total Price to a number with (.) for thousands, and (,) for decimals.
// $total = number_format($total,',','.','.');

//Create a new PDF file
$pdf=new FPDF();
$pdf->AddPage();

//Fields Name position
$Y_Fields_Name_position = 20;
//Table position, under Fields Name
$Y_Table_Position = 26;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(20);
$pdf->Cell(60,6,'Book Name',1,0,'L',1);
$pdf->SetX(80);
$pdf->Cell(30,6,'Author',1,0,'L',1);
$pdf->SetX(110);
$pdf->Cell(30,6,'Issued',1,0,'L',1);
$pdf->SetX(140);
$pdf->Cell(30,6,'Returned',1,0,'L',1);
$pdf->SetX(170);
$pdf->Cell(20,6,'Fine',1,0,'L',1);
$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('Arial','',12);

// Book Name
$pdf->SetY($Y_Table_Position);
$pdf->SetX(20);
$pdf->MultiCell(60,6,$book_name,1);

// Author
$pdf->SetY($Y_Table_Position);
$pdf->SetX(80);
$pdf->MultiCell(30,6,$author,1);

// Issued
$pdf->SetY($Y_Table_Position);
$pdf->SetX(110);
$pdf->MultiCell(30,6,$issued,1,'L');

// Returned
$pdf->SetY($Y_Table_Position);
$pdf->SetX(140);
$pdf->MultiCell(30,6,$returned,1,'L');

// Fine
$pdf->SetY($Y_Table_Position);
$pdf->SetX(170);
$pdf->MultiCell(20,6,$fine,1,'L');

// $pdf->Ln();

// $pdf->SetX(135);
// $pdf->Cell(30,6,'$ '.$total,1,'R');

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $no_of_rows)
{
    $pdf->SetX(20);
    $pdf->MultiCell(170,6,'',1);
    $i = $i +1;
}

$pdf->Output();
?>