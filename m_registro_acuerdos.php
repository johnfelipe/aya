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
//mkdir('./img/personas', 0777);
if(!isset($_SESSION["login"]))
{
	$insert=mysql_query("INSERT INTO bitacora (text) VALUES('Acceso de Intruso fallido al Área de Registro  Mediante la URL')");
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



$borrar_tempo=mysql_query("delete from tempo");
$query_anio=mysql_query("SELECT periodo FROM datos");
$row_anio=mysql_fetch_array($query_anio);

$date=date('Y-m-d');
$antes=explode('-',$date);
$resta=intval($antes[0])-$row_anio['periodo'];
$date2=$resta."-".date('m-d');
$query_rango_date=mysql_query("select * from per_consejo where per_activo=1 ");
$validar_per=mysql_num_rows($query_rango_date);

if($validar_per==0)
{
	header("location: m_registro_consejo_consejo.php");
}

$fet=mysql_fetch_array($query_rango_date);


//consutla para saber si han registrado actas
	$query_numero_de_acta=mysql_query("SELECT actas.act_id  FROM actas, per_consejo WHERE per_consejo.per_consejo_id=actas.act_conid AND per_consejo.per_consejo_id=$fet[per_consejo_id]");
	$compro_numero_acta=mysql_num_rows($query_numero_de_acta);
	
	if($compro_numero_acta<1)
	{
		$n_acta=1;
		
	}
	else
	{
		$n_acta=$compro_numero_acta+1;
	}
	
	//// ver q proceso se lleva
	$validar_proc=mysql_query("SELECT proc_legitimo FROM datos WHERE n_datos=1");

$row_pro=mysql_fetch_array($validar_proc);
 if($row_pro['proc_legitimo']==0)
 {
	 header("location: m_registro_acuerdos_a.php");
 }
 else
 {
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
    <li id="active"><a href="./bitacora/bitacora_m_registro.php">Registro</a></li>
    <li><a href="./bitacora/bitacora_m_consultas.php">busquedas</a></li>
    <li><a href="contruccion_reportes.php">reportes</a></li>
    <li><a href="./bitacora/bitacora_m_mantenimiento.php">Mantenimiento</a></li>
    <li><a href="#">salir</a></li>
    <li><a href="#">&nbsp;</a></li>
    
    
    </ul>
  
    </div>
   
    <div id="submenu">
  
   <li><a href="m_registro_personas.php">Personas</a></li>
    <li><a href="m_registro_empleados.php">Empleados</a> </li>
    <li><a href="m_registro_consejo">Concejo</a></li>
    <li><a href="m_registro_actas_menu2.php">Actas</a></li>
    <li><a href="#">Acuerdos</a></li>
    </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
     

<div align="center">

<table width="75%" border="0" cellspacing="5" align="center">
  <tr>
  
    <td align="center"><h2  >Registro del Acuerdos</h2></td>
  </tr>
  <tr>
    <td align="center">
    		
            	<fieldset>
                	<legend>Gestion De Acuerdos</legend>
                    <form method="get" enctype="multipart/form-data" name="f_ges_acu">
                    <table border="0">
                    	<tr>
                        	<td> Busqueda de Actas</td>
                            <td> <input type="text" name="c1" id="c1" /></td>
                            <td>Fecha <input type="text"  name="c2" readonly="readonly" onclick="muestraCalendario('','f_ges_acu','c2')" /></td>
                            <td> <input type="submit" name="buscar" value="Buscar"  />  </td>
                        </tr>
                        <tr>
                        	<td> </td>
                            <td align="center"> <input type="checkbox" name="ck1" checked="checked" />Por N&deg; de actas</td>
                            <td align="center"> <input type="checkbox" name="ck2"  />&nbsp;Por Fecha  </td>
                        </tr>
                        
                    </table>
                    
                    
                    </form>
                </fieldset>
    
    </td>
  </tr>
  <tr>
  	<td align="center">
    	<br /><br />
        
    	<?php

if(@$buscar)
{
		
			//funciones
			@$actas=$_GET['c1']; //acta
			@$ck2=$_GET['ck2']; //ckeck 2
			
			//trado de la fecha
			@$part=explode('-',$c2);
			@$date=$part[2]."-".$part[1]."-".$part[0];
			//fin fecha
			
						
			$query="select actas.act_id, actas.act_conid, actas.act_num, actas.act_fecha, actas.act_type from per_consejo, actas where act_num like '%$actas%' AND per_consejo.per_consejo_id=actas.act_conid AND per_consejo.per_activo=1"; //query por defaul
			
			if(isset($ck2))
				{
					$query=$query." and act_fecha= '$date'";
				} 
				
				//consulta ejecutada
				$consul=mysql_query($query);
					
					// comprobar datos enviados
					//echo "query".mysql_num_rows($consul);
					
								//;
				
				if(mysql_num_rows($consul) > 0)
				{
					// tabla si se afecto columnas
					echo "<div style=\"font-size:12px\"> <table border='0' border=\"0\" cellspacing=\"0\" >
						<tr>
							<th>N&deg; de acta</th>
							<th>Fecha de realizacion</th>
							<th>Agregar Acuerdos</th>
							
						
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
						$activa=mysql_query("select * from actas where  act_id=$f[act_id]");
						$valida=mysql_fetch_array($activa);
						
							$date_p=explode('-',$f['act_fecha']);
							$date_leer=$date_p['2'].'-'.$date_p['1'].'-'.$date_p['0'];
												
							if($valida['estado']=='activo' )
							{
									
								if($numero%2==0)
								{
								echo "<tr align=center bgcolor='#BDBDBD'>
										<td><font color='white'>&nbsp;".$f['act_num']."&nbsp;</td>
										<td><font color='white'> &nbsp;".$date_leer."&nbsp;</td>
										<td><font color='white'>&nbsp;<a href=\"./m_registro_acuerdos_datos.php?id=$f[act_id]\" target=\"_self\">agregar</a> &nbsp;</td>
									</tr>";
								}
								else
								{
									echo "<tr align=center>
											<td>".$f['act_num']."</td>
											<td>".$date_leer."</td>
											<td><a href=\"./m_registro_acuerdos_datos.php?id=$f[act_id]\" target=\"_self\">agregar</a></td>
											
										</tr>";
								
								}
								
								
								
								
								
	
							
							
							}
							else
							{
								
								if(!($numero%2==0))	
								{
									echo  "<tr align=center>
									<td>".$f['act_num']."</td>
									<td>".$date_leer."</td>
									<td><font color=red>Acta Cerrada</font></td>
									</tr>";
								}
								else
								{
									echo  "<tr align=center bgcolor='#BDBDBD'>
									<td><font color='white'>".$f['act_num']."</td>
									<td><font color='white'>".$date_leer."</td>
									<td><font color='white'><font color=red>Acta Cerrada</font></td>
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
					
					echo "</table><br /><br /></div>";
					
				}
				
				  
			
		}






?>
    </td>
  </tr>

</table>




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
