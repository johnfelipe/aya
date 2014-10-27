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

mysql_query("SET NAMES UTF8");

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nomina editar de Observaciones</title>
</head>
	
<body>
	
    <h2 align="center">Nomina de Observaciones a Editar</h2>
    <table>
    	
        <hr color="#000000" size="2%"  />
		<form method=get>
		<input type="hidden" id="hi" value="<?php echo $id; ?>" />
		</form>
	  <?php
		
			//valiacion si ya ser registro el periodo del consejo
		if(!empty($id))
		{
			
			//echo $row_fecha['per_consejo_id']."<br>";
			//echo $id;
			$query_1=mysql_query("SELECT ob1_id FROM ob_01 WHERE ob1_idact=$id ORDER BY ob1_id");
			$query_2=mysql_query("SELECT ob2_id FROM ob_02 WHERE ob2_idact=$id ORDER BY ob2_id");
			$query_3=mysql_query("SELECT ob3_id FROM ob_03 WHERE ob3_idact=$id ORDER BY ob3_id");

			$val_obs1=mysql_num_rows($query_1);
			$val_obs2=mysql_num_rows($query_2);
			$val_obs3=mysql_num_rows($query_3);

			if($val_obs1>0 OR $val_obs2>0 OR $val_obs3>0)
			{
				echo "<br /><table align='center' border='0' cellspacing='0' cellspacing=\"5\">
					<tr align='center'>
						<th>Acta&nbsp;&nbsp;</th><th>&nbsp;Descripci&oacute;n</th><th>&nbsp;&nbsp;Accion</th>
					</tr>";
					
					$query_acta=mysql_query("SELECT act_num  FROM actas WHERE act_id=$id");
					$row_acta=mysql_fetch_array($query_acta);
			}
				
			
			if($val_obs1 > 0)
			{
				$row_obs1=mysql_fetch_array($query_1);
				echo "
				<tr>
					<td>".$row_acta['act_num']."</td>
					<td>Salvedad</td>
					<td><input type=\"button\" nane='bx' value=\"Editar\"  onclick=\"open('edit_obser_e.php?id1=".$row_obs1['ob1_id']."','per2','width=600, height=400, scrollbars=yes')\" style=\"cursor: pointer\" ></td>
				<tr>
				
				
				
				" ;
			}
			if($val_obs2 > 0)
			{
				$row_obs2=mysql_fetch_array($query_2);
				echo "
				<tr>
					<td>".$row_acta['act_num']."</td>
					<td>Abstenci&oacute;n</td>
					<td><input type=\"button\" nane='bx' value=\"Editar\"  onclick=\"open('edit_obser_e.php?id2=".$row_obs2['ob2_id']."','per2','width=600, height=400, scrollbars=yes')\" style=\"cursor: pointer\" ></td>
				<tr>
				
				
				
				" ;
			}
			if($val_obs3 > 0)
			{
				$row_obs3=mysql_fetch_array($query_3);
				echo "
				<tr>
					<td>".$row_acta['act_num']."</td>
					<td>Voto en contra</td>
					<td><input type=\"button\" nane='bx' value=\"Editar\"  onclick=\"open('edit_obser_e.php?id3=".$row_obs3['ob3_id']."','per2','width=600, height=400, scrollbars=yes')\" style=\"cursor: pointer\" ></td>
				<tr>
				
				
				
				" ;
			}
			
			
		}
		?>
		<tr >
			<th colspan='5' align='center'><a href="#" target="_blank" onClick="window.close();">Cerrar Ventana</a><th>
		</tr>
            </table>
       

	
</body>
</html>