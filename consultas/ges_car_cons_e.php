<?php
// conect DB
include("../Connections/cx.php");
//llamamos a la libreria  paginacion
include ( '../scrips/pag_lib/PHPPaging.lib.php');
extract($_REQUEST);
//echo $id;
			
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Consulta Cargo Empleados</title>
<script language="javascript" src="../scrips/calendario/javascripts.js"></script>
</head>

<body>
<div align="center" id='central'>
      <table border="0" align="center" width="90%">
      
      <tr>
        	<td >
            	<fieldset >
                	<legend>Agregar Cargo a Empleados</legend>
                    <form method="GET" name="pero_conesjo">
                    <br />
                    <table align="center" width="80%">
                    <tr>
                      <td rowspan="2">Busqueda de Cargo</td>
                      <td><input type="text" name="c1" id="c1" maxlength="50"  /></td>
                      <td rowspan="2"><input type="submit" value="Buscar" name="buscar" /> <input type="reset" value="borrar"  /></td>
                    </tr>
                    <tr>
                    	<td><input type="checkbox" name="ck1" checked="checked"  />Por Nombres</td>
                   	  </tr>
                    
                    
                    
                    </table>
                    
                    
                    
                    </form>
                </fieldset>
            
            </td>
        </tr>
   
      
      </table>



<?php


//

//funciones
$mensaje="";

					
					
	if(@$_GET['buscar'])
	{

		
		//trado de los apellidos
				
		
			mysql_query("SET NAMES UTF8");
			
	     
			
			$query="select * from cargo where car_m like '%$c1%' AND rango=1 OR rango=2 OR rango=3 OR rango=4 OR rango=5"; //query por defaul
			
			
				$query.=" ORDER BY rango, nivel";
				//consulta ejecutada
				$consul=mysql_query($query);
				//funcio

				
				
				
				
				if(mysql_num_rows($consul)>0)
				{
						echo " <br>".$id."<table border='0' cellpadding='1' cellspacing='0' >
						<tr align=center>
							<th>Nombres</th>
							<th> Agregar</th>
													
						</tr>
					
					";
		

		

		
					
					$paging = new PHPPaging;
						$paging->modo('publicacion');
						$mantenerURLVar = array('paginasok', 'hi','c1','c2','c3'); 	
					
					//hacemos la consulta SQL que mostrará los resultados
					$paging->agregarConsulta("$query");
					
					//  Ejecutamos la paginación
					   $paging->ejecutar(); 
					
					//color de columna
					$numero=0;
					
					//un bucle de repeticion para mostrar la información
					while($f= $paging->fetchResultado()) 
					{
						
						
							$funcionario=mysql_query("select cargo.car_id, cargo.car_m from cargo, nomina_consejo where car_m like '%%' AND cargo.car_id=nomina_consejo.nomina_carid AND nomina_consejo.nomina_carid=$f[car_id] AND nomina_consejo.nomina_activo=1");
							$valida=mysql_num_rows($funcionario);
							
							
							if($valida==0)
							{
								if($numero%2==0)
								{
								echo "<tr align=center bgcolor='#BDBDBD'>
										<td><font color='white'>". $f['car_m']."</td>
										<td><font color='white'><input type=\"button\" nane='bx' value=\"+\" onClick=\"opener.document.getElementById('text2').value='$f[car_m]+$f[car_id]\\n';window.close();\" style='cursor:pointer'></font></td>
									</tr>";
								}
								else
								{
									echo "<tr align=center>
											<td>". $f['car_m']."</td>
											<td><input type=\"button\" nane='bx' value=\"+\" onClick=\"opener.document.getElementById('text2').value='$f[car_m]+$f[car_id]\\n';window.close();\" style='cursor:pointer'></font></td>
										</tr>";
								
								}
							
							
							}
							else
							{
								
								if(!($numero%2==0))	
								{
									echo  "<tr align=center>
									<td>". $f['car_m']."</td>
									<td><font color=red>Plaza utilizada</font></td>
									</tr>";
								}
								else
								{
									echo  "<tr align=center bgcolor='#BDBDBD'>
									<td>". $f['car_m']."</td>
									<td><font color=red>Plaza utilizada</font></td>
									</tr>";
								
								}
								
								
								
								
								
	
							
							
							
							}
						
							
								
							
						$numero+=1;
							
							
							
							
							
								
								
								
								
								
	
							
							
							
						
							
								
							
					
					}
					
					//Mostrarmos la cantidad de paginas enlas que se mostraran toda la informacion
					echo "<tr >
							<th colspan='5' align='center'>
							Página ".$paging->numEstaPagina()." de ".$paging->numTotalPaginas()."<br />
								Mostrando ".$paging->numRegistrosMostrados()." resultados, del ".$paging->numPrimerRegistro()." al ".$paging->numUltimoRegistro()." de un total de ".$paging->numTotalRegistros()."
							<td>
							</tr>
						<tr >
							<th colspan='5' align='center'>Paginas ".$paging->fetchNavegacion()."
							</tr>";
						//eliminamos datos enviado en javascrip
						
				}
				
				
				
				
				
	}
	/*if($_GET['bx'])
	{
	$eliminartem=mysql_query("delete from temp where let='$funcio[let]'");
	
	}*/
				/*
				
				
				//datos antes de paginar copia de respaldi
				
	
				//comprobacion de datos enviados
				//echo $actas."____".$date;
				
				if(mysql_num_rows($consul) > 0)
				{
					// tabla si se afecto columnas
					echo " <br>-".$funcionario."_<table border='1' >
						<tr>
							<td>Nombres</td>
							<td>Primer Apellido</td>
							<td>Segundo Apellido</td>
							<td> N&deg; DUI</td>
							
						
						</tr>
					
						
					
					
					";
					
					while($rows=mysql_fetch_array($consul))
					{
					echo "<tr>
							<td class='repor'>".$rows['nombres']."</td>
							<td class='repor'>".$rows['primer_apellido']."</td>
							<td class='repor'>".$rows['segundo_apellido']."</td>
							<td class='repor'>".$rows['dui']."</td>
							<td class='repor'> <input type=\"button\" value=\"+\" onClick=\"opener.document.getElementById('".$funcionario."').value='$rows[nombres] $rows[primer_apellido] $rows[segundo_apellido]+$rows[id_persona]\\n';window.close();\" style='cursor:pointer'></td>
						   </tr>";
						
						
					}
					
				}
				
				  
			//}
	}
	*/
		
	


?>



</div>
</body>
</html>