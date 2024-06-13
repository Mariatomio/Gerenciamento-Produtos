<?php
/**
 * PHP e MySQL para iniciantes
 *
 * Arquivo que faz a conexão com o banco de dados utilizando MySQLi
 *
 * PHP 5+, MySQL 4.1+
 *
 * @author Thiago Belem <contato@thiagobelem.net>
 * @link http://blog.thiagobelem.net/mysql/php-e-mysql-para-iniciantes-consulta-simples/
 */

// Dados de acesso ao servidor MySQL
$MySQL = array(
	'servidor' => 'localhost',	// Endereço do servidor
	'usuario' => 'root',		// Usuário
	'senha' => 'breitkopf',				// Senha
	'banco' => 'consulta'		// Nome do banco de dados
);

$MySQLi = new MySQLi($MySQL['servidor'], $MySQL['usuario'], $MySQL['senha'], $MySQL['banco']);

// Verifica se ocorreu um erro e exibe a mensagem de erro
if (mysqli_connect_errno())
    trigger_error(mysqli_connect_error(), E_USER_ERROR);

?>