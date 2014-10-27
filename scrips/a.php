<?php
include("./Connections/cx.php");

/*
for($a=28;$a<=375;$a++)
{

	$con=mysql_query("SELECT acu_tex0 FROM acuerdos WHERE acu_id=$a");
	$r=mysql_fetch_array($con);
	$contenido=str_replace('Comuníquese.','',$r['acu_tex0']);
	mysql_query("UPDATE acuerdos SET acu_tex0='$contenido' WHERE acu_id=$a  ");
	//mysql_query("update acuerdos set act_line='///// RUBRICADAS.- ', act_rubr='' where acu_id=$a ");
}


*/

 ?>