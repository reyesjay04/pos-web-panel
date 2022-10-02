<?php session_start();
require('../../resources/fpdf/fpdf.php');

$array = explode(' - ', $_POST['dateval']);
$Count = 0;

foreach($array as $value) {
    if($Count == 0 ) {
        $Date1 = $value;
    } elseif ($Count > 0) {
        $Date2 = $value;
    }
$Count += 1;
}

$Date1 = date_create($Date1);
$Date1 = date_format($Date1,"Y-m-d");
$Date2 = date_create($Date2);
$Date2 = date_format($Date2,"Y-m-d");


$sums = array();
$Walk = 0;
$Register = 0;
$GCash = 0;
$Grab = 0;
$Paymaya = 0;
$Lalafood = 0;
$RepExpenses = 0;
$FoodPanda = 0;
$Others = 0;

include('../../resources/functions.php');
//-------------------------------------------------Daily Transaction
$sql = "SELECT grosssales, transaction_type FROM  posrev.admin_daily_transaction WHERE guid = '".$_POST["guid"]."' AND zreading >= '".$Date1."' and zreading <= '".$Date2."'";

$result = query($sql);
while ($row = mysqli_fetch_array($result)) {

    if (strcmp($row['transaction_type'],'Walk-In') == 0 ) {
        $Walk += 1;
    } 
    if (strcmp($row['transaction_type'],'Registered') == 0) {
        $Register += 1;
    } 
    if ($row['transaction_type'] == 'GCash') {
         $GCash += 1;
    } 
    if ($row['transaction_type'] == 'Grab') {
         $Grab += 1;
    } 
    if ($row['transaction_type'] == 'Paymaya') {
         $Paymaya += 1;
    } 
    if ($row['transaction_type'] == 'Lalafood') {
         $Lalafood += 1;
    } 
    if ($row['transaction_type'] == 'Representation Expenses') {
         $RepExpenses += 1;
    } 
    if ($row['transaction_type'] == 'Food Panda') {
         $FoodPanda += 1;
    } 
    if ($row['transaction_type'] == 'Others') {
        $Others += 1;
    }
}
class PDF extends FPDF
{
protected $col = 0; // Current column
protected $y0;      // Ordinate of column start

function Header()
{
    // Page header
    global $title;

    $this->SetFont('Arial','B',15);
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
    $this->SetDrawColor(255,255,255);
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0,0,0);
    $this->SetLineWidth(1);
    $this->Cell($w,9,$title,1,1,'C',true);
    $this->Ln(10);
    // Save ordinate
    $this->y0 = $this->GetY();
}

function Footer()
{
    // Page footer
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->SetTextColor(128);
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

function SetCol($col)
{
    // Set position at a given column
    $this->col = $col;
    $x = 10+$col*65;
    $this->SetLeftMargin($x);
    $this->SetX($x);
}

function AcceptPageBreak()
{
    // Method accepting or not automatic page break
    if($this->col<2)
    {
        // Go to next column
        $this->SetCol($this->col+1);
        // Set ordinate to top
        $this->SetY($this->y0);
        // Keep on page
        return false;
    }
    else
    {
        // Go back to first column
        $this->SetCol(0);
        // Page break
        return true;
    }
}

function ChapterTitle($num, $label)
{
    // Title
    $this->SetFont('Arial','',12);
    $this->SetFillColor(200,220,255);
    $this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
    $this->Ln(4);
    // Save ordinate
    $this->y0 = $this->GetY();
}

function ChapterBody($file)
{
    // Read text file
    $txt = file_get_contents($file);
    // Font
    $this->SetFont('Times','',12);
    // Output text in a 6 cm width column
    $this->MultiCell(60,5,$txt);
    $this->Ln();
    // Mention
    $this->SetFont('','I');
    $this->Cell(0,5,'(end of excerpt)');
    // Go back to first column
    $this->SetCol(0);
}

function PrintChapter($num, $title, $file)
{
    // Add chapter
    $this->AddPage();
    $this->ChapterTitle($num,$title);
    $this->ChapterBody($file);
}
}

$pdf = new PDF();
$title = 'Innovention | Transaction Types';
$pdf->SetTitle($title);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Text(10,45,'Types:');
$pdf->Text(10,50,'Walk-In');
$pdf->Text(10,60,'Registered');
$pdf->Text(10,70,'GCash');
$pdf->Text(10,80,'Grab');
$pdf->Text(10,90,'Paymaya');
$pdf->Text(10,100,'Lalafood');
$pdf->Text(10,110,'Rep. Expenses');
$pdf->Text(10,120,'Food Panda');
$pdf->Text(10,130,'Others');

$pdf->Text(50,50,$Walk);
$pdf->Text(50,60,$Register);
$pdf->Text(50,70,$GCash);
$pdf->Text(50,80,$Grab);
$pdf->Text(50,90,$Paymaya);
$pdf->Text(50,100,$Lalafood);
$pdf->Text(50,110,$RepExpenses);
$pdf->Text(50,120,$FoodPanda);
$pdf->Text(50,130,$Others);

$Filename = $pdf->Output('F');;

echo $Filename;
?>
