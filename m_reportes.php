<?php
//inclumos la base de datos
include("./Connections/cx.php");
//inlcuimos lso calendarios
include("scrips/calendario/calendario.php");

//incluimos libreria paginacion;

include ("scrips/pag_lib/PHPPaging.lib.php");

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
if($_SESSION["tipo"]=='u1')
{
	$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] intento acceseder al menu reportes)");
header("location: inicio.php");
}
if($_SESSION["tipo"]=='u2')
{
	$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] intento acceseder al menu reportes)");
header("location: inicio.php");
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
    <li class="first"><a href="inicio.php">Inicio</a></li>
    <li ><a href="m_registro.php" >Registro</a></li>
    <li><a href="m_consultas.php">busquedas</a></li>
    <li id="active"><a href="#">reportes</a></li>
    <li ><a href="m_mantenimiento.php">Mantenimiento</a></li>
    <li><a href="#">salir</a></li>
    <li><a href="#">&nbsp;</a></li>
    
    </ul>
  
    </div>
   
    <div id="submenu">
	<li><a href="m_reportes_historicos.php">historicos</a></li>
    <li><a href="#">consejo</a></li>
	<li><a href="#">personas</a></li>
	<li><a href="#">empleados</a></li>
	<li><a href="m_reportes.php">bitacora</a></li>

    </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
     

<div align="center">
	<div align="center" >
<table width="85%" border="0" cellspacing="5" align="center">
  <tr>
  
    <td align="center"><img src="./img/reportes.png" width='350 px'></td>
  </tr>
  <tr>
    <td align="center">
    		
            <h2>Área de Reportes</h2>	
                 
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
			
			
			
			
			mysql_query("SET NAMES UTF8");
						
			$query="SELECT * FROM bitacora WHERE text LIKE '%$c1%'  ORDER BY  stamp "; //query por defaul
			
			if(isset($ck2))
				{
					//trado de la fecha
			@$part=explode('-',$c2);
			@$date=$part[2]."-".$part[1]."-".$part[0];
			@$part2=explode('-',$c3);
			@$date2=$part2[2]."-".$part2[1]."-".$part2[0];
			//fin fecha
					$query="SELECT * FROM bitacora WHERE text LIKE '%$c1%' AND date(stamp) BETWEEN '$date' AND '$date2' ORDER BY  stamp ";
				} 
				
				//consulta ejecutada
				$query.=" ";
				$consul=mysql_query($query);
				if(mysql_num_rows($consul) > 0)
				{
					// tabla si se afecto columnas
					echo " <table border='1' cellspacing=\"0\" width=\"500\" >
						<tr>
							<th align='center' width='85 px'>Fecha&nbsp;</th>
							<th  align='center'>Hora</th>
							<th  align='center'>Descripción</th>
							
							
						
						</tr>
					
						
					
					
					";
					
					
	
	
					
					
					$paging = new PHPPaging;
						$paging->modo('publicacion');
						$mantenerURLVar = array('paginasok', 'hi','c1','c2','c3'); 	
					
					//hacemos la consulta SQL que mostrará los resultados
					$paging->agregarConsulta("$query");
					$pepin=base64_encode($query);
					
					//  Ejecutamos la paginación
					   $paging->ejecutar(); 
					
					//color de columna
					$numero=0;
					
					//un bucle de repeticion para mostrar la información
					while($f= $paging->fetchResultado()) 
					{
						$part_=explode(' ',$f['stamp']);
						
						$fe=explode('-',$part_[0]);
						$date_0=$fe[2].'-'.$fe[1].'-'.$fe[0];
						
						
			
										
							
									
								if($numero%2==0)
								{
								echo "<tr align=center bgcolor='#BDBDBD'>
										<td><font color='white'>&nbsp;".$date_0."&nbsp;</td>
										<td><font color='white'> &nbsp;".$part_[1]."&nbsp;</td>
										<td><font color='white'>&nbsp;".$f['text']."</td>
										
									</tr>";
								}
								else
								{
									echo "<tr align=center>
											<td>".$date_0."</td>
											<td>".$part_[1]."</td>
											<td>&nbsp;".$f['text']."</td>
											
											
										</tr>";
								
								}
								
								
								
								
								
	
							
							
							
								
								
								
								
								
	
							
							
							
							
						
							
								
							
						$numero+=1;
					}
			
					//Mostrarmos la cantidad de paginas enlas que se mostraran toda la informacion
					echo "
							<tr>
								<td colspan='3' align='center'>
									<br /><a href=\"impresiones/bitacora_pdf.php?q_zl1=".$pepin."\" target=\"_blank\"><input type=\"button\" value=\"Imprimir Bitácora\"  style=\"cursor: pointer\"></a><br />
								</td>
							</tr>
							<tr >
							<th colspan='3' align='center'>
							Página ".$paging->numEstaPagina()." de ".$paging->numTotalPaginas()."<br />
								Mostrando ".$paging->numRegistrosMostrados()." resultados, del ".$paging->numPrimerRegistro()." al ".$paging->numUltimoRegistro()." de un total de ".$paging->numTotalRegistros()."
							<td>
							</tr>
						<tr >
							<th colspan='3' align='center'>Paginas ".$paging->fetchNavegacion()."
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
