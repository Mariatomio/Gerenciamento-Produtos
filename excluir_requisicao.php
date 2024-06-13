<?php
// excluir_requisicao.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Certifique-se de validar e limpar os dados para evitar SQL injection
    $orderId = $_POST["order_id"];

    // Execute a consulta DELETE no banco de dados usando $orderId
    // Substitua as informações de conexão e a consulta DELETE conforme necessário
    $conexao = new mysqli('localhost', 'root', 'breitkopf', 'portal2');

    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }

    $sql = "DELETE FROM requisicao2 WHERE order_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $orderId);
    
    if ($stmt->execute()) {
        echo "Registro excluído com sucesso.";
    } else {
        echo "Erro na exclusão: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>
