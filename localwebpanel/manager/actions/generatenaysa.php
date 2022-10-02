<?php

require '../../resources/functions.php';
$storeid = $_GET['storeid'];

$query = "SELECT MIN FROM admin_outlets WHERE store_id = $storeid";
$res = mysqli_query($connection, $query);
$fetchrow = mysqli_fetch_array($res);
$MIN = $fetchrow['MIN'];

$inv_arr = array();

$sql = "SELECT DATE_FORMAT(`date`, '%m/%d/%Y') as DATEF, stock_primary, sku FROM admin_pos_inventory WHERE store_id = $storeid ";
// echo $sql;
$result = mysqli_query($connection, $sql);
$Count = 2;
while ($row = mysqli_fetch_array($result)) { 
    $inv_arr[] = array("Date" => $row['DATEF'], "MIN" => $MIN, "SKU" => $row['sku'], "Qty" => $row['stock_primary'], "Paycode" => "", "UnitPrice" => "0", "Gross" => "0", "Disc" => "0", "Vat" => "0" );
    $Count += 1;
}

require '../../resources/phpoffice/vendor/autoload.php';
//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\IOFactory;
//phpspreadsheet Date class
use PhpOffice\PhpSpreadsheet\Shared\Date;
//phpspreadsheet numberformat style class
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
//rich text class
use \PhpOffice\PhpSpreadsheet\RichText\RichText;
//phpspreadsheet style color
use \PhpOffice\PhpSpreadsheet\Style\Color;

use \PhpOffice\PhpSpreadsheet\Style\Borders;

use \PhpOffice\PhpSpreadsheet\Style\Style;
//make a new spreadsheet object
$spreadsheet = new Spreadsheet();
//get current active sheet (first sheet)
$sheet = $spreadsheet->getActiveSheet();
//set default font
$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri')->setSize(11);
//set column dimension to auto size
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
//simple text data
$spreadsheet->getActiveSheet()
			->setCellValue('A4',"MIN");								
$spreadsheet->getActiveSheet()
			->setCellValue('A5',"ITEM_NO");
$spreadsheet->getActiveSheet()
			->setCellValue('A6',"QUANTITY");
$spreadsheet->getActiveSheet()
			->setCellValue('A7',"PAY_CODE");
$spreadsheet->getActiveSheet()
			->setCellValue('A8',"UNIT_PRICE");
$spreadsheet->getActiveSheet()
			->setCellValue('A9',"GROSS_AMOUNT");
$spreadsheet->getActiveSheet()
			->setCellValue('A10',"DISCOUNT_AMOUNT");
$spreadsheet->getActiveSheet()
			->setCellValue('A11',"VAT_AMOUNT");

$richText = new RichText();
$payable = $richText->createTextRun('FIELD_NAME');
$payable->getFont()->setBold(true);
$payable->getFont()->setColor( new Color( Color::COLOR_BLACK) );
$spreadsheet->getActiveSheet()->getCell('A2')->setValue($richText);

$richText = new RichText();
$payable = $richText->createTextRun('DATE');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('A3')->setValue($richText);

//simple text data
$spreadsheet->getActiveSheet()->setCellValue('B4',"TEXT");								
$spreadsheet->getActiveSheet()->setCellValue('B5',"TEXT");
$spreadsheet->getActiveSheet()->setCellValue('B6',"NUMBER");
$spreadsheet->getActiveSheet()->setCellValue('B7',"TEXT");
$spreadsheet->getActiveSheet()->setCellValue('B8',"NUMBER");
$spreadsheet->getActiveSheet()->setCellValue('B9',"NUMBER");
$spreadsheet->getActiveSheet()->setCellValue('B10',"NUMBER");
$spreadsheet->getActiveSheet()->setCellValue('B11',"NUMBER");

$richText = new RichText();
$payable = $richText->createTextRun('FIELD TYPE');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('B2')->setValue($richText);

$richText = new RichText();
$payable = $richText->createTextRun('DATE');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('B3')->setValue($richText);

$richText = new RichText();
$payable = $richText->createTextRun('LENGTH');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('C2')->setValue($richText);

$spreadsheet->getActiveSheet()
			->setCellValue('C4',"50");								
$spreadsheet->getActiveSheet()
			->setCellValue('C5',"25");
$spreadsheet->getActiveSheet()
			->setCellValue('C7',"5");

$richText = new RichText();
$payable = $richText->createTextRun('Required');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('D2')->setValue($richText);

$richText = new RichText();
$payable = $richText->createTextRun('YES');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('D3')->setValue($richText);

$richText = new RichText();
$payable = $richText->createTextRun('YES');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('D4')->setValue($richText);

$richText = new RichText();
$payable = $richText->createTextRun('YES');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('D5')->setValue($richText);

