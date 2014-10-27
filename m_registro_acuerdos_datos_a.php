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
else

//desturi session
if(isset($des))
{	
	//echo "<h1>funca</h1>";
		//unset($_SESSION['login']);
		$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Cerro Sessión')");
		session_destroy();
		
		header("location: index.php");
		
}
$borrar_tempo=mysql_query("delete from tempo2");
mysql_query("SET NAMES utf8");
// datos de acta
$n_acta_query=mysql_query("SELECT act_num FROM actas WHERE act_id=$id");

$row_n_acta=mysql_fetch_array($n_acta_query);
//fin datos del acta

//inicio tabla DATOS
$datos_query=mysql_query("SELECT acue_head, acue_neck, acue_c_n  FROM datos");
$row_datos=mysql_fetch_array($datos_query);

//fin tabla datos

// inicio numero de acuerdo
$acuerdo_query=mysql_query("SELECT acu_id FROM acuerdos WHERE acu_actid=$id");

@$num_=mysql_num_rows($acuerdo_query);

if($num_==0)
{
	$n_acuerdo=$row_datos['acue_c_n'];
}
else
{
	$n_acuerdo=$num_+$row_datos['acue_c_n'];
	
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
<script language="javascript" src="scrips/calendario/javascripts.js"></script>
<script language="javascript" src="scrips/calendario/javascripts.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
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
    <li><a href="#">Empleados</a> </li>
    <li><a href="m_registro_consejo.php">Concejo</a></li>
    <li><a href="m_registro_actas_menu2.php">Actas</a></li>
    <li><a href="m_registro_acuerdos.php">Acuerdos</a></li>
    </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
      <p>&nbsp;</p>
    <div align="center" >
      
      <table width="454">
        <tr>
          <td align="center"><h2  >Registro de Acuerdos</h2>
            
            
            
            </td>
          </tr>
        <tr>
          <td align="center">
            <form method="post" enctype="application/x-www-form-urlencoded" name="registro_acuerdos" action="registro/procesa_acue.php">
              
              <table width="75%" border="0" cellspacing="5">
                <tr>
                  <th scope="row">N&deg; Actas<input type="hidden" name="h1" value="<?php echo $id; ?>" /></th>
                  <td><span id="sprytextfield1">
                    <label for="text1"></label>
                    <input type="text" name="text1" id="text1" size="12" readonly="readonly" value="<?php echo $row_n_acta['act_num'] ?>"  />
                    <span class="textfieldRequiredMsg">*.</span></span></td>
                  <td scope="row"><strong>N&deg; Acuerdo <input type="hidden" name="libro" value="<?php echo 'mijo'; ?>" /></strong></td>
                  <td><span id="sprytextfield2">
                    <label for="text2"></label>
                    <input type="text" name="text2" id="text2" size="12" readonly="readonly" value="<?php echo $n_acuerdo; ?>" />
                    <span class="textfieldRequiredMsg">*.</span></span></td>
                  </tr>
                <tr>
                  <th colspan="4" scope="row"><span id="sprytextarea1">
              <label for="textarea1"></label>
              <textarea name="textarea1" id="textarea1" cols="70" rows="1" readonly="readonly"><?php echo $row_datos['acue_head']; ?></textarea>
              <span class="textareaRequiredMsg">*.</span></span></th>
                  </tr>
                <tr>
                  <th colspan="4" scope="row"><span id="sprytextarea2">
                    <label for="textarea2"></label>
                    <textarea name="textarea2" id="textarea2" cols="70" rows="5" readonly="readonly"><?php echo $row_datos['acue_neck']; ?></textarea>
                    <span class="textareaRequiredMsg">*.</span></span></th>
                  </tr>
                <tr>
                  <th colspan="4" scope="row"><span id="sprytextarea3">
                  <label for="textarea3"></label>
                  <textarea name="textarea3" id="textarea3" cols="70" rows="5"></textarea>
                  <span id="countsprytextarea3">&nbsp;</span><span class="textareaRequiredMsg">*.</span><span class="textareaMaxCharsMsg">*.</span></span></th>
                  </tr>
                <tr>
                  <th colspan="4" scope="row" ><input type="button" value="Reprogramacion" name="lista" onclick="open('./m_registro_repro_select.php','per','width=700, height=500','scrollbars=yes')" style="cursor: pointer"    /></th>
                </tr>
                <tr>
                  <th colspan="4" scope="row" >Fecha Confrontado<span id="sprytextfield3">
                    <label for="text3"></label>
                    <input type="text" name="text3" id="text3" readonly="readonly"  onclick="muestraCalendario('','registro_acuerdos','text3')" style="cursor:pointer" />
                    <span class="textfieldRequiredMsg">*.</span></span></th>
                  </tr>
                <tr>
                  <th colspan="4" scope="row">Descripcion<span id="sprytextfield4">
                    <label for="text4"></label>
                    <input type="text" name="text4" id="text4" size="49" />
                    <span class="textfieldRequiredMsg">*.</span></span></th>
                  </tr>
                <tr>
                  <th scope="row">&nbsp;</th>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  </tr>
                <tr>
                  <th colspan="4" scope="row"><p>
                  <input type="submit" name="guardar" value="Guardar"  />
                  &nbsp; &nbsp; &nbsp;<input type="reset" value="Borrar"  />
                  </p></th>
                  </tr>
                <tr>
                  <th colspan="4" scope="row">* Dato Obligatorio</th>
                  </tr>
                </table>
              
            </form>
            </td>
          </tr>
        <tr>
          <td>
            </td>
          </tr>
        <tr>
          <td align="center"><?php echo @$mensaje ;?></td>
          </tr>
        </table>
      
      
      <p>&nbsp;</p>
      <p>&nbsp; </p>
    </div>
    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"]});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {validateOn:["blur", "change"]});
var sprytextarea3 = new Spry.Widget.ValidationTextarea("sprytextarea3", {validateOn:["blur", "change"], maxChars:65000, counterId:"countsprytextarea3", counterType:"chars_count"});
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
