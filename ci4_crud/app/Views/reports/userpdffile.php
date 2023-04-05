<?php

use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('
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
');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('Schedule.pdf', array("Attachment" => false));
