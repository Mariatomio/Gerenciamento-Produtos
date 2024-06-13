<?php
 
function session_checker(){
 
    if (!isset($_SESSION['matricula'])){
 
        header ("Location:errousuario1.html");
        exit(); 
 
    }
 
}
 
?>
