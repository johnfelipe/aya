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
<title>Consulta Personas para Emplearlas</title>
<script language="javascript" src="../scrips/calendario/javascripts.js"></script>
</head>

<body>
<div align="center" id='central'>
      <table border="0" align="center" width="90%">
      
      <tr>
        	<td >
            	<fieldset >
                	<legend>Agregar Empleados a Usuarios
                    </legend><form method="GET" name="pero_conesjo">
                    <br />
                    <table align="center" width="80%" border="0">
                    <tr>
                      <td rowspan="2">Busqueda de Personas</td>
                      <td><input type="text" name="c1" id="c1" maxlength="50" size="12px"  /></td>
                      <td><input type="text" name="c2" id="c2" maxlength="50" size="12px"  /></td>
                      <td><input type="text" name="c3" id="c3" maxlength="50" size="12px"  /></td>
                      <td><input type="text" name="c4" size="12 px" /></td>
                      <td rowspan="2"><input type="submit" value="Buscar" name="buscar" /> <input type="reset" value="borrar"  /></td>
                    </tr>
                    <tr>
                    	<td><input type="checkbox" name="ck1" checked="checked"  />Por Nombres</td>
                    	<td><input type="checkbox" name="ck2"  />
                    	Por Primer Apellidos</td>
                    	<td><input type="checkbox" name="ck3" />
                   	    Por DUI</td>
                    	<td><input type="checkbox" name="ck4" />
                    	  Por cargo</td>
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

					
					
	if(isset($_GET['buscar']))
	{

		
		//trado de los apellidos
				
		
			
			
	     
			mysql_query("SET NAMES UTF8");
			$query="SELECT personas.nombres, personas.primer_apellido, personas.dui, personas.id_genero,empleados.emp_id, cargo.car_m, cargo.car_m FROM personas,  cargo, empleados  WHERE personas.id_persona=empleados.emp_perid  AND empleados.emp_carid=cargo.car_id AND personas.nombres like '%$c1%' AND empleados.emp_estado=1"; //query por defaul
			
			if(isset($ck2))
				{
					$query=$query." AND personas.primer_apellido like '%$c2%' ";
				} 
			if(isset($ck3))
				{
					$query=$query." AND personas.dui like '%$c3%'";
				} 
				if(isset($ck4))
				{
					$query=$query." AND cargo.car_m like '%$c4%'";
				}
				$query.=" ORDER BY id_persona";
				//consulta ejecutada
				$consul=mysql_query($query);
				//funcio

				
				
				
				
				if(mysql_num_rows($consul)>0)
				{
						echo " <br><table border='0' cellpadding='0'  cellspacing='0' >
						<tr align=center>
							<th>&nbsp;Nombres&nbsp;</th>
							<th>&nbsp;Primer Apellido&nbsp;</th>
							<th>DUI</th>
							<th>Cargo</th>
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
						$query_usu=mysql_query("SELECT * FROM usuarios WHERE usu_eid=$f[emp_id]");
						$validar=mysql_num_rows($query_usu);
						
							if($validar==0)
							{
									//echo $f['id_persona'];
									
									
										if($numero%2==0)
										{
										echo "<tr align=center bgcolor='#BDBDBD'>
												<td><font color='white'>&nbsp;". $f['nombres']."&nbsp;</td>
												<td><font color='white'>&nbsp;". $f['primer_apellido']."&nbsp;</td>
												<td><font color='white'>&nbsp;". $f['dui']."&nbsp;</td>
												<td><font color='white'>&nbsp;". $f['car_m']."&nbsp;</td>
												<td><font color='white'><input type=\"button\" nane='bx' value=\"+\" onClick=\"opener.document.getElementById('text1').value='$f[nombres] $f[primer_apellido]+$f[emp_id]\\n';window.close();\" style='cursor:pointer'></font></td>
											</tr>";
										}
										else
										{
											echo "<tr align=center>
													<td>". $f['nombres']."</td>
													<td>". $f['primer_apellido']."</td>
													<td>". $f['dui']."</td>
													<td>". $f['car_m']."</td>
													<td><input type=\"button\" nane='bx' value=\"+\" onClick=\"opener.document.getElementById('text1').value='$f[nombres] $f[primer_apellido]+$f[emp_id]\\n';window.close();\" style='cursor:pointer'></font></td>
												</tr>";
										
										}
										
							
							}
							else
							{
								
								if(!($numero%2==0))	
								{
									echo  "<tr align=center>
									<td>". $f['nombres']."</td>
									<td>". $f['primer_apellido']."</td>
									<td>". $f['dui']."</td>
									<td>". $f['car_m']."</td>
									<td>&nbsp;<font color=red>usuario asignado</font></td>
									</tr>";
								}
								else
								{
									echo  "<tr align=center bgcolor='#BDBDBD'>
									<td><font color='white'>". $f['nombres']."</td>
									<td><font color='white'>". $f['primer_apellido']."</td>
									<td><font color='white'>". $f['dui']."</td>
									<td><font color='white'>". $f['car_m']."</td>
									<td><font color='white'>&nbsp;<font color=red>usuario asignado</font></td>
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
							</th>
						</tr>
						<tr >
							<th colspan='5' align='center'>Paginas ".$paging->fetchNavegacion()."
							</th>
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