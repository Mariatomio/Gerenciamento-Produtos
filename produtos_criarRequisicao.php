<?php session_start(); ?>

<?php
$link = mysqli_connect('localhost', 'root', 'breitkopf', 'testes');

// Verifica a conexão
if (!$link) {
    die('Erro ao conectar ao servidor MySQL: ' . mysqli_connect_error());
}
mysqli_set_charset($link, "utf8mb4");
$sql = "SELECT * FROM categoria ORDER BY nomeCat ASC";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$tipoCategorias = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);


$sqlProduto = "SELECT * FROM produto ORDER BY nome ASC";
$stmtItem = mysqli_prepare($link, $sqlProduto);
mysqli_stmt_execute($stmtItem);
$resultProduto = mysqli_stmt_get_result($stmtItem);
$produtos = mysqli_fetch_all($resultProduto, MYSQLI_ASSOC);
mysqli_stmt_close($stmtItem);

mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="ckeditor/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<?php include "head.php"; ?>
<?php include "config.php"; ?>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    <?php include "produtos_header.php"; ?>

    <div id="wrapper">
        <div class="content-page ">
            <div class="content ">
                <div class="container-fluid mt-5">
                    <center>
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    Requisição </div>
                            </div>
                        </div>
                    </center>
                    <!-- end page title -->
                    <div class="row justify-content-md-center">
                        <div class="col-11">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row justify-content-md-center mb-5">
                                        <div class="col-11">
                                            <div class="card">
                                                <div class="card-body">

                                                    <script>
                                                        function updatePreco() {
                                                            const select = document.getElementById('item');
                                                            const precoInput = document.getElementById('preco');
                                                            const selectedOption = select.options[select.selectedIndex];
                                                            const preco = selectedOption.getAttribute('data-preco');
                                                            precoInput.value = preco;
                                                        }
                                                    </script>

                                                    <form action="processarProdutosRequisicao.php" method="post">
                                                        <div class="row justify-content-center">
                                                            <input type="hidden" id="preco" name="preco" value="">
                                                            <div class="col-lg-6">
                                                                <label for="item" class="form-label">Item<font color="red">*</font></label>
                                                                <select name="item" id="item" class="form-select" style="height: 43.28px;" onchange="updatePreco()">
                                                                    <option value="">Selecione</option>
                                                                    <?php
                                                                    foreach ($produtos as $produto) {
                                                                        echo '<option value="' . $produto["sku"] . '" data-preco="' . $produto["preco"] . '">' . $produto["nome"] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label for="qnt" class="form-label" required>Quantidade<font color="red">*</font></label>
                                                                <input type="text" class="form-control" name="qnt" id="qnt" placeholder="Informe a quantidade desejada">
                                                            </div>

                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-12">
                                                                <button type="submit" style="margin-top: 3%; width: 100px;" class="btn btn-primary" id="enviarBotao">Enviar</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="overlay" class="overlay">
                                    <div class="alert-box">
                                        <p id="alert-message"></p>
                                        <button class="btn- btn-success" id="alert-okay-btn">OK</button>
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
                                    }

                                    /* Estilo para o botão "OK" */
                                    #alert-okay-btn {
                                        margin-top: 10px;
                                        /*      width: 25%; */
                                    }
                                </style>
                                <!-- end row-->
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div><!-- end col -->
                </div>
                <?php include "rodapeProdutos.php"; ?>
            </div>
        </div>
    </div>



    <script src="meuperfil.js"></script>
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

<?php if (!isset($_SESSION['nome']) && !isset($_SESSION['cpf'])) {
} ?>