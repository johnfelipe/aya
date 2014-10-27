<?php

include("./Connections/cx.php");
extract($_REQUEST);
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
    <li><a href="#">Personas</a></li>
    <li><a href="m_registro_empleados.php">Empleados</a> </li>
    <li><a href="m_registro_consejo.php">Concejo</a></li>
    <li><a href="m_registro_actas_menu2.php">Actas</a></li>
    <li><a href="m_registro_acuerdos.php">Acuerdos</a></li>
        </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
    <div align="center" id="table1">
      <table width="200" border="0" cellspacing="5">
        <tr>
          <td align="center"><h2 >Registro de Personas</h2></td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>
            <form name="principal" method="post" enctype="multipart/form-data" action="registro/procesa_personas.php" >
              <table width="328" border="0" cellspacing="5">
                <tr>
                  <th width="82" scope="row">Nombres</th>
                  <td width="227"><span id="sprytextfield2">
                  <label for="text1"></label>
                  <input name="text1" type="text" class="textareaFocusState" id="text1" maxlength="50" />
                  <span class="textfieldRequiredMsg">*</span></span></td>
               
                  </tr>
                <tr>
                  <th scope="row">Primer Apelldio</th>
                  <td><span id="sprytextfield3">
                    <label for="text2"></label>
                    <input type="text" name="text2" id="text2" maxlength="50" />
                    <span class="textfieldRequiredMsg">*</span></span></td>
               
                  </tr>
                <tr>
                  <th scope="row">Segundo Apellido</th>
                  <td><span id="sprytextfield4">
                    <label for="text3"></label>
                    <input type="text" name="text3" id="text3" maxlength="50" />
</span></td>
                 
                  </tr>
                <tr>
                  <th scope="row">Genero</th>
                  <td>
                      <span id="spryselect1">
                      <select name="s1">
                        <option value="0" >-Elija una Opcion-</option>
                        <option value="F" >Femenino</option>
                        <option value="M" >Masculino</option>
                      </select>
                      <span class="selectInvalidMsg">*.</span></span></td>
               
                  </tr>
                <tr>
                  <th scope="row">Direccion</th>
                  <td><span id="sprytextarea1">
                  <label for="textarea1"></label>
                  <textarea name="textarea1" id="textarea1" cols="35" rows="5"></textarea>
                  <span id="countsprytextarea1">&nbsp;</span><span class="textareaRequiredMsg">Se necesita un valor.</span><span class="textareaMaxCharsMsg">Se ha superado el número máximo de caracteres.</span></span></td>
           
                  </tr>
                <tr>
                  <th scope="row">Municipio</th>
                  <td><span id="sprytextfield1">
                  <label for="text6"></label>
                  <input type="text" name="text6" id="text6" readonly="readonly" onclick="open('consultas/ges_muni.php?id=text6','per', 'width=900 ,height=700');" style="cursor:pointer">
                  <span class="textfieldRequiredMsg">*.</span></span></td>
             
                  </tr>
                <tr>
                  <th scope="row">Telefono</th>
                  <td><span id="sprytextfield5">
                  <label for="text4"></label>
                  <input type="text" name="text4" id="text4"   />
                  <span class="textfieldRequiredMsg">*.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
                
                  </tr>
                <tr>
                  <th scope="row">DUI</th>
                  <td><span id="sprytextfield6">
                  <label for="text5"></label>
                  <input type="text" name="text5" id="text5"/>
                  <span class="textfieldRequiredMsg">*.</span><span class="textfieldInvalidFormatMsg">*.</span></span></td>
             
                  </tr>
                <tr>
                  <th scope="row">Profesi&oacute;n</th>
                  <td><span id="sprytextfield7">
                    <label for="text7"></label>
                    <input type="text" name="text7" id="text7" readonly="readonly" onclick="open('consultas/ges_prof.php?id=text7','per', 'width=900 ,height=700');" style="cursor:pointer"/>
                    <span class="textfieldRequiredMsg">*.</span></span></td>
              
                  </tr>
                <tr>
                  <th scope="row">Nacionalidad</th>
                  <td><span id="sprytextfield8">
                    <label for="text8"></label>
                    <input type="text" name="text8" id="text8" readonly="readonly" 
                    onclick="open('./consultas/ges_naci.php?id=text8','per', 'width=900 ,height=700,scrollbars=yes');" style="cursor:pointer" />
                    <span class="textfieldRequiredMsg">*.</span></span></td>
                 
                  </tr>
                <tr>
                  <th scope="row">Fotografia</th>
                  <td><label for="fileField"></label><input type="file" name="foto"  />
                    <br />&nbsp;</td>
              
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
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur", "change"], isRequired:false});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {maxChars:200, validateOn:["blur", "change"], counterId:"countsprytextarea1", counterType:"chars_count"});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "phone_number", {format:"phone_custom", pattern:"0000-0000", useCharacterMasking:true, validateOn:["blur", "change"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "custom", {pattern:"00000000-0", useCharacterMasking:true, validateOn:["blur", "change"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur", "change"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {validateOn:["blur", "change"]});
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
