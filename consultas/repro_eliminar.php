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

mysql_query("SET NAMES UTF8");

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nomina Elimacion de Reprogramacion</title>
</head>
	
<body>
	
    <h2 align="center">Nomina de Reprogramaciones</h2>
    <table>
    	
        <hr color="#000000" size="2%"  />
		<form method=get>
		<input type="hidden" id="hi" value="<?php echo $id; ?>" />
		</form>
	  <?php
		
			//valiacion si ya ser registro el periodo del consejo
		if(!empty($id))
		{
			
			//echo $row_fecha['per_consejo_id']."<br>";
			//echo $id;
			$query="SELECT * FROM repro WHERE rep_acu=$id ORDER BY rep_id";
			
		
			$query_repro=mysql_query($query);
			$existe_cc=mysql_num_rows($query_repro);
			
				
			
			if($existe_cc > 0)
			{
					echo "<br /><table align='center' border='0' cellspacing='0' cellspacing=\"5\">
					<tr align='center'>
						<th>Linea</th><th>Descripci&oacute;n</th><th>Linea</th><th>A/D</th><th>Monto</th><th>Accion</th>
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
								
								<td><font color='white'>&nbsp;". $row2['rep_a'] ."&nbsp;</td>
								<td><font color='white'>&nbsp;". $row2['rep_b'] ."&nbsp;</td>
								<td><font color='white'>&nbsp;". $row2['rep_c'] ."&nbsp;</td>
								<td><font color='white'>&nbsp;". $row2['rep_d']."&nbsp;</td>
								<td><font color='white'>&nbsp;". $row2['rep_f']."&nbsp;</td>
								<td><input type=\"button\" nane='bx' value=\"Eliminar\"  onclick=\"open('../consultas/repro_eliminar_datos.php?id=".$row2['rep_id']."','per2','width=600, height=400, scrollbars=yes')\" style=\"cursor: pointer\" >";
							}
							else
							{
								echo"<tr align=center >
										
										<td><font >&nbsp;". $row2['rep_a'] ."&nbsp;</td>
										<td><font >&nbsp;". $row2['rep_b']."&nbsp;</td>
										<td><font >&nbsp;". $row2['rep_c'] ."&nbsp;</td>
										<td><font >&nbsp;". $row2['rep_d'] ."&nbsp;</td>
										<td><font >&nbsp;". $row2['rep_f'] ."&nbsp;</td>
										<td><font ><input type=\"button\" nane='bx' value=\"Eliminar\"onclick=\"open('repro_eliminar_datos.php?id=".$row2['rep_id']."','per2','width=600, height=400, scrollbars=yes')\" style=\"cursor: pointer\" ></font></td>
									</tr>";
							
							}
					
					
					
					
				
					
					
					
						
					$numero+=1;
					
				}
				//Mostrarmos la cantidad de paginas enlas que se mostraran toda la informacion
					echo "
					<tr >
							<th colspan='6' align='center'>
								&nbsp;
							</th>
							</tr>
						<tr >
							<th colspan='6' align='center'>
							Página ".$paging->numEstaPagina()." de ".$paging->numTotalPaginas()."<br />
								Mostrando ".$paging->numRegistrosMostrados()." resultados, del ".$paging->numPrimerRegistro()." al ".$paging->numUltimoRegistro()." de un total de ".$paging->numTotalRegistros()."
							</th>
							</tr>
						<tr >
							<th colspan='6' align='center'>Paginas ".$paging->fetchNavegacion()."
							</th>
						</tr>";
							
						
				
			}
			else
			{
				echo "<br><h1> <font color=\"#FF0000\">Necesita Registrar Reprogramaciones de forma previa</font></h1>	";
			}
			
		}
		else
		{
			echo "<br><h1><font color=\"#FF0000\">Datos invalidos consulte al administrador de sistemas</font></h1>	";
		}
		
		?>
		<tr >
			<th colspan='5' align='center'><a href="#" target="_blank" onClick="window.close();">Cerrar Ventana</a><th>
		</tr>
            </table>
       

	
</body>
</html>