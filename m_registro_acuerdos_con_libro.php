<?php
//inclumos la base de datos
include("./Connections/cx.php");
//inlcuimos lso calendarios
include("scrips/calendario/calendario.php");

//incluimos libreria paginacion;

include ( 'scrips/pag_lib/PHPPaging.lib.php');

//esctraemos todas las variables
extract($_REQUEST);
//icniaializacmos las secciones
session_start();
//mkdir('./img/personas', 0777);
if(!isset($_SESSION["login"]))
{
	$insert=mysql_query("INSERT INTO bitacora (text) VALUES('Acceso de Intruso fallido al Área de Registro  Mediante la URL')");
header("location: index.php");
}

//desturi session
if(isset($des))
{	
	//echo "<h1>funca</h1>";
		//unset($_SESSION['login']);
		$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Cerro Sessión')");
		session_destroy();
		
		header("location: index.php");
		
}



$borrar_tempo=mysql_query("delete from tempo");
$query_anio=mysql_query("SELECT periodo FROM datos");
$row_anio=mysql_fetch_array($query_anio);

$date=date('Y-m-d');
$antes=explode('-',$date);
$resta=intval($antes[0])-$row_anio['periodo'];
$date2=$resta."-".date('m-d');
$query_rango_date=mysql_query("select * from per_consejo where per_activo=1 ");
$validar_per=mysql_num_rows($query_rango_date);

if($validar_per==0)
{
	header("location: m_registro_consejo_consejo.php");
}

$fet=mysql_fetch_array($query_rango_date);

$validar_proc=mysql_query("SELECT proc_legitimo FROM datos WHERE n_datos=1");

$row_pro=mysql_fetch_array($validar_proc);
 if($row_pro['proc_legitimo']==0)
 {
	
 }
 else
 {
	 header("location: m_registro_actas.php");
 }




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla_1.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Registro Actas</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->

<script language="javascript" src="scrips/calendario/javascripts.js"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
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
<form method="post" name="session" enctype="application/x-www-form-urlencoded"> 
<table width="295" border="0" align="center" background="">
  <tr>
    <td colspan="4" align="center"><h2>Bienvenid@: </h2></td>
  </tr>
  <tr>
    <td width="95" align="center"><img src="img/personas/<?php echo $_SESSION['img']; ?>"  width="50 px" height="70 px" title=" <?php echo $_SESSION['name']; ?>" alt=" <?php echo $_SESSION['name']; ?>"/></td>
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
<p>Alcaldía  <span class="bigger">Municipal</span></p>
  <p> de Usulután</p>
<!-- InstanceEndEditable --></div>
</div>
<div id="main">
<div id="menus">
	<!-- InstanceBeginEditable name="EditRegion_menu" -->
    <div id="mainmenu">
    
    <ul>
<li class="first" ><a href="inicio.php">Inicio</a></li>
    <li id="active"><a href="./bitacora/bitacora_m_registro.php">Registro</a></li>
    <li><a href="./bitacora/bitacora_m_consultas.php">busquedas</a></li>
    <li><a href="contruccion_reportes.php">reportes</a></li>
    <li><a href="./bitacora/bitacora_m_mantenimiento.php">Mantenimiento</a></li>
    <li><a href="#">salir</a></li>
    <li><a href="#">&nbsp;</a></li>
    
    
    </ul>
  
    </div>
   
    <div id="submenu">
  
   <li><a href="m_registro_personas.php">Personas</a></li>
    <li><a href="m_registro_empleados.php">Empleados</a> </li>
    <li><a href="m_registro_consejo">Concejo</a></li>
    <li><a href="m_registro_actas_menu2.php">Actas</a></li>
    <li><a href="#">Acuerdos</a></li>
    </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
     

<div align="center">
  
  <table width="75%" border="0" cellspacing="5" align="center">
    <tr>
      
      <td align="center"><h2  >Registro del Acuerdos</h2></td>
      </tr>
    <tr>
      <td align="center">
        
        <fieldset>
          <legend>Gestion De Acuerdos</legend>
          <form method="get" enctype="multipart/form-data" name="f_ges_acu" action="m_registro_actas_a.php">
            <table border="0">
              <tr>
                
                <td>Selecione el libro&nbsp;&nbsp;&nbsp;</td>
                <td><span id="spryselect1">
                  <label for="select1"></label>
                  <select name="select1" id="select1">
                  	
                 
                  <?php
				  
					$s_libro=mysql_query("SELECT * FROM libro WHERE lib_act='1'");		
					
					while($f=mysql_fetch_array($s_libro))
					{
						echo "<option value=\"".$f['id_libro']."\">".$f['libro_descrip']."</option>";
					}	
						  
				  ?>
                   </select>
                  <span class="selectRequiredMsg">*.</span></span>&nbsp;&nbsp;</td>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="aceptar"  />  </td>
                </tr>
              <tr>
                <td> </td>
                <td align="center">
                  
                  
                  
                  </td>
                <td align="center">&nbsp;</td>
                </tr>
              
              </table>
            
            
            </form>
          </fieldset>
        
        </td>
      </tr>
    <tr>
      <td align="center">
        <br /><br />
        
        
        </td>
      </tr>
    
  </table>
  
  
  
  
</div
>
    <script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["change", "blur"]});
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
