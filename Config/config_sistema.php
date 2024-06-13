<?php
//////////////////////////////////////////////
// Sistema de cadastro						//
// Autor: Diego Gomes Araujo				//
// E-mail: diegogomesaraujo@hotmail.com		//
// Vers�o: 1.0								//
//////////////////////////////////////////////

// faz conex�o com o servidor MySQL
$local_serve = "localhost"; 	 // local do servidor
$usuario_serve = "root";		 // nome do usuario
$senha_serve = "breitkopf";			 	 // senha
$banco_de_dados = "sistema"; 	 // nome do banco de dados

$conn = @mysqli_connect($local_serve,$usuario_serve,$senha_serve) or die ("O servidor n�o responde!");

// conecta-se ao banco de dados
$db = @mysql_select_db($banco_de_dados,$conn) 
	or die ("N�o foi possivel conectar-se ao banco de dados!");
	

?>