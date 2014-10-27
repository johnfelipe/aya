<?php

include("../Connections/cx.php");
extract($_REQUEST);


															
				if($isnert=mysql_query("DELETE FROM relacion_actas WHERE relacion_actaid=$id_acta AND relacion_nominaid=$id_conse AND relacion_funcionario=$nomina_id"))
				{

					$mensaje="<font color=\"green\" >DATOS ELIMINADOS</font> ";
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
			echo $mensaje;
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