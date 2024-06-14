<?php
session_start();

$mysqli = new mysqli('localhost', 'root', 'breitkopf', 'testes');

// Verificar a conexão
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}
$id = $_GET["id"];
$sku = $_POST["skuValor"];
$nome = isset($_POST["nomeItem"]) && $_POST["nomeItem"] !== '' ? $_POST["nomeItem"] : null;
$categoria = isset($_POST["tipo_categoriaSelect"]) && $_POST["tipo_categoriaSelect"] !== '' ? $_POST["tipo_categoriaSelect"] : null;
$descricao = isset($_POST["descricao"]) && $_POST["descricao"] !== '' ? $_POST["descricao"] : null;
$preco = isset($_POST["preco"]) && $_POST["preco"] !== '' ? $_POST["preco"] : null;
$dataVencimento = isset($_POST["dataValidade"]) && $_POST["dataValidade"] !== '' ? $_POST["dataValidade"] : null;
$quantidade = isset($_POST["quantidade"]) && $_POST["quantidade"] !== '' ? $_POST["quantidade"] : null;

// Atualiza a tabela produto
$sql2 = "UPDATE produto SET ";
$params2 = array();
$types2 = '';

if ($nome !== null) {
    $sql2 .= "nome = ?";
    $params2[] = &$nome;
    $types2 .= 's';
}

if ($categoria !== null) {
    if (!empty($params2)) $sql2 .= ", ";
    $sql2 .= "categoria = ?";
    $params2[] = &$categoria;
    $types2 .= 's';
}

if ($descricao !== null) {
    if (!empty($params2)) $sql2 .= ", ";
    $sql2 .= "descricao = ?";
    $params2[] = &$descricao;
    $types2 .= 's';
}

if ($preco !== null) {
    if (!empty($params2)) $sql2 .= ", ";
    $sql2 .= "preco = ?";
    $params2[] = &$preco;
    $types2 .= 's';
}

if ($dataVencimento !== null) {
    if (!empty($params2)) $sql2 .= ", ";
    $sql2 .= "dataVencimento = ?";
    $params2[] = &$dataVencimento;
    $types2 .= 's';
}

$sql2 .= " WHERE id = ?";
$params2[] = &$id;
$types2 .= 'i';

$stmt2 = mysqli_prepare($mysqli, $sql2);
if (!$stmt2) {
    die('Erro ao preparar a consulta SQL para produto: ' . mysqli_error($mysqli));
}

// Vincula os valores aos parâmetros da declaração
mysqli_stmt_bind_param($stmt2, $types2, ...$params2);

// Executar a consulta preparada para produto
if (!mysqli_stmt_execute($stmt2)) {
    die('Erro ao executar a consulta SQL para produto: ' . mysqli_stmt_error($stmt2));
}

// Atualiza a tabela estoque apenas se quantidade estiver definida
if ($quantidade !== null) {
    $sql = "UPDATE estoque SET quantidade = ? WHERE sku = ?";
    $stmt = mysqli_prepare($mysqli, $sql);
    if (!$stmt) {
        die('Erro ao preparar a consulta SQL para estoque: ' . mysqli_error($mysqli));
    }

    // Vincula os valores aos parâmetros da declaração
    mysqli_stmt_bind_param($stmt, 'ss', $quantidade, $sku);



    if (mysqli_stmt_execute($stmt)) {
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

const mensagem = "Produto atualizado";
 const redirectToPage = "/produtos_listaItens.php";
 showAlert(mensagem, redirectToPage);
 });
 </script>';
    } else {
        echo 'Erro ao executar a consulta SQL para estoque: ' . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}
// Fecha os statements
mysqli_stmt_close($stmt2);
mysqli_close($mysqli);

?>
<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">

<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<?php include "head.php"; ?>
<?php include "config.php"; ?>

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
            /*  width: 25%; */
        }
    </style>


    <?php include "rodapeProdutos.php"; ?>
    </script>
    <script src="vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="vendors/js/charts/raphael-min.js" type="text/javascript"></script>
    <script src="vendors/js/charts/morris.min.js" type="text/javascript"></script>
    <script src="vendors/js/extensions/unslider-min.js" type="text/javascript"></script>
    <script src="vendors/js/timeline/horizontal-timeline.js" type="text/javascript"></script>
    <script src="js/core/app-menu.js" type="text/javascript"></script>
    <script src="js/core/app.js" type="text/javascript"></script>
    <script src="js/scripts/pages/dashboard-ecommerce.js" type="text/javascript"></script>
</body>

</html>