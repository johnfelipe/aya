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
$insert=mysql_query("INSERT INTO bitacora (text) VALUES('Acceso de Intruso fallido al  Área de Mantenimiento')");


header("location: index.php");
}

mysql_query("SET NAMES UTF8");
//desturi session
if(isset($des))
{	
	//echo "<h1>funca</h1>";
		//unset($_SESSION['login']);
		$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Cerro Sessión')");
		session_destroy();
		
		header("location: index.php");
		
}

$query_acta=mysql_query("SELECT * FROM actas WHERE act_id=$acta");
$row_acta=mysql_fetch_array($query_acta);
//inicio tabla DATOS
$datos_query=mysql_query("SELECT acue_head, acue_neck  FROM datos");
$row_datos=mysql_fetch_array($datos_query);

//fin tabla datos
//echo $row_acta['act_id']."---".$acu;
// inicio numero de acuerdo
$acuerdo_query=mysql_query("SELECT * FROM acuerdos WHERE acu_actid=$row_acta[act_id] AND acu_id=$acu");

$row_acuerdo=mysql_fetch_array($acuerdo_query);

$part=explode('-',$row_acuerdo['acu_conf']);
$date=$part['2'].'-'.$part['1'].'-'.$part['0'];
//fin numero de acuerdo


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
 <li class="first"><a href="inicio.php">Inicio</a></li>
    <li ><a href="m_registro.php" >Registro</a></li>
    <li id="active"><a href="m_consultas.php">busquedas</a></li>
    <li><a href="contruccion_reportes.php">reportes</a></li>
    <li><a href="m_mantenimiento.php">Mantenimiento</a></li>
    <li><a href="#">salir</a></li>
    <li><a href="#">&nbsp;</a></li>
    
    </ul>
  
    </div>
   
    <div id="submenu">
 
    <li><a href="m_consultas_im_actas.php">Impresion Actas</a></li>
    <li><a href="m_consultas_im_acuerdos.php">Impresion de Acuerdos</a></li>
    <li><a href="m_consultas_ed_actas.php">Editar Actas</a> </li>
    <li><a href="m_consultas_ed_acuerdos.php">Editar Acuerdos</a></li>
    </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
     

<div align="center">
  
  <table width="75%" border="0" cellspacing="5" align="center">
    <tr>
      
      <td align="center"><h2 >Edicion del Acuerdos</h2></td>
      </tr>
    <tr>
      <form method="post" name="r_acuerdos" enctype="application/x-www-form-urlencoded" action="registro/update_acuerdo.php">
        <td align="center">
          <table width="350 px" border="0" cellspacing="5">
            <tr>
              <td>N&deg; Actas<input type="hidden" name="h1" value="<?php echo $row_acuerdo['acu_id']; ?>" /><span id="sprytextfield1">
                <label for="text1"></label>
                <input type="text" name="text1" id="text1" readonly="readonly" value="<?php echo $row_acta['act_num']; ?>" />
                <span class="textfieldRequiredMsg">*.</span></span></td>
              <td>N&deg; Acuerdo <span id="sprytextfield2">
                <label for="text2"></label>
                <input type="text" name="text2" id="text2" readonly="readonly"  value="<?php  echo $row_acuerdo['acu_num'];?>" />
                <span class="textfieldRequiredMsg">*.</span></span></td>
              </tr>
            <tr>
              <td colspan="2"><span id="sprytextarea3">
                <label for="textarea3"></label>
                <textarea name="textarea3" id="textarea3" cols="70" rows="1" readonly="readonly"><?php echo $row_datos['acue_head']; ?></textarea>
                <span class="textareaRequiredMsg">Se necesita un valor.</span></span></td>
            </tr>
            <tr>
              <td colspan="2"><span id="sprytextarea2">
                <label for="textarea2"></label>
                <textarea name="textarea2" id="textarea2" cols="70" rows="3" readonly="readonly"><?php echo $row_datos['acue_neck'];?></textarea>
                <span class="textareaRequiredMsg">Se necesita un valor.</span></span></td>
            </tr>
            <tr>
              <td colspan="2"><span id="sprytextarea1">
              <label for="textarea1"></label>
              <textarea name="textarea1" id="textarea1" cols="70" rows="15"><?php echo $row_acuerdo['acu_tex0'] ?></textarea>
              <span id="countsprytextarea1">&nbsp;</span><span class="textareaRequiredMsg">*.</span><span class="textareaMaxCharsMsg">Se ha superado el número máximo de caracteres.</span></span></td>
              </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" value="Reprogramacion" name="lista" onclick="open('./edit_repro.php?id=<?php echo $row_acuerdo['acu_id'];  ?>','per','width=300, height=200','scrollbars=yes')" style="cursor: pointer"    /></td>
            </tr>
            <tr>
              <td colspan="2">Confrontado:<input type="text" readonly="readonly" name="con" value="<?php echo $date; ?>" onclick="muestraCalendario('','r_acuerdos','con')" style="cursor:pointer"  /></td>
            </tr>
            <tr>
              <td colspan="2">Descripción: <span id="sprytextfield3">
                <label for="text3"></label>
                <input type="text" name="text3" id="text3" size="60" value="<?php echo $row_acuerdo['acu_desc']; ?>"  maxlength="250"/>
</span></td>
              </tr>
            <tr>
              <td colspan="2" align="center"><table width="100%" border="0" cellspacing="5">
                <tr>
                  <td width="13%" align="center">Linea Inicio Rubrica</td>
                  <td width="87%"><span id="sprytextarea4">
                  <label for="textarea4"></label>
                  <textarea name="textarea4" id="textarea4" cols="60" rows="5"><?php echo $row_acuerdo['act_line']; ?></textarea>
                  <span id="countsprytextarea4">&nbsp;</span><span class="textareaRequiredMsg">Se necesita un valor.</span><span class="textareaMaxCharsMsg">*.</span></span></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="2" align="center"></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><br  />
            
              <p>
                <input type="submit" name="guardar" value="Guardar"  />
                &nbsp; &nbsp; &nbsp;<input type="reset" value="Borrar"  />
              </p></td>
              </tr>
            <tr>
              <td colspan="2" align="center">* Dato Obligatorio</td>
              </tr>
            </table>
          
          
          
          </form>
      </td>
      </tr>
    <tr>
      <td align="center">
        <br /><br /></td>
      </tr>
    
    </table>
  
  
  
  
</div
>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"], counterId:"countsprytextarea1", maxChars:65000, counterType:"chars_count"});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur", "change"], isRequired:false});
var sprytextarea3 = new Spry.Widget.ValidationTextarea("sprytextarea3");
var sprytextarea4 = new Spry.Widget.ValidationTextarea("sprytextarea4", {validateOn:["blur", "change"], counterId:"countsprytextarea4", maxChars:65000, counterType:"chars_count"});
var sprytextarea5 = new Spry.Widget.ValidationTextarea("sprytextarea5", {validateOn:["blur", "change"], counterId:"countsprytextarea5", maxChars:65000, counterType:"chars_count"});
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
