<?php

define('BD_USER', 'root');
define('BD_PASS', 'breitkopf');
define('BD_NAME', 'portal2');

$conexao = new mysqli('localhost', BD_USER, BD_PASS);

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
$conexao->set_charset("utf8mb4");
// Selecionar o banco de dados
mysqli_select_db($conexao, BD_NAME) or die("Erro na seleção do banco de dados");

/* ?> */
