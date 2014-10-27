<?php
//lib ára crear pdf
include("../scrips/pdf_lib/fpdf.php");
//concexion
include("../Connections/cx.php");
//agregar libreria para combertir numeros
include("../scrips/numero_letra_lib/numero_letra.php");

//lib numeros a romanos
include("../scrips/romanos_lib/romano_class.php");
extract($_REQUEST);




//encab encabeza de fpdf error al utilizar caracteres utf8 problema con justificacion
class PDF extends FPDF
{
	//Cabecera de página
	function Header()
	{
		/*//Logo
		$this->Image('../img/logo1.gif',19,8,25);
		$this->Image('../img/logo2.gif',170,8,30);
		//Arial bold 15
		$this->SetFont('Arial','B',12);
		//Movernos a la derecha
		$this->Ln(5);*/
		
		//Logo
		$this->Image('../img/logo1.gif',19,8,25);
		$this->Image('../img/logo2.gif',170,10,30);
		$this->Image('../img/bandera.jpg',19,42,180,3);
		//Arial bold 15
		//Arial bold 15
    $this->SetFont('Arial','B',15);
    //Movernos a la derecha
	$this->Ln(20);
    $this->Cell(40);
    //Título
  		$this->Cell(80,5,utf8_decode('ALCALDÍA MUNICIPAL DE USULUTÁN'),0,0,'C');
		$this->Ln();
		$this->SetFont('Arial','B',12);
		$this->Cell(40);
		$this->Cell(80,5,utf8_decode('UNIDOS POR EL DESARROLLO'),0,0,'C');
		$this->Ln();
		$this->Cell(40);
		$this->SetFont('Arial','B',6);
		$this->Cell(80,3,utf8_decode('CALLE GRIMALDI N. 3 USULUTÁN, EL SALVADOR, C.A'),0,0,'C');
		$this->Ln();
		$this->Cell(40);
		$this->SetFont('Arial','B',6);
		$this->Cell(80,3,'TEL: 2662-0142, 2662-0103, FAX: 2662-3112',0,0,'C');
    //Salto de línea
    $this->Ln(2);
		
		//Título
		/*
		$this->Cell(200,5,utf8_decode('ALCALDÍA MUNICIPAL DE USULUTAN'),0,0,'C');
		$this->Ln();
		$this->SetFont('Arial','B',12);
		$this->Cell(80);
		$this->Cell(33,5,utf8_decode('UNIDOS POR EL DESARROLLO'),0,0,'C');
		$this->Ln();;
		$this->Cell(80);
		$this->SetFont('Arial','B',6);
		$this->Cell(36,3,utf8_decode('CALLE GRIMALDI N. 3 USULTÁN, EL SALVADOR, C.A'),0,0,'C');
		$this->Ln();;
		$this->Cell(80);
		$this->SetFont('Arial','B',6);
		$this->Cell(36,3,'TEL: 2662-0142, 2662-0103, FAX: 2662-3112',0,0,'C');
*/
	
		//Salto de línea
		$this->Ln(20);
	}
	
	//Pie de página
		function Footer()
		{
			//Posición: a 1,5 cm del final
			$this->SetY(-20);
			//Arial italic 8
			$this->SetFont('Arial','I',8);
			//Número de página
			$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
		}
}

extract($_REQUEST);


//tratado de textos desde la base de datos
$datos_query=mysql_query("SELECT * FROM datos");

$row_datos=mysql_fetch_array($datos_query);


$query= mysql_query("SELECT * FROM acuerdos WHERE acu_id=$id_acu_pdf");
$row_acuerdo=mysql_fetch_array($query);

//inicio tratado de datos del acta

