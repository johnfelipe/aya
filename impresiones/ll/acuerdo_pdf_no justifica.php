<?php
include("../Connections/cx.php");
require_once('../scrips/Cezpdf/class.ezpdf.php');
//agregar libreria para combertir numeros
include("../scrips/numero_letra_lib/numero_letra.php");

//lib numeros a romanos
include("../scrips/romanos_lib/romano_class.php");
extract($_REQUEST);
mysql_query("set names utf8");
$pdf =& new Cezpdf('LETTER');
//$pdf->setFontFamily('Courier.afm',$tmp);

$pdf->selectFont('../scrips/Cezpdf/fonts/Helvetica.afm');
$pdf->ezSetCmMargins(3.5,2.5,3,2);
// tragado de datos



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
				$nu_acta=strtoupper(decena($row_acta['act_num'],false,''));
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

/*
$inter_1=@$row_acuerdo['acu_tex1'];
echo $inter_1."<br>koko";
$inter_2=str_replace('?','-',$inter_1);
*/
$acta=$row_acuerdo['acu_tex0'];
$acta=str_replace('?','"',$acta);
//echo strpos($acta,'!programacion!');
$q_tabla=mysql_query("SELECT * FROM repro WHERE rep_acu=$row_acuerdo[acu_id]");
$valida_repro=mysql_num_rows($q_tabla);
if($valida_repro >=1)
{
	
	//tabla ez  encaebezados y opciones
	$titles = array(
				'num'=>utf8_decode('<b>Número</b>'),
				'a'=>utf8_decode('<b>Código</b>'),
				'b'=>utf8_decode('<b>Descripción</b>'),
				'c'=>utf8_decode('<b>Línea</b>'),
				'd'=>utf8_decode('<b>A/D</b>'),
				'f'=>utf8_decode('<b>Monto</b>'),

			);
			

$options = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);


	
	// fin tabla ez
	
	
	$partes=explode('!reprogramacion!',$acta);
	 
	// echo @$row_acuerdo[acu_id];
		
		$bb=1;
		while($row_table=mysql_fetch_array($q_tabla))
		{
			$di=$row_table['rep_f'];
			
			
			$data[] = array_merge(array('num'=>$bb),array('a'=>@$row_table['rep_a']),array('b'=>@$row_table['rep_b']), array('c'=>@$row_table['rep_c']), array('d'=>@$row_table['rep_d']), array('f'=>$di));
			
			
			$bb+=1;
		}
		
$text_full=utf8_decode($row_datos['acue_neck']).utf8_decode($acta).utf8_decode(" Se levantó la Sesión y  firmamos").'. ';
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
@$text_full=str_replace('?','"',$text_full);
	$partes=explode('!reprogramacion!',$text_full);
	for($aa=0; $aa<=2; $aa++)	
	{	if($aa==0)
		{
			$arr[$aa]=$partes[0];	
		}
		else if( $aa==1)
		{
			$arr[$aa]=$datas;
		}
		else
		{
			$arr[$aa]=$partes[1];

		}
		
		
	}
		
		
		//echo $extencion=strlen($text_full)/60
}
else
{


$text_full=utf8_decode($row_datos['acue_neck']).utf8_decode($acta).utf8_decode(" Se levantó la Sesión y  firmamos").'. ';
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
@$text_full=str_replace('?','"',$text_full);
$arr[0]= $text_full;
//echo $extencion=strlen($text_full)/60;
//fin rubricas
}

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





//fin sexo alcalde y secretario
@$numero_de=sizeof($arr);
//fin tratado de datos
//menbrete
		$Footer = $pdf->openObject();
		// coloca una linea arriba y abajo de todas las paginas
		
		$pdf->saveState();
		$pdf->setStrokeColor(0,0,0,1);
		
			//encabezado
			$pdf->addJpegFromFile("../img/logo1.jpg",70,710,50,70);
			$pdf->addJpegFromFile("../img/logo2.jpg",500,710,70,70);
			$pdf->addJpegFromFile("../img/bandera.jpg",70,695,500,10);
			$pdf->addTextWrap(200,745,250,13,utf8_decode('ALCALDÍA MUNICIPAL DE USULUTÁN'),'center');
			$pdf->addTextWrap(200,736,250,10,utf8_decode('UNIDOS POR EL DESARROLLO'),'center');
			$pdf->addTextWrap(200,728,250,8,utf8_decode('CALLE GRIMALDI N. 3 USULUTÁN, EL SALVADOR, C.A'),'center');
			$pdf->addTextWrap(200,719,250,8,utf8_decode('TEL: 2662-0142, 2662-0103, FAX: 2662-3112'),'center');
			
			
		/*	$pdf->addText(200,738,10,utf8_decode('UNIDOS POR EL DESARROLLO'));
			$pdf->addText(200,733,10,utf8_decode('CALLE GRIMALDI N. 3 USULUTÁN, EL SALVADOR, C.A'));
			$pdf->addText(200,727,10,utf8_decode('TEL: 2662-0142, 2662-0103, FAX: 2662-3112'));*/
		 	//encabezado
			//pie
			$pdf->addJpegFromFile("../img/bandera.jpg",70,35,500,10);
		
			$pdf->restoreState();
			$pdf->closeObject();
			// termina las lineas
			$pdf->addObject($Footer,'all');
			$pdf->ezStartPageNumbers(500,22,10,'','Pagina : {PAGENUM} de {TOTALPAGENUM}',1);
			//pie
//menbrete
echo '<p align=\'justify\'>';
$pdf->ezText($row_datos['acue_head'],12,'full');
if($numero_de>=3)
{

		$pdf->ezText($arr[0],12,'full');


$pdf->ezTable($data, $titles, '', $options);

$pdf->ezText($partes[1],12,'full');

$pdf->ezText(utf8_decode($row_acuerdo['act_rubr']),12,'full');
}
else
{
	$pdf->ezText($arr[0],12,'full');
	$pdf->ezText(utf8_decode($row_acuerdo['act_rubr']),10,'full');
}
		
 
echo '<p>';



		

//tabla


//tabla



ob_end_clean();
$pdf->ezStream();
?>