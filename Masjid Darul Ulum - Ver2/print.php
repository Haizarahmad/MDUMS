<?php 
    require ("fpdf/fpdf.php");
    require "config.php";

    $expense_id = $_GET['Expense_id'];
    $sql = "SELECT * FROM expense INNER JOIN expense_type ON expense.Expense_Type = expense_type.expense_type_id WHERE expense.Expense_id = $expense_id;";
    $result = mysqli_query($conn, $sql);  // Assuming $conn is your database connection

    while ($row = mysqli_fetch_array($result)) {

        $type = $row['Expense_Type'];

        $pdf = new FPDF('L','mm',"A4");

        $pdf->AddPage();
        $pdf->setFont('Arial','',15);
        $pdf->Cell(275, 10, 'MASJID DARUL ULUM TAMAN DESA ILMU','LTR',1,'C');
        $pdf->setFont('Arial','BU',15);
        $pdf->Cell(275, 10, 'BAUCAR BAYARAN','LRB',1,'C');
        $pdf->setFont('Arial','',13);

        $pdf->Cell(40, 10, 'Tunai', 1, 0);
        $pdf->Rect(30, 32, 10, 5);
        $pdf->Cell(40, 10, 'ePayment', 1, 0); 
        $pdf->Rect(75, 32, 10, 5);

        if($row['payment_method'] == 'tunai'){
            $pdf->Line(32, 36, 38, 33, 10);
        }else{
            $pdf->Line(77, 36, 83, 33, 10);
        }

        $pdf->Cell(100, 10, 'No. Baucar: '.$row['Expense_id'], 1, 0); 
        $pdf->Cell(95, 10, 'Tarikh: ' . $row['Expense_Date'], 1, 1);

        $pdf->Cell(275, 10, 'Bayar Kepada: '.$row['Expense_To'], 'LR', 1);
        $pdf->Line(42, 48, 280, 48, 10);

        $pdf->Cell(50, 10, 'Amaun dibayar: ', 'TL', 0);
        $pdf->Cell(150, 10, 'Ringgit ', 'TB', 0);
        $pdf->Line(78, 58, 200, 58, 10);

        $pdf->Cell(75, 10, 'RM '.$row['Expense_Amount'], 1, 1);

        $pdf->Cell(275, 10, 'Tujuan Bayaran: '.$row['Expense_description'], 'LTR', 1);
        $pdf->Line(46, 68, 280, 68, 10);

        $pdf->Cell(275, 10, 'Tajuk Akaun Perbelanjaan: '.$row['expense_type'], 'BLR', 1);
        $pdf->Line(67, 78, 280, 78, 10);

        $pdf->Cell(137.5, 25, 'Disediakan Oleh: ', 'TLR', 0);
        $pdf->Cell(137.5, 25, 'Diluluskan Oleh: ', 'TLR', 1);
        $pdf->Cell(35, 10, '', 'LB', 0);
        $pdf->Cell(102.5, 10, $row['Expense_prepare'], 'BR', 0, 'C');
        $pdf->Cell(35, 10, '', 'LB', 0);
        $pdf->Cell(102.5, 10, $row['accepted_by'], 'BR', 1,'C');

        $pdf->Cell(275, 10, 'Saya mengesahkan pembayaran seperti di atas telah diterima.', 'LTR', 1);
        $pdf->Cell(275, 20, 'Tandatangan penerima:', 'LR', 1);
        $pdf->Line(62, 138, 200, 138, 10);
        $pdf->Cell(155, 20, 'Nama:', 'LB', 0);
        $pdf->Cell(120, 20, 'Tarikh:', 'RB', 0);

        $pdf->Output();
    }    

?>