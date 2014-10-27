<?php
//inclumos la base de datos
include("../Connections/cx.php");
//inlcuimos lso calendarios
//include("scrips/calendario/calendario.php");
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
/*if(isset($guardar))
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
*/

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edici&oacute;n de Reprogramaciones</title>
</head>

<body>
<table align="center">
<tr>
	<th align="center">Edici&oacute;n de Reprogramaci&oacute;n</th>
</tr>
<tr>
	<td>
<form  method="post" action="update_repro.php">
<table cellspacing="1" align="center" border="1" >
	<tr align='center'>
    <?php
			$qq=mysql_query("SELECT * FROM repro WHERE rep_id=$id");
			
			$row=mysql_fetch_array($qq);
	
	 ?>
		<th>codigo</th><th>Descripci&oacute;n</th><th>Linea</th><th>A/D</th><th>Monto</th>
	</tr>
       
        <td>
        	<input type="hidden" name="h1" value="<?php echo $id ; ?>" /><input type="text" name="c1" value="<?php echo $row['rep_a'] ; ?>" />
        </td>
        <td>
        	<input type="text" name="c2" value="<?php echo $row['rep_b'] ; ?>" />
          
        </td>
        <td>
        	<input type="text" name="c3" value="<?php echo $row['rep_c'] ; ?>" />
        </td>
        <td>
        	<input type="text" name="c4" value="<?php echo $row['rep_d'] ; ?>" />
        </td>
        <td>
        	<input type="text" name="c5" value="<?php echo $row['rep_f'] ; ?>" />
        </td>
     
    </tr>
</table>

<table align="center">
	<tr>
    	<td><input type="submit" name="guardar" value="Guardar" /><input type="reset" Borrar /></td>
    </tr>
</table>
</form>
 </td>
 </tr>
</table>
</body>
</html>