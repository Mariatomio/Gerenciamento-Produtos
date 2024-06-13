<?php
// excluir_requisicao.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Certifique-se de validar e limpar os dados para evitar SQL injection
    $id_tipo_item = $_POST["id_tipo_item"];
    $conexao = new mysqli('localhost', 'root', 'breitkopf', 'portal2');

    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }

    $sql = "DELETE FROM tipo_item WHERE id_tipo_item = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_tipo_item);
    
    if ($stmt->execute()) {
        echo "Registro excluído com sucesso.";
    } else {
        echo "Erro na exclusão: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>
