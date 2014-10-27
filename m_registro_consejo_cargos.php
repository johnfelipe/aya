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

$query_anio=mysql_query("SELECT periodo FROM datos");
$row_anio=mysql_fetch_array($query_anio);

$date=date('Y-m-d');
$antes=explode('-',$date);
$resta=intval($antes[0])-$row_anio['periodo'];
$date2=$resta."-".date('m-d');
$query_rango_date=mysql_query("select * from per_consejo where per_activo=1");
$valida=mysql_num_rows($query_rango_date);
if($valida==0)
{
 header("location: m_registro_consejo_consejo.php");
}
$contenido=mysql_fetch_array($query_rango_date);

$part0=explode('-',$contenido['per_consejo_des']);
$part1=explode('-',$contenido['per_consejo_has']);

$desde=$part0['2'].'-'.$part0['1'].'-'.$part0['0'];
$hasta=$part1['2'].'-'.$part1['1'].'-'.$part1['0'];



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
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
    <li><a href="m_registro_actas_menu2.php">Actas</a></li>
    <li><a href="m_registro_acuerdos.php">Acuerdos</a></li><strong></strong>
    </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
      <p>&nbsp;</p>

<div align="center">

<table width="350" border="0" cellspacing="5">
  <tr>
    <td align="center"><h2 >Registro del Concejo</h2></td>
  </tr>
  <tr>
    <td align="center">
    <form method="post" enctype="application/x-www-form-urlencoded" name="registo_consejo" action="registro/procesa_consejo.php">
    	<table width="300" border="0" cellspacing="5">
          <tr>
            <th scope="row">Periodo del Concejo</th>
            <td><span id="sprytextfield1">
              <label for="text1"></label>
              <input type="text" name="text1" id="text1" value="<?php echo $desde." al ".$hasta;?>" size="25" />
              <span class="textfieldRequiredMsg">*.</span></span><input type="hidden" name="h1" value="<?php echo $contenido['per_consejo_id']; ?>" /></td>
          </tr>
          <tr>
            <th scope="row">Cargo</th>
            <td><span id="sprytextfield2">
              <label for="text2"></label>
              <input type="text" name="text2" id="text2" readonly="readonly" onclick="open('consultas/ges_car_cons.php?id=text1','per', 'width=900 ,height=700');"  style="cursor:pointer" />
              <span class="textfieldRequiredMsg">*.</span></span></td>
          </tr>
          <tr>
            <th scope="row">Persona</th>
            <td><span id="sprytextfield3">
              <label for="text3"></label>
              <input type="text" name="text3" id="text3" readonly="readonly" onclick="open('consultas/ges_pers_cons.php?id=text1','per', 'width=900 ,height=700');" style="cursor:pointer" />
              <span class="textfieldRequiredMsg">*.</span></span></td>
          </tr>
          <tr>
            <th scope="row">Firma</th>
            <td><span id="sprytextfield4">
              <label for="text4"></label>
              <input type="text" name="text4" id="text4" />
              <span class="textfieldRequiredMsg">*.</span></span></td>
          </tr>
          <tr>
            <th colspan="2" scope="row">&nbsp;<br  />
            
              <p>
                <input type="submit" name="guardar" value="Guardar"  />
                &nbsp; &nbsp; &nbsp;<input type="reset" value="Borrar"  />
              </p></th>
          </tr>
          <tr>
             <td colspan="2" align="center">
                  * Dato Obligatorio</td>
          </tr>
          <tr>
            <td colspan="2" align="center">&nbsp;</td>
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

</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur", "change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur", "change"]});
    </script>
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
