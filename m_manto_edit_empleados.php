<?php

include("./Connections/cx.php");
include("scrips/pag_lib/PHPPaging.lib.php");
extract($_REQUEST);
session_start();
//mkdir('./img/personas', 0777);
if(!isset($_SESSION["login"]))
{
$insert=mysql_query("INSERT INTO bitacora (text) VALUES('Acceso de Intruso fallido al  Área de Mantenimiento')");
header("location: index.php");
}

if($_SESSION['tipo']<>'root')
{
	$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] intento Acceder al Área de Mantenimiento ')");	
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


//echo fileperms ('../img/personas'); 
/*
if(isset($guardar))
{
	
	//chmod ('./img/personas',0777); 
	
	if(isset($_FILES["foto"]["tmp_name"]))
	{
		$nombre = $_FILES["foto"]["name"];
		$destino =  "./img/personas/".$nombre;
		if($_FILES['foto']["type"]='image/jpeg')
		{
			if($_FILES['foto']['size']< 1000000)
			{
				/*if(is_uploaded_file($_FILES['foto']['tmp_name']))
				{*/
					/*if(copy($_FILES['foto']['tmp_name'],$destino))
					{
						$mensaje="sos paloma";
					}
				
				
			}
			else
			{
				$mensaje="<font color=\"#FF0000\">magen no pudo ser almacenada. Debe tener un peso menor de 1 Megabyte </font>";
				
			}
		}
		else
		{
			$mensaje="<font color=\"#FF0000\">Formato de Imageno no Soportado</font>".$fileField."__".$HTTP_POST_FILES[$fileField]['type']."---".$imagen." la imagen";
			
		}
	}
	else
	{
		$mensaje="<font color=\"#FF0000\">no acede a los datos</font>";
	}
	
}*/

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla_1.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Aplicacion de actas y acuerdos</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
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
    <li><a href="m_registro.php" >Registro</a></li>
    <li><a href="m_consultas.php">busquedas</a></li>
    <li><a href="contruccion_reportes.php">reportes</a></li>
    <li id="active"><a href="m_mantenimiento.php">Mantenimiento</a></li>
    <li><a href="#">salir</a></li>
    <li><a href="#">&nbsp;</a></li>
    
    </ul>
  
    </div>
   
    <div id="submenu">
    <li><a href="m_manto_sistema.php">Configuraciones de Sistema</a></li>
    <li><a href="m_manto_ges_dato.php">Gestion Datos</a> </li>
    <li><a href="m_manto_ges_perdato.php">Gestion Actas y consejo</a> </li>
    <li><a href="m_manto_repor.php">Bitácora</a></li>
    <li><a href="m_manto_copias.php">Copias de Seguridad</a></li>
        </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
    <div align="center" id="table1">
    <div align="center">
      <table width="70 %" border="0" cellspacing="5" align="center">
        <tr>
          <td align="center"><h2 >Edición Datos de los Empleados</h2></td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>
             <table border="0" align="center" width="100%">
      
     		 <tr>
        	<td  align="center">
            	<fieldset >
                	<legend>Busqueda de cargos</legend>
                    <form method="GET" name="pero_conesjo">
                    <br />
                    <table align="center" width="80%">
                    <tr>
                      <td rowspan="2">Busqueda de Cargos</td>
                      <td><input type="text" name="c1" id="c1"  /></td>
                      <td><input type="text" name="c2" maxlength="11" size="12"  /></td>
                      <td><input type="text" name="c3" size="12"  /></td>
                      <td><input type="text" name="c4" size="13" /></td>
                      <td rowspan="2"><input type="submit" value="Buscar" name="buscar" /> <input type="reset" value="borrar"  /></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="ck1" checked="checked"  />
Por Cargo</td>
                      <td><input type="checkbox" name="ck2"  />
Por Nombre</td>
                      <td><input type="checkbox" name="ck3" />
                        Por Apellido</td>
                    	<td><input type="checkbox" name="ck4" />
                    	  Por DUI</td>
                    	</tr>
                    
                    
                    
                    </table>
                    
                    
                    
                    </form>
                </fieldset>
            
            </td>
        </tr>
   
      
      </table>

            </td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td align="center">
		  <?php




