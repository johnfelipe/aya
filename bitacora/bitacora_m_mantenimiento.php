<?php
include("../Connections/cx.php");
extract($_REQUEST);
session_start();




	mysql_query("set names utf8");

if(!isset($_SESSION["login"]))
{

$insert=mysql_query("INSERT INTO bitacora (text) VALUES('Acceso de Intruso fallido al Menú de Registro')");
header("location: ../index.php");
}
else
{
	
		 if($_SESSION['tipo']=='u2')
		 {
			 mysql_query("set names utf8");
			 $insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name]  Accedio al Área de Mantenimiento nivel2 ')");	
			 header("location: ../m_mantenimiento_2.php");  
			 
		  }
		  else if($_SESSION['tipo']=='u1')
		  {
			  mysql_query("set names utf8");
			  $insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] intento Acceder al Área de Mantenimiento')");	
			header("location: ../inicio.php");  
		  }
	else
	{
		mysql_query("set names utf8");
			$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Acceso al Menú de Mantenimiento')");
	
	header("location: ../m_mantenimiento.php");
		
	}	
		
	
	

}

?>