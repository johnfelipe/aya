<?php
//coneccion a BD
include("../Connections/cx.php");
//extraccion de todas las funciones
extract($_REQUEST);





//inicio de las funciones de seccion
session_start();
if(!isset($_SESSION["login"]))
{
header("location: ../index.php");
}

//desturi session
if(isset($des))
{	
	//echo "<h1>funca</h1>";
		//unset($_SESSION['login']);
		$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Cerro Sessión')");
		session_destroy();
		
		header("location: ../index.php");
		
}

//echo fileperms ('../img/personas'); 

if(isset($h1))
{
		$part1=explode('+',$text2);
		$cargo=$part1[1];
		
		$part2=explode('-',$text3);
		$date1=$part2[2].'-'.$part2[1].'-'.$part2[0];
		
		$part3=explode('-',$text4);
		$date2=$part3[2].'-'.$part3[1].'-'.$part3[0];
		//echo $h1.'_'. $cargo.'_'.$text3.'_'.$date1.'_'.$select1;
	
		if($insert=mysql_query("UPDATE empleados SET emp_carid=$cargo, emp_des='$date1', emp_has='$date2', emp_estado=$select1 WHERE emp_id=$h1" ))
		{
			$par=explode('+',$text1);
				if($select1==1)
				{
				$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Actualizo los Datos del Empleado $par[0] con Cargo $part1[0]')");
				}
				else
				{
					$query=mysql_query("SELECT * FROM usuarios WHERE usu_eid=$h1");
					$valida=mysql_num_rows($query);
					if($valida>=1)
					{
						while($row=mysql_fetch_array($query))
						{
						mysql_query("UPDATE usuarios SET  usua_ac=2 WHERE usu_eid=$h1" );
						$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Elimino al Usuario $row[usu_usu]')");
						}
					}
					else
					{
						$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Desactivo al  Empleado $par[0] con Cargo $part1[0]')");
					}
					
					
				}
			$mensaje="<h2>Datos Editados</h2>
					<br>";
		}
		else
		{
			$mensaje.="
					<font color=\"#FF0000\">Imposble Editar datos del Empleado</font><br>";
		}
		
	
}
else
{
	$insert=mysql_query("INSERT INTO bitacora (text) VALUES('Acceso de $_SESSION[name] fallido al  Área de Mantenimiento Mediante la URL')");
	header("location: ../m_manto_edit_empleados.php");
	
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla_1.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Aplicacion de actas y acuerdos</title>
<meta http-equiv="refresh" content="2;URL=../m_manto_edit_empleados.php"> 
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
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
     <li class="first"><a href="../inicio.php">Inicio</a></li>
    <li><a href="../m_registro.php" >Registro</a></li>
    <li><a href="../m_consultas.php">busquedas</a></li>
    <li><a href="../services.html">reportes</a></li>
    <li id="active"><a href="../m_mantenimiento.php">Mantenimiento</a></li>
    <li><a href="#">salir</a></li>
    <li><a href="#">&nbsp;</a></li>
    
    </ul>
  
    </div>
   
    <div id="submenu">
        </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
    <div align="center" id="table1">
      <table width="200" border="0" cellspacing="5">
        <tr>
          <td align="center"><h2>Edicion de Empelados</h2></td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>
          
              <table width="328" border="0" cellspacing="5">
                <tr>
                  <td width="309" align="center"><?php echo $mensaje; ?></td>
                </tr>
                </table>
        
            </td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
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
