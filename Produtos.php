<?php


// Conecta ao banco de dados
$link = mysqli_connect('localhost', 'root', 'breitkopf', 'testes');

// Verifica a conexão
if (!$link) {
    die('Erro ao conectar ao servidor MySQL: ' . mysqli_connect_error());
}
mysqli_set_charset($link, "utf8mb4");

/* $idTicket = $_SESSION["matricula"]; */

// Consulta SQL para obter a lista de departamentos
$sqltipo_item = "SELECT * FROM produto ORDER BY id DESC";
$stmttipo_item = mysqli_prepare($link, $sqltipo_item);
mysqli_stmt_execute($stmttipo_item);
$resulttipo_item = mysqli_stmt_get_result($stmttipo_item);
$hdztipo_item = mysqli_fetch_all($resulttipo_item, MYSQLI_ASSOC);
mysqli_stmt_close($stmttipo_item);


// Consulta SQL para obter a lista de departamentos
/* $sqltipo_Fornecedor = "SELECT * FROM fornecedor ORDER BY nome_fornecedor ASC";
$stmttipo_Fornecedor = mysqli_prepare($link, $sqltipo_Fornecedor);
mysqli_stmt_execute($stmttipo_Fornecedor);
$resulttipo_Fornecedor = mysqli_stmt_get_result($stmttipo_Fornecedor);
$hdztipo_Fornecedor = mysqli_fetch_all($resulttipo_Fornecedor, MYSQLI_ASSOC);
mysqli_stmt_close($stmttipo_Fornecedor); */
?>

<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />


<?php include "head.php"; ?>
<?php include "config.php"; ?>

