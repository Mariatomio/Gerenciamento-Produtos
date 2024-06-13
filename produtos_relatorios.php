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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php include "head.php"; ?>
<?php include "config.php"; ?>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    <?php include "produtos_header.php"; ?>

    <div id="wrapper">
        <div class="content-page ">
            <div class="content ">
                <div class="container-fluid mt-5" style="margin-bottom: 10%;">
                    <center>
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h2> Requisição</h2>
                                </div>
                            </div>
                        </div>
                    </center>

                    <div style="display: flex; flex-direction: column;">
                        <h3>Gráfico 10 itens mais comprados</h3>
                        <canvas id="chartItem"></canvas>
                    </div>
                    <center>
                    <div style="width: 100px !important; height: 100px !important;">
                        <?php
                        $mysqli = new mysqli('localhost', 'root', 'breitkopf', 'testes');

                        // Verificar a conexão
                        if ($mysqli->connect_error) {
                            die("Erro de conexão: " . $mysqli->connect_error);
                        }

                        $sql = "SELECT sku, SUM(quantidade) as total FROM controle GROUP BY sku ORDER BY total DESC LIMIT 10";
                        $result = $mysqli->query($sql);

                        if (!$result) {
                            die('Erro na consulta: ' . $mysqli->error);
                        }

                        $data = [];
                        while ($row = $result->fetch_assoc()) {
                            $data[] = $row;
                        }

                        $mysqli->close();
                        ?>

                        <script>
                            const data = <?php echo json_encode($data); ?>;
                            console.log(data);

                            // Criar labels para os itens
                            const labelsItens = data.map(item => item.sku);

                            // Extrair os valores totais para os itens
                            const dataQtdItem = data.map(item => item.total);

                            console.log(dataQtdItem);

                            // Configuração do gráfico
                            const ctxItem = document.getElementById('chartItem').getContext('2d');
                            const chartItem = new Chart(ctxItem, {
                                type: 'bar',
                                data: {
                                    labels: labelsItens,
                                    datasets: [{
                                        label: 'Top 10',
                                        data: dataQtdItem,
                                        backgroundColor: '#1c5383',
                                        borderColor: '#11436e',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                    </center>
                </div>
                <?php include "rodapeProdutos.php"; ?>
            </div>
        </div>
    </div>



    <script src="js/core/app-menu.js" type="text/javascript"></script>
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