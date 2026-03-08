<?php

session_start();
//include("includes/dbconnection.php");

require("../fpdf182/fpdf.php");

//database connection

$db = new PDO('mysql:host=localhost;dbname=church_db','root','');



class myPDF extends FPDF{

function header(){

          //$this->Image('log.jpg',20,16);
          $this->SetFont('Arial','B',14);
          $this->Cell(276,5,'PROJECT CONTRIBUTION LISTS',0,0,'C');
          $this->Ln();
          $this->SetFont('Times','',12);
          $this->Cell(276,10,'Member Support',0,0,'C');
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
           $this->Cell(40,10,'Email ',1,0,'C');
           $this->Cell(80,10,'Amount Contributed',1,0,'C');
           $this->Cell(80,10,'M-pesa Code',1,0,'C');
           $this->Cell(60,10,'Contribution Date & Time',1,0,'C');
           $this->Ln();
  }

  function ViewTable($db){

      $this->SetFont('Times','',12);

    

      $stmt=$db->query("SELECT procontributions.*, members.email FROM procontributions 
                        JOIN members ON procontributions.member_id = members.member_id");
      $counter = 1;

      while($data = $stmt->fetch(PDO::FETCH_OBJ)){

        $this->Cell(20,10,$counter,1,0,'C');
        $counter++;
        $this->Cell(40,10,$data->email,1,0,'C');
        $this->Cell(80,10,$data->amount_contributed,1,0,'L');
        $this->Cell(80,10,$data->mpesa_code,1,0,'L');
        $this->Cell(60,10,$data->created_at,1,0,'L');
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
