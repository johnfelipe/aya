<?php
//lib ára crear pdf
include("../scrips/pdf_lib/tabla_tradi_fpdf.php");
//concexion
include("../Connections/cx.php");
//agregar libreria para combertir numeros
include("../scrips/numero_letra_lib/numero_letra.php");

//lib numeros a romanos
include("../scrips/romanos_lib/romano_class.php");
extract($_REQUEST);

$arr = array(); 



extract($_REQUEST);
mysql_query("set names utf8");

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
						  $mes1="0-enero-febrero-marzo-abril-mayo-junio-julio-agosto-septiembre-octubre-noviembre-diciembre";
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

					
					$fecha_exte=date('Y-m-d');
					$fecha_mes=fecha($fecha_exte);
					
					$part=explode('-',$fecha_exte);
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
	$partes=explode('!reprogramacion!',$acta);
	  $datas[] = array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
	// echo @$row_acuerdo[acu_id];
		
		$bb=1;
		while($row_table=mysql_fetch_array($q_tabla))
		{
			$di=$row_table['rep_f'];
			$datas[] = array($bb,@utf8_decode($row_table['rep_a']),@utf8_decode($row_table['rep_b']),@$row_table['rep_c'],@utf8_decode($row_table['rep_d']),$di);
			$bb+=1;
		}
		
$text_full=utf8_decode($row_datos['acue_neck']).utf8_decode($acta).utf8_decode("Comúniquese. Se levantó la Sesión y  firmamos").'. ';
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
	$partes=explode('!tabla!',$text_full);
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


$text_full=utf8_decode($row_datos['acue_neck']).utf8_decode($acta).utf8_decode("Comúniquese. Se levantó la Sesión y  firmamos").'. ';
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
//$query_sex_alcal=mysql_query("SELECT personas.id_genero, personas.nombres, personas.primer_apellido, personas.segundo_apellido, cargo.car_m, cargo.car_f FROM personas, cargo, nomina_consejo, relacion_actas, acuerdos WHERE personas.id_persona=nomina_consejo.nomina_perid AND cargo.rango=1 AND cargo.car_id=nomina_consejo.nomina_carid
//AND nomina_consejo.nomina_id=relacion_actas.relacion_funcionario AND relacion_actas.relacion_actaid=acuerdos.acu_actid AND acuerdos.acu_id=$id_acu_pdf");

