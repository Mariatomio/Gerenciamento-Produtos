<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<html lang="en" data-textdirection="ltr" class="loading">
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />


<?php include "head.php"; ?>
<?php include "config.php"; ?>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns fixed-navbar">

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
                                                width: 180px;
                                            }
                                        </style>
                                        <div style="display: flex; align-items: flex-end; justify-content: flex-end; width: 100%;">
                                            <a href="produtos_testePdf.php"><button type="button" id="openModalBtn" class="btn btn-sm btn-primary waves-effect waves-light" style="padding: 6.3px 37.8px 6.3px 12.6px; height: 30px; background-color: #0079BC !important;">
                                                   Relatório
                                                </button></a>
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
                                    <h4 class="header-title mb-4">Estoque</h4>
                                    <div class="table-responsive">
                                        <style>
                                            #tickets-table {
                                                padding: 20px;
                                            }
                                        </style>

                                        <table class="table table-striped table-bordered text-inputs-searching" data-lang="pt" id="tickets-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%">Id</th>
                                                    <th style="width: 30%">Código Produto</th>
                                                    <th style="width: 30%">Quantidade</th>
                                                    <th style="width: 30%">Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table1">

                                                <?php
                                                $link = mysqli_connect('localhost', 'root', 'breitkopf', 'testes');

                                                if (!$link) {
                                                    die('Erro ao conectar ao servidor MySQL: ' . mysqli_connect_error());
                                                }

                                                mysqli_set_charset($link, "utf8mb4");

                                                // Construct the SQL query based on the filters
                                                $sql = "SELECT * FROM estoque ORDER BY id ASC";

                                                $consulta = mysqli_query($link, $sql);

                                                if (!$consulta) {
                                                    die('Erro na consulta: ' . mysqli_error($link));
                                                }

                                                while ($registro = mysqli_fetch_assoc($consulta)) {/* ?id_hdz_tickets=' . $registro["id_hdz_tickets"] . '\ */
                                                    echo '<tr>';
                                                    echo '<td style="width: 10%">' . $registro["id"] . '</td>';
                                                    echo '<td style="width: 30%">' . $registro["sku"] . '</td>';
                                                    echo '<td style="width: 30%">' . $registro["quantidade"] . '</td>';
                                                    echo '<td style="padding:5px; display:flex; justify-content:center; gap:5px">
                                                    <form class="counter-container" action="produtos_alterarEstoque.php" method="post" ><div class="counter-container">
                                                    <input type="hidden" name="id" value="' . $registro["id"] . '">
                                                    <div class="btn btn-success" id="decrement">-</div>
                                                    <input type="text" name="quantidade" class="form-control" id="counter" value="' . $registro["quantidade"] . '">
                                                    <div class="btn btn-success" id="increment">+</div>
                                                </div><button type="submit" class="btn btn-success waves-effect waves-light"><i class="fe-check"></i></button></form>';
                                                    echo '</tr>';
                                                }

                                                // Fecha a conexão
                                                mysqli_close($link);
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php include "rodapeProdutos.php"; ?>

    <style>
        #decrement,
        #increment {
            height: 40.5px;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        #counter {
            height: 40.5px;
            margin: 0;
            width: 50%;
            border-radius: 0;
        }

        .counter-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80%;
            margin-right: 3%;
        }

        button {
            padding: 10px 20px;
            font-size: 20px;
            cursor: pointer;
        }

        input[type="text"] {
            width: 50px;
            text-align: center;
            font-size: 20px;
            margin: 0 10px;
            padding: 5px;
        }

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

        document.addEventListener('DOMContentLoaded', (event) => {
            const counterInput = document.getElementById('counter');
            const incrementButton = document.getElementById('increment');
            const decrementButton = document.getElementById('decrement');

            incrementButton.addEventListener('click', () => {
                let currentValue = parseInt(counterInput.value);
                counterInput.value = currentValue + 1;
            });

            decrementButton.addEventListener('click', () => {
                let currentValue = parseInt(counterInput.value);
                counterInput.value = currentValue - 1;
            });

            counterInput.addEventListener('input', () => {
                // Allow only numeric input
                let value = counterInput.value;
                value = value.replace(/[^0-9]/g, '');
                counterInput.value = value;
            });
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