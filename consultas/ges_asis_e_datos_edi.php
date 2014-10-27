<?php
include("../Connections/cx.php");
include ( '../scrips/pag_lib/PHPPaging.lib.php');
extract($_REQUEST);
/*
$date=date('Y-m-d');
$antes=explode('-',$date);
$resta=intval($antes[0])-4;
$date2=$resta."-".date('m-d');
$query_rango_date=mysql_query("select * from per_consejo where date(per_consejo_des) between '$date2' and '$date' ");
$existe_consejo=mysql_num_rows($query_rango_date);

*/

$row;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Asistencia del Cosejo</title>
</head>
	
<body>
	
    <h2 align="center">Nomina de Asistencia del Consejo Municipal</h2>
    <table>
    	
        <hr color="#000000" size="2%"  />
		<form method=get>
		<input type="hidden" id="hi" value="<?php echo $id_consejo; ?>" />
		</form>
	  <?php

			//valiacion si ya ser registro el periodo del consejo
		if($id_consejo<>'')
		{
			mysql_query("SET NAMES UTF8");
			//echo $row_fecha['per_consejo_id']."<br>";
			
			$query="
			
			SELECT personas.id_persona, personas.nombres, personas.primer_apellido, personas.segundo_apellido, cargo.car_id, cargo.car_m, nomina_consejo.nomina_id, nomina_consejo.nomina_conid,per_consejo.per_consejo_id, per_consejo.per_consejo_des, per_consejo.per_consejo_has FROM personas, cargo, nomina_consejo, per_consejo, relacion_actas WHERE personas.id_persona=nomina_consejo.nomina_perid AND nomina_consejo.nomina_carid=cargo.car_id AND nomina_consejo.nomina_activo=1 AND nomina_consejo.nomina_conid=per_consejo.per_consejo_id  AND nomina_consejo.nomina_conid=$id_consejo AND relacion_actas.relacion_actaid=$acta AND relacion_actas.relacion_nominaid=nomina_consejo.nomina_conid AND relacion_actas.relacion_funcionario=nomina_consejo.nomina_id ORDER BY cargo.rango, cargo.nivel";
			$query_car=mysql_query($query);
			$existe_cc=mysql_num_rows($query_car);
			
			
			
			if($existe_cc > 0)
			{
					echo "<br /><table align='center' border='0' cellspacing='0' cellspacing=\"5\">
					<tr align='center'>
						<th>Cargo</th><th>Nombres</th><th>Primer Apellido</th><th>Periodo</th><th>Acci&oacute;n</th>
					<tr>";
				$paging = new PHPPaging;
						$paging->modo('publicacion');
						$mantenerURLVar = array('paginasok','hi'); 	
					
					//hacemos la consulta SQL que mostrará los resultados
					$paging->agregarConsulta("$query");
					
					//  Ejecutamos la paginación
					   $paging->ejecutar(); 
					   
				$numero=0;
				while($row2=$paging->fetchResultado())
				{
					
						if($numero%2==0)
						{
						echo"<tr align=center bgcolor='#BDBDBD'>
								<td><font color='white'>&nbsp;". @$row2['car_m'] ."&nbsp;</td>
								<td><font color='white'>&nbsp;". @$row2['nombres'] ."&nbsp;</td>
								<td><font color='white'>". @$row2['primer_apellido'] ."</td>
								<td><font color='white'>&nbsp;". @$row2['per_consejo_des'] ." hasta ". @$row2['per_consejo_has'] ."&nbsp;</td>
								<td><input type=\"button\" nane='bx' value=\"Editar\"  onclick=\"open('../consultas/lista_asis_edi.php?id_acta=".@$acta."&id_conse=".@$row2[per_consejo_id]."&nomina_id=".@$row2[nomina_id]."&id_cargo=".@$row2[car_id]."&cargo_nom=".@$row2[car_m]."&id_per=".@$row2[id_persona]."&nombre_per=".@$row2[nombres]."&ape_per=".@$row2[primer_apellido]."&nomina_consejo=".@$row2[nomina_conid]."','per2','width=600, height=400, scrollbars=yes')\" style=\"cursor: pointer\" >";
							}
							else
							{
								echo"<tr align=center >
										<td><font >&nbsp;". @$row2['car_m'] ."&nbsp;</td>
										<td><font >&nbsp;". @$row2['nombres'] ."&nbsp;</td>
										<td><font >". @$row2['primer_apellido'] ."</td>
										<td><font >&nbsp;". @$row2['per_consejo_des'] ." hasta ". @$row2['per_consejo_has'] ."&nbsp;</td>
										<td><font ><input type=\"button\" nane='bx' value=\"Editar\"onclick=\"open('../consultas/lista_asis_edi.php?id_acta=".@$acta."&id_conse=".@$row2[per_consejo_id]."&nomina_id=".@$row2[nomina_id]."&id_cargo=".@$row2[car_id]."&cargo_nom=".@$row2[car_m]."&id_per=".@$row2[id_persona]."&nombre_per=".@$row2[nombres]."&ape_per=".@$row2[primer_apellido]."&nomina_consejo=".@$row2[nomina_conid]."','per2','width=600, height=400, scrollbars=yes')\" style=\"cursor: pointer\" ></font></td>									</tr>";
							
							}
					
					
					
					
				
					
					
					
						
					$numero+=1;
				}
				//Mostrarmos la cantidad de paginas enlas que se mostraran toda la informacion
					echo "
						<tr >
							<th colspan='5' align='center'>
							Página ".$paging->numEstaPagina()." de ".$paging->numTotalPaginas()."<br />
								Mostrando ".$paging->numRegistrosMostrados()." resultados, del ".$paging->numPrimerRegistro()." al ".$paging->numUltimoRegistro()." de un total de ".$paging->numTotalRegistros()."
							<td>
							</tr>
						<tr >
							<th colspan='5' align='center'>Paginas ".$paging->fetchNavegacion()."
							</tr>";
							
						
				
			}
			else
			{
				echo "<br><h1> <font color=\"#FF0000\">Registre a todos los funcionarios antes de realizar este proceso</font></h1>	";
			}
			
		}
		else
		{
			echo "<br><h1><font color=\"#FF0000\">Registre el periodo del consejo antes de realizar este proceso</font></h1>	";
		}
		
		?>
		<tr >
			<th colspan='5' align='center'><a href="#" target="_blank" onClick="window.close();">Cerrar Ventana</a><th>
		</tr>
            </table>
       

	
</body>
</html>