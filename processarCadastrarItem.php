<?php
session_start();

$mysqli = new mysqli('localhost', 'root', 'breitkopf', 'testes');

// Verificar a conexão
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

function gerarStringAleatoria($tamanho = 9)
{
    $caracteres = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&';
    $quantidadeCaracteres = strlen($caracteres);
    $stringAleatoria = '';

    for ($i = 0; $i < $tamanho; $i++) {
        $indiceAleatorio = mt_rand(0, $quantidadeCaracteres - 1);
        $stringAleatoria .= $caracteres[$indiceAleatorio];
    }

    return $stringAleatoria;
}

$nome = $_POST["nomeItem"];
$categoria = $_POST["tipo_categoriaSelect"];
$descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
$preco = $_POST["preco"];
$dataVencimento = isset($_POST["dataValidade"]) ? $_POST["dataValidade"] : "";
$quantidade = $_POST["quantidade"];
$sku = gerarStringAleatoria();

mysqli_set_charset($mysqli, "utf8mb4");

if (!empty($dataVencimento)) {
    $dataAtualTimestamp = time();
    $dataVencimentoTimestamp = strtotime($dataVencimento);

    if ($dataVencimentoTimestamp < $dataAtualTimestamp) {
        die("Erro: A data de vencimento não pode ser retroativa.");
    }
}

// Usar prepared statements para inserir dados no produto
$sql = "INSERT INTO produto (nome, categoria, descricao, preco, dataVencimento, sku) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar a declaração SQL: " . $mysqli->error);
}

$stmt->bind_param('sissss', $nome, $categoria, $descricao, $preco, $dataVencimento, $sku);

if ($stmt->execute()) {
    echo "Registro de produto inserido com sucesso!";
} else {
    echo "Erro na inserção de produto: " . $stmt->error;
}

$stmt->close();

// Usar prepared statements para inserir dados no estoque
$sql2 = "INSERT INTO estoque (sku, quantidade) VALUES (?, ?)";
$stmt2 = $mysqli->prepare($sql2);

if ($stmt2 === false) {
    die("Erro ao preparar a declaração SQL: " . $mysqli->error);
}

$stmt2->bind_param('si', $sku, $quantidade);

if ($stmt2->execute()) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
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
    
    const mensagem = "Produto criado com sucesso!";
    const redirectToPage = `/produtos_cadastrarItem.php`;
    showAlert(mensagem, redirectToPage);
    
});
</script>';
} else {
    echo "Erro na inserção de estoque: " . $stmt2->error;
    echo '<script>
 document.addEventListener("DOMContentLoaded", function() {
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
 const mensagem = "Erro ao criar produto, tente novamente!";
 const redirectToPage = `/produtos_cadastrarItem.php`;
 showAlert(mensagem, redirectToPage);
 
});
</script>';
}

$stmt2->close();

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