<?php
//inclumos la base de datos
include("./Connections/cx.php");
//inlcuimos lso calendarios
include("scrips/calendario/calendario.php");

//incluimos libreria paginacion;

include ( 'scrips/pag_lib/PHPPaging.lib.php');

//esctraemos todas las variables
extract($_REQUEST);
//icniaializacmos las secciones
session_start();
mysql_query("SET NAMES UTF8");
if(!isset($_SESSION["login"]))
{
	$insert=mysql_query("INSERT INTO bitacora (text) VALUES('Acceso de Intruso fallido al  Área de Mantenimiento')");
header("location: index.php");
}

//desturi session
if(isset($des))
{	
	//echo "<h1>funca</h1>";
		//unset($_SESSION['login']);
		$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Cerro Sessión')");
		session_destroy();
		
		header("location: index.php");
		
}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla_1.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Registro Actas</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->

<script language="javascript" src="scrips/calendario/javascripts.js"></script>


<!-- InstanceEndEditable -->
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrap">
<div id="header">
<div id="logo">
<h1 id="sitename"><img src="img/logo1.png"  /><span class="green"></span></h1>
<h2 class="description">&nbsp;</h2>
</div>
<div id="headercontent"><!-- InstanceBeginEditable name="EditRegion_session" -->
<form method="post" name="session" enctype="application/x-www-form-urlencoded"> 
<table width="295" border="0" align="center" background="">
  <tr>
    <td colspan="4" align="center"><h2>Bienvenid@: </h2></td>
  </tr>
  <tr>
    <td width="95" align="center"><img src="img/personas/<?php echo $_SESSION['img']; ?>"  width="50 px" height="70 px" title=" <?php echo $_SESSION['name']; ?>" alt=" <?php echo $_SESSION['name']; ?>"/></td>
    <td width="165" colspan="3" align="center"><h2><?php echo $_SESSION['name']; ?> </h2> </td>
    </tr>
    <tr>
    	<td colspan="4" align="center"><input type="submit"
        name="des" value="Cerrar Sesión"   />      </td>
    </tr>
  </table>
</form>
<!-- InstanceEndEditable --></div>
<div id="sitecption"><!-- InstanceBeginEditable name="EditRegion_tex2" -->
<p>Alcaldía  <span class="bigger">Municipal</span></p>
  <p> de Usulután</p>
<!-- InstanceEndEditable --></div>
</div>
<div id="main">
<div id="menus">
	<!-- InstanceBeginEditable name="EditRegion_menu" -->
    <div id="mainmenu">
    
    <ul>
<li class="first" ><a href="inicio.php">Inicio</a></li>
    <li ><a href="./bitacora/bitacora_m_registro.php">Registro</a></li>
    <li><a href="./bitacora/bitacora_m_consultas.php">busquedas</a></li>
    <li><a href="contruccion_reportes.php">reportes</a></li>
    <li id="active"><a href="./bitacora/bitacora_m_mantenimiento.php">Mantenimiento</a></li>
    <li><a href="#">salir</a></li>
    <li><a href="#">&nbsp;</a></li>    
    </ul>
  
    </div>
   
    <div id="submenu">
     <li><a href="#">Edicion Periodo Concejo</a>
    <li><a href="m_manto_edit_consejo.php">Edicicion del consejo</a></li>
   
    </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
     

<div align="center">

<table width="85%" border="0" cellspacing="5" align="center">
  <tr>
  
    <td align="center"><h2 >Edicion del Periodo</h2></td>
  </tr>
  <tr>
    <td align="center">
    		
            	
                    <form method="get" enctype="multipart/form-data" name="impre_acu_acta">
                    <table border="0" cellpadding="5" cellspacing="5">
                    	<tr>
                        	<td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td> Desde
                            <input type="text"  name="c2" readonly="readonly" onclick="muestraCalendario('','impre_acu_acta','c2')" /></td>
                            
                            <td>hasta
                            <input type="text"  name="c3" readonly="readonly" onclick="muestraCalendario('','impre_acu_acta','c3')" /></td>
                            <td> <input type="submit" name="buscar" value="Buscar"  />  </td>
                            
                        </tr>
                        <tr>
                        	<td>&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="left" colspan="3">&nbsp; <input type="checkbox" name="ck1"  checked="checked" />
Por Rango de Fecha</td>
                        </tr>
                    </table>
                    
                    
                    </form>
                
    
    </td>
  </tr>
  <tr>
  	<td align="center">
    	<br /><br />
        
    	<?php
		extract($_REQUEST);

