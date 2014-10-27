<?php


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


//fin elimina sql

include("../Connections/cx.php");
extract($_REQUEST);
session_start();
mysql_query("set names utf8");
//mkdir('./img/personas', 0777);
if(!isset($_SESSION["login"]))
{
header("location: index.php");
}

if($_SESSION['tipo']=='u1')
{
	$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] intento Acceder al Área de Mantenimiento mediante la URL ')");	
	header("location: inicio.php");
}
if($_SESSION['tipo']=='u2')
{
	$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] intento Acceder al Área de Mantenimiento mediante la URL ')");	
	header("location: inicio.php");
}

//desturi session
if(isset($des))
{	
	//echo "<h1>funca</h1>";
		//unset($_SESSION['login']);
		session_destroy();
		
		header("location: index.php");
		
}

$query=mysql_query("SELECT * FROM datos");

$row=mysql_fetch_array($query);

if(isset($crear))
{
	
$nom_archivo = date('d-m-Y').'_'.$text1.'_'.$row['back_head'];
				
				//mysql_query("INSERT INTO respaldo VALUES(md5('$_POST[usu]'),md5('$_POST[pas]'),'$strArchivo')");
				$ruta = "./$nom_archivo";
				$Sentencia = "mysqldump.exe --user=$username_cx --password=$password_cx" . chr(32);
				$Sentencia .= "-e -K -f -n -q --add-locks" . chr(32);
				$Sentencia .= "--databases $database_cx > $nom_archivo" . chr(32);
				$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Creo una Copia de Respaldo con el  Nombre de $nom_archivo')");
                $Resultados = "DROP DATABASE IF EXISTS $database_cx;\r\nCREATE DATABASE $database_cx;\r\nUSE $database_cx\r\n";
				$Resultados .= @exec($Sentencia);
				//empisa el 64
				$id_file = fopen($nom_archivo,"r+");
				$tamanio = filesize($nom_archivo);
				
				
				$n_local="./".$nom_archivo;//nombre asigando a archivo temporar sql copiaderespado
				$cryp=fopen("./local_re.sql","a+");//nombre asigando al archivo temporal encrypatado
				$fd = fopen ($n_local, "r");//abriendo el archivo sql a encryptar
				while (!feof($fd)) {///mientras no este en el final del documento leido
				
					$buffer = fgets($fd);  //recorrera linea por linea asta una extencion 1024 caracteres
					
					//$pop=strrev($buffer);
					$rebuffer=base64_encode($buffer);
					fwrite($cryp,$rebuffer."\n"); //escribe y encryptada la linea leida
					
					
				}
				fclose($cryp);//cierra encryptado
				fclose ($fd);  //cierra archivo temporal
				fclose($id_file);
				chmod($nom_archivo,0777);
				chmod("./local_re.sql",0777);
				unlink($nom_archivo);
				rename("local_re.sql",$nom_archivo);
				
				//termina 64
			
				
				/*$nombre_u=$_SESSION["login"];
						
				$fecha_h = date("Y-m-d G:i:s ");
				mysql_query("INSERT INTO historial VALUES('$nombre_u','$fecha_h','Este usuarios  ha creado una Copia de Respaldo con el nombre: $strArchivo')",$cx);
*/
				

				//forzar descarga
					$carpeta="./";
					$file=$carpeta.$nom_archivo;
					mysql_query("SET NAMES UTF8");
					
				   header("Content-Transfer-Encoding: binary");
				   header("Content-type: application/force-download");
				   header("Content-Disposition: attachment; filename=".basename($file));
				   header("Content-Length: ".filesize($file));
				   readfile($file);
				   	header("location: index.php");
				 	
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
    <li><a href="../m_manto_ges_perdato.php">Gestion Actas y concejo</a> </li>
    <li><a href="../m_manto_repor.php">Bitácora</a></li>
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
          <td align="center"><h2 style="color: #5B920A;">Crear Copia de Seguridad</h2></td>
          </tr>
        <tr>
          <td align="center"><form name="crear" method="post" enctype="application/x-www-form-urlencoded"><table width="50%" border="0" cellspacing="5">
            <tr>
              <th scope="row">nombre de la copia:</th>
              <td><span id="sprytextfield1">
                <label for="text1"></label>
                <input type="text" name="text1" id="text1" />
                <span class="textfieldRequiredMsg">*.</span></span></td>
              </tr>
            <tr>
              <th colspan="2" scope="row"><input type="submit" value="Crear" name="crear"  />&nbsp;<input type="reset" value="Borrar" /></th>
              </tr> 
            <tr>
              <th scope="row">&nbsp;</th>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <th scope="row">&nbsp;</th>
              <td>&nbsp;</td>
              </tr>
            </table></form></td>
          </tr>
  </table>
      
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </div>
    
      <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
      </script>
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
