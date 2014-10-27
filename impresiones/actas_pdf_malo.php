<?php
//lib ára crear pdf
//include("../scrips/pdf_lib/fpdf.php");
include("../scrips/pdf_lib/tabla_fpdf_acta.php");
//concexion
include("../Connections/cx.php");
//agregar libreria para combertir numeros
include("../scrips/numero_letra_lib/numero_letra.php");

//lib numeros a romanos
include("../scrips/romanos_lib/romano_class.php");
extract($_REQUEST);
//$id;


//encab encabeza de fpdf error al utilizar caracteres utf8 problema con justificacion
class PDFi extends PDF
{
	//Cabecera de página
	/*function Header()
	{
		
		//Logo
		$this->Image('../img/logo1.gif',19,8,25);
		$this->Image('../img/logo2.gif',170,10,30);
		$this->Image('../img/bandera.jpg',19,42,180,3);
		
    $this->SetFont('Arial','B',15);
    //Movernos a la derecha
	$this->Ln(20);
    $this->Cell(40);
    //Título
  		$this->Cell(80,5,utf8_decode('ALCALDÍA MUNICIPAL DE USULUTÁN'),0,0,'C');
		$this->Ln();
		$this->SetFont('Arial','B',12);
		$this->Cell(40);
		$this->Cell(80,5,utf8_decode('Libro de ACTAS'),0,0,'C');
	
		$this->Ln(12);
		$this->SetFont('Arial','B',16);
		//$this->Cell(300,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
	
		//Salto de línea
		$this->Ln(13);
	}
	*/
	
	//Pie de página
		function Footer()
		{
		{
			//Posición: a 1,5 cm del final
			$this->SetY(-9);
			//Arial italic 8
			$this->SetFont('Arial','I',8);
			//Número de página
			$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
		}
		}
}
$anterior=$id -1;
$query_coor=mysql_query("SELECT act_Y FROM actas WHERE act_id=$anterior");
if(mysql_num_rows($query_coor)>0)
{
	$row_coor=mysql_fetch_array($query_coor);
	if($row_coor['act_Y']> 20)
	{
		$coor_inicio=$row_coor['act_Y']+3;	
		if($coor_inicio > 302)
		{
			$coor_inicio=20;
		}
	}
	else
	{
		$coor_inicio=$row_coor['act_Y'];	
	}
}
else
{
	$coor_inicio=20;
}

$set=mysql_query("set names utf8");

$datos_query=mysql_query("SELECT * FROM datos");

$row_datos=mysql_fetch_array($datos_query);

$query_acta=mysql_query("SELECT * FROM actas WHERE act_id=$id");

$row_acta=mysql_fetch_array($query_acta);
$fin=$row_acta['act_hora_fin']; 

if($row_acta['act_type']==1)
{
	 $text1=$row_datos['acta_head0'];
}
elseif( $row_acta['act_type']==2)
{
		$text1=$row_datos['acta_head1'];
}
else
{
		$text1=$row_datos['acta_head2'];
}


// inicio combertimos el numero del acta a letras

	//inicio numero acta a letras
				if($row_acta['act_num']<10)
				{
					 $numero_text=strtoupper(unidad($row_acta['act_num'],false,''));
				}
				elseif($row_acta['act_num']<100)
				{
					  $numero_text=strtoupper(decena($row_acta['act_num'],false,''));
				}
				elseif($row_acta['act_num']<1000)
				{
					$numero_text=strtoupper(centena($row_acta['act_num'],false,''));
				}
				//echo $numero_text;
						//fin numero acta a letras
				
			$text1=str_replace('%',$numero_text,$text1);
			//inicio hora a letras
			if($row_acta['act_hora']<10)
				{
					 $horas_text=unidad($row_acta['act_hora'],false,'');
				}
				elseif(($row_acta['act_hora'] >=10) and ($row_acta['act_hora'] <=24))
				{
					  $horas_text=decena($row_acta['act_hora'],false,'');
				}
				
			$text1=str_replace('!!', $horas_text,$text1);
			
	
			//fin horas a letras

