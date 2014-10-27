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
if(isset($id))
{
	
$query_anio=mysql_query("SELECT periodo FROM datos");
$row_anio=mysql_fetch_array($query_anio);


$query_activo=mysql_query("SELECT * FROM per_consejo WHERE per_consejo_id =$id");

$row_per=mysql_fetch_array($query_activo);

	$par0=explode('-',$row_per['per_consejo_des']);
	$par1=explode('-',$row_per['per_consejo_has']);
	$date0=$par0[2].'-'.$par0[1].'-'.$par0[0];
	$date1=$par1[2].'-'.$par1[1].'-'.$par1[0];

}
else
{
	$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] intento Acceder al Área de Mantenimiento Mediante la URL')");
	header("location: m_manto_edit_periodo.php");
}
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
    <li ><a href="m_consultas.php">busquedas</a></li>
    <li ><a href="contruccion_reportes.php">reportes</a></li>
    <li id="active"><a href="m_mantenimiento.php">Mantenimiento</a></li>
    <li><a href="#">salir</a></li>
    <li><a href="#">&nbsp;</a></li>
    
    </ul>
  
    </div>
   
    <div id="submenu">
    
  <li><a href="m_manto_edit_periodo.php">Edicion Periodo Concejo</a>
    <li><a href="m_manto_edit_consejo.php">Edicicion del consejo</a></li>
    </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
      <p>&nbsp;</p>

<div align="center">

<table width="350" border="0" cellspacing="5">
  <tr>
    <td align="center"><h2 >Edicion del Periodo del Concejo</h2></td>
  </tr>
  <tr>
    <td align="center">
   <form method="post" enctype="application/x-www-form-urlencoded" name="registo_consejo" action="registro/update_consejo_periodo.php" >
    	<table width="300" border="0" cellspacing="5">
          <tr>
            <th scope="row">Desde<input type="hidden" name="h1" value="<?php echo $row_per['per_consejo_id'];  ?>"  /></th>
            <td><span id="sprytextfield1">
              <label for="text1"></label>
            </span><span id="sprytextfield3">
            <label for="text3"></label>
            <span class="textfieldRequiredMsg">Se necesita un valor.</span><span id="sprytextfield5">
            <label for="text5"></label>
            <input type="text" name="text1" id="text5" onclick="muestraCalendario('','registo_consejo','text1')" style="cursor:pointer" value="<?php  echo $date0;?>"/>
            <span class="textfieldRequiredMsg">*.</span></span></span></td>
          </tr>
          <tr>
            <th scope="row">Hasta</th>
            <td><span id="sprytextfield2">
              <label for="text2"></label>
              <span class="textfieldRequiredMsg">*.</span></span><span id="sprytextfield4">
              <label for="text4"></label>
              <span class="textfieldRequiredMsg">Se necesita un valor.</span><span id="sprytextfield6">
              <label for="text6"></label>
              <input type="text" name="text2" id="text6" onclick="muestraCalendario('','registo_consejo','text2')" style="cursor:pointer"  value="<?php  echo $date1;?>" />
              <span class="textfieldRequiredMsg">*.</span></span></span></td>
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
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur", "change"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur", "change"]});
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
