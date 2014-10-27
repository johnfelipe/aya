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
if(!isset($_SESSION["login"]))
{
$insert=mysql_query("INSERT INTO bitacora (text) VALUES('Acceso de Intruso fallido al Área de Registro  Mediante la URL')");
header("location: index.php");
}
mysql_query("SET NAMES UTF8");
if(isset($guardar))
{
	if(!empty($textarea2))
	{
			$linea=explode(';',@$textarea2);
			$nn=0;
			//while($linea[])
			foreach($linea as $key => $value)
			{
				@$dato=explode(',',$value);
				@$dato[0]=trim($dato[0]);
				if(mysql_query("INSERT INTO tempo2 Values('$dato[0]','$dato[1]','$dato[2]','$dato[3]','$dato[4]')"))
				{
					mysql_query("DELETE FROM tempo2 WHERE a='' and b='' and c='' and d='' and f=''");
					$mensaje="Datos Almacenados";
				}
				echo $nn.'<br>';
				$nn+=1;
			}
		echo "<script>window.parent.close()</script>  ";
	}
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<div align="center">





<form method="post" enctype="application/x-www-form-urlencoded">

            	<table width="70%" border="0" cellspacing="5">
                  <tr>
                    <th scope="row" align="center"><img src="img/ad.png" width="94" height="99" alt="Agregar Reprogramacion" title="Agregar Reprogramacion" onclick="open('add_repro.php?id=<?php echo $id;?>','per2','width=900, height=700','scrollbars=yes')" style="cursor: pointer" /></th>
                    <th scope="row" align="center"><img src="img/pencil.png" width="96" height="93" alt="Editar Reprogramacion"  title="Editar Reprogramacion" onclick="open('consultas/repro_editar.php?id=<?php echo $id;?>','per2','width=900, height=700','scrollbars=yes')" style="cursor: pointer"/></th>
                  </tr>
                  <tr>
                    <th colspan="2" align="center" scope="row"><img src="img/eliminar.png" width="80" height="72" alt="Eliminar Reprogramacion" title="Eliminar Reprogramacion"  onclick="open('consultas/repro_eliminar.php?id=<?php echo $id;?>','per2','width=900, height=700','scrollbars=yes')" style="cursor: pointer"/></th>
                  </tr>
                  <tr>
                    <th colspan="2" align="center" scope="row">&nbsp;</th>
                  </tr>
                </table>

  </form>
 
</div>
</body>
</html>