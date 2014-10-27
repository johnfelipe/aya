<?php


$mensaje="";
//inicio elimnar los sql
$path = ".";
$dir = opendir($path);
while ($elemento = readdir($dir))
{
$extensiones = explode(".",$elemento) ;
@$nombre = $extensiones[0] ;
@$nombre2  = $extensiones[1] ;
$tipo = array ("zip", "rar", "ace", "cab", "bat", "sql");
if(in_array($nombre2, $tipo)){
   @unlink("$elemento");
}
}
closedir($dir);
include("../Connections/cx.php");
extract($_REQUEST);
session_start();
mysql_query("set names utf8");
//fin elimina sql
//mkdir('./img/personas', 0777);
if(!isset($_SESSION["login"]))
{
header("location: ../index.php");
}

if($_SESSION['tipo']=='u1')
{
$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] intento Acceder al Área de Mantenimiento mediante la URL ')");	
header("location: ../inicio.php");
}if($_SESSION['tipo']=='u2')
{
$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] intento Acceder al Área de Mantenimiento mediante la URL ')");	
header("location: ../inicio.php");
}

//desturi session
if(isset($des))
{	
	//echo "<h1>funca</h1>";
		//unset($_SESSION['login']);
		session_destroy();
		
		header("location: ../index.php");
		
}

if(isset($res))
{
				
		//Configuracion del restaurador de base de datos
					/*$usuario = "root";
					$password = "asdwyuhjtgfr";
					$database = "repuestos";
					$servidor = "localhost";*/
					
						$usuario = $username_cx;
						$password = $password_cx;
						$database = $database_cx;
						$servidor = $hostname_cx;
						$res_des="/des_cryp.sql";
						
						if(!empty($_FILES["f1"]["tmp_name"]))
						{
							$destino =  "asdw.sql";
							//echo $_FILES["f1"]["tmp_name"];
							if(copy($_FILES['f1']['tmp_name'],$destino))
							{
								
								
								$n_local=$destino;

				
                
		$n_local=$destino;//nombre asigando a archivo temporar sql copiaderespado
				$cryp=fopen("./des_cryp.sql","a+");//nombre asigando al archivo temporal encrypatado
				$fd = fopen ($n_local, "r");//abriendo el archivo sql a encryptar
				while (!feof($fd)) {///mientras no este en el final del documento leido
				
					$buffer = fgets($fd);  //recorrera linea por linea asta una extencion 1024 caracteres
					//$rebuffer=base64_decode($buffer);
					
					fwrite($cryp,base64_decode($buffer)); //escribe y encryptada la linea leida
											   
				}
				fclose($cryp);//cierra encryptado
				fclose ($fd);  //cierra archivo temporal
				chmod($destino,0777);
				chmod("./des_cryp.sql",0777);
		
											 // mysql.exe  --user=admin --password=password
									$Sentencia = "mysql.exe --user=$usuario --password=$password  $database < ./des_cryp.sql" . chr(32);
									exec($Sentencia);
									mysql_query("SET NAMES UTF8");
					$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Restauro los Datos')");
									session_destroy();
									header("location: ../index.php");
							}
							else
							{
								$mensaje="<font color=\"#FF0000\">Imposible Copiar</font>";	
							}
							
							
							
							
						}
						else
						{
							$mensaje="<font color=\"#FF0000\">Debe seleccionar un archivo para Restaurar la Base de Datos</font>";	
						}
						
						
						
						
						
						
					
				//forzar descarga


	
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

<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrap">
<div id="header">
<div id="logo">
<h1 id="sitename"><img src="img/logo1.png"  /><span class="green"></span></h1>
<h2 class="description">&nbsp;</h2>
</div>
<div id="headercontent"><!-- InstanceBeginEditable name="EditRegion_session" -->
<form method="post" name="session" enctype="application/x-www-form-urlencoded"> 
<table width="295" border="0" align="center" background="">
  <tr>
    <td colspan="4" align="center"><h2>Bienvenid@: </h2></td>
  </tr>
  <tr>
    <td width="95" align="center"><img src="../img/personas/<?php echo $_SESSION['img']; ?>"  width="50 px" height="70 px" title=" <?php echo $_SESSION['name']; ?>" alt=" <?php echo $_SESSION['name']; ?>"/></td>
    <td width="165" colspan="3" align="center"><h2><?php echo $_SESSION['name']; ?> </h2> </td>
    </tr>
    <tr>
    	<td colspan="4" align="center"><input type="submit"
        name="des" value="Cerrar Sesión"   />      </td>
    </tr>
  </table>
</form>
<!-- InstanceEndEditable --></div>
<div id="sitecption"><!-- InstanceBeginEditable name="EditRegion_tex2" -->
  <p>Alcaldia <span class="bigger">Municipla</span></p>
  <p> de Usulutan</p>
<!-- InstanceEndEditable --></div>
</div>
<div id="main">
<div id="menus">
	<!-- InstanceBeginEditable name="EditRegion_menu" -->
    <div id="mainmenu">
    
    <ul>
    <li class="first" ><a href="../inicio.php">Inicio</a></li>
    <li ><a href="../m_registro.php">Registro</a></li>
    <li><a href="../m_consultas.php">Busquedas</a></li>
    <li><a href="../contruccion_reportes.php">Reportes</a></li>
    <li id="active"><a href="../m_mantenimiento.php">Mantenimiento</a></li>
  <li><a href="#">salir</a></li>
    <li><a href="#">&nbsp;</a></li>
    
    </ul>
  
    </div>
   
    <div id="submenu">
<li><a href="../m_manto_sistema.php">Configuraciones de Sistema</a></li>
    <li><a href="../m_manto_ges_dato.php">Gestion Datos</a> </li>

    <li><a href="../m_manto_ges_perdato.php">Gestion Actas y concejo</a></li>
    <li><a href="../m_manto_repor.php">Bit&aacute;cora</a></li>
    <li><a href="../m_manto_copias.php">Copias de Seguridad</a></li>
        </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
    <div align="center" id="table1">
      
      <br  />
      
      <br  />
          <table width="70%" border="0" cellspacing="5">
  <tr>
    <td align="center"><h2 style="color: #5B920A;">Restaura Copias de Seguridad</h2></td>
    </tr>
  <tr>
    <td align="center"><form method="post" enctype="multipart/form-data" ><table width="70%" border="0" cellspacing="5">
      <tr>
        <th width="30%" scope="row">Nombre de la copia</th>
        <td width="70%"><label for="fileField"></label>
          <input type="file" name="f1" id="fileField" /></td>
        </tr>
      <tr>
        <th colspan="2" scope="row"><input type="submit" value="Restaurar" name="res"  />
          &nbsp;
          <input type="reset" value="Borrar" /></th>
        </tr>
    </table></form></td>
    </tr>
</table>

          <p><?php echo $mensaje; ?></p>
          <p>&nbsp;</p>
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
