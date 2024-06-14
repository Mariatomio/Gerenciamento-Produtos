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
                                            }
                                        </style>
                                        <div style="display: flex; align-items: flex-end; justify-content: flex-end;">
                                            <a href="produtos_cadastrarCategoria.php"></a><button type="button" class="btn btn-sm btn-primary waves-effect waves-light mr-2" style="padding: 6.3px 37.8px 6.3px 12.6px; height: 30px; background-color: #0079BC !important;">
                                                <i class="mdi mdi-plus-circle"></i> Nova categoria
                                            </button>
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
                                    <h4 class="header-title mb-4">Gerenciar Categorias</h4>
                                    <div class="table-responsive">
                                        <style>
                                            #tickets-table {
                                                padding: 20px;
                                            }
                                        </style>

                                        <table class="table table-striped table-bordered text-inputs-searching" data-lang="pt" id="tickets-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%">Id</th>
                                                    <th style="width: 65%">Nome da categoria</th>
                                                    <th style="width: 20%">Ação</th>
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
                                                $sql = "SELECT * FROM categoria ORDER BY nomeCat ASC";

                                                $consulta = mysqli_query($link, $sql);

                                                if (!$consulta) {
                                                    die('Erro na consulta: ' . mysqli_error($link));
                                                }

                                                while ($registro = mysqli_fetch_assoc($consulta)) {/* ?id_hdz_tickets=' . $registro["id_hdz_tickets"] . '\ */
                                                    echo '<tr>';
                                                    echo '<td style="width: 15%">' . $registro["id"] . '</td>';
                                                    echo '<td style="width: 85%">' . $registro["nomeCat"] . '</td>';
                                                    echo '<td style="display:flex; justify-content:center; gap:3px"><a><button type="button" class="btn btn-primary waves-effect waves-light open-modal-btn" data-modal-id="myModal' . $registro["id"] . '" data-bs-target="#myModal' . $registro["id"] . '" data-bs-toggle="modal"><i class="fe-edit"></i></button></a>';
                                                    echo '<button type="button" class="btn btn-danger" onclick="deleteRow(' . $registro["id"] . ')"><i class="fe-trash-2 text-Secondary"></i></button>';
                                                    echo '</tr>';

                                                    echo ' <div id="myModal' . $registro["id"] . '" class="modal" tabindex="-1" role="dialog" aria-hidden="true">';
                                                    echo ' <div class="modal-content" style="display: flex;  justify-content: flex-start; align-items: center; flex-direction: column;">';
                                                    echo ' <div class="modal-header bg-light" style="width: 100%;">';
                                                    echo ' <span class="close" data-delete-id="closeModalBtn' . $registro["id"] . '" id="closeModalBtn' . $registro["id"] . '">&times;</span>';
                                                    echo ' <h4 class="modal-title" id="myCenterModalLabel">Editar Categoria';
                                                    echo ' </h4>';
                                                    echo ' </div>';
                                                    echo ' <div class="row justify-content-center" style="padding: 0; width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">';
                                                    echo ' <div>';
                                                    echo ' <div class="card">';
                                                    echo ' <div class="card-body" style="padding: 40px;">';
                                                    echo '<form action="produto_alterarCategoriaItem.php?id=' . $registro["id"] . '" method="post">';
                                                    echo '<div class="row justify-content-center">';
                                                    echo '<div class="col-lg-12">';

                                                    echo '<label for="simpleinput" class="form-label">Categoria</label>';
                                                    echo '<input type="text" id="nomeCat" name="nomeCat" class="form-control" placeholder="Informe o nome da categoria" value="' . $registro["nomeCat"] . '" required>';
                                                    echo ' </div>';

                                                    echo '<div class="row justify-content-center">';
                                                    echo '<div class="col-lg-12" style="padding-left: 0;">';
                                                    echo '<button type="submit" style="margin-top: 3%; width: 100px;" class="btn btn-primary" id="enviarBotao">Atualizar</button>';
                                                    echo ' </div>';
                                                    echo ' </div>';
                                                    echo '</form>';
                                                    echo ' </div>';
                                                    echo ' </div>';
                                                    echo ' </div>';
                                                    echo ' </div>';
                                                    echo ' </div>';
                                                    echo ' </div>';
                                                }

                                                // Fecha a conexão
                                                mysqli_close($link);
                                                ?>
                                            </tbody>
                                        </table>
                                        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> <!-- Certifique-se de incluir o jQuery -->

                                        <script>
                                            function deleteRow(id) {
                                                var confirmation = confirm("Tem certeza que deseja excluir?");

                                                if (confirmation) {
                                                    $.ajax({
                                                        type: "POST",
                                                        url: `excluir_categoriaItem.php?id=${id}`, // Substitua com o nome do seu script de exclusão
                                                        data: {
                                                            id: id
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
                        </div><!-- end col -->
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