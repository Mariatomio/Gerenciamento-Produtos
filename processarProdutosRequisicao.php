<?php
session_start(); // Inicia a sessão

// Conectar ao banco de dados (substitua as informações de conexão conforme necessário)
$mysqli = new mysqli('localhost', 'root', 'breitkopf', 'testes');

// Verificar a conexão
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST["item"];
    $nome = $_SESSION["cpf"];
    $quantidade = $_POST["qnt"];
    $preco = $_POST["preco"];
    $tipoMovimentacao = 'Saída';

    echo $preco;
    $sql = "INSERT INTO requisicao(sku, user, quantidade) VALUES (?, ?, ?)";
    $sql2 = "INSERT INTO controle(sku, preco, quantidade, tipoMovimentacao) VALUES (?, ?, ?, ?)";

    mysqli_set_charset($mysqli, "utf8mb4");

    $stmt = $mysqli->prepare($sql);
    $stmt2 = $mysqli->prepare($sql2);

    if ($stmt && $stmt2) {
        $stmt->bind_param('sss', $item, $nome, $quantidade);
        $stmt2->bind_param('ssss', $item, $preco, $quantidade, $tipoMovimentacao);

        if ($stmt->execute() && $stmt2->execute()) {
            echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Seu código JavaScript aqui
    
        function showAlert(message, redirectTo = null) {
            const overlay = document.getElementById("overlay");
            const alertMessage = document.getElementById("alert-message");
            const alertOkayBtn = document.getElementById("alert-okay-btn");
    
            if (overlay && alertMessage && alertOkayBtn) {
                alertMessage.textContent = message;
                overlay.style.display = "block";
    
                alertOkayBtn.addEventListener("click", function() {
                    overlay.style.display = "none";
    
                    if (redirectTo) {
                        window.location.href = redirectTo;
                    } else {
                        window.location.reload();
                    }
                });
            } else {
                console.error("Elementos do DOM não encontrados");
            }
        }
    
        // Restante do seu código...
    
    const mensagem = "Pedido criado com sucesso!";
    const redirectToPage = `/produtos_criarRequisicao.php`;
    showAlert(mensagem, redirectToPage);
    
});
</script>';
        } else {
            echo '<script>alert("Erro ao inserir dados: ' . $stmt->error . '");</script>';
        }

        $stmt->close();
        $stmt2->close();
    } else {
        echo '<script>alert("Erro ao preparar a consulta SQL: ' . $mysqli->error . '");</script>';
    }
}
// Fechar a conexão
$mysqli->close();
?>




<!DOCTYPE html>
<html lang="pt-br" data-textdirection="ltr" class="loading">
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<?php include "head.php"; ?>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    <?php include "produtos_header.php"; ?>

    <div id="overlay" class="overlay">
        <div class="alert-box">
            <p id="alert-message"></p>
            <button id="alert-okay-btn" class="btn btn-success">OK</button>
        </div>
    </div>

    <style>
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9999;
        }

        /* Estilo para a caixa de alerta */
        .alert-box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        /* Estilo para o botão "OK" */
        #alert-okay-btn {
            margin-top: 10px;
            /*  width: 25%; */
        }
    </style>

    <?php include "rodapeProdutos.php"; ?>
</body>

</html>