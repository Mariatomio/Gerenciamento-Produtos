<?php
session_start();
include "functions.php";
session_checker();
include "config.php";

// Conectar ao banco de dados (substitua as informações de conexão conforme necessário)
$mysqli = new mysqli('localhost', 'root', 'breitkopf', 'portal2');

// Verificar a conexão
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

$nome_tipo_item = $_POST["nome_tipo_item"];

mysqli_set_charset($mysqli, "utf8mb4");

$sqlRequisicao2 = "INSERT INTO tipo_item(nome_tipo_item) VALUES ('$nome_tipo_item')";
$stmtRequisicao2 = $mysqli->prepare($sqlRequisicao2);


// Executa a primeira inserção
if ($stmtRequisicao2->execute()) {

    // Se chegou até aqui, significa que todos os registros foram inseridos com sucesso
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

            const mensagem = "Tipo item criado com sucesso!";
            const redirectToPage = `/tipo_item.php`;
            showAlert(mensagem, redirectToPage);
        });
    </script>';
} else {
    echo "Erro na inserção de registros1: " . $stmtRequisicao2->error;
}

// Fechar a instrução preparada da primeira inserção
$stmtRequisicao2->close();

// Fechar a conexão
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pt-br" data-textdirection="ltr" class="loading">
<link rel="shortcut icon" href="assets/images/favicon.ico">
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="ckeditor/ckeditor.js"></script>

<?php include "head.php"; ?>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    <?php include "./menus/menuusuario.php"; ?>

    <!--  //////////////////////////////////////////////////////////////////////////// -->

    <?php $id_perfil = isset($_SESSION["id_perfil"]) ? (int)$_SESSION["id_perfil"] : 0;


    switch ($id_perfil) {
        case 1:
            include 'menuadmin.php';
            break;
        case 13:
            include 'menuadmin.php';
            break;
        case 14:
            include 'menudho.php';
            break;
        case 1015:/*  */
            include 'menupadrao.php';
            break;
        case 1016:
            include 'menupadrao.php';
            break;
        case 1018:
            include 'menuconsorcio.php';
            break;
        case 1020:
            include 'menuhelpdesk.php';
            break;
        case 1021:
            include 'menusupervisor.php';
            break;
        case 1029:
            include 'menucontabil.php';
            break;
        case 1067:
            include 'menuadm.php';
            break;
        case 1078:/*  */
            include 'menupj.php';
            break;
        case 1080:/*  */
            include 'menusupervisorRh.php';
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

</body>

</html>