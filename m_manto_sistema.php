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

mysql_query("set names utf8");
$query=mysql_query("SELECT * FROM datos");

$row=mysql_fetch_array($query);
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
    <li class="first" ><a href="inicio.php">Inicio</a></li>
    <li ><a href="m_registro.php">Registro</a></li>
    <li><a href="m_consultas.php">Busquedas</a></li>
    <li><a href="contruccion_reportes.php">Reportes</a></li>
    <li id="active"><a href="m_mantenimiento.php">Mantenimiento</a></li>
    <li><a href="#">salir</a></li>
    <li><a href="#">&nbsp;</a></li>
    
    </ul>
  
    </div>
   
    <div id="submenu">
     <li><a href="#">Configuraciones de Sistema</a></li>
    <li><a href="m_manto_ges_dato.php">Gestion Datos</a> </li>

    <li><a href="m_manto_ges_perdato.php">Gestion Actas y concejo</a></li>
    <li><a href="m_manto_repor.php">Bit&aacute;cora</a></li>
    <li><a href="m_manto_copias.php">Copias de Seguridad</a></li>
        </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
    <div align="center" id="table1">
      <table width="200" border="0" cellspacing="5">
        <tr>
          <td align="center"><h2 style="color: #F93;"><img src="img/advertencia.png" width="38" height="38"  /> Configuración de la Aplicación <img src="img/advertencia.png" alt="warning" width="38" height="38"  /></h2></td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>
            <form name="principal" method="post" enctype="multipart/form-data" action="registro/procesa_siste.php" >
              <table width="90 %" border="0" cellspacing="5">
                <tr>
                  <th scope="row">Periodo del Consejo</th>
                  <td> <input type="hidden" name="h1" value="<?php echo $row['n_datos']; ?>" /><span id="sprytextfield9">
                    <label for="text9"></label>
                    <input type="text" name="text1" id="text9" value="<?php echo $row['periodo']; ?>" />
                    <span class="textfieldRequiredMsg">*</span></span></td>
                  </tr>
                <tr>
                  <th scope="row">N&deg; inicio Acuerdo</th>
                  <td><span id="sprytextfield4">
                    <label for="text3"></label>
                    <input type="text" name="text4" id="text3" value="<?php echo $row['acue_c_n']; ?>" />
                    <span class="textfieldRequiredMsg">*.</span></span></td>
                </tr>
                <tr>
                  <th width="82" scope="row">Acta Session Ordinaria</th>
                  <td width="227"><span id="sprytextfield2">
                    <label for="text1"></label>
                    <span class="textfieldRequiredMsg">*</span><span id="sprytextarea2">
                    <label for="textarea2"></label>
                    <textarea name="textarea1" id="textarea2" cols="35" rows="5"><?php echo $row['acta_head0']; ?></textarea>
                    <span id="countsprytextarea2">&nbsp;</span><span class="textareaRequiredMsg">*.</span><span class="textareaMaxCharsMsg">Se ha superado el número máximo de caracteres.</span></span></span></td>
                  
                  </tr>
                <tr>
                  <th scope="row">Acta Session ExtraOrdinaria</th>
                  <td><span id="sprytextfield3">
                    <label for="text2"></label>
                    <span class="textfieldRequiredMsg">*</span><span id="sprytextarea3">
                    <label for="textarea3"></label>
                    <textarea name="textarea3" id="textarea3" cols="35" rows="5"><?php echo $row['acta_head1']; ?></textarea>
                    <span id="countsprytextarea3">&nbsp;</span><span class="textareaRequiredMsg">*</span><span class="textareaMaxCharsMsg">Se ha superado el número máximo de caracteres.</span></span></span></td>
                  
                  </tr>
                <tr>
                  <th scope="row">Acta Session Otros</th>
                  <td><span id="sprytextarea4">
                    <label for="textarea4"></label>
                    <textarea name="textarea4" id="textarea4" cols="35" rows="5"></textarea>
