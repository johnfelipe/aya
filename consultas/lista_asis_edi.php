<?php

include("../Connections/cx.php");
extract($_REQUEST);

//echo "consejo=".$id_conse." _ id en el consejo".$nomina_id." acta".$id_acta;

		//echo $id_acta."_".$id_conse."/".$nomina_id."*";
		$html="<table align=\"center\" border=\"0\">
			<tr >
				<td colspan=\"2\">
					
					<table align=\"center\" border=\"1\">
						<tr>
							<th>
								Cargo
							</th>
							<td>
							  ".$cargo_nom ."
							</td>
						</tr>
						<tr>
							<th>
								Nombre
							</th>
							<td>
								". $nombre_per ."
							</td>
						</tr>
						<tr>
							<th>
								Apellido
							</th>
							<td>
								". $ape_per ."
							</td>
						</tr>
						<tr align=\"center\">
							<th>
								Agregar la Profecion
							</th>
							<td>
								<input type=\"checkbox\" name=\"pro\" checked=\"checked\">
							</td>
						</tr>
						
					</table>
					<br />
			
				</td>
			</tr>
			<tr>
				<td>
					<input type=\"submit\" name=\"agregar\" value=\"Agregar a la lista\">
				</td>
				<td>
					<input type=\"button\" name=\"cerrar\" value=\"cerrar\" onClick=\"window.close();\">
				</td>
			</tr>
			
		</table>";
		
	

if(isset($agregar))
{
			if(isset($pro))
			{																
				if($isnert=mysql_query("UPDATE relacion_actas SET relacion_profe=1 WHERE relacion_actaid=$id_acta AND relacion_nominaid=$id_conse AND relacion_funcionario=$nomina_id"))
				{
					$mensaje="<font color=\"green\" >exito al Actualizar la lista</font> ";
				}
				else
				{
					$mensaje="<font color=\"red\" >error al Actualizar la lista</font> ";
				}	
			}
			else
			{
				if($isnert=mysql_query("UPDATE relacion_actas SET relacion_profe=0 WHERE relacion_actaid=$id_acta AND relacion_nominaid=$id_conse AND relacion_funcionario=$nomina_id"))
				{
					$mensaje="<font color=\"green\" >exito al Actualizar la lista</font> ";
				}
				else
				{
					$mensaje="<font color=\"red\" >error al Actualizar la lista</font> ";
				}	
				
			}
	
	
	
}

if(isset($borrar))
{
	
	if($isnert=mysql_query("DELETE FROM tempo WHERE nomina=$nomina_id"))
	{
		$mensaje="<font color=\"green\" >exito al Eliminar a la lista</font> ";
	}
	else
	{
		$mensaje="<font color=\"red\" >error al Eliminar a la lista</font> ";
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
	echo $html;

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
</table>
</form>
</body>
</html>