<?php
include("../Connections/cx.php");
include ( '../scrips/pag_lib/PHPPaging.lib.php');
extract($_REQUEST);
/*
$date=date('Y-m-d');
$antes=explode('-',$date);
$resta=intval($antes[0])-4;
$date2=$resta."-".date('m-d');
$query_rango_date=mysql_query("select * from per_consejo where date(per_consejo_des) between '$date2' and '$date' ");
$existe_consejo=mysql_num_rows($query_rango_date);

*/

$id=$id_consejo;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Asistencia del Cosejo</title>
</head>
	
<body>
	<div align="center">
    	<table width="70%" border="0" cellspacing="5">
          <tr>
            <td colspan="2" align="center"><h3 style="color: #5B920A;">Editar Personas del Asistentes<br /> Del Consejo</h3></td>
          </tr>
          <tr>
            <td  align="center"><img src="../img/consejo_add.png" width="178" height="172" title="Agregar Aistente" onclick="open('ges_asis_e_datos_add.php?id_consejo=<?php echo $id;?>&acta=<?php echo $acta; ?>','per2','width=900, height=700','scrollbars=yes')" style="cursor: pointer"  /></td>
            <td align="center"><img src="../img/consejo_edit.png" width="178" height="172" title="Editar Datos de Aistente"  onclick="open('ges_asis_e_datos_edi.php?id_consejo=<?php echo $id;?>&acta=<?php echo $acta; ?>','per2','width=900, height=700','scrollbars=yes')" style="cursor: pointer"  /></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><img src="../img/consejo_elimi.png" width="178" height="172" title="Eliminar Aistente"  onclick="open('ges_asis_e_datos_eli.php?id_consejo=<?php echo $id;?>&acta=<?php echo $acta; ?>','per2','width=900, height=700','scrollbars=yes')" style="cursor: pointer"    /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>

    </div>
    
	
</body>
</html>