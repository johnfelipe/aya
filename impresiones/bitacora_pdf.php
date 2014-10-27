<?php
include("../Connections/cx.php");
require_once('../scrips/Cezpdf/class.ezpdf.php');
extract($_REQUEST);
$pdf =& new Cezpdf('LETTER');
$pdf->selectFont('../scrips/Cezpdf/fonts/Courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
$a=base64_decode($q_zl1);
$conexion = mysql_connect($hostname_cx, $username_cx, $password_cx );
mysql_select_db($database_cx , $conexion);
$queEmp = "SELECT * FROM bitacora ";
$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);

$ixx = 0;
while($datatmp = mysql_fetch_assoc($resEmp)) { 
	$ixx = $ixx+1;
	/*$part=explode(' ',$datatmp['stamp']);
	$d=explode('-',$part[0]);
	
	$datea=$d[2].'-'.$d[1].'-'.$d[0];
	
	*/
	$data[] = array_merge(array('num'=>$ixx),array('a'=>$datatmp['stamp']),array('b'=>$datatmp['text']));
}
$titles = array(
				'num'=>'<b>Nº</b>',
				'a'=>'<b>Fecha y Hora</b>',
				'b'=>'<b>Descripción</b>',

			);
$options = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);
$txttit = "<b>Bitacora</b>\n";
$txttit.= "Aplicacion Actas y Acuerdos \n";

$pdf->ezText($txttit, 12);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
ob_end_clean();
$pdf->ezStream();
?>