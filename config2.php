<?php
 
define('BD_USER', 'root');
define('BD_PASS', 'breitkopf');
define('BD_NAME', 'listaemails');
 
mysql_connect('localhost', BD_USER, BD_PASS);
mysql_select_db(BD_NAME);
 
?>