</span></td>
                  
                  </tr>
                <tr>
                  <th scope="row">Pie Acta</th>
                  <td>  <span id="sprytextarea8">
              <label for="textarea8"></label>
              <textarea name="textarea8" id="textarea8" cols="35" rows="5"><?php echo $row['act_fin'];?></textarea>
              <span id="countsprytextarea8">&nbsp;</span><span class="textareaRequiredMsg">*.</span><span class="textareaMaxCharsMsg">*.</span></span></td>
                </tr>
                
                <tr>
                  <th scope="row">Acuerdo Introduccion</th>
                  <td><span id="sprytextarea1">
                    <label for="textarea1"></label>
                    <span id="countsprytextarea1">&nbsp;</span><span class="textareaRequiredMsg">Se necesita un valor.</span><span class="textareaMaxCharsMsg">Se ha superado el número máximo de caracteres.</span><span id="sprytextarea6">
                    <label for="textarea6"></label>
                    <textarea name="textarea6" id="textarea6" cols="35" rows="5"><?php echo $row['acue_neck']; ?></textarea>
                    <span id="countsprytextarea6">&nbsp;</span><span class="textareaRequiredMsg">*.</span><span class="textareaMaxCharsMsg">Se ha superado el número máximo de caracteres.</span></span></span></td>
                  
                  </tr>
                <tr>
                  <th scope="row">Acuerdo Nota al Pie </th>
                  <td><span id="sprytextfield1">
                    <label for="text6"></label>
                    <span class="textfieldRequiredMsg">*.</span><span id="sprytextarea7">
                    <label for="textarea7"></label>
                    <textarea name="textarea7" id="textarea7" cols="35" rows="5"><?php echo $row['acue_footer']; ?></textarea>
                    <span id="countsprytextarea7">&nbsp;</span><span class="textareaRequiredMsg">*.</span><span class="textareaMaxCharsMsg">*.</span></span></span></td>
                  
                  </tr>
                <tr>
                  <th scope="row">Simbolo Rubricas</th>
                  <td><span id="sprytextfield5">
                    <label for="text4"></label>
                    <span class="textfieldRequiredMsg">*.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span><span id="sprytextfield10">
                    <label for="text10"></label>
                    <input type="text" name="text2" id="text10" value="<?php echo $row['acuer_sim']; ?>" />
                    <span class="textfieldRequiredMsg">*.</span></span></span></td>
                  
                  </tr>
                <tr>
                  <th scope="row">Nombre BackUp</th>
                  <td><span id="sprytextfield6">
                    <label for="text5"></label>
                    <span class="textfieldRequiredMsg">*.</span><span class="textfieldInvalidFormatMsg">*.</span><span id="sprytextfield11">
                    <label for="text11"></label>
                    <input type="text" name="text3" id="text11" maxlength="100" value="<?php echo $row['back_head']; ?>" />
                    <span class="textfieldRequiredMsg">*.</span></span></span></td>
                  
                  </tr>
                <tr>
                  <th scope="row">&nbsp;</th>
                  <td><span id="sprytextfield7">
                    <label for="text7"></label>
                    <span class="textfieldRequiredMsg">*.</span></span></td>
                  
                  </tr>
                <tr>
                  <th scope="row">&nbsp;</th>
                  <td><span id="sprytextfield8">
                    <label for="text8"></label>
                    <span class="textfieldRequiredMsg">*.</span></span></td>
                  
                  </tr>
                <tr>
                  <th colspan="2" scope="row"><input type="submit" name="guardar" value="Guardar"  />&nbsp; &nbsp; &nbsp;<input type="reset" value="Borrar"  /></th>
                  </tr>
                  
                <tr>
                  <td colspan="2" align="center">&nbsp;
                    
                    </td>
                  </tr>
                <tr>
                  <td colspan="2" align="center">
                    <h1> <font color="#FF0000">Estos Datos afectaran el funcionamiento de la Aplicación</font></h1></td>
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
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {validateOn:["blur", "change"]});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {validateOn:["blur", "change"], counterId:"countsprytextarea2", counterType:"chars_count", maxChars:3000});
var sprytextarea3 = new Spry.Widget.ValidationTextarea("sprytextarea3", {validateOn:["blur", "change"], counterId:"countsprytextarea3", maxChars:3000, counterType:"chars_count"});

var sprytextarea5 = new Spry.Widget.ValidationTextarea("sprytextarea5", {validateOn:["blur", "change"], counterId:"countsprytextarea5", maxChars:3000, counterType:"chars_count"});
var sprytextarea6 = new Spry.Widget.ValidationTextarea("sprytextarea6", {validateOn:["blur", "change"], counterId:"countsprytextarea6", counterType:"chars_count", maxChars:3000});
var sprytextarea7 = new Spry.Widget.ValidationTextarea("sprytextarea7", {validateOn:["blur", "change"], maxChars:3000, counterId:"countsprytextarea7", counterType:"chars_count"});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "none", {validateOn:["blur", "change"]});
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11", "none", {validateOn:["blur", "change"]});
var sprytextarea4 = new Spry.Widget.ValidationTextarea("sprytextarea4", {validateOn:["blur", "change"], isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur", "change"]});
var sprytextarea8 = new Spry.Widget.ValidationTextarea("sprytextarea8", {validateOn:["blur", "change"], maxChars:200, counterId:"countsprytextarea8", counterType:"chars_count"});
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
