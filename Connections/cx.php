<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cx = "127.0.0.1";
$database_cx = "apt_catalogo";
$username_cx = "root";
$password_cx = "123456*";
$cx = mysql_connect($hostname_cx, $username_cx, $password_cx) or trigger_error(mysql_error(),E_USER_ERROR); 
$a=mysql_query("use $database_cx");


?>