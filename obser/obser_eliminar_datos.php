<?php

include("../Connections/cx.php");
extract($_REQUEST);
session_start();

					mysql_query("SET NAMES UTF8");
				if(isset($id1))
				{
					
					if($isnert=mysql_query("DELETE FROM ob_01 WHERE ob1_id=$id1"))
					{
						
						$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Elimino Observacion tipo Salvedad')");
	
						$mensaje="<font color=\"green\" >DATOS ELIMINADOS</font> ";
					}
					
				}
				
				if(isset($id2))
				{
					
					if($isnert=mysql_query("DELETE FROM ob_02 WHERE ob2_id=$id2"))
					{
					
						$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Elimino Observacion tipo Abstención')");
	
						$mensaje="<font color=\"green\" >DATOS ELIMINADOS</font> ";
					}
					
				}
				if(isset($id3))
				{
					
					if($isnert=mysql_query("DELETE FROM ob_03 WHERE ob3_id=$id3"))
					{
						
						$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Elimino Observacion tipo Voto en contra')");
	
						$mensaje="<font color=\"green\" >DATOS ELIMINADOS</font> ";
					}
					
				}
				

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agregar Personas asistentes al ACTA</title>
</head>

<body>
<form method="post">
<br />
<?php
	echo @$html;

?>
<br />
<table align="center">
	<tr>
    	<td>
        	<?php
			echo @$mensaje;
			?>
        </td>
    </tr>
    <tr >
		<th colspan='5' align='center'><a href="#" target="_blank" onClick="window.close();">Cerrar Ventana</a><th>
	</tr>
</table>
</form>
</body>
</html>