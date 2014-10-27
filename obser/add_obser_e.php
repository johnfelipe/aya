<?php
//inclumos la base de datos
include("../Connections/cx.php");
//inlcuimos lso calendarios
include("../scrips/calendario/calendario.php");
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
mysql_query("SET NAMES UTF8");
if(isset($guardar))
{
	if(!empty($textarea1))
	{
		 if($e1=='sal')
		 {
			
			 $sal_val=mysql_num_rows( mysql_query("select * from ob_01 WHERE ob1_idact=$id"));
			 
			 if($sal_val>=1)
			 {
				$mensaje="<font  color=\"red\">Ya se encuentra almacenado un dato</font>"; 
			 }
			 else
			 {
			
				if(mysql_query("INSERT INTO ob_01 Values('','$textarea1',$id)"))
				{
					
					$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] editó una acta Agregando Observaciones del Consejo')");
					
					
					
					$mensaje="<font  color=\"#006600\">Datos Almacenados</font>";
				}
			 }
		 }
		 elseif($e1=='abs')
		 {
			 $sal_val=mysql_num_rows( mysql_query("select * from ob_02 WHERE ob2_idact=$id"));
			 
			 if($sal_val>=1)
			 {
				$mensaje="<font  color=\"red\">Ya se encuentra almacenado un dato</font>"; 
			 }
			 else
			 {
			
			 	
			 	if(mysql_query("INSERT INTO ob_02 Values('','$textarea1',$id)"))
				{
					
					$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] editó una acta Agregando Observaciones del Consejo')");
					
					
					
					$mensaje="<font color=\"#006600\">Datos Almacenados</font>";
				}
			 }
			 
		 }
		 elseif($e1=='vot')
		 {
			 $sal_val=mysql_num_rows( mysql_query("select * from ob_03 WHERE ob3_idact=$id"));
			 
			 if($sal_val>=1)
			 {
				$mensaje="<font  color=\"red\">Ya se encuentra almacenado un dato</font>"; 
			 }
			 else
			 {
			
			 if(mysql_query("INSERT INTO ob_03 Values('','$textarea1',$id)"))
				{
					
					$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] editó una acta Agregando Observaciones del Consejo')");
					
					
					
					$mensaje="<font color=\"#006600\">Datos Almacenados</font>";
				}
			 }
			 
		 }
				
			
		//echo "<script>window.parent.close()</script>  ";
	}
	
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edicion agregar observacion</title>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center">
<form method="post" enctype="application/x-www-form-urlencoded">

            	<table width="70%" border="0" cellspacing="5">
                  <tr>
                    <th scope="row" align="center">Observaciones del Consejo                      </th>
                  
                  </tr>
                  <tr>
                      <td align="center"><input type="radio" name="e1" value="sal" checked="checked"  />Salvedades <input type="radio" name="e1" value="abs"  /> Abstenciones <input type="radio" name="e1" value="vot"  /> Voto en contra</td>
                  </tr>
                  <tr>
                    <td>
                      	
                    </td>
                  </tr>
                  <tr>
                      <td align="center">
                      	<span id="sprytextarea1">
                        <label for="textarea1"></label>
                        <textarea name="textarea1" id="textarea1" cols="45" rows="5"></textarea>
                        <span id="countsprytextarea1">&nbsp;</span><span class="textareaRequiredMsg">*</span><span class="textareaMaxCharsMsg">.</span></span><br />
                    <?php echo $mensaje; ?></td>
                  </tr>
                  <tr>
                    
                   <th scope="row"><p>
                <input type="submit" name="guardar" value="Guardar"  />
                &nbsp; &nbsp; &nbsp;<input type="reset" value="Borrar"  />
                </p></th>
              </tr>
                  <tr>
                    <th scope="row"><a href="#" target="_blank" onClick="window.close();">Cerrar Ventana</a></th>
                  </tr>
                  <tr>
              <th scope="row">* Dato Obligatorio</th>
              </tr>
                </table>

  </form>
</div>
<script type="text/javascript">
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"], maxChars:60000, counterId:"countsprytextarea1", counterType:"chars_count"});
</script>
</body>
</html>