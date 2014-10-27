<?php
//coneccion a BD
include("../Connections/cx.php");
//extraccion de todas las funciones
extract($_REQUEST);





//inicio de las funciones de seccion
session_start();
if(!isset($_SESSION["login"]))
{
header("location: ../index.php");
}
mysql_query("set names utf8");
if(isset($h1))
{
	
		if($insert=mysql_query("UPDATE repro SET  rep_a='$c1', rep_b='$c2' ,rep_c='$c3' ,rep_d='$c4' ,rep_f='$c5' WHERE rep_id=$h1" ))
		{
			
			$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Actualizo datos de una Reprogramacion')");
			$mensaje="<h2>Datos Actualizados</h2>
					<br>";
		}
		else
		{
			$mensaje.="
					<font color=\"#FF0000\">Imposble actualizar</font><br>";
		}
		
	
}
else
{
	header("location: ../inico.php");
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table align="center">
	<tr>
    	<td>
        	<?php
			echo @$mensaje;
			?>
        </td>
    </tr>
    <tr >
		<th colspan='5' align='center'><a href="#" target="_blank" onClick="window.close();">Cerrar Ventana</a></th>
	</tr>
</table>
</body>
</html>