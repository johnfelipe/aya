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

if(!isset($id))
{
	header("location: m_manto_edit_empleados_datos.php");
}

$query_empleados=mysql_query("SELECT *  FROM empleados WHERE emp_id=$id");
$row_emple=mysql_fetch_array($query_empleados);

$part1=explode('-',$row_emple['emp_des']);
$part2=explode('-',$row_emple['emp_has']);

$query_per=mysql_query("SELECT *  FROM personas WHERE id_persona=$row_emple[emp_perid]");
$row_per=mysql_fetch_array($query_per);

$query_car=mysql_query("SELECT *  FROM cargo WHERE car_id=$row_emple[emp_carid]");
$row_car=mysql_fetch_array($query_car);
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

<script language="javascript" src="scrips/calendario/javascripts.js"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
    <li ><a href="m_registro.php" >Registro</a></li>
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
      <p>&nbsp;</p>
    <div align="center" >
      
      <table width="454">
        <tr>
          <td align="center"><h2>Edicion  de Empleados</h2>
            
            </td>
          </tr>
        <tr>
          <td align="center">
            <form method="post" enctype="application/x-www-form-urlencoded" name="registro_empleados" action="registro/update_empleados.php">
              <table width="325" border="0" cellspacing="5">
                <tr>
                  <th width="81" scope="row">Nombre del Empleado<input type="hidden" name="h1" value="<?php echo $row_emple['emp_id']; ?>" /></th>
                  <td width="225"><span id="sprytextfield1">
                    <label for="text12"></label>
                    <input type="text" name="text1" id="text12"  value="<?php echo $row_per['nombres'].' ' .$row_per['primer_apellido']; ?>" readonly="readonly"/>
                    <span class="textfieldRequiredMsg">*.</span></span></td>
                  </tr>
                <tr>
                  <th scope="row">Cargo</th>
                  <td><span id="sprytextfield2">
                    <label for="text13"></label>
                    <input type="text" name="text2" id="text13" readonly="readonly" onclick="open('consultas/ges_car_empleado.php?id=text1','per', 'width=900 ,height=700');"  style="cursor:pointer" value="<?php echo $row_car['car_m'].'+'.$row_car['car_id'] ?>" />
                    <span class="textfieldRequiredMsg">*.</span></span></td>
                  </tr>
                <tr>
                  <th scope="row">Inicio</th>
                  <td><span id="sprytextfield3">
                  <label for="text16"></label>
                  <input type="text" name="text3" id="text16" readonly="readonly" onclick="muestraCalendario('','registro_empleados','text16')" style="cursor:pointer" value="<?php echo $part1[2].'-'.$part1[1].'-'.$part1[0]; ?>"/>
                  <span class="textfieldRequiredMsg">*.</span></span></td>
                  </tr>
                <tr>
                  <th scope="row">Fin</th>
                  <td><span id="sprytextfield4">
                  <label for="text17"></label>
                  <input type="text" name="text4" id="text17" readonly="readonly" onclick="muestraCalendario('','registro_empleados','text17')" style="cursor:pointer" value="<?php echo $part2[2].'-'.$part2[1].'-'.$part2[0]; ?>"/>
                  <span class="textfieldRequiredMsg">*.</span><span class="textfieldInvalidFormatMsg"><br />
                  Formato no válido.</span></span></td>
                  </tr>
                <tr>
                  <th scope="row">Estado</th>
                  <th scope="row" align="left"><span id="spryselect1">
                    <label for="select1"></label>
                    <select name="select1" id="select1">
                    	<option value="-1" >-elija-</option>
                        <?php
						if($row_emple['emp_estado']==1)
						{
							echo "<option value=\"1\" selected=\"selected\">activo</option>
							<option value=\"0\">inactivo</option>
							";
						}
						else
						{
							echo "<option value=\"1\" >activo</option>
							<option value=\"0\" selected=\"selected\">inactivo</option>
							";
							
						}
						
						?>
                    </select>
                    <span class="selectInvalidMsg">*.</span></span></th>
                </tr>
                <tr>
                  <th colspan="2" scope="row"><input type="submit" name="guardar" value="Guardar"  />&nbsp; &nbsp; &nbsp;<input type="reset" value="Borrar"  /></th>
                  </tr>
                <tr>
                  
                  <td colspan="2" align="center">
                  * Dato Obligatorio</td>
                </tr>
                </table>
              <p>&nbsp;</p>
            </form>
            </td>
          </tr>
        <tr>
          <td>
            </td>
          </tr>
        <tr>
          <td align="center"></td>
          </tr>
        </table>
      
      
      <p>&nbsp;</p>
      <p>&nbsp; </p>
    </div>
    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur", "change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur", "change"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["change", "blur"], invalidValue:"-1", isRequired:false});
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
