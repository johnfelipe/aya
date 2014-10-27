<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
<?php
include("./Connections/cx.php");
$QUERY=mysql_query("select *  from actas  ");
		$a=1;
		$id_book=1;
		
		
	while($f=mysql_fetch_array($QUERY))
	{
		
		if(mysql_query("UPDATE actas SET act_lb=$id_book WHERE act_id=$f[act_id] "))
		{
			echo $a;
		}
		$a++;
	}

?>