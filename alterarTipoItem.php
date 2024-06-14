<?php

session_start(); // Inicia a session
include "functions.php"; // arquivo de funções.
session_checker();
?>


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

$id_tipo_item = $_GET["id_tipo_item"];
// Recupera os dados da requisição POST
$nome_tipo_item = $_POST['nome_tipo_item'];


// Prepara a consulta SQL usando um prepared statement
$sql = "UPDATE tipo_item SET nome_tipo_item = ? WHERE id_tipo_item = ?";

// Inicializa o statement
$stmt = mysqli_prepare($link, $sql);

// Verifica se a preparação da consulta foi bem-sucedida
if (!$stmt) {
    die('Erro ao preparar a consulta SQL: ' . mysqli_error($link));
}

// Vincula os valores aos parâmetros da declaração
mysqli_stmt_bind_param($stmt, 'si', $nome_tipo_item, $id_tipo_item);

// Executa a consulta

// Executa a consulta
if (mysqli_stmt_execute($stmt)) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Seu código JavaScript aqui
    
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
    
        // Restante do seu código...
    
    const mensagem = "Tipo item editado";
    const redirectToPage = `/tipo_item.php`;
    showAlert(mensagem, redirectToPage);
    
});
</script>';
}
// Fecha o statement
mysqli_stmt_close($stmt);

// Fecha a conexão
mysqli_close($link);

?>
<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">

<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="ckeditor/ckeditor.js"></script>

<?php include "head.php"; ?>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    <!-- - var navbarShadow = true-->
    <!-- navbar-fixed-top-->
    <?php include "./menus/menuusuario.php"; ?>

    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <?php $id_perfil = isset($_SESSION["id_perfil"]) ? (int)$_SESSION["id_perfil"] : 0;

    switch ($id_perfil) {
        case 1:
            include 'menuadmin.php';
            break;
        case 13:
            include 'menupadrao.php';
            break;
        case 14:
            include 'menudho.php';
            break;
        case 1016:
            include 'menupadrao.php';
            break;
        case 1018:
            include 'menuconsorcio.php';
            break;
        case 1029:
            include 'menucontabil.php';
            break;
        case 1067:
            include 'menuadm.php';
            break;
        case 1021:
            include 'menusupervisor.php';
            break;
        case 1020:
            include 'menuhelpdesk.php';
            break;
        default:
            include 'menuusuario.php';
            break;
    } ?>

    <div id="overlay" class="overlay">
        <div class="alert-box">
            <p id="alert-message"></p>
            <button id="alert-okay-btn" class="btn btn-success">OK</button>
        </div>
    </div>
    <!-- </div> -->

    <div id="messageBox" class="message-box">
        <div class="message-content">
            <p id="messageText"></p>
            <div class="button-container">
                <button id="yesButton">Sim</button>
                <button id="noButton">Não</button>
            </div>
        </div>
    </div>

    <style>
        .message-box {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Fundo escuro semi-transparente */
            z-index: 9999;
            /* Z-index alto para sobrepor outros elementos */
            visibility: hidden;
        }

        .message-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .message-content p {
            margin-bottom: 10px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .button-container button {
            margin: 0 5px;
        }

        .message-content button {
            background-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }



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