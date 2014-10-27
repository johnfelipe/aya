<?php  

$a='pepe';
$b='a,b,c,d';

$c=explode(',',$a);
echo sizeof($c);

$d=explode(',',$b);
echo '<br>'.sizeof($d);


?>