$query_sex_secre=mysql_query("SELECT personas.id_genero, personas.nombres, personas.primer_apellido, personas.segundo_apellido, cargo.car_m, cargo.car_f,profesiones.nomenclatura, profesiones.nomenclatura2 FROM personas, cargo, nomina_consejo, per_consejo, profesiones WHERE personas.id_persona=nomina_consejo.nomina_perid AND cargo.rango=5 AND cargo.car_id=nomina_consejo.nomina_carid
AND nomina_consejo.nomina_activo=1 AND nomina_consejo.nomina_conid=per_consejo.per_consejo_id AND per_consejo.per_activo=1 AND personas.id_profesion=profesiones.id_profesion");

/*
$row_alcal=mysql_fetch_array($query_sex_alcal);
//echo $alcalde=$row_alcal['nombres']." ".$row_alcal['primer_apellido']." ".$row_alcal['segundo_apellido'];
	if($row_alcal['id_genero']=='F')
	{
		$alcalde=$row_alcal['nombres']." ".$row_alcal['primer_apellido']." ".$row_alcal['segundo_apellido'];
		$alcade_s=$row_alcal['car_f'];	
		
		if($row_alcal['car_f']=='Alcaldesa Municipal')
			{
				@$head='LA INFRASCRITA ALCALDESA MUNICIPAL,';
			}
			else
			{
				@$head='LA INFRASCRITA ALCALDESA MUNICIPAL INTERINA,';
			}					
	}
	else
	{
			$alcalde=$row_alcal['nombres']." ".$row_alcal['primer_apellido']." ".$row_alcal['segundo_apellido'];
			$alcade_s=$row_alcal['car_m'];	
			if($row_alcal['car_m']=='Alcalde Municipal')
			{
				@$head='EL INFRASCRITO ALCALDE MUNICIPAL,';
			}
			else
			{
				@$head='EL INFRASCRITO ALCALDE MUNICIPAL INTERINO,';
			}												
	}
	
	*/
	$row_secre=mysql_fetch_array($query_sex_secre);
//echo $alcalde=$row_alcal['nombres']." ".$row_alcal['primer_apellido']." ".$row_alcal['segundo_apellido'];
	if($row_secre['id_genero']=='F')
	{
		$secre=$row_secre['nombres']." ".$row_secre['primer_apellido']." ".$row_secre['segundo_apellido'];
		$secre_s=$row_secre['car_f'];	
		@$nomen=$row_secre['nomenclatura2'];
		$cer='LA INFRASCRITA SECRETARIA MUNICIPAL,';		
	}
	else
	{
			$secre=$row_secre['nombres']." ".$row_secre['primer_apellido']." ".$row_secre['segundo_apellido'];
			$secre_s=$row_secre['car_m'];
			@$nomen=$row_secre['nomenclatura'];
			$cer='EL INFRASCRITO SECRETARIO MUNICIPAL,';
	}





//fin sexo alcalde y secretario
@$numero_de=sizeof($arr);
$pdf=new PDF('P','mm','letter');
$pdf->SetLeftMargin(25);
$pdf->SetTopMargin(0);
$pdf->SetRightMargin(35);
$pdf->SetAutoPageBreak(true,25);
$pdf->AliasNbPages();
$pdf->AddPage();  
$pdf->SetFont('times','',12);
$pdf->MultiCell(170,6,utf8_decode($cer),0,'J');
$pdf->Ln(2);
/*
$pdf->MultiCell(178,6,'         '.$text_full,0,'J');
$pdf->Ln(1);
$pdf->MultiCell(178,6,utf8_decode($row_acuerdo['act_rubr']),0,'J');

$pdf->tablewidths = array(20,20,40,15,20,40);
$pdf->morepagestable($datas);
*/


if($numero_de>=3)
{

$pdf->MultiCell(170,7,$arr[0],0,'J');
$pdf->SetX(65);
$pdf->tablewidths = array(12,15,80,15,15,30);
$pdf->morepagestable($datas);
$pdf->Ln();
$pepe=$pdf->GetY();
$pdf->SetX(25);

@$pdf->MultiCell(170,7,trim($partes[1]).utf8_decode($tex_confronto),0,'J');
$pdf->SetX(25);
//$pdf->MultiCell(170,6,utf8_decode($row_acuerdo['act_rubr']),0,'J');
}
else
{
	$pdf->MultiCell(170,7,$arr[0].utf8_decode($tex_confronto),0,'J');
	//$pdf->MultiCell(170,6,utf8_decode($row_acuerdo['act_rubr']),0,'J');
}





$pdf->SetX(25);

$pdf->Ln(25);
$line=$pdf->GetY();
if($line>243)
{
	$pdf->ln(3);
}
//que_act=mysql_query("select * from ");
/*$pdf->Cell(50,4,utf8_decode($alcalde),0,0,'C');
$pdf->Cell(60,4,'',0,0,'C');*/
$pdf->Cell(160,4,utf8_decode($nomen.' '.$secre),0,0,'C');
$pdf->Ln();
/*$pdf->Cell(50,4,$alcade_s,0,0,'C');
$pdf->Cell(60,4,'',0,0,'C');*/
$pdf->Cell(160,4,utf8_decode($secre_s),0,0,'C');



$pdf->Ln(1);

//$pdf->MultiCell(300,60,$row_acuerdo['acu_tex0'],0,0,'C');
$pdf->Output();



?>
