<?php
//para ver al detalle la utilizacion de esta libreria puede ingresar a
//http://phppaging.phperu.net/basico/
//WWW.djcharlie.tk
require_once 'PHPPaging.lib.php';
mysql_connect("localhost","root");
mysql_select_db("base");
$paging = new PHPPaging;
      
     
        $paging->agregarConsulta("select * from visitante");
        
        // Ejecutamos la paginación
        $paging->ejecutar();  



	while($f= $paging->fetchResultado()) {
	echo $f['Nombre'].'<br>';
	}
	echo 'Paginas '.$paging->fetchNavegacion();
	?>