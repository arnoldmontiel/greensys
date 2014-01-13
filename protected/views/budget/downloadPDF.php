<?php
ob_end_clean();

$mpdf=new mPDF('utf-8','A4');
$stylesheet = file_get_contents('css/bootstrap.min.css');
$stylesheet2 = file_get_contents('protected/views/layouts/estilos.php');
$mpdf->setHeader('{DATE j-m-Y}');
$mpdf->setFooter('{PAGENO}');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($stylesheet2,1);
$mpdf->WriteHTML($htmlCode,2);
$mpdf->Output();
?>