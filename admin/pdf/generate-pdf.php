<?php
session_start();
require("../fpdf182/fpdf.php");

$db = new PDO('mysql:host=localhost;dbname=mandera', 'root', '');

// ── COLLECT FILTERS FROM GET PARAMS ──
$status   = $_GET['status']   ?? '';
$school   = $_GET['school']   ?? '';
$period   = $_GET['period']   ?? '';
$year     = $_GET['year']     ?? '';
$name     = $_GET['name']     ?? '';
$location = $_GET['location'] ?? '';

// ── BUILD WHERE CLAUSE ──
$where = [];
if(!empty($status))   $where[] = "ba.a_status = " . $db->quote($status);
if(!empty($school))   $where[] = "s.school = " . $db->quote($school);
if(!empty($period))   $where[] = "act.period_name = " . $db->quote($period);
if(!empty($year))     $where[] = "act.p_year = " . $db->quote($year);
if(!empty($name))     $where[] = "s.fullname LIKE " . $db->quote('%' . $name . '%');
if(!empty($location)) $where[] = "(ba.r_location LIKE " . $db->quote('%' . $location . '%') . " OR ba.residence LIKE " . $db->quote('%' . $location . '%') . ")";
$whereSQL = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";

// ── BUILD REPORT TITLE based on filters ──
$reportTitle = "STUDENT BURSARY APPLICATION REPORT";
$subTitle    = "Mandera North CDF Bursary";
$filterDesc  = [];
if(!empty($status))   $filterDesc[] = "Status: $status";
if(!empty($school))   $filterDesc[] = "School: $school";
if(!empty($period))   $filterDesc[] = "Period: $period";
if(!empty($year))     $filterDesc[] = "Year: " . ($year - 1) . "/$year";
if(!empty($name))     $filterDesc[] = "Student: $name";
if(!empty($location)) $filterDesc[] = "Location: $location";
$filterText = !empty($filterDesc) ? "Filters: " . implode(" | ", $filterDesc) : "All Records";

class myPDF extends FPDF {

    public $reportTitle = '';
    public $subTitle    = '';
    public $filterText  = '';

    function header() {
        // Logo
        // $this->Image('../../images/newlogo.png', 10, 8, 25);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(276, 6, $this->reportTitle, 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times', '', 12);
        $this->Cell(276, 6, $this->subTitle, 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', 'I', 9);
        $this->Cell(276, 6, $this->filterText, 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(276, 5, 'Generated on: ' . date('d/m/Y H:i:s'), 0, 0, 'C');
        $this->Ln(10);
    }

    function footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}   |   Mandera North CDF Bursary System', 0, 0, 'C');
    }

    function headerTable() {
        $this->SetFont('Times', 'B', 10);
        $this->SetFillColor(52, 58, 64);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(8,  10, '#',            1, 0, 'C', true);
        $this->Cell(35, 10, 'Full Name',    1, 0, 'C', true);
        $this->Cell(28, 10, 'Reg No.',      1, 0, 'C', true);
        $this->Cell(30, 10, 'School',       1, 0, 'C', true);
        $this->Cell(30, 10, 'Period',       1, 0, 'C', true);
        $this->Cell(22, 10, 'Acad. Year',   1, 0, 'C', true);
        $this->Cell(30, 10, 'Applied(KSh)', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Given(KSh)',   1, 0, 'C', true);
        $this->Cell(23, 10, 'Status',       1, 0, 'C', true);
        $this->SetTextColor(0, 0, 0);
        $this->Ln();
    }

    function viewTable($db, $whereSQL) {
        $this->SetFont('Times', '', 10);
        $stmt = $db->query("SELECT ba.*, s.fullname, s.school, act.period_name, act.p_year
                            FROM bursary_application ba
                            JOIN students s ON ba.student_id = s.student_id
                            JOIN bursary_activity act ON ba.bursary_id = act.bursary_id
                            $whereSQL
                            ORDER BY s.fullname ASC");

        $counter = 1;
        $fill = false;
        while($data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $yr = intval($data->p_year);
            $academic_year = ($yr - 1) . '/' . $yr;
            $given = $data->given_amount ?? 0;

            // Alternate row colors
            if($fill) {
                $this->SetFillColor(240, 240, 240);
            } else {
                $this->SetFillColor(255, 255, 255);
            }

            $this->Cell(8,  8, $counter++,                    1, 0, 'C', $fill);
            $this->Cell(35, 8, $data->fullname,               1, 0, 'L', $fill);
            $this->Cell(28, 8, $data->reg_num,                1, 0, 'C', $fill);
            $this->Cell(30, 8, $data->school,                 1, 0, 'C', $fill);
            $this->Cell(30, 8, $data->period_name,            1, 0, 'L', $fill);
            $this->Cell(22, 8, $academic_year,                1, 0, 'C', $fill);
            $this->Cell(30, 8, number_format($data->total_amount, 2), 1, 0, 'R', $fill);
            $this->Cell(30, 8, number_format($given, 2),      1, 0, 'R', $fill);
            $this->Cell(23, 8, $data->a_status,               1, 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }

        // Totals row
        $totals = $db->query("SELECT SUM(ba.total_amount) as total_applied, SUM(ba.given_amount) as total_given
                              FROM bursary_application ba
                              JOIN students s ON ba.student_id = s.student_id
                              JOIN bursary_activity act ON ba.bursary_id = act.bursary_id
                              $whereSQL")->fetch(PDO::FETCH_OBJ);

        $this->SetFont('Times', 'B', 10);
        $this->SetFillColor(200, 220, 255);
        $this->Cell(153, 8, 'TOTALS', 1, 0, 'R', true);
        $this->Cell(30, 8, 'KSh ' . number_format($totals->total_applied ?? 0, 2), 1, 0, 'R', true);
        $this->Cell(30, 8, 'KSh ' . number_format($totals->total_given ?? 0, 2),   1, 0, 'R', true);
        $this->Cell(23, 8, '',  1, 0, 'C', true);
        $this->Ln();
    }
}

$pdf = new myPDF();
$pdf->reportTitle = $reportTitle;
$pdf->subTitle    = $subTitle;
$pdf->filterText  = $filterText;
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->headerTable();
$pdf->viewTable($db, $whereSQL);
$pdf->Output();
?>
