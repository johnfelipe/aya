<?php
include("./Connections/cx.php");
extract($_REQUEST);
$mensa="";
if(isset($g))
{
	
	if(!empty($_FILES["archivo"]["tmp_name"]))
	{
		
			//mysql_query("truncate inmueble_postgre");
		$archivo_txt = fopen ($_FILES["archivo"]["tmp_name"], "r");//abriendo el archivo txt de forma exclusiva lectura
		$xx=0;
					while (!feof($archivo_txt)) ///mientras no este en el final del documento, leerlo
					{ 
				
					
						$linea = fgets($archivo_txt,4096);  //recorrera linea por linea asta una extencion 4096 caracteres
				
						$arr_=explode("\t",$linea);
						
				if(mysql_query("INSERT INTO tempo2 VALUES('$arr_[0]','$arr_[1]','$arr_[2]','$arr_[3]','$arr_[4]')"))
				{
					$xx+=1;
				}
				else
				{
					$mensaje_insert9= "<font color=\"#FF0000\">Error</font>";
				}
	
						
												   
				}
				$mensa="total de lineas guardadas".$xx;
				
		
	}

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>reprogramacion archivo</title>
</head>

<body>
<div align="center">
<form method="post" enctype="multipart/form-data">

            	<table width="70%" border="0" cellspacing="5">
                  <tr>
                    <th scope="row" align="center">Reprogramaciones</th>
                  
                  </tr>
                  <tr>
                      <td align="center">&nbsp;
                      <input type="file" name="archivo" />
                      
                      </td>
                  </tr>
                  <tr>
                    
                   <th scope="row"><p>
                <input type="submit" name="g" value="Guardar"  />
                &nbsp; &nbsp; &nbsp;<input type="reset" value="Borrar"  />
                </p></th>
              </tr>
              <tr>
              	<td align="center"><?php  echo $mensa; ?></td>
              </tr>
                  <tr>
                    <th scope="row"><a href="#" target="_blank" onClick="window.close();">Cerrar Ventana</a></th>
                  </tr>
                  <tr>
              <th scope="row">* Dato Obligatorio</th>
              </tr>
                </table>
                

  </form>
</div>
</body>
</html>
