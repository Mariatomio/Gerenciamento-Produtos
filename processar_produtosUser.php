<?php
session_start(); // Inicia a sessão

// Conectar ao banco de dados (substitua as informações de conexão conforme necessário)
$mysqli = new mysqli('localhost', 'root', 'breitkopf', 'testes');

// Verificar a conexão
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);

    /* $nome = $_POST["nome"];
    $cpf = $_POST["cpf"]; */

    $_SESSION['nome'] = $nome;
    $_SESSION['cpf'] = $cpf;

    mysqli_set_charset($mysqli, "utf8mb4");
    $sql = "INSERT INTO usuario(nome, cpf) VALUES ('$nome', '$cpf')";

    if ($mysqli->query($sql) === TRUE) {
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
    
    const mensagem = "Dados enviados com sucesso!";
    const redirectToPage = `/produto_index.php`;
    showAlert(mensagem, redirectToPage);
    
});
</script>';
    } else {
        echo "Erro na inserção de registros: " . $mysqli->error;
    }
}
// Fechar a conexão
$mysqli->close();
?>




<!DOCTYPE html>
<html lang="pt-br" data-textdirection="ltr" class="loading">
<title>Gerenciador de Produdos | User</title>
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="ckeditor/ckeditor.js"></script>

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
        /* Estilo para o elemento de sobreposição */
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
        }
    </style>

    <?php include "rodapeProdutos.php"; ?>
</body>

</html>