$query_acta=mysql_query("SELECT * FROM actas WHERE act_id=$acta");
$row_acta=mysql_fetch_array($query_acta);

	if($row_acta['act_type']==1 )
	{
		$row_datos['acue_neck']=str_replace('==','Ordinaria',$row_datos['acue_neck']);
	}
	elseif($row_acta['act_type']==2 )
	{
		
		$row_datos['acue_neck']=str_replace('==','Extraordinaria  ',$row_datos['acue_neck']);
		
	}
	else
	{
		$row_datos['acue_neck']=str_replace('==',' <modificar este dato y tambien en dato.acta_head2>  ',$row_datos['acue_neck']);
	}
			// inicio tratado de numero acta a letra
			if($row_acta['act_num']<100)
			{
				$nu_acta=strtoupper( decena($row_acta['act_num'],false,''));
			}
			else
			{	$nu_acta= strtoupper(centena($row_acta['act_num'],false,''));
				
			}
			
			
			$row_datos['acue_neck']=str_replace('NN',$nu_acta,$row_datos['acue_neck']);
		
			if($row_acta['act_hora']<25)
			{
			$hora=decena($row_acta['act_hora'],false,'');
			}
			
			$row_datos['acue_neck']=str_replace('%%%%%%%%',$hora,$row_datos['acue_neck']);
			// fin tratado de numero acta a letra
						
			// inicioTratado fecha alctual a letras
			function fecha($fecha)
					{
						if ($fecha)
					 {
						  $f=explode("-",$fecha);
						  $nummes=(int)$f[1];
						  $mes1="0-enero-febre-marzo-abril-mayo-junio-julio-agosto-septiembre-octubre-noviembre-diciembre";
						  $mes1=explode("-",$mes1);
						  $desfecha="@ de $mes1[$nummes] del /-";
						  return $desfecha;
					   }
					}
					
					$fecha_mes=fecha($row_acta['act_fecha']);
					
					$part=explode('-',$row_acta['act_fecha']);
					if($part[2]<10)
					{
						$dia_letra=unidad($part[2],false,'');	
					}
					else
					{
						$dia_letra=decena($part[2],false,'');	
					}
					$anio_letra=convertir_a_letras($part[0],false,'');
					$fecha_mes=str_replace('/-',$anio_letra,$fecha_mes);
					$fecha_letras=trim(str_replace('@',$dia_letra,$fecha_mes));
					
					
					$row_datos['acue_neck']=str_replace('$$$$$$',$fecha_letras,$row_datos['acue_neck']);
					
					
				//fin tratado de fecha actual a letras
				
				//inicio tratado de numero romano de acuerdo
					
						$acuerdo_ormano = new CRomano($row_acuerdo['acu_num']);
				  		$romano=strtoupper($acuerdo_ormano->getRomano())."- ";
					
					
					$row_datos['acue_neck']=str_replace('##',$romano,$row_datos['acue_neck']);
				
				//fin tratado de numero de acuerdo
				



			//fin tratado de datos del acta





$tex_confronto=$row_datos['acue_footer'];
//ibnicio fecha confrontado

					
					$fecha_mes=fecha($row_acuerdo['acu_conf']);
					
					$part=explode('-',$row_acuerdo['acu_conf']);
					if($part[2]<10)
					{
						$dia_letra=unidad($part[2],false,'');	
					}
					else
					{
						$dia_letra=decena($part[2],false,'');	
					}
					$anio_letra=convertir_a_letras($part[0],false,'');
					$fecha_mes=str_replace('/-',$anio_letra,$fecha_mes);
					$fecha_letras=trim(str_replace('@',$dia_letra,$fecha_mes));
					$tex_confronto=str_replace('/**',$fecha_letras,$tex_confronto);
					
//fin fecha confrontado


$inter_1=@$row_acuerdo['acu_tex1'];
//echo $inter_1."<br>";
$inter_2=str_replace('?','-',$inter_1);

$acta=$row_acuerdo['acu_tex0'];
$acta=str_replace('?','"',$acta);

$text_full=utf8_decode($row_datos['acue_neck']).utf8_decode($acta).$inter_2.utf8_decode(" Se levantó la Sesión y  firmamos").'. ';
//fin tratado de texto desde la base de datos
//echo $text_full;
//rubricas
$query_rubri=mysql_query("SELECT nomina_consejo.nomina_firma FROM nomina_consejo, acuerdos, relacion_actas WHERE relacion_actas.relacion_actaid=acuerdos.acu_actid AND nomina_consejo.nomina_conid=relacion_actas.relacion_nominaid  AND nomina_consejo.nomina_id=relacion_actas.relacion_funcionario AND acuerdos.acu_id=$id_acu_pdf ORDER BY nomina_consejo.nomina_carid");
$numero=1;
while($numero<=5)
{
	$text_full.=$row_datos['acuer_sim'];
$numero+=1;
}
$numero=1;
while($row_ru=(mysql_fetch_array($query_rubri)))
{
		while($numero<=5)
	{
		@$sim.=$row_datos['acuer_sim'];
	$numero+=1;
	}
	@$tex_rub=$tex_rub.utf8_decode($row_ru['nomina_firma']).$sim;
}