<body data-open="click" data-menu="vertical-menu" class="fixed-navbar">
<?php include "produtos_header.php"; ?>
    <div id="wrapper">
        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">



                    <style>
                        .card-header {
                            padding: 10px;
                            cursor: pointer;
                            background-color: #FFFFFF;
                            border-top-left-radius: 6px !important;
                            border-top-right-radius: 6px !important;
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

                        #pesquisar {
                            display: flex;
                            align-items: center;
                            justify-content: flex-end;
                        }

                        /* -------------------------------------------------------------- */
                        #botoesPeC {
                            display: flex;
                            align-items: center;
                            justify-content: space-evenly;
                            flex-wrap: wrap;
                        }

                        #centralizar {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            height: 85vh !important;
                        }

                        #cardBody {
                            padding: 40px 80px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            flex-direction: column;
                            flex-wrap: wrap;
                            width: 100%;
                            margin-bottom: 1%;
                            background-color: #FFFFFF;
                            /* box-shadow: offset-x offset-y blur-radius spread-radius color; */
                            box-shadow: 12px 12px 10px -5px rgba(0, 0, 0, 0.2);
                        }

                        #produtosPrincipais {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            height: 300px;
                            justify-content: space-around;
                        }

                        .botoesOpcao {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            width: 100%;
                            max-width: 230px;
                        }

                        .list {
                            width: 180px;
                        }

                        #qualProduto {
                            width: 100%;
                        }

                        .botoesPeC {
                            width: 180px;
                            margin-bottom: 8%;
                        }

                        @media (max-width: 418px) {
                            #botoesPeC {
                                flex-direction: column;
                                align-items: center;
                            }
                        }
                        @media (max-width: 398px) {
                            #cardBody {
                              padding: 10px 20px;
                            }
                        }

                    </style>

                    <div class="row" id="centralizar">
                        <div class="col-lg-8 col-md-9 col-xs-12">
                            <div class="card" style="width: 100%;">
                                <div class="card-body" id="cardBody">
                                    <div id="qualProduto">
                                        <h1 style="text-align: center;">Escolha uma opção:</h1>
                                        <div id="botoesPeC">
                                            <div><button class="btn btn-primary botoesPeC" id="produto">Produtos</button></div>
                                            <div><button class="btn btn-primary botoesPeC" id="categoria">Categorias</button></div>
                                        </div>
                                    </div>

                                    <div id="produtosPrincipais" style="display: none;">
                                        <h2 style="text-align: center;">Desejas realizar qual operação:</h2>
                                        <div class="botoesOpcao"><a href="/produto_incluir.php"><button class="btn btn-success list">1 - Incluir produtos</button></a></div>
                                        <div class="botoesOpcao"><a href="/produto_alterar.php"><button class="btn btn-success list">2 - Alterar produtos</button></a></div>
                                        <div class="botoesOpcao"><a href="/produto_excluir.php"><button class="btn btn-success list">3 - Excluir produtos</button></a></div>
                                        <div class="botoesOpcao"><a href="/produto_listar.php"><button class="btn btn-success list">4 - Listar produtos</button></a></div>
                                    </div>

                                    <script>
                                        const botoesPeC = document.querySelectorAll(".botoesPeC");
                                        const qualProduto = document.getElementById("qualProduto");
                                        const produtosPrincipais = document.getElementById("produtosPrincipais");

                                        botoesPeC.forEach(botao => {
                                            botao.addEventListener("click", (event) => {
                                                event.preventDefault();
                                                qualProduto.style.display = 'none';
                                                produtosPrincipais.style.display = 'flex';
                                            })
                                        })
                                    </script>




                                    <section style="display: none;">
                                        <div align="right" style="padding: 20px;" id="pesquisar">
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
                                                    margin-right: 8px;
                                                }
                                            </style>
                                            <input type="text" id="searchInput" placeholder="Pesquisar...">
                                        </div>

                                        <h4 class="header-title mb-4">Gerenciar Fornecedores</h4>
                                        <div class="table-responsive">
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
                                            <table class="table table-hover table-bordered text-inputs-searching" data-lang="pt" id="tickets-table">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 2%">Id</th>
                                                        <th style="width: 50%">Nome</th>
                                                        <th style="width: 38%">Valor</th>
                                                        <th style="width: 10%">Ação</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table1">



                                                    <?php

                                                    $link = mysqli_connect('localhost', 'root', 'breitkopf');

                                                    // Verifica a conexão
                                                    if (!$link) {
                                                        die('Erro ao conectar ao servidor MySQL: ' . mysqli_connect_error());
                                                    }

                                                    // Seleciona o Banco de dados através da conexão acima
                                                    $conexao = mysqli_select_db($link, 'portal2');
                                                    if (!$conexao) {
                                                        die('Erro ao selecionar o banco de dados: ' . mysqli_error($link));
                                                    }
                                                    mysqli_set_charset($link, "utf8mb4");
                                                    $sql = "SELECT * FROM itens ORDER BY nome_item ASC";


                                                    $consulta = mysqli_query($link, $sql);

                                                    if (!$consulta) {
                                                        die('Erro na consulta: ' . mysqli_error($link));
                                                    }

                                                    while ($registro = mysqli_fetch_assoc($consulta)) {
                                                        echo '<tr>';
                                                        echo '<td style="width: 2%">' . $registro["id_item"] . '</td>';
                                                        echo '<td style="width: 50%">' . $registro["nome_item"] . '</td>';
                                                        echo '<td style="width: 38%">' . $registro["valor"] . '</td>';
                                                        echo '<td style="width: 10%"><a><button type="button" class="btn btn-primary waves-effect waves-light open-modal-btn" data-modal-id="myModal' . $registro["id_item"] . '" data-bs-target="#myModal2_' . $registro["id_item"] . '" data-bs-toggle="modal"><i class="fe-edit"></i></button></a>';
                                                        echo '<form method="post" action="excluir_item.php?id_item=' . $registro["id_item"] . '" style="display:inline;">';
                                                        echo '<input type="hidden" name="matricula" value="' . $registro["id_fornecedor"] . '">';
                                                        echo '<button type="submit" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir este usuário?\')"><i class="fe-trash-2 text-Secondary"></i></button>';
                                                        echo '</form></td>';
                                                        echo '</tr>';


                                                        echo ' <div id="myModal' . $registro["id_item"] . '" class="modal" tabindex="-1" role="dialog" aria-hidden="true">';
                                                        echo ' <div class="modal-content" style="display: flex;  justify-content: flex-start; align-items: center; flex-direction: column;">';
                                                        echo ' <div class="modal-header bg-light" style="width: 100%;">';
                                                        echo ' <span class="close" data-delete-id="closeModalBtn' . $registro["id_item"] . '" id="closeModalBtn' . $registro["id_item"] . '">&times;</span>';
                                                        echo ' <h4 class="modal-title" id="myCenterModalLabel">Editar item';
                                                        echo ' </h4>';
                                                        echo ' </div>';
                                                        echo ' <div class="row justify-content-center" style="padding: 0; width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">';
                                                        echo ' <div class="cardTI" id="CardTI">';
                                                        echo ' <div class="card">';
                                                        echo ' <div class="card-body" style="padding: 40px;">';
                                                        echo '<form action="alterarItem.php?id_item=' . $registro["id_item"] . '" method="post">';
                                                        echo '<div class="row justify-content-center">';
                                                        echo '<div class="col-lg-10">';

                                                        echo '<label for="simpleinput" class="form-label">Item</label>';
                                                        echo '<input type="text" id="nome_item" name="nome_item" class="form-control" placeholder="Descrição" value="' . $registro["nome_item"] . '" required>';

                                                        echo ' </div>';

                                                        echo '<div class="col-lg-2">';

                                                        echo '<label for="simpleinput" class="form-label">Valor</label>';
                                                        echo '<input onkeyup="monetario(this);" type="text" id="valor" class="form-control" name="valor" placeholder="R$" value="' . $registro["valor"] . '" required>';

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

                                        </div>
                                    </section>


                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- O Modal -->
                    <div id="myModal" class="modal">
                        <!-- Conteúdo do modal -->
                        <div class="modal-content">
                            <div class="modal-header bg-light">
                                <span class="close" id="closeModalBtn">&times;</span>
                                <h4 class="modal-title" id="myCenterModalLabel">Adicionar Usuarios
                                </h4>
                            </div>

                            <div class="modal-body p-4">
                                <form action="" id="formulario" method="post">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8">
                                            <form>
                                                <label for="simpleinput" class="form-label">Nome
                                                    Completo</label>
                                                <input type="text" id="nome" class="form-control" required>
                                            </form>
                                        </div>
                                        <div class="col-lg-4">
                                            <form>
                                                <label for="simpleinput" class="form-label">CPF</label>
                                                <input oninput="mascaraCPF(this)" type="text" id="cpf" class="form-control" required placeholder="000.000.000-00">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-5">
                                            <form>
                                                <label for="simpleinput" class="form-label">Cargo</label>
                                                <select type="text" id="cargo" class="form-control" required>
                                                    <option value="1">Selecionar Cargo</option>
                                                </select>
                                            </form>
                                        </div>
                                        <div class="col-lg-5">
                                            <form>
                                                <label for="simpleinput" class="form-label">Departamento</label>
                                                <select type="text" id="departamento" class="form-control" required>
                                                    <option value="43">Selecionar Departamento</option>
                                                </select>
                                            </form>
                                        </div>
                                        <div class="col-lg-2 ">
                                            <form>
                                                <label for="simpleinput" class="form-label">Matrícula</label>
                                                <input type="number" id="matricula" class="form-control" required placeholder="0000">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-5">
                                            <form>
                                                <label for="simpleinput" class="form-label">Filial</label>
                                                <select name="filiais" id="filiais" class="form-control" required>
                                                    <option value="Selecione">Selecionar Filial</option>
                                                </select>
                                            </form>
                                        </div>
                                        <div class="col-lg-5">
                                            <form>
                                                <label for="simpleinput" class="form-label">Perfil</label>
                                                <select name="perfil" id="perfil" class="form-control" required>
                                                    <option value="1016">Selecionar Perfil</option>
                                                </select>
                                            </form>
                                        </div>
                                        <div class="col-lg-2">
                                            <form>
                                                <label for="simpleinput" class="form-label">Data
                                                    Admissão</label>
                                                <input type="date" id="admissao" class="form-control">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8">
                                            <form>
                                                <label for="simpleinput" class="form-label">E-mail
                                                    Empresarial</label>
                                                <input type="email" id="email" class="form-control" aria-describedby="emailHelp">
                                            </form>
                                        </div>

                                        <div class="col-lg-4">
                                            <form>
                                                <label for="simpleinput" class="form-label">Data
                                                    Nascimento</label>
                                                <input type="date" id="nascimento" class="form-control">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8">
                                            <form>
                                                <label for="simpleinput" class="form-label">E-mail
                                                    Pessoal</label>
                                                <input type="email" id="email_pessoal" class="form-control" aria-describedby="emailHelp">
                                            </form>
                                        </div>
                                        <div class="col-lg-4">
                                            <form>
                                                <label for="simpleinput" class="form-label">Telefone</label>
                                                <input oninput="mascaraTelefone(this)" type="text" id="telefone" class="form-control" placeholder="00 00000-0000">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-5">
                                            <form>
                                                <label for="simpleinput" class="form-label">Estado</label>
                                                <select class="form-control" id="estado">
                                                    <option value="">Selecionar Estado</option>
                                                    <option value="Acre">Acre</option>
                                                    <option value="Alagoas">Alagoas</option>
                                                    <option value="Amapá">Amapá</option>
                                                    <option value="Amazonas">Amazonas</option>
                                                    <option value="Bahia">Bahia</option>
                                                    <option value="Ceará">Ceará</option>
                                                    <option value="Distrito Federal">Distrito Federal
                                                    </option>
                                                    <option value="Espírito Santo">Espírito Santo</option>
                                                    <option value="Goiás">Goiás</option>
                                                    <option value="Maranhão">Maranhão</option>
                                                    <option value="Mato Grosso">Mato Grosso</option>
                                                    <option value="Mato Grosso do Sul">Mato Grosso do Sul
                                                    </option>
                                                    <option value="Minas Gerais">Minas Gerais</option>
                                                    <option value="Pará">Pará</option>
                                                    <option value="Paraíba">Paraíba</option>
                                                    <option value="Paraná">Paraná</option>
                                                    <option value="Pernambuco">Pernambuco</option>
                                                    <option value="Piauí">Piauí</option>
                                                    <option value="Rio de Janeiro">Rio de Janeiro</option>
                                                    <option value="Rio Grande do Norte">Rio Grande do Norte
                                                    </option>
                                                    <option value="Rio Grande do Sul">Rio Grande do Sul
                                                    </option>
                                                    <option value="Rondônia">Rondônia</option>
                                                    <option value="Roraima">Roraima</option>
                                                    <option value="Santa Catarina">Santa Catarina</option>
                                                    <option value="São Paulo">São Paulo</option>
                                                    <option value="Sergipe">Sergipe</option>
                                                    <option value="Tocantins">Tocantins</option>
                                                    <option value="Estrangeiro">Estrangeiro</option>
                                                </select>
                                            </form>
                                        </div>
                                        <div class="col-lg-5">
                                            <form>
                                                <label for="simpleinput" class="form-label">Cidade</label>
                                                <input type="text" name="cidade" id="cidade" class="form-control"></input>
                                            </form>
                                        </div>
                                        <div class="col-lg-2">
                                            <form>
                                                <label for="simpleinput" class="form-label">CEP</label>
                                                <input oninput="mascaraCEP(this)" type="text" id="cep" class="form-control" placeholder="00000-000">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-10">
                                            <form>
                                                <label for="simpleinput" class="form-label">Endereço</label>
                                                <input type="text" id="endereco" class="form-control">
                                            </form>
                                        </div>

                                        <div class="col-lg-2">
                                            <form>
                                                <label for="simpleinput" class="form-label">Número</label>
                                                <input type="text" min="1" id="numero" class="form-control">
                                            </form>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-auto" style="padding-right: 0;">
                                        <div class="text-lg-end my-1 my-lg-0">
                                            <a href="/lista_usuarios.html#" type="button" class="btn btn-danger waves-effect waves-light me-1"></i>Cancelar</a>


                                            <button class="btn btn-primary" type="submit" onclick="addNewUser()">Salvar</button>


                                        </div>
                                    </div><!-- end col-->
                                </form>
                            </div>
                            <!-- Elemento de sobreposição para o alerta -->
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
                                    /* width: 20%; */

                                }
                            </style>

                        </div>
                    </div>

                    <!-- end row -->
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

                        var openModalBtn = document.getElementById('openModalBtn');
                        var openModalBtnEdited = document.getElementById('openModalBtnEdited'); /* + id_circular */
                        var modal = document.getElementById('myModal');

                        // Ação para abrir o modal
                        openModalBtn.onclick = function() {
                            modal.style.display = 'block';
                        }

                        // Ação para fechar o modal
                        closeModalBtn.onclick = function() {
                            modal.style.display = 'none';
                        }

                        // Fechar o modal se clicar fora dele
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = 'none';
                            }
                        }
                    </script>

                </div> <!-- container -->
            </div> <!-- content -->
            <?php include "rodapeProdutos.php"; ?>
        </div>

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