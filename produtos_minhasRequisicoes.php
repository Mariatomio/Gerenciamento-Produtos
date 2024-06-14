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

<?php include "head.php"; ?>
<?php include "config.php"; ?>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    <!-- - var navbarShadow = true-->
    <!-- navbar-fixed-top-->
    <?php include "produtos_header.php"; ?>

    <div id="wrapper">
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">

                    <script>
                        function mostrarTodosTickets() {
                            window.location.href = 'https://portal.breitkopf.com.br/minhasRequisicoes.php';
                        }
                    </script>

                    <style>
                        .card-header {
                            padding: 10px;
                            cursor: pointer;
                            background-color: #FFFFFF;
                            border-top-left-radius: 6px !important;
                            border-top-right-radius: 6px !important;
                        }

                        #cardBody {
                            display: block;
                            padding: 10px;
                            margin-bottom: 1%;
                            background-color: #FFFFFF;
                            border-bottom-left-radius: 6px !important;
                            border-bottom-right-radius: 6px !important;
                            transition: display 0.3s ease-in-out !important;
                        }


                        @media (max-width: 768px) {
                            #deixaroff {
                                flex-direction: column;
                                align-items: center;

                            }
                        }

                        #SelecionarPrioridade,
                        #SelecionarStatus,
                        #SelecionarFilial {
                            width: 210px;
                        }
                    </style>


                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body" style="padding: 20px;">
                                    <div align="right">
                                        <style>
                                            #tickets-table_filter {
                                                display: none !important;
                                                visibility: hidden !important;
                                            }

                                            #searchInput {
                                                outline: none;
                                                border: 1px solid rgb(184, 184, 184);
                                                border-radius: 5px;
                                                height: 30px;
                                            }
                                        </style>
                                        <div style="display: flex; align-items: flex-end; justify-content: flex-end;">
                                            <input type="text" id="searchInput" placeholder="Pesquisar...">
                                        </div>
                                    </div>

                                    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                                    <script>
                                        $(document).ready(function() {
                                            $('#searchInput').on('input', function() {
                                                var searchTerm = $(this).val().toLowerCase();
                                                filterTable(searchTerm);
                                            });

                                            function filterTable(searchTerm) {
                                                $('#table1 tr').each(function() {
                                                    var currentRowText = $(this).text().toLowerCase();
                                                    var isVisible = currentRowText.includes(searchTerm);
                                                    $(this).toggleClass('d-none', !isVisible);
                                                });
                                            }
                                        });
                                    </script>
                                    <h4 class="header-title mb-4">Gerenciar Requisições</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered text-inputs-searching" data-lang="pt" id="tickets-table">
                                            <thead>
                                                <tr style="width: 100%;">
                                                    <th style="width: 80%">Id do produto</th>
                                                    <th style="width: 20%">Quantidade</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table1">
                                                <?php
                                                $link = mysqli_connect('localhost', 'root', 'breitkopf', 'testes');

                                                // Verifica a conexão com o banco de dados
                                                if (!$link) {
                                                    die('Erro na conexão: ' . mysqli_connect_error());
                                                }

                                                // Verifica se a sessão está ativa
                                                if (!isset($_SESSION["cpf"])) {
                                                    die('Usuário não está logado.');
                                                }

                                                $cpfUsuario = $_SESSION["cpf"];

                                                // Evita injeção SQL
                                                $cpfUsuario = mysqli_real_escape_string($link, $cpfUsuario);

                                                // Constrói a consulta SQL baseada nos filtros
                                                $sql = "SELECT * FROM requisicao WHERE user = '$cpfUsuario' ORDER BY user ASC";

                                                // Executa a consulta
                                                $consulta = mysqli_query($link, $sql);

                                                // Verifica se a consulta foi executada com sucesso
                                                if (!$consulta) {
                                                    die('Erro na consulta: ' . mysqli_error($link));
                                                }

                                                // Verifica se há registros retornados pela consulta
                                                if (mysqli_num_rows($consulta) == 0) {
                                                    echo 'Nenhum registro encontrado.';
                                                } else {
                                                    // Itera sobre os registros retornados
                                                    while ($registro = mysqli_fetch_assoc($consulta)) {
                                                        echo '<tr style="width: 100%">';
                                                        echo '<td style="width: 80%">' . htmlspecialchars($registro["sku"]) . '</td>';
                                                        echo '<td style="width: 20%">' . htmlspecialchars($registro["quantidade"]) . '</td>';
                                                             echo '</tr>';
                                                    }   
                                                }
                                                // Fecha a conexão com o banco de dados
                                                mysqli_close($link);

                                                ?>
                                            </tbody>
                                        </table>
                                        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> <!-- Certifique-se de incluir o jQuery -->

                                        <script>
                                            function deleteRow(sku) {
                                                console.log("deleteRow chamado com sku: " + sku);
                                                var confirmation = confirm("Tem certeza que deseja excluir?");

                                                if (confirmation) {
                                                    $.ajax({
                                                        type: "POST",
                                                        url: `excluir_ProdutoItem.php?sku=${sku}`, // Substitua com o nome do seu script de exclusão
                                                        data: {
                                                            sku: sku
                                                        },
                                                        success: function(response) {
                                                            window.location.reload();
                                                            // Atualize a tabela ou faça qualquer outra ação necessária após a exclusão
                                                            console.log(response);
                                                        },
                                                        error: function(error) {
                                                            console.error("Erro na exclusão: " + error);
                                                        }
                                                    });
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "rodapeProdutos.php"; ?>

    <style>
        /* Estilização básica do modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            height: auto;
            width: 80%;
            background-color: #fefefe;
            /*  padding: 20px; */
            min-height: 200px;
            /* ou ajuste conforme necessário */
            max-height: 95vh;
            /* ou ajuste conforme necessário */
            overflow-y: auto;
        }


        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
    </style>

    <script>
        var openModalBtns = document.querySelectorAll('.open-modal-btn');
        var openModalBtns2 = document.querySelectorAll('.open-modal-btn2');
        console.log(openModalBtns);

        var close = document.querySelectorAll('.close');
        console.log(close);

        // Attach a click event listener to each button
        openModalBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                /*         alert("cLICOU") */
                var modalId = btn.getAttribute('data-modal-id');
                var modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'block';

                }
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = 'none';
                    }
                }
            })
        })

        close.forEach(btn2 => {
            btn2.addEventListener('click', function() {
                window.location.reload();
            })
        })


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