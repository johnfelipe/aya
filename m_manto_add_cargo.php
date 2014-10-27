<?php

include("./Connections/cx.php");
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
	if(isset($_SESSION['login']))
	{
		
		$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] intento Acceder al Área de Mantenimiento Mediante la URL ')");	
header("location: inicio.php");		
		
	}
	else
	{
		 $insert=mysql_query("Acceso de Intruso fallido al  Área de Mantenimiento Mediante la URL')");	
		   session_destroy();
				 header("location: index.php");  
	}

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
      <table width="200" border="0" cellspacing="5">
        <tr>
          <td align="center"><h2 >Registro de Cargo</h2></td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>
            <form name="principal" method="post" enctype="multipart/form-data" action="registro/procesa_cargo.php" >
              <table width="328" border="0" cellspacing="5">
                <tr>
                  <th width="82" scope="row">Cargo Masculino</th>
                  <td width="227"><span id="sprytextfield2">
                  <label for="text1"></label>
                  <input name="text1" type="text" class="textareaFocusState" id="text1" maxlength="70"  />
                  <span class="textfieldRequiredMsg">*</span></span></td>
               
                  </tr>
                <tr>
                  <th scope="row">Cargo Femenino</th>
                  <td><span id="sprytextfield3">
                    <label for="text2"></label>
                    <input type="text" name="text2" id="text2" maxlength="70" />
                    <span class="textfieldRequiredMsg">*</span></span></td>
               
                  </tr>
                <tr>
                  <th scope="row">Rango</th>
                  <td><span id="spryselect1">
                    <label for="select1"></label>
                    <select name="select1" id="select1">
                      <option value="0" selected="selected">-elija-</option>
                      <option value="1" >poder alcalde</option>
                      <option value="2">poder sindico</option>
                      <option value="3">poder Regidor</option>
                      <option value="4">poder Regidor supl.</option>
                      <option value="5">poder Secretario</option>
                      <option value="6">cargos de empleados</option>
                      </select>
                    <span class="selectInvalidMsg">*.</span></span></td>
                  
                </tr>
                <tr>
                  <td colspan="2" align="center">
                    <input type="submit" name="guardar" value="Guardar"  />&nbsp; &nbsp; &nbsp;<input type="reset" value="Borrar"  />
                    </td>
                </tr>
                <tr>
                  <td colspan="2" align="center">* Dato Obligatorio</td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><?php echo @$mensaje; ?></td>
                </tr>
                </table>
              </form>
            </td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
        </table>
    </div>
    <script type="text/javascript">
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur", "change"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"0", isRequired:false, validateOn:["blur", "change"]});
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
