<?php

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Potato CI4 Tutorial');
$pdf->SetTitle('Student List');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$xotherdata = "San Jose, Batangas\nTel. No. (000) 000 000\nStudent List";

$pdf->SetHeaderData("logo.png", 16, 'Potato CI4 Tutorial', $xotherdata);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 9));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// remove default header/footer
// $pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(10);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 10);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$pdf->SetFont('helvetica', '', 8);

// ---------------------------------------------------------
// add a page
$pdf->AddPage();
$xobj = "";

	$xobj .= "<table cellpadding=\"3\">";

	if(count($data_datatablefile1) > 0)
	{
	    $xobj .= "<tr>";
	    	$xobj .= "<td style=\"padding:15px; width:660px; border: 1px solid black; text-align: center;\"><b>STUDENT LIST</b></td>";
	    $xobj .= "</tr>";

	    $xobj .= "<tr>";
    		$xobj .= "<td style=\"padding:15px; width:40px; border: 1px solid black; text-align:center;\"><b>#</b></td>";
    		$xobj .= "<td style=\"padding:15px; width:100px; border: 1px solid black; text-align:center;\"><b>Student No.</b></td>";
    		$xobj .= "<td style=\"padding:15px; width:520px; border: 1px solid black; text-align:center;\"><b>Student Name</b></td>";
	    $xobj .= "</tr>";


	    foreach ($data_datatablefile1 as $key => $value) 
	    {
		    $xobj .= "<tr>";
	    		$xobj .= "<td style=\"padding:15px; width:40px; border-left: 1px solid black; text-align:center;\">".($key+1)."</td>";
	    		$xobj .= "<td style=\"padding:15px; width:100px; border-left: 1px solid black; text-align: center;\">{$value['studentid']}</td>";
	    		$xobj .= "<td style=\"padding:15px; width:520px; border-left: 1px solid black;border-right: 1px solid black;\">{$value['lastname']} {$value['suffix']}, {$value['firstname']} {$value['middlename']}</td>";
		    $xobj .= "</tr>";
	    }

	    $xobj .= "<tr>";
    		$xobj .= "<td style=\"text-align: center; width:660px; border-top: 1px solid black;\"><br><br><br><i>- - - Nothing follows - - -</i></td>";
    	$xobj .= "</tr>";
		
	}
	else
	{
	    $xobj .= "<tr>";
    		$xobj .= "<td style=\"text-align: center; width:660px;\"><br><br><br><i>- - - No record found - - -</i></td>";
    	$xobj .= "</tr>";
	}

	$xobj .= "</table>";

// output the HTML content
$pdf->writeHTML($xobj, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Schedule.pdf', 'I');
exit();
//============================================================+
// END OF FILE
//============================================================+

?>