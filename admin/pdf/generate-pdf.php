<?php
session_start();
require("../fpdf182/fpdf.php");

// Connect to your waste management database
$db = new PDO('mysql:host=localhost;dbname=mandera', 'root', ''); // change db name & credentials as needed

class myPDF extends FPDF {
    function header() {
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'STUDENT APPLICATION REPORT',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'Mandera CDF Bursary',0,0,'C');
        $this->Ln(20);
    }

    function footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function headerTable() {
        $this->SetFont('Times','B',12);
        $this->Cell(10,10,'#',1,0,'C');
        $this->Cell(30,10,'Fullname',1,0,'C');
        $this->Cell(25,10,'Reg N.O',1,0,'C');
        $this->Cell(35,10,'School Name',1,0,'C');
        $this->Cell(40,10,'Period Name',1,0,'C');
        $this->Cell(40,10,'Applied Amount',1,0,'C');
        $this->Cell(40,10,'Allocated Amount',1,0,'C');
        $this->Cell(30,10,'Status',1,0,'C');
        $this->Ln();
    }

    function viewTable($db) {
        $this->SetFont('Times','',11);
        $stmt = $db->query("SELECT * from `bursary_application` join students on  bursary_application.student_id=students.student_id join bursary_activity on bursary_application.bursary_id=bursary_activity.bursary_id");

        $counter = 1;
        while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $this->Cell(10,10,$counter++,1,0,'C');
            $this->Cell(30,10,$data->fullname,1,0,'L');
            $this->Cell(25,10,$data->reg_num,1,0,'C');
            $this->Cell(35,10,$data->school,1,0,'C');
            $this->Cell(40,10,$data->period_name,1,0,'L');
            $this->Cell(40,10,$data->total_amount,1,0,'C');
            $this->Cell(40,10,$data->given_amount,1,0,'C');
            $this->Cell(30,10,$data->a_status,1,0,'C');
            $this->Ln();
        }
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();
?>
