<?php

session_start();
//include("includes/dbconnection.php");

require("../fpdf182/fpdf.php");

//database connection

$db = new PDO('mysql:host=localhost;dbname=edms','root','');



class myPDF extends FPDF{

function header(){

          //$this->Image('log.jpg',20,16);
          $this->SetFont('Arial','B',14);
          $this->Cell(276,5,'EXAM DISCIPLINARY MANGEMENT SYSTEM',0,0,'C');
          $this->Ln();
          $this->SetFont('Times','',12);
          $this->Cell(276,10,'Case Appeals Statement',0,0,'C');
          $this->Ln(20);

}

 function footer(){

       $this->SetY(-15);
       $this->SetFont('Arial','',8);
       $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
 }

  function headerTable(){

           $this->SetFont('Times','B',12);
           $this->Cell(20,10,'#',1,0,'C');
           $this->Cell(40,10,'Case Number',1,0,'C');
           $this->Cell(60,10,'Case Verdict',1,0,'C');
           $this->Cell(80,10,'Apppeal Number',1,0,'C');
           $this->Cell(40,10,'Apppeal Date',1,0,'C');
           $this->Cell(40,10,'Appeal Status',1,0,'C');
           $this->Ln();
  }

  function ViewTable($db){

      $this->SetFont('Times','',12);

      //$start_da = $_POST['startDate'];
      //$end_da =   $_POST['endDate'];

      //$stmt = $db->query("select * from orders where order_date >='$search' and order_date <='$end_se'");
      //$stmt = $db->query("select * from orders join payment on orders.order_id=payment.order_id where order_date >= '$start_da' and order_date <= '$end_da' and o_state=5");
      $stmt=$db->query("select * from tblcomplaints join appeal on tblcomplaints.complaintNumber=appeal.complaintNumber");
      $counter = 1;

      while($data = $stmt->fetch(PDO::FETCH_OBJ)){

        $this->Cell(20,10,$counter,1,0,'C');
        $counter++;
        $this->Cell(40,10,$data->complaintNumber,1,0,'C');
        $this->Cell(60,10,$data->remarks,1,0,'L');
        $this->Cell(80,10,$data->appeal_id,1,0,'L');
        $this->Cell(40,10,$data->regdate,1,0,'L');
        $this->Cell(40,10,$data->status,1,0,'L');
        $this->Ln();
      }
  }


}

  $pdf = new myPDF();
  $pdf->AliasNbPages();
  $pdf->AddPage('L','A4',0);
  $pdf->headerTable();
  $pdf->ViewTable($db);
  $pdf->Output();

 ?>
