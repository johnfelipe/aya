<?php
//inclumos la base de datos
include("../Connections/cx.php");
//inlcuimos lso calendarios
include("../scrips/calendario/calendario.php");
//include("../scrips/calendario/calendario.php");

//esctraemos todas las variables
extract($_REQUEST);
//icniaializacmos las secciones
session_start();

if(!isset($_SESSION["login"]))
{
$insert=mysql_query("INSERT INTO bitacora (text) VALUES('Acceso de Intruso fallido al Área de Registro  Mediante la URL')");
header("location: index.php");
}

$query_val_acta=mysql_query("SELECT estado FROM actas WHERE act_id=$id");
$val_query_acta=mysql_num_rows($query_val_acta);

if($val_query_acta>0)
{
	
}


mysql_query("SET NAMES UTF8");



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Menu ediccion</title>
</head>

<body>
<div align="center">





<form method="post" enctype="application/x-www-form-urlencoded">

            	<table width="70%" border="0" cellspacing="5">
                  <tr>
                    <th scope="row" align="center"><img src="../img/ad.png" width="94" height="99" alt="Agregar Observaci&oacute;n" title="Agregar Observaci&oacute;n" onclick="open('add_obser_e.php?id=<?php echo $id;?>','per2','width=900, height=700','scrollbars=yes')" style="cursor: pointer" /></th>
                    <th scope="row" align="center"><img src="../img/pencil.png" width="96" height="93" alt="Editar Observaci&oacute;n"  title="Editar Observaci&oacute;n" onclick="open('obser_edit.php?id=<?php echo $id;?>','per2','width=900, height=700','scrollbars=yes')" style="cursor: pointer"/></th>
                  </tr>
                  <tr>
                    <th colspan="2" align="center" scope="row"><img src="../img/eliminar.png" width="80" height="72" alt="Eliminar Observaci&oacute;n" title="Eliminar Observaci&oacute;n"  onclick="open('obser_eliminar.php?id=<?php echo $id;?>','per2','width=900, height=700','scrollbars=yes')" style="cursor: pointer"/></th>
                  </tr>
                  <tr>
                    <th colspan="2" align="center" scope="row">&nbsp;</th>
                  </tr>
                </table>

  </form>
 
</div>
</body>
</html>