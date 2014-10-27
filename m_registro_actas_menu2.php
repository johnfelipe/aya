<?php
//inclumos la base de datos
include("./Connections/cx.php");
//inlcuimos lso calendarios
include("scrips/calendario/calendario.php");
//include("scrips/calendario/calendario.php");

//esctraemos todas las variables
extract($_REQUEST);
//icniaializacmos las secciones
session_start();
$mensaje='';
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

$borrar_tempo=mysql_query("delete from t_01");
$borrar_tempo=mysql_query("delete from t_02");
$borrar_tempo=mysql_query("delete from t_03");
$borrar_tempo=mysql_query("delete from tempo");
/*
$query_anio=mysql_query("SELECT periodo FROM datos");
$row_anio=mysql_fetch_array($query_anio);

$date=date('Y-m-d');
$antes=explode('-',$date);
$resta=intval($antes[0])-$row_anio['periodo'];
$date2=$resta."-".date('m-d');
$query_rango_date=mysql_query("select * from per_consejo where date(per_consejo_des) between '$date2' and '$date' ");
$fet=mysql_fetch_array($query_rango_date);

*/
//consutla para saber si han registrado actas

$query_datos=mysql_query("SELECT * FROM datos");
$row_datos=mysql_fetch_array($query_datos);

	$query_numero_de_per=mysql_query("SELECT per_consejo_id, per_consejo_id   FROM per_consejo  WHERE per_activo=1");
	
	$compro_numero_per=mysql_num_rows($query_numero_de_per);
	if($compro_numero_per==1)
	{
		//NUMERO EDITABLE DE ACTA
			$row_per=mysql_fetch_array($query_numero_de_per);
		$query_numero_de_acta=mysql_query("SELECT * FROM actas  WHERE act_conid=$row_per[per_consejo_id]");
		$row__acta=mysql_fetch_array($query_numero_de_acta);
		
		$compro_numero_acta=mysql_num_rows($query_numero_de_acta);
		if($compro_numero_acta<1)
		{
			$n_acta=$row_datos['n_acta_ini'];
			
		}
		else
		{
			$n_acta=$row_datos['n_acta_ini']+$compro_numero_acta+1;
		}
		/*
		
		//NUMERO AUTOMATICO DE ACTA 
			$row_per=mysql_fetch_array($query_numero_de_per);
		$query_numero_de_acta=mysql_query("SELECT * FROM actas  WHERE act_conid=$row_per[per_consejo_id]");
		
		$compro_numero_acta=mysql_num_rows($query_numero_de_acta);
		if($compro_numero_acta<1)
		{
			$n_acta=1;
			
		}
		else
		{
			$n_acta=$compro_numero_acta+1;
		}
		
		
		
		*/
		
		
	}
	else
	{
		header("location: m_registro_consejo_consejo.php");
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
    <li><a href="m_registro_consejo.php">Concejo</a></li>
    <li><a href="#">Actas</a></li>
    <li><a href="m_registro_acuerdos.php">Acuerdos</a></li>
    </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
 
	

<div align="center">
  
  <table width="75%" border="0" cellspacing="5" align="center">
    <tr>
      
      <td align="center"><h2 >Registro de Bilbros, Años Fiscales y Actas</h2></td>
      </tr>
    <tr>
      <td align="center">
        <form method="post" name="registro_actas" enctype="application/x-www-form-urlencoded" action="registro/procesa_acta.php" >
          <table width="60%" border="0" cellspacing="5">
            <tr>
              <th width="100%" scope="row"><table width="200" border="0">
                <tr>
                  <td><a href="m_registro_libro.php" target="_self"><img src="img/libro.jpg" width="180" height="206" alt="libros" title="Registro de Libros y Años Fiscales"/></a>&nbsp;</td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td><a href="m_registro_acuerdos_con_libro.php" target="_self"><img src="img/acta-de-nacimiento.jpg" width="261" height="206" alt="Registro de Actas" title="Registro de Actas" /></a></td>
                </tr>
              </table></th>
            </tr>
            </table>
          </form>
        
        </td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>&nbsp;</td>
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
