<?php

$mysqli = new mysqli('localhost', 'root', 'breitkopf', 'testes');

// Verificar a conexão
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}
echo"aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
$sku = $_POST['sku'];

if ($sku === null) {
    die("SKU não fornecido.");
}

echo "<script>alert('SKU recebido: " . $sku . "')</script>";

// Usar prepared statements para prevenir SQL injection
$sql2 = "DELETE FROM estoque WHERE sku = ?";
$sql = "DELETE FROM produto WHERE sku = ?";

$stmt2 = $mysqli->prepare($sql2);
$stmt1 = $mysqli->prepare($sql);

if ($stmt2 === false || $stmt1 === false) {
    die("Erro ao preparar a declaração SQL: " . $mysqli->error);
}

$stmt2->bind_param('s', $sku);
$stmt1->bind_param('s', $sku);

$execute1 = $stmt2->execute();
$execute2 = $stmt1->execute();

if ($execute1 && $execute2) {
    echo "Registro excluído com sucesso!";
} else {
    echo "Erro na exclusão de registros: " . $stmt2->error . " " . $stmt1->error;
}

$stmt2->close();
$stmt1->close();
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="pt-br" data-textdirection="ltr" class="loading">
<title>Gerenciamento de Produtos</title>
<script src="ckeditor/ckeditor.js"></script>
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="assets/css/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Adicione essas linhas ao cabeçalho do seu documento HTML -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<?php include "head.php"; ?>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    <?php include "produtos_header.php" ?>

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

        #alert-okay-btn {
            margin-top: 10px;
        }
    </style>

    <?php include "rodapeProdutos.php" ?>
</body>

</html>