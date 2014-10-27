<?php
// conect DB
include("../Connections/cx.php");
//llamamos a la libreria  paginacion
include ( '../scrips/pag_lib/PHPPaging.lib.php');
extract($_REQUEST);
//echo $id;
@$_GET['id']=$id;
			mysql_query("SET NAMES UTF8");	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Consulta periodo libro</title>
<script language="javascript" src="../scrips/calendario/javascripts.js"></script>
</head>

<body>
<div align="center" id='central'>
      <table border="0" align="center" width="90%">
      
      <tr>
        	<td >
            	<fieldset >
                	<legend>Agregar Periodo
                    </legend><form method="GET" name="pero_conesjo">
                    <br />
                    <table align="center" width="80%">
                    <tr>
                      <td rowspan="2">Busqueda de Periodo</td>
                      <td><input type="text" name="c1" id="c1" maxlength="50" size="12px"  /></td>
                      <td><input type="text" name="c2" id="c2" maxlength="50" size="12px"  /><div style="display: none" ><input type="text" value="<?php echo $_GET['id'];?>" name="hi"  /></div></td>
                      <td rowspan="2"><input type="submit" value="Buscar" name="buscar" /> <input type="reset" value="borrar"  /></td>
                    </tr>
                    <tr>
                    	<td>Desde</td>
                    	<td> Hasta</td>
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
	
		$validacion_proseso=mysql_query("SELECT proc_legitimo FROM datos WHERE n_datos=1");
		//trado de los apellidos
		
		$num_proceso=mysql_fetch_array($validacion_proseso);
		
		if($num_proceso['proc_legitimo']==1)
		{
			
			
			$valdiada_periodo=mysql_query("SELECT * FROM per_consejo WHERE per_activo=1");
			$num_peri=mysql_num_rows($valdiada_periodo);
			
			if($num_peri>1)
			{
			echo "<font color=\"#FF0000\">Solo puede estar un Periodo Activo</font>";	
			}
			else
			{
				$query="SELECT * FROM per_consejo WHERE per_activo=1 and per_consejo_des  like '%$c1%' OR per_consejo_has like'%$c2%'  "; //query validar proceso
			
				
				
				//consulta ejecutada
				$consul=mysql_query($query);
				//funcio

				
				
				
				
				if(mysql_num_rows($consul)>0)
				{
						echo " <br>".@$id."<table border='0' cellpadding='1' cellspacing='0' >
						<tr align=center>
							<th>Periodo Desde</th>
							<th>Periodo Hasta</th>
							<th>Agregar</th>
																				
						</tr>
					
					";
		

		
					
					$paging = new PHPPaging;
						$paging->modo('publicacion');
						$mantenerURLVar = array('pagina','id','hi','c1','c2','$_GET[id]'); 	
					
					//hacemos la consulta SQL que mostrará los resultados
					$paging->agregarConsulta("$query");
					
					//  Ejecutamos la paginación
					   $paging->ejecutar(); 
					
					//color de columna
					$numero=0;
					
					//un bucle de repeticion para mostrar la información
					while($f= $paging->fetchResultado()) 
					{
						
						
							if($f['per_activo']==1)
							{
								$botton="<input type=\"button\" nane='bx' value=\"+\" onClick=\"opener.document.getElementById('text1').value='$f[per_consejo_des]+$f[per_consejo_has]+$f[per_consejo_id]\\n';window.close();\" style='cursor:pointer'>";
							}
							else
							{
								$botton="";
							}
								if($numero%2==0)
								{
								echo "<tr align=center bgcolor='#BDBDBD'>
										<td><font color='white'>".$f['per_consejo_des']."</td>
										<td><font color='white'>". $f['per_consejo_has']."</td>
										<td><font color='white'>".$botton."</font></td>
									</tr>";
								}
								else
								{
									echo "<tr align=center>
											<td>". $f['per_consejo_des']."</td>
											<td>". $f['per_consejo_has']."</td>
											<td>".$botton."</font></td>
										</tr>";
								
								
								
								
								
								
								
	
							
							
							
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
		}
		else
		{
			$query="SELECT * FROM per_consejo WHERE per_activo=1 and  per_consejo_des  like '%$c1%' OR per_consejo_has like'%$c2%' and  per_activo=1 "; //query validar proceso
			
				
				
				//consulta ejecutada
				$consul=mysql_query($query);
			
						
				
				
				
				if(mysql_num_rows($consul)>0)
				{
					
							
						echo " <br>".@$id."<table border='0' cellpadding='1' cellspacing='0' >
						<tr align=center>
							<th>Periodo Desde</th>
							<th>Periodo Hasta</th>
							<th>Agregar</th>
																				
						</tr>
					
					";
		

		
					
					$paging = new PHPPaging;
						$paging->modo('publicacion');
						$mantenerURLVar = array('pagina','id','hi','c1','c2','$_GET[id]'); 	
					
					//hacemos la consulta SQL que mostrará los resultados
					$paging->agregarConsulta("$query");
					
					//  Ejecutamos la paginación
					   $paging->ejecutar(); 
					
					//color de columna
					$numero=0;
					
					//un bucle de repeticion para mostrar la información
					while($f= $paging->fetchResultado()) 
					{
						if($f['per_activo']==1)
							{
								$botton="<input type=\"button\" nane='bx' value=\"+\" onClick=\"opener.document.getElementById('text1').value='$f[per_consejo_des]+$f[per_consejo_has]+$f[per_consejo_id]\\n';window.close();\" style='cursor:pointer'>";
							}
							else
							{
								$botton="";
							}
						
							
								if($numero%2==0)
								{
								echo "<tr align=center bgcolor='#BDBDBD'>
										<td><font color='white'>".$f['per_consejo_des']."</td>
										<td><font color='white'>". $f['per_consejo_has']."</td>
										<td><font color='white'>".$botton."</font></td>
									</tr>";
								}
								else
								{
									echo "<tr align=center>
											<td>". $f['per_consejo_des']."</td>
											<td>". $f['per_consejo_has']."</td>
											<td>".$botton."</font></td>
										</tr>";
								
								
								
								
								
								
								
	
							
							
							
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