//funciones
$mensaje="";

					
					
	if(isset($_GET['buscar']))
	{

		
		//trado de los apellidos
				
		
			
			
	     
			mysql_query("SET NAMES UTF8");
			$query="SELECT cargo.car_m, personas.nombres, personas.primer_apellido, personas.dui, empleados.emp_des, empleados.emp_has, empleados.emp_id FROM personas, empleados , cargo WHERE personas.id_persona=empleados.emp_perid AND empleados.emp_carid=cargo.car_id AND empleados.emp_estado=1 and cargo.car_m like '%$c1%' "; //query por defaul
			
			if(isset($ck2))
				{
					$query=$query." AND personas.nombres LIKE '%$c2%' ";
				} 
				if(isset($ck3))
				{
					$query=$query." AND  personas.primer_apellido LIKE '%$c3%' ";
				}
				if(isset($ck4))
				{
					$query=$query." AND  personas.dui LIKE '%$c4%' ";
				}
			
				$query.=" ORDER BY personas.id_persona";
				//consulta ejecutada
				$consul=mysql_query($query);
				//funcio

				
				
				
				
				if(mysql_num_rows($consul)>0)
				{
						echo " <br><table border='0' cellpadding='1' cellspacing='0' cellspacing=\"5\" >
						<tr align=center>
							<th>Cargo</th>
							<th>Nombre</th>
							<th>Apellido&nbsp;</th>
							<th>DUI</th>
							<th>periodo</th>
							<th>&nbsp;Acción</th>
													
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
						
						
							
								if($numero%2==0)
								{
								echo "<tr align=center bgcolor='#BDBDBD'>
										<td><font color='white'>&nbsp;". $f['car_m']."&nbsp;</td>
										<td><font color='white'> &nbsp;". $f['nombres']."&nbsp;</td>
										<td><font color='white'>&nbsp;". $f['primer_apellido']."&nbsp;</td>
										<td><font color='white'>&nbsp;". $f['dui']."&nbsp;</td>
										<td><font color='white'></font></td>
										<th><input type=\"button\" value=\"Editar\" onclick=\"open('m_manto_edit_empleados_datos.php?id=". $f['emp_id']."','_self','width=900, height=700','scrollbars=yes')\" style=\"cursor: pointer\" /></th>
									</tr>";
								}
								else
								{
									echo "<tr align=center>
											<td>". $f['car_m']."</td>
											<td>". $f['nombres']."</td>
											<td>". $f['primer_apellido']."</td>
											<td>". $f['dui']."</td>
											<td></td>
											<th><input type=\"button\" value=\"Editar\" onclick=\"open('m_manto_edit_empleados_datos.php?id=". $f['emp_id']."','_self','width=900, height=700','scrollbars=yes')\" style=\"cursor: pointer\"  /></th>
										</tr>";
						
							}
							
						
							
								
							
						$numero+=1;
					}
					
					//Mostrarmos la cantidad de paginas enlas que se mostraran toda la informacion
					echo "
					<tr >
							<th colspan='6' align='center'>
							&nbsp;
							<th>
						</tr>
						<tr >
							<th colspan='6' align='center'>
							Página ".$paging->numEstaPagina()." de ".$paging->numTotalPaginas()."<br />
								Mostrando ".$paging->numRegistrosMostrados()." resultados, del ".$paging->numPrimerRegistro()." al ".$paging->numUltimoRegistro()." de un total de ".$paging->numTotalRegistros()."
							<th>
						</tr>
						<tr >
							<th colspan='6' align='center'>Paginas ".$paging->fetchNavegacion()."
							</tr>";
						//eliminamos datos enviado en javascrip
						
				}
				
				
				
				
				
	}
	
		
	


?>
</td>
          <td>&nbsp;</td>
          </tr>
        </table>
    </div>
   
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