//fin
	//fin horas a letras
			
			//incio tratado de fechas
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
				//echo $row_acta['act_fecha'];		
			$fecha=fecha($row_acta['act_fecha']);
			$part=explode('-',$row_acta['act_fecha']);
							
							// fecha letras año
			$fe=convertir_a_letras($part[0],false,'');
			$fecha=str_replace('/-',$fe,$fecha);
			
						//fecha letras dia
				if($part[2]<10)
				{
					$fe=unidad($part[2],false,'');
				}
				elseif($part[2]>=10)
				{
					$fe=decena($part[2],false,'');
				}
				$fecha=str_replace('@',$fe,$fecha);
				
				
				$text1=str_replace('/+',trim($fecha),$text1);
			//fin tratado de fechas


		//inicio agregar nombres y profecion a encabezado
		
		$query_nomb_profesion=mysql_query("SELECT personas.nombres, personas.primer_apellido, personas.segundo_apellido, personas.id_genero, cargo.car_m, cargo.car_f, relacion_actas.relacion_profe, profesiones.descripcion FROM personas, cargo, nomina_consejo, relacion_actas, profesiones WHERE personas.id_persona=nomina_consejo.nomina_perid  AND cargo.car_id=nomina_consejo.nomina_carid AND
profesiones.id_profesion=personas.id_profesion
AND nomina_consejo.nomina_conid=relacion_actas.relacion_nominaid AND nomina_consejo.nomina_id=relacion_actas.relacion_funcionario AND relacion_actas.relacion_actaid=$id ORDER BY cargo.rango, cargo.nivel");
			
			$valida=mysql_num_rows($query_nomb_profesion);
		$numero=1;
		while($f=mysql_fetch_array($query_nomb_profesion))
		{
			if($numero==1)
			{
				if($f['id_genero']=='M')
				{
					$del="del Señor: ".$f['car_m']." ";
					
					if($f['relacion_profe']==1)
					{
						$del.=$f['descripcion'].' ';
					}
					
					
					$del.=$f['nombres']." ".$f['primer_apellido'].' ';
					if(!empty($f['segundo_apellido']))
					{
						$del.=$f['segundo_apellido'].' ';
					}
					
					$text1=str_replace('@@',$del,$text1);
					
				
				}
				else
				{
					
					$del="de la Señora: ".$f['car_f']." ".$f['nombres']." ".$f['primer_apellido'].' ';
					if(!empty($f['segundo_apellido']))
					{
						$del.=$f['segundo_apellido'].' ';
					}
					$text1=str_replace('@@',$del,$text1);
					
				}
				$text1=str_replace('¿','',$text1);
			}
			else
			{
				if($f['id_genero']=='M')
				{
					$del="Señor: ".$f['car_m']." ";
					if(!($numero==$valida))
					{
						if($f['relacion_profe']==1)
						{
							$del.=$f['descripcion'].' ';
						}
						
						
						$del.=$f['nombres']." ".$f['primer_apellido'];
						if(!empty($f['segundo_apellido']))
						{
							$del.=' '.$f['segundo_apellido'].', ';
						}
						else
						{
							$del.=', ';
						}
						$text1.=$del;
					}
					else
					{
						if($f['relacion_profe']==1)
						{
							$del.=$f['descripcion'].' ';
						}
						
						
						$del.=$f['nombres']." ".$f['primer_apellido'];
						if(!empty($f['segundo_apellido']))
						{
							$del.=' '.$f['segundo_apellido'];
						}
						
						$text1.=$del;	
					}
					
				}
				else
				{
					
						@$del="Señora: ".$f['car_f']." ";
					if(!($numero==$valida))
					{	
						if($f['relacion_profe']==1)
						{
							$del.=$f['descripcion'].' ';
						}
						
						$del.=$f['nombres']." ".$f['primer_apellido'];
						if(!empty($f['segundo_apellido']))
						{
							$del.=" ".$f['segundo_apellido'].', ';
						}
						else
						{
							$del.=', ';
						}
						$text1.=$del;
					}
					else
					{
						if($f['relacion_profe']==1)
						{
							$del.=$f['descripcion'].' ';
						}
						
						$del.=$f['nombres']." ".$f['primer_apellido'];
						if(!empty($f['segundo_apellido']))
						{
							$del.=" ".$f['segundo_apellido'];
						}
						
						$text1.=$del;
					
					}
					
					
				}
				
			}
			
			
			$numero+=1;	
			
		}
		
		
		$text1=$text1;
		$text1.='. '.$row_acta['act_tex0'].', ';
		//fin agregar nombres y profecion a encabezado

		
			//incio agregandar todas los acuerdos
				$case=0;
				$query_acuerdos=mysql_query("SELECT acu_num, acu_tex0, acu_id FROM acuerdos WHERE acu_actid=$row_acta[act_id] ORDER BY acu_num");
				$texto='';
				while($row_acta=mysql_fetch_array($query_acuerdos))
				{
					
					//inicio numero acta a letras
					$acuerdo_ormano = new CRomano($row_acta['acu_num']);
				  	$romano=$acuerdo_ormano->getRomano()."- ";
									
					//fin numero acta a letras
					$tex_acta=$romano.$row_acta['acu_tex0'];
					/////////////////////////////////////////////////////////////////////////
					
					@$q_tabla=mysql_query("SELECT * FROM repro WHERE rep_acu=$row_acta[acu_id]");
					@$valida_repro=mysql_num_rows($q_tabla);
					if($valida_repro >=1)
					{
						$partes=explode('!tabla!',$tex_acta);
						switch ($case) 
						{
							case 0:
								$datas[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
							case 1:
								$datas1[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
							case 2:
								$datas2[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
							case 3:
								$datas3[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));;
							break;
							case 4:
								$datas4[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
							case 5:
								$datas5[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
							case 6:
								$datas6[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
							case 7:
								$datas7[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
							case 8:
								$datas8[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
							case 9:
								$datas9[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
							case 10:
								$datas10[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
							case 11:
								$datas11[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
							case 12:
								$datas12[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
							case 13:
								$datas13[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
							case 14:
								$datas14[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
							case 15:
								$datas15[] =  array(@utf8_decode('Num'),@utf8_decode('Código'),@utf8_decode('Descripción'),@utf8_decode('Línea'),@utf8_decode('A/D'),@utf8_decode('Monto'));
							break;
						}
						
						$bb=1;
						while($row_table=mysql_fetch_array($q_tabla))
						{
							$di=utf8_decode($row_table['rep_f']);
							$dato=utf8_decode($row_table['rep_b']);
							//$datas[] = array($bb,@$row_table['rep_a'],@$row_table['rep_b'],@$row_table['rep_c'],@$row_table['rep_d'],$di);
							switch ($case) 
								{
									case 0:
										$datas[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 1:
										$datas1[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 2:
										$datas2[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 3:
										$datas3[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 4:
										$datas4[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 5:
										$datas5[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 6:
										$datas6[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 7:
										$datas7[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 8:
										$datas8[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 9:
										$datas9[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 10:
										$datas10[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 11:
										$datas11[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 12:
										$datas12[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 13:
										$datas13[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 14:
										$datas14[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									case 15:
										$datas15[] = array($bb,@utf8_decode($row_table['rep_a']),@$dato,@utf8_decode($row_table['rep_c']),@utf8_decode($row_table['rep_d']),$di);
									break;
									
								}
									
									
							$bb+=1;
						}

						
						@$fin=sizeof($partes)+1;
						for($aa=0;$aa<=$fin; $aa++)
						{
							if($aa==0)
							{
								if($case==0)
								{
								 @$arr[]=$text1.$partes[0];
								}
								else
								{
									$indice=sizeof($arr)-1;
									@$arr[$indice].=' '.$partes[0];
									
								}
							
							}
							else if($aa==1)
							{
								switch ($case) 
								{
									case 0:
										@$arr[]=$datas;
									break;
									case 1:
										@$arr[]=$datas1;
									break;
									case 2:
										@$arr[]=$datas2;
									break;
									case 3:
										@$arr[]=$datas3;
									break;
									case 4:
										@$arr[]=$datas4;
									break;
									case 5:
										@$arr[]=$datas5;
									break;
									case 6:
										@$arr[]=$datas6;
									break;
									case 7:
										@$arr[]=$datas7;
									break;
									case 8:
										@$arr[]=$datas8;
									break;
									case 9:
										@$arr[]=$datas9;
									break;
									case 10:
										@$arr[]=$datas10;
									break;
									case 11:
										@$arr[]=$datas11;
									break;
									case 12:
										@$arr[]=$datas12;
									break;
									case 13:
										@$arr[]=$datas13;
									break;
									case 14:
										@$arr[]=$datas14;
									break;
									case 15:
										@$arr[]=$datas15;
									break;
								}
								
								
							}
							else if($aa==2)
							{
								@$arr[]=$partes[1];
								
							}
							
							
						
						}
						
						$case+=1;
					}
					else
					{
						if(!isset($arr[0]))
						{
							$text1.= 'Comuníquese. Acuerdo Número '.$tex_acta." ";	
						}
						else
						{
						$indice=sizeof($arr)-1;
						
							$arr[$indice].= 'Comuníquese. Acuerdo Número '.$tex_acta." ";
						}
						
					}
				
					
				}
				
				if(!isset($arr[0]))
				{
					$arr[]=$text1;
				
				}
					
					//////////////////////////////////
					
					
				
				
					
				
			
			
			
			
			//fin gregar todos los acuerdos
		 $row_datos['act_fin'];
			
		$row_datos['act_fin']=str_replace('-/-',$fecha,$row_datos['act_fin']); 
	
		$h_fin=explode(':',$fin);
		
				
					  @$h_e=decena($h_fin[0],false,'');
					  @$h_m=decena($h_fin[1],false,'');
					 $time=$h_e." con ".$h_m." minutos";
		$row_datos['act_fin']=str_replace('-*-',$time,$row_datos['act_fin']);	
		
		
		$text1.=$row_datos['act_fin'];



		//inicio tratado de in antes de las firmas
		
		
		
		
		
		//fin tratdo antes de las firmas




/*echo sizeof($arr).'<br>';
echo $arr[2];
*/
//----------------------------------------------------


$text1=utf8_decode($text1);
$text1=str_replace('?','"',$text1);



//echo $arr[2];

$pdf=new PDF('P','mm',array(216,320));
$pdf->SetLeftMargin(30);
$pdf->SetTopMargin(0);
$pdf->SetRightMargin(2);
$pdf->SetAutoPageBreak(true,20);
$pdf->AliasNbPages();
$pdf->AddPage();  
$pdf->SetFont('times','',12);
$pdf->Ln(2);
$pdf->SetY($coor_inicio);

//$pdf->MultiCell(160,6,$text1,0,'J');
$exten=sizeof($arr)-1;
$salve_val=sizeof($arr);
if($exten>0)
{
	
	$case=0;
	for($aa=0; $aa<=$exten;$aa++)
	{
		if($aa%2==0)
		{
			
			$line=utf8_decode($arr[$aa]);
			$line=str_replace('?','"',$line);
			if($aa==($salve_val-1))
			{
			 $q_salve=mysql_query("select * from ob_01 where ob1_idact=$id");
			 
			 $row_sal=mysql_num_rows($q_salve);
				if($row_sal>0)
				{
					$arr_salve=mysql_fetch_array($q_salve);
					$pdf->MultiCell(160,6,$line.utf8_decode($arr_salve['ob1_text']),0,'J');
					
				}
			}
			else
			{
			$pdf->MultiCell(160,6,$line,0,'J');
			}
			
		}
		else
		{
			/*switch ($case) 
			{
				case 0:
					$pdf->tablewidths = array(12,15,70,15,15,30);
					$pdf->morepagestable($arr[$aa]);
					$pdf->Ln(2);
				break;
				case 1:
					$pdf->tablewidths = array(12,15,70,15,15,30);
					$pdf->morepagestable($arr[$aa]);
					$pdf->Ln(2);
					
				break;
				case 2:
					$pdf->tablewidths = array(12,15,70,15,15,30);
					$pdf->morepagestable($datas2);
					
					
				break;
				case 3:
					$pdf->tablewidths = array(12,15,70,15,15,30);
					$pdf->morepagestable($datas2);
					$pdf->Ln(2);
				break;
				case 4:
					$pdf->tablewidths = array(12,15,70,15,15,30);
					$pdf->morepagestable($datas2);
					$pdf->Ln(2);
				break;
				case 5:
					$pdf->tablewidths = array(12,15,70,15,15,30);
					$pdf->morepagestable($datas2);
					$pdf->Ln(2);
				break;
				case 6:
					$pdf->tablewidths = array(12,15,70,15,15,30);
					$pdf->morepagestable($datas2);
					$pdf->Ln(2);
				break;
				case 7:
					$pdf->tablewidths = array(12,15,70,15,15,30);
					$pdf->morepagestable($datas2);
					$pdf->Ln(2);
				break;
				case 8:
					$pdf->tablewidths = array(12,15,70,15,15,30);
					$pdf->morepagestable($datas2);
					$pdf->Ln(2);
				break;
				case 9:
					$pdf->tablewidths = array(12,15,70,15,15,30);
					$pdf->morepagestable($datas2);
					$pdf->Ln(2);
				break;
				case 10:
					$pdf->tablewidths = array(12,15,70,15,15,30);
					$pdf->morepagestable($datas2);
					$pdf->Ln(2);
				break;
				case 11:
					$pdf->tablewidths = array(12,15,70,15,15,30);
					$pdf->morepagestable($datas2);
					$pdf->Ln(2);
				break;
			}*/
			//$pdf->tablewidths = array(12,20,50,15,20,30);
			//$pdf->morepagestable($arr[$aa]);
			$pdf->tablewidths = array(12,15,70,15,15,30);
			$pdf->morepagestable($arr[$aa]);
			$pdf->Ln(2);
		$case+=1;	
		}
		
	}

}
else
{
	$line=utf8_decode($arr[0]);
	$line=str_replace('?','"',$line);
	$pdf->MultiCell(160,6,$line,0,'J');
}
//echo $aa.'<br>'.$salve_val.$id;




$pdf->Ln(5);
$cordenadasY=$pdf->GetY();
$cordenadasy=$pdf->GetX();
$pdf->SetX(30);

$pdf->SetFont('times','',10);
	//inicio firmas de los asistentes
	$query_asis=mysql_query("SELECT personas.nombres, personas.primer_apellido, personas.segundo_apellido, personas.id_genero, cargo.car_m,  cargo.car_f FROM personas, cargo, nomina_consejo, relacion_actas WHERE personas.id_persona=nomina_consejo.nomina_perid  AND cargo.car_id=nomina_consejo.nomina_carid AND nomina_consejo.nomina_conid=relacion_actas.relacion_nominaid AND nomina_consejo.nomina_id=relacion_actas.relacion_funcionario AND relacion_actas.relacion_actaid=$id ORDER BY cargo.rango, cargo.nivel");
	$bb=1;
	$total=mysql_num_rows($query_asis);
	while($pepe=mysql_fetch_array($query_asis))
	{
		$pdf->SetX(45);
		$per=$pepe['nombres']." ".$pepe['primer_apellido']." ".$pepe['segundo_apellido'];
					
					
					//genenero del caro		
				if($pepe['id_genero']=='M')
				{
					$genero=$pepe['car_m'];
				}
				else
				{
					$genero=$pepe['car_f'];
				}
				
		if(!($bb%2==0))
		{
			//$pdf->Multicell(0,9	,"This is a multi-line text string\nNew line\nNew line"); 
			//$pdf->Multicell(50,3,$per."\n".$pepe['car_nom'],1,'C'); 
			if($bb==$total)
			{
				$pdf->SetX(86);
				
				
				$pdf->multicell(60,3,utf8_decode($per)."\n".utf8_decode($genero),0,'C');
			}
			else
			{
				$cordenadasY=$pdf->GetY();
				 if($cordenadasY>270)
				 {
					$pdf->Ln(8);
					$pdf->multicell(90,3,utf8_decode($per)."\n".utf8_decode($genero),0,'C');
					$cordenadasY=$pdf->GetY();
				 }
				 else
				 {
					 $pdf->multicell(60,3,utf8_decode($per)."\n".utf8_decode($genero),0,'C');
					 $cordenadasY=$pdf->GetY();
					}
			}
			
	
		}
		else
		{
		
			$pdf->SetY($cordenadasY -6);
			$pdf->SetX($cordenadasy+90);
			//$pdf->Multicell(60,3	,$per."\n".$pepe['car_nom'],1,'C');
			$pdf->multicell(60,3,utf8_decode($per)."\n".utf8_decode($genero),0,'C');
			$pdf->Ln(7);
			$cordenadasY=$pdf->GetY()+6.00;
			
		}
			
		
		$bb+=1;
		
		//echo $pepe['car_nom'];
			
		
				
	}
	$pdf->Ln();
	$cordenadas_final_Y=$pdf->GetY();
	if($cordenadas_final_Y >= 300 )
	{
		$cordenadas_final_Y=52;
	}
	
	mysql_query("UPDATE actas SET act_Y=$cordenadas_final_Y WHERE act_id=$id");

//$pdf->MultiCell(300,60,$row_acuerdo['acu_tex0'],0,0,'C');
$pdf->Output();

?>