$text_full=$text_full.$tex_rub;
$text_full.=$row_acuerdo['act_line'];
//echo $extencion=strlen($text_full)/60;
//fin rubricas

// inicio sexo alcalde y secretario
$query_sex_alcal=mysql_query("SELECT personas.id_genero, personas.nombres, personas.primer_apellido, personas.segundo_apellido, cargo.car_m, cargo.car_f FROM personas, cargo, nomina_consejo, relacion_actas, acuerdos WHERE personas.id_persona=nomina_consejo.nomina_perid AND cargo.rango=1 AND cargo.car_id=nomina_consejo.nomina_carid
AND nomina_consejo.nomina_id=relacion_actas.relacion_funcionario AND relacion_actas.relacion_actaid=acuerdos.acu_actid AND acuerdos.acu_id=$id_acu_pdf");

$query_sex_secre=mysql_query("SELECT personas.id_genero, personas.nombres, personas.primer_apellido, personas.segundo_apellido, cargo.car_m, cargo.car_f FROM personas, cargo, nomina_consejo, relacion_actas, acuerdos WHERE personas.id_persona=nomina_consejo.nomina_perid AND cargo.rango=5 AND cargo.car_id=nomina_consejo.nomina_carid
AND nomina_consejo.nomina_id=relacion_actas.relacion_funcionario AND relacion_actas.relacion_actaid=acuerdos.acu_actid AND acuerdos.acu_id=$id_acu_pdf");


$row_alcal=mysql_fetch_array($query_sex_alcal);
//echo $alcalde=$row_alcal['nombres']." ".$row_alcal['primer_apellido']." ".$row_alcal['segundo_apellido'];
	if($row_alcal['id_genero']=='F')
	{
		$alcalde=$row_alcal['nombres']." ".$row_alcal['primer_apellido']." ".$row_alcal['segundo_apellido'];
		$alcade_s=$row_alcal['car_f'];							
	}
	else
	{
			$alcalde=$row_alcal['nombres']." ".$row_alcal['primer_apellido']." ".$row_alcal['segundo_apellido'];
			$alcade_s=$row_alcal['car_m'];											
	}
	
	
	$row_secre=mysql_fetch_array($query_sex_secre);
//echo $alcalde=$row_alcal['nombres']." ".$row_alcal['primer_apellido']." ".$row_alcal['segundo_apellido'];
	if($row_secre['id_genero']=='F')
	{
		$secre=$row_secre['nombres']." ".$row_secre['primer_apellido']." ".$row_secre['segundo_apellido'];
		$secre_s=$row_secre['car_f'];							
	}
	else
	{
			$secre=$row_secre['nombres']." ".$row_secre['primer_apellido']." ".$row_secre['segundo_apellido'];
			$secre_s=$row_secre['car_m'];										
	}



@$text_full=str_replace('?','"',$text_full);

//fin sexo alcalde y secretario

$pdf=new PDF('P','mm','letter');
$pdf->SetLeftMargin(30);
$pdf->SetTopMargin(0);
$pdf->SetRightMargin(35);
$pdf->SetAutoPageBreak(true,25);
$pdf->AliasNbPages();
$pdf->AddPage();  
$pdf->SetFont('times','',12);
$pdf->MultiCell(160,6,$row_datos['acue_head'],0,'J');
$pdf->Ln(2);
$pdf->MultiCell(178,6,'         '.$text_full,0,'J');
$pdf->Ln(1);
$pdf->MultiCell(178,6,utf8_decode($row_acuerdo['act_rubr']),0,'J');
$pdf->Ln(1);
$pdf->MultiCell(178,6,utf8_decode($tex_confronto),0,'J');
$pdf->Ln(13);
$pdf->Cell(50,4,utf8_decode($alcalde),0,0,'C');
$pdf->Cell(70,4,'',0,0,'C');
$pdf->Cell(50,4,utf8_decode($secre),0,0,'C');
$pdf->Ln();
$pdf->Cell(50,4,$alcade_s,0,0,'C');
$pdf->Cell(70,4,'',0,0,'C');
$pdf->Cell(50,4,utf8_decode($secre_s),0,0,'C');



$pdf->Ln(1);

//$pdf->MultiCell(300,60,$row_acuerdo['acu_tex0'],0,0,'C');
$pdf->Output();



?>
