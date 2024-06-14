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
                                    <h4 class="page-title">Cadastrar Produto</h4>
                                </div>
                            </div>
                        </div>
                    </center>
                    <!-- end page title -->
                    <div class="row justify-content-md-center mb-5">
                        <div class="col-11">
                            <div class="card">
                                <div class="card-body">
                                    <form action="processarCadastrarItem.php" method="post">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6">
                                                <label for="simpleinput" class="form-label">Nome do item<font color="red">*</font></label>
                                                <input type="text" id="nome_item" name="nomeItem" class="form-control" placeholder="Descrição" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="seletor" class="form-label" required>Categoria<font color="red">*</font></label>
                                                <select name="tipo_categoriaSelect" id="tipo_categoriaSelect" class="form-select" style="height: 43.28px;">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($tipoCategorias as $tipocategoria) {
                                                        echo '<option value="' . $tipocategoria["id"] . '">' . $tipocategoria["nomeCat"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="simpleinput" class="form-label">Descrição (Opcional)</label>
                                                <input type="text" id="descricao" name="descricao" class="form-control" placeholder="Descrição">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="simpleinput" class="form-label">Preço<font color="red">*</font></label>
                                                <input onkeyup="monetario(this);" type="text" id="Preco" class="form-control" name="preco" placeholder="R$" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="quantidade" class="form-label">Quantidade</label>
                                                <input type="text" class="form-control" name="quantidade" placeholder="Quantidade">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="simpleinput" class="form-label">Data do vencimento (Opcional)</label>
                                                <input type="date" class="form-control" id="dataValidade" name="dataValidade" >
                                                <!--   <input type="date" id="dataValidade" name="dataValidade" class="form-control"> -->
                                            </div>

                                            <!--  <div class="col-lg-6">
                                                 <label for="simpleinput" class="form-label">Foto do produto</label>
                                                 <input type="file" class="form-control" name="fotoProduto">
                                             </div> -->
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-lg-12">
                                                <button type="submit" style="margin-top: 3%; width: 100px;" class="btn btn-primary" id="enviarBotao">Enviar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Obter o elemento de input da data
                                        var inputDate = document.getElementById('dataValidade');

                                        // Obter a data atual e formatá-la como YYYY-MM-DD
                                        var today = new Date();
                                        var dd = String(today.getDate()).padStart(2, '0');
                                        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
                                        var yyyy = today.getFullYear();
                                        var minDate = yyyy + '-' + mm + '-' + dd;

                                        // Definir o atributo 'min' para o input de data
                                        inputDate.setAttribute('min', minDate);
                                    });
                                </script>

                                <!-- Elemento de sobreposição para o alerta -->
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

    <script type="text/javascript">
        function monetario(i) {
            var v = i.value.replace(/\D/g, '');
            v = (v / 100).toFixed(2) + '';
            v = v.replace(".", ",");
            v = v.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            i.value = "R$" + v;
        }
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

<?php if (!isset($_SESSION['nome']) && !isset($_SESSION['cpf'])) {
} ?>