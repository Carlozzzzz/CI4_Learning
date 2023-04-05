<?php

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Author');
$pdf->SetTitle('Schedule');
$pdf->SetSubject('Schedule');
$pdf->SetKeywords('Schedule');

$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Schedule', 'By: Author', array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->SetFont('dejavusans', '', 12, '', true);

$pdf->AddPage();

$html = '
<html>
<head>
	<title>Schedule</title>
	<meta charset="utf-8">
</head>
<body>
	<table cellpadding="5">
		<tr>
			<td style="font-size:14px;padding:15px; width:100px; background-color: #696969; color: #f0fff0;"><b>Time</b></td>
			<td style="font-size:14px;padding:15px; width:120px; background-color: #696969; color: #f0fff0;"><b>Day(s)</b></td>
		</tr>
		'.implode('', array_map(function($value) {
			return '
			<tr>
				<td><b>'.$value['firstname'].'</b></td>
				<td>'.$value['lastname'].'</td>
			</tr>
			<tr>
				<td colspan="6"><hr></td>
			</tr>';
		}, $data_recordfile)).'
		<tr>
			<td colspan="6" style="text-align: center;"><br><br><i>- - - Nothing follows - - -</i></td>
		</tr>
	</table>
</body>
</html>
';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Schedule.pdf', 'I');
exit();
