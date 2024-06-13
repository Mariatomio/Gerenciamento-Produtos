<?php session_start(); ?>

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
                                    categoria </div>
                            </div>
                        </div>
                    </center>
                    <!-- end page title -->
                    <div class="row justify-content-md-center">
                        <div class="col-11">
                            <div class="card">
                                <div class="card-body">
                                    <form action="processarCadastrarCategoria.php" method="post">
                                        <div class="row justify-content-end align-items-end">
                                            <div class="col-lg-10">
                                                <label for="simpleinput" class="form-label">Categoria</label>
                                                <input type="text" id="nome_Categoria" name="nomeCategoria" class="form-control" placeholder="Nome da categoria" required>
                                            </div>

                                            <div class="col-lg-2">
                                                <button type="submit" style="margin-top: 3%; width: 100px;" class="btn btn-primary" id="enviarBotao">Enviar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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

    <script>
        CKEDITOR.replace('editor');
        CKEDITOR.replace('editorContabil');
        CKEDITOR.replace('mytextarea1');
    </script>

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