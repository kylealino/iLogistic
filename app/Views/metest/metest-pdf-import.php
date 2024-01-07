<?php
use \setasign\Fpdi\Fpdi;

$mefiles_path = ROOTPATH . 'public/uploads/mepdfs/';
$mefile = 'mesample-doc2.pdf';

require_once(ROOTPATH . 'app/ThirdParty/fpdf/fpdf.php');
require_once(ROOTPATH . 'app/ThirdParty/fpdi2/src/autoload.php');

// initiate FPDI
$pdf = new Fpdi();

// get the page count
$pageCount = $pdf->setSourceFile($mefiles_path . $mefile);
// iterate through all pages

for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
	// import a page
	$templateId = $pdf->importPage($pageNo);

	$pdf->AddPage();
	// use the imported page and adjust the page size
	$pdf->useTemplate($templateId, ['adjustPageSize' => true]);

	$pdf->SetFont('Helvetica');
	$pdf->SetXY(5, 15);
	$pdf->Write(8, 'A complete document imported with FPDI');
}

// Output the new PDF
$pdf->Output('D', 'metest-report.pdf');
//$pdf->Output();



?>
