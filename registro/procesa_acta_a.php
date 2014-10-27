<?php
//coneccion a BD
include("../Connections/cx.php");
//extraccion de todas las funciones
extract($_REQUEST);





//inicio de las funciones de seccion
session_start();
if(!isset($_SESSION["login"]))
{
header("location: ../index.php");
}

//desturi session
if(isset($des))
{	
	//echo "<h1>funca</h1>";
		//unset($_SESSION['login']);
		$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Cerro Sessión')");
		session_destroy();
		
		header("location: ../index.php");
		
}

//echo fileperms ('../img/personas'); 

if(isset($guardar))
{
	$coompro_lista=mysql_query("SELECT * FROM tempo");
	$compro=mysql_num_rows($coompro_lista);

	if($compro==0)
	{
		$mensaje="<font color=\"#FF0000\">Lista de Asistencia Vacia, Verifiquela</font><br>";
	}
	else
	{
	
			$par0=explode('-',$text2);
			
			mysql_query("set names utf8");
		  $date=$par0[2]."-".$par0[1]."-".$par0[0];
				//echo 'id_acta'.$h1.$text1.'_'.$date.'_'.$select1.'_'.$select2.':'.$select3.':'.$select4.'_tipo'.$radio.'_'.$textarea1.'_coo_activo';
				
				//echo $h1.'_'.$select2.':'.$select3.':'.$select4;
				 $qdato=mysql_query("select n_datos from datos where activo=1");
				 $dato_d=mysql_fetch_array($qdato);
				 
				 
				if(mysql_query("INSERT INTO actas VALUES('',$h1,$text1,'$date',$select1,'$select2:$select3:$select4',$radio,'$textarea1','','','activo',$lb,$dato_d[0])"))
				{
					$max=mysql_query("SELECT max(act_id) FROM actas");
					$id_usar=mysql_fetch_array($max);
		
					//$id_usar[0];
					//insercion de observaciones
						//1-------salvedades
						$query_ob1=mysql_query("SELECT * FROM t_01 ORDER BY a");
						$num_query_ob1=mysql_num_rows($query_ob1);
						if($num_query_ob1>0)
						{
							while($row_t01=mysql_fetch_array($query_ob1))
							{
								mysql_query("INSERT INTO ob_01 VALUES('','$row_t01[b]',$id_usar[0])");
							}
							
						}
						//2-------abstenciones
						$query_ob2=mysql_query("SELECT * FROM t_02 ORDER BY aa");
						$num_query_ob2=mysql_num_rows($query_ob2);
						if($num_query_ob2>0)
						{
							while($row_t02=mysql_fetch_array($query_ob2))
							{
								mysql_query("INSERT INTO ob_02 VALUES('','$row_t02[bb]',$id_usar[0])");
							}
							
						} 
						//3-------abstenciones
						$query_ob3=mysql_query("SELECT * FROM t_03 ORDER BY aaa");
						$num_query_ob3=mysql_num_rows($query_ob3);
						if($num_query_ob3>0)
						{
							while($row_t03=mysql_fetch_array($query_ob3))
							{
								mysql_query("INSERT INTO ob_03 VALUES('','$row_t03[bbb]',$id_usar[0])");
							}
							
						} 
					//fin insercion de observaciones
					
					
					
					
					
					
					
					
					if($radio==1)
					{
						$rad='Ordinaria';
					}
					else if($radio==2)
					{
						$rad='Extraordinaria';
					}
					else
					{
						$rad='Otros';
					}
					
					$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Registro una acta tipo $rad ')");
					
					$query_agregalista=mysql_query("SELECT * FROM tempo ORDER BY nomina");
					$num_rows=mysql_num_rows($query_agregalista);
					
					if($num_rows>0)
					{	
						while($row_tempo=mysql_fetch_array($query_agregalista))
						{ /*
							//echo $row_tempo['consejo']."consejo_".$row_tempo['nomina']."psedonas__".$row_tempo['id_acta']."acta_<br />";
							$query_idac=mysql_query("select* from actas");
							$relacion_idacta=mysql_num_rows($query_idac)+1;
								$uqry=mysql_query("select * from actas where act_conid=$h1 and act_num=$text1");
								$row_idact=mysql_fetch_array($uqry);
								$id_acta=$row_idact['act_id'];*/
							if($insert_relacion=mysql_query("INSERT INTO relacion_actas VALUES($id_usar[0],$row_tempo[consejo],$row_tempo[nomina],'$row_tempo[profecion]')"))
							{
								
								$mensaje="<h2>Datos Guardados</h2>";
										
							}
							else
							{
								echo "error al insertar a relacion_actas";
							}
									
						}						
					}
					
					
					$mensaje="<h2>Datos Guardados</h2>";
					
					
					
				}
				else
				{
					$mensaje="<font color=\"#FF0000\">Error Al Almacenar los Datos</font><br>";			
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
<meta http-equiv="refresh" content="1;URL=../m_registro_acuerdos_con_libro.php"> 
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
  <li class="first"><a href="../inicio.php">Inicio</a></li>
    <li id="active"><a href="../m_registro.php">Registro</a></li>
    <li><a href="../products.html">busquedas</a></li>
    <li><a href="../contruccion_reportes.php">reportes</a></li>
    <li><a href="../m_mantenimiento.php">Mantenimiento</a></li>
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
    <div align="center" id="table1">
      <table width="200" border="0" cellspacing="5">
        <tr>
          <td align="center"><h2 >Registro de Actas</h2></td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>
          
              <table width="328" border="0" cellspacing="5">
                <tr>
                  <td width="309" align="center"><?php echo $mensaje; ?></td>
                </tr>
                </table>
        
            </td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
        </table>
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
