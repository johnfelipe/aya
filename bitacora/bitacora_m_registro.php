<?php

include("../Connections/cx.php");
extract($_REQUEST);
session_start();
mysql_query("SET NAMES UTF8");
if(!isset($_SESSION["login"]))
{
	mysql_query("set names utf8");
$insert=mysql_query("INSERT INTO bitacora (text) VALUES('Acceso de Intruso fallido al Menú de Registro')");
header("location: ../index.php");
}
else
{
	mysql_query("set names utf8");
	$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Acceso al Menú de Registro')");
	
	header("location: ../m_registro.php");
}

?>