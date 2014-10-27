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
		 //echo $textarea2;
			$linea=explode(';',@$textarea2);
			$nn=0;
			//while($linea[])
			foreach($linea as $key => $value)
			{
				@$dato=explode(',',$value);
				@$dato[0]=trim($dato[0]);
				if(mysql_query("INSERT INTO repro Values('',$h1,'".@$dato[0]."','".@$dato[1]."','".@$dato[2]."','".@$dato[3]."','".@$dato[4]."')"))
				{
					
					$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] editó una acta Agregando Reprogramaciones')");
					
					
					mysql_query("DELETE FROM repro WHERE rep_a='' and rep_b='' and rep_c='' and rep_d='' and rep_f=''");
					$mensaje="Datos Almacenados";
				}
				//echo $nn.'<br>';
				$nn+=1;
			}
		//echo "<script>window.parent.close()</script>  ";
	}
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center">
<form method="post" enctype="application/x-www-form-urlencoded">

            	<table width="70%" border="0" cellspacing="5">
                  <tr>
                    <th scope="row" align="center">Reprogramaciones<input type="hidden" value="<?php echo $id ; ?>" name="h1" /></th>
                  
                  </tr>
                  <tr>
                      <td align="center"><span id="sprytextarea2">
                      <label for="textarea2"></label>
                      <textarea name="textarea2" id="textarea2" cols="45" rows="5"></textarea>
                    <span class="textareaRequiredMsg">*</span></span><br />
                    <?php echo @$mensaje; ?>
                    </td>
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

var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {validateOn:["blur", "change"], hint:"5xxx0, Secretaria, 5xxxx, Aum, 2155.14;  5xxx0, Secretaria, 5xxxx, Aum, 2155.14;"});
</script>
</body>
</html>