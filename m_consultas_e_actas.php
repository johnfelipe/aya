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
if(!isset($_SESSION["login"]))
{
header("location: index.php");
}
mysql_query("SET NAMES UTF8");
$query_acta=mysql_query("SELECT * FROM actas WHERE act_id=$id");
$row_acta=mysql_fetch_array($query_acta);
$part_fe= explode('-',$row_acta['act_fecha']);

$part_h_f=explode(':',$row_acta['act_hora_fin']);

$date=$part_fe[2].'-'.$part_fe[1].'-'.$part_fe[0];

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
<title>Registro Actas</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->

<script language="javascript" src="scrips/calendario/javascripts.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
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
  
  <table width="85%" border="0" cellspacing="5" align="center">
    <tr>
      
      <td align="center"><h2 >Edicion de Actas</h2></td>
      </tr>
    
    
    <tr>
      <td align="center"> 
        <form method="post" enctype="application/x-www-form-urlencoded" name="edit_acta" action="registro/update_acta.php">
          <table width="60%" border="0" cellspacing="5">
            <tr>
              <th width="19%" scope="row">N° Acta</th>
              <th width="21%" scope="row"><span id="sprytextfield1">
                <label for="text1"></label>
                <input type="text" name="text1" id="text1" value="<?php echo $row_acta['act_num']; ?>" readonly="readonly"  size="10"/>
                <span class="textfieldRequiredMsg">*.</span></span><input type="hidden" name="h1" value="<?php echo $row_acta['act_id']; ?>"  /></th>
              <th width="14%"  scope="row" align="right">Fecha </th>
              <th width="46%"  align="left"><span id="sprytextfield2">
                <label for="text2"></label>
                <input type="text" name="text2" id="text2" value="<?php echo $date; ?>" onclick="muestraCalendario('','edit_acta','text2')" style="cursor:pointer" />
                <span class="textfieldRequiredMsg">*.</span></span></th>
              
              </tr>
            <tr>
              <th colspan="4" scope="row"><input type="button" value="Lista de Personas" name="lista" onclick="open('./consultas/ges_asis_e.php?id_consejo=<?php echo $row_acta['act_conid']; ?>&acta=<?php echo $row_acta['act_id']; ?>','per','width=400, height=500','scrollbars=yes')" style="cursor: pointer"    /></th>
              </tr>
            <tr>
              <th colspan="4" scope="row"><br />Hora de inicio <span id="spryselect1">
                <label for="select1"></label>
                <select name="select1" id="select1">
                	<option value="0">-elija-</option >
                    <?php
					for($aa=8; $aa<=23; $aa++)
					{
						if($aa==$row_acta['act_hora'])
						{
							echo "<option value=\"".$aa."\" selected=\"selected\">".$aa."</option >";
						}
						else
						{
							echo "<option value=\"".$aa."\">".$aa."</option >";	
						}
					}
					
					
					
					 ?>

                </select>
                <span class="selectInvalidMsg">*.</span></span></th>
              </tr>
            <tr>
              <th colspan="4" scope="row"><br />hora de finalizacion<span id="spryselect2">
                <label for="select2"></label>
                <select name="select2" id="select2">
                	<option value="0">-elija-</option >
                    <?php
					for($aa=8; $aa<=23; $aa++)
					{
						if($aa==$part_h_f[0])
						{
							echo "<option value=\"".$aa."\" selected=\"selected\">".$aa."</option >";
						}
						else
						{
							echo "<option value=\"".$aa."\">".$aa."</option >";	
						}
					}
					?>
                </select>
                <span class="selectInvalidMsg">*.</span></span>:<span id="spryselect3">
                <label for="select3"></label>
                <select name="select3" id="select3">
                    <option value="0">-elija-</option >
                    <?php
                    for($aa=1; $aa<=59; $aa++)
					{
						if($aa==$part_h_f[1])
						{
							echo "<option value=\"".$aa."\" selected=\"selected\">".$aa."</option >";
						}
						else
						{
							echo "<option value=\"".$aa."\">".$aa."</option >";	
						}
					}
					?>
                    
                </select>
                <span class="selectInvalidMsg">*.</span></span>:<span id="spryselect4">
                <label for="select4"></label>
                <select name="select4" id="select4">
                <option value="0">-elija-</option >
                <?php
                    for($aa=1; $aa<=59; $aa++)
					{
						if($aa==$part_h_f[2])
						{
							echo "<option value=\"".$aa."\" selected=\"selected\">".$aa."</option >";
						}
						else
						{
							echo "<option value=\"".$aa."\">".$aa."</option >";	
						}
					}
					?>
                </select>
                <span class="selectInvalidMsg">*.</span></span></th>
              </tr>
            <tr>
              <th colspan="4" scope="row"><br />
                <p>tipo de acta 
               		<?php
					
					if($row_acta['act_type']==1)
					{
						$radio="<input type=\"radio\" name=\"radio\" id=\"radio1\" value=\"1\" checked=\"checked\" />
                  <label for=\"radio\">Ordinaria </label>
                  <input type=\"radio\" name=\"radio\" id=\"radio2\" value=\"2\" />Extra ordinaria	
                  </label>
                  <input type=\"radio\" name=\"radio\" id=\"radio3\" value=\"3\" disabled=\"disabled\" />
                  <label for=\"radio3\">Otros</label>";
					}
					elseif($row_acta['act_type']==2)
					{
							$radio="<input type=\"radio\" name=\"radio\" id=\"radio1\" value=\"1\" />
                  <label for=\"radio\">Ordinaria </label>
                  <input type=\"radio\" name=\"radio\" id=\"radio2\" value=\"2\"  checked=\"checked\" />Extra ordinaria	
                  </label>
                  <input type=\"radio\" name=\"radio\" id=\"radio3\" value=\"3\" disabled=\"disabled\" />
                  <label for=\"radio3\">Otros</label>";
					}
					else
					{
						$radio="";
					}
					echo $radio;
					
					
					?>
               
				               
               
               </p>
               
                  
                </p>              </th>
              </tr>
              <tr>
            <th scope="row" colspan="4" align="center" ><input type="button" name="observa" value="Observaciones del Consejo" onclick="open('./obser/edit_obser.php?id=<?php echo $row_acta['act_id']; ?>','per','width=300, height=200','scrollbars=yes')" style="cursor: pointer"   /><br />&nbsp;</th>
           
            </tr>
            <tr>
              <th scope="row">Acta</th>
              <th colspan="3" scope="row"><span id="sprytextarea1">
              <label for="textarea1"></label>
              <textarea name="textarea1" id="textarea1" cols="45" rows="5"><?php echo $row_acta['act_tex0'] ?></textarea>
              <span id="countsprytextarea1">&nbsp;</span><span class="textareaRequiredMsg">*.</span><span class="textareaMaxCharsMsg">Se ha superado el número máximo de caracteres.</span></span>
                </th>
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
      <td align="center"> &nbsp;
        <br /><br /></td>
      </tr>
    
  </table>
  
  </a>
  
  
</div
>
    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {isRequired:false, invalidValue:"0", validateOn:["change", "blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {isRequired:false, invalidValue:"0", validateOn:["change", "blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {isRequired:false, invalidValue:"0", validateOn:["change", "blur"]});
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {invalidValue:"0", isRequired:false, validateOn:["change", "blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"], maxChars:65000, counterId:"countsprytextarea1", counterType:"chars_count"});
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
