<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Produtos</title>
    <html lang="en" data-textdirection="ltr" class="loading">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <style>
        #deixarColuna {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 80%;
        }


        #centralizar {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn {
            width: 110px;
        }
    </style>

    <?php include "head.php"; ?>
    <?php include "config.php"; ?>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns fixed-navbar">
    <?php include "produtos_header.php"; ?>

    <div id="wrapper mt-4">
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-5" id="centralizar">
                        <h2 style="text-align: center;">Bem vindo ao gerenciador de produtos</h2>

                        <?php if (!isset($_SESSION['nome']) && !isset($_SESSION['cpf'])) { ?>
                            <div id="deixarColuna">
                                <form action="processar_produtosUser.php" method="post" id="deixarColuna">
                                    <div class="row col-12">
                                        <div class="col-12">
                                            <div class="col-12"><label for="nome">Informe o seu nome:</label>
                                                <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome">
                                            </div class="col-12">
                                            <div><label for="cpf">Informe o seu cpf:</label>
                                                <input type="text" name="cpf" id="cpf" class="form-control" placeholder="xxx.xxx.xxx-xx">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="botao mt-4"><button type="submit" class="btn btn-primary">Enviar</button></div>
                                </form>
                            </div>
                        <?php } else {

                            $nome = $_SESSION['nome'];
                            echo '<p style="text-align: center;">Olá ' . $nome . ', no menu ao lado você encontrará seus produtos e requisições</p>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "rodapeProdutos.php"; ?>

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