if(isset($buscar))
{
		
			//funciones
			
			
			
			@$part=explode('-',$c2);
			@$date=$part[2]."-".$part[1]."-".$part[0];
			@$part2=explode('-',$c3);
			@$date2=$part2[2]."-".$part2[1]."-".$part2[0];
			
						
			$query="SELECT * FROM per_consejo WHERE  per_consejo_des LIKE '%%' AND 	per_consejo_has LIKE '%%' "; //query por defaul
			
			/*if(isset($ck2))
				{
					//trado de la fecha
			
			//fin fecha
					$query="SELECT * FROM actas WHERE act_num LIKE '%$c1%' AND date(act_fecha) BETWEEN '$date' AND '$date2' ORDER BY act_id, act_num";
				} */
				
				//consulta ejecutada
				$query.=" ORDER BY per_consejo_id ";
				$consul=mysql_query($query);
				if(mysql_num_rows($consul) > 0)
				{
					// tabla si se afecto columnas
					echo " <table border='0' cellspacing=\"0\" >
						<tr>
							<th>Inicio</th>
							<th>Fin</th>
							<th>Acción</th>
							
							
						
						</tr>
					
						
					
					
					";
					
					/*while($rows=mysql_fetch_array($consul))
					{
					echo "<tr>
							<td class='repor'>".$rows['act_num']."</td>
							<td class='repor'>".$rows['act_fecha']."</td>
							<td class='repor'><a href=\"../registro/acuerdos.php?id=$rows[act_id]\" target=\"_self\">agregar</a> </td>
						   </tr>";
						//<div style='cursor:pointer' onclick=\"open('../registro/acuerdos.php?id=$rows[act_num]','hola','_self','fullscreen=yes')\">agregar</div></td>
						
					}*/
					
					
					
	//incia paginacion
	
	
	
					
					
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
						
						
							$date_p=explode('-',$f['per_consejo_des']);
							$date_leer=$date_p['2'].'-'.$date_p['1'].'-'.$date_p['0'];
							
							$date_p1=explode('-',$f['per_consejo_has']);
							$date_leer1=$date_p1['2'].'-'.$date_p1['1'].'-'.$date_p1['0'];
												
							if($f['per_activo']==1)
							{
									
								if($numero%2==0)
								{
								echo "<tr align=center bgcolor='#BDBDBD'>
										<td><font color='white'>&nbsp;".$date_leer."&nbsp;</td>
										<td><font color='white'> &nbsp;".$date_leer1."&nbsp;</td>
										<td><font color='white'>&nbsp;<a href=\"m_manto_edit_periodo_datos.php?id=".$f['per_consejo_id']."\" target=\"_self\" ><img src=\"img/pencil.png\" width=\"30 px\" alt=\"Editar Periodo\" title=\"Editar Periodo\"></a>
											
											<a href=\"registro/delete_periodo.php?id=".$f['per_consejo_id']."\" target=\"_self\" ><img src=\"img/eliminar.png\" width=\"30 px\" alt=\"Eliminar Periodo\" title=\"Eliminar Periodo\"></a>
										
										 </td>
										
									</tr>";
								}
								else
								{
									echo "<tr align=center>
											<td>".$date_leer."</td>
											<td>".$date_leer1."</td>
											<td><a href=\"m_manto_edit_periodo_datos.php?id=".$f['per_consejo_id']."\" target=\"_self\" ><img src=\"img/pencil.png\" width=\"30 px\" alt=\"Editar Periodo\" title=\"Editar Periodo\"></a>
											
											<a href=\"registro/delete_periodo.php?id=".$f['per_consejo_id']."\" target=\"_self\" ><img src=\"img/eliminar.png\" width=\"30 px\" alt=\"Eliminar Periodo\" title=\"Eliminar Periodo\"></a>
											 </td>
											
											
										</tr>";
								
								}
							}
							else
							{
								
								
							if($numero%2==0)
								{
								echo "<tr align=center bgcolor='#BDBDBD'>
										<td><font color='white'>&nbsp;".$date_leer."&nbsp;</td>
										<td><font color='white'> &nbsp;".$date_leer1."&nbsp;</td>
										<td></td>
										
									</tr>";
								}
								else
								{
									echo "<tr align=center>
											<td>".$date_leer."</td>
											<td>".$date_leer1."</td>
											<td><</td>
											
											
										</tr>";
								
								}	
								
								
								
							}
								
					
							
						$numero+=1;
					}
					
					//Mostrarmos la cantidad de paginas enlas que se mostraran toda la informacion
					echo "
							<tr>
								<td colspan='5' align='center'>
									&nbsp;
								</td>
							</tr>
							<tr >
							<th colspan='5' align='center'>
							Página ".$paging->numEstaPagina()." de ".$paging->numTotalPaginas()."<br />
								Mostrando ".$paging->numRegistrosMostrados()." resultados, del ".$paging->numPrimerRegistro()." al ".$paging->numUltimoRegistro()." de un total de ".$paging->numTotalRegistros()."
							<td>
							</tr>
						<tr >
							<th colspan='5' align='center'>Paginas ".$paging->fetchNavegacion()."
							</tr>";
						//eliminamos datos enviado en javascrip
						
			
	
	//fin paginacion
					
					echo "</table><br />";
					
				}
				
				  
			
		}






?>
    </td>
  </tr>

</table>

  </a>


    </div
>
    <!-- InstanceEndEditable -->
    </div>
<div class="clear"></div>



</div>
</div>
<div id="footer">
Aplicaion_actas&amp;acuerdos &copy; Todos los Derechos reservados 2012<br />

Tec. Oscar René Sánchez<br />
version 0.2.0</div>



</div>
</body>
<!-- InstanceEnd --></html>
