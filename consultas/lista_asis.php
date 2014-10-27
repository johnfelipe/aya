<?php

include("../Connections/cx.php");
extract($_REQUEST);

//echo "consejo=".$id_conse." _ id en el consejo".$nomina_id." acta".$id_acta;
mysql_query("SET NAMES UTF8");
$q=("SELECT * FROM  tempo WHERE consejo=$id_conse AND nomina=$nomina_id AND id_acta=$id_acta");
$query_=mysql_query($q);
$num_rows=mysql_num_rows($query_);
 $mensaje="";

	if($num_rows==0)
	{
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
		
	}
	else
	{
		$html="<table align=\"center\" border=\"0\">
			<tr>
				<td colspan='2' align='center'><font color='red'>Esta persona ya se encuentra<br /> en la lista de asistencia <br /><br /></font></td>
			</tr>
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
						
					</table>
				
				<br />
				</td>
			</tr>
			<tr>
				<td>
					<input type=\"submit\" name=\"borrar\" value=\"eliminar de la lista\">
				</td>
				<td>
					<input type=\"button\" name=\"cerrar\" value=\"cerrar\" onClick=\"window.close();\">
				</td>
			</tr>
			
		</table>";
		
	}

if(isset($agregar))
{
	if(isset($pro))
	{
		if($isnert=mysql_query("INSERT INTO tempo VALUES($id_conse, $nomina_id, '1', $id_acta)"))
		{
			$mensaje="<font color=\"green\" >exito al Agregar a la lista</font> ";
			echo "<script>   window.parent.close()</script>  ";
		}
		else
		{
			$mensaje="<font color=\"red\" >error al Agregar a la lista</font> ";
		}	
	}
	else
	{
		if($isnert=mysql_query("INSERT INTO tempo VALUES($id_conse, $nomina_id, '0', $id_acta)"))
		{
			$mensaje="<font color=\"green\" >exito al Agregar a la lista</font> ";
			echo "<script>window.parent.close()</script>  ";
		}
		else
		{
			$mensaje="<font color=\"red\" >error al Agregar a la lista</font> ";
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
			echo $mensaje;
			?>
        </td>
    </tr>
</table>
</form>
</body>
</html>