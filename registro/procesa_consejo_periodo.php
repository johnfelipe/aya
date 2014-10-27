<?php
//coneccion a BD
include("../Connections/cx.php");
//extraccion de todas las funciones
extract($_REQUEST);





//inicio de las funciones de seccion
session_start();
//mkdir('./img/personas', 0777);
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

if(isset($guardar))
{
//	echo $text1;
	//echo $_FILES["foto"]["name"];
	
	$par0=explode('-',$text1);
	$par1=explode('-',$text2);
	$date0=$par0[2].'-'.$par0[1].'-'.$par0[0];
	$date1=$par1[2].'-'.$par1[1].'-'.$par1[0];
	//echo $h1."_".$par0[1]."_".$par1[1]."_".$text4;
	
		if(mysql_query("INSERT INTO per_consejo VALUES('','$date0','$date1',1)"))
		{
			$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Registro un Perido de Concejo del $text1 al $text2 ')");
			$mensaje="<h2>Datos Almacenados</h2>";
		}
		else
		{
			$mensaje="<font color=\"#FF0000\">Error Al Almacenar los Datos</font><br>";			
		}
	
	
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla_1.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Aplicacion de actas y acuerdos</title>
<meta http-equiv="refresh" content="1;URL=../m_registro_consejo_consejo.php"> 
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
</form><!-- InstanceEndEditable --></div>
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
     <li class="first" ><a href="../inicio.php">Inicio</a></li>
    <li id="active"><a href="../m_registro.php">Registro</a></li>
    <li ><a href="../m_consultas.php">busquedas</a></li>
    <li><a href="../contruccion_reportes.php">reportes</a></li>
    <li><a href="../m_mantenimiento.php">Mantenimiento</a></li>
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
          <td align="center"><h2 >Registro de Consejo</h2></td>
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