$richText = new RichText();
$payable = $richText->createTextRun('YES');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('D6')->setValue($richText);

$richText = new RichText();
$payable = $richText->createTextRun('YES');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('D7')->setValue($richText);

$richText = new RichText();
$payable = $richText->createTextRun('YES');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('D8')->setValue($richText);

$richText = new RichText();
$payable = $richText->createTextRun('YES');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('D9')->setValue($richText);

$richText = new RichText();
$payable = $richText->createTextRun('YES');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('D10')->setValue($richText);

$richText = new RichText();
$payable = $richText->createTextRun('YES');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('D11')->setValue($richText);

$richText = new RichText();
$payable = $richText->createTextRun('Description');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('E2')->setValue($richText);

$spreadsheet->getActiveSheet()->setCellValue('E3',"Transaction Date");		
$spreadsheet->getActiveSheet()->setCellValue('E4',"POS INFO");							
$spreadsheet->getActiveSheet()->setCellValue('E5',"Item Code/Product Code");
$spreadsheet->getActiveSheet()->setCellValue('E6',"Quantity Purchase , Negative Quantity for Return or Exchange");
$spreadsheet->getActiveSheet()->setCellValue('E7',"Check Value in POS_PAYTYPE");
$spreadsheet->getActiveSheet()->setCellValue('E8',"VAT Inclusive");
$spreadsheet->getActiveSheet()->setCellValue('E9',"Quantity * Unit Price");
$spreadsheet->getActiveSheet()->setCellValue('E10',"Zero if Blank");
$spreadsheet->getActiveSheet()->setCellValue('E11',"Zero if Blank");

$styleArray = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$styleArray1 = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$spreadsheet->getActiveSheet()->getStyle('H2:P2')->applyFromArray($styleArray);

$spreadsheet->getActiveSheet()->getStyle('H3:H'.$Count)->applyFromArray($styleArray1);
$spreadsheet->getActiveSheet()->getStyle('I3:I'.$Count)->applyFromArray($styleArray1);
$spreadsheet->getActiveSheet()->getStyle('J3:J'.$Count)->applyFromArray($styleArray1);
$spreadsheet->getActiveSheet()->getStyle('K3:K'.$Count)->applyFromArray($styleArray1);
$spreadsheet->getActiveSheet()->getStyle('L3:L'.$Count)->applyFromArray($styleArray1);
$spreadsheet->getActiveSheet()->getStyle('M3:M'.$Count)->applyFromArray($styleArray1);
$spreadsheet->getActiveSheet()->getStyle('N3:N'.$Count)->applyFromArray($styleArray1);
$spreadsheet->getActiveSheet()->getStyle('O3:O'.$Count)->applyFromArray($styleArray1);
$spreadsheet->getActiveSheet()->getStyle('P3:P'.$Count)->applyFromArray($styleArray1);

$richText = new RichText();
$payable = $richText->createTextRun('DATE');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('H2')->setValue($richText);	

$richText = new RichText();
$payable = $richText->createTextRun('MIN');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('I2')->setValue($richText);	

$richText = new RichText();
$payable = $richText->createTextRun('ITEM_NO');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('J2')->setValue($richText);	

$richText = new RichText();
$payable = $richText->createTextRun('QUANTITY');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('K2')->setValue($richText);	

$richText = new RichText();
$payable = $richText->createTextRun('PAY_CODE');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('L2')->setValue($richText);	

$richText = new RichText();
$payable = $richText->createTextRun('UNIT_PRICE');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('M2')->setValue($richText);	

$richText = new RichText();
$payable = $richText->createTextRun('GROSS_AMOUNT');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('N2')->setValue($richText);	

$richText = new RichText();
$payable = $richText->createTextRun('DISCOUNT_AMOUNT');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('O2')->setValue($richText);	

$richText = new RichText();
$payable = $richText->createTextRun('VAT_AMOUNT');
$payable->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getCell('P2')->setValue($richText);	

$arrayData = [
    [NULL, 2010, 2011, 2012],
    ['Q1',   12,   15,   21],
    ['Q2',   56,   73,   86],
    ['Q3',   52,   61,   69],
    ['Q4',   30,   32,    0],
];
$spreadsheet->getActiveSheet()
    ->fromArray(
        $inv_arr,  // The data to set
        NULL,        // Array values with this value will not be set
        'H3'         // Top left coordinate of the worksheet range where
                     //    we want to set these values (default is A1)
    );

//change worksheet name
$spreadsheet->getActiveSheet()
			->setTitle('EXCEL Uploading Template');
//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename="POS INTERFACING '.date("YmdHis").' .xlsx"');
//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');

// echo "EXCEL Uploading Template";
