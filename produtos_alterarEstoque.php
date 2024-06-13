<?php
$link = mysqli_connect('localhost', 'root', 'breitkopf', 'testes');

// Verifica a conexão
if (!$link) {
    die('Erro ao conectar ao servidor MySQL: ' . mysqli_connect_error());
}


$id = $_POST["id"];
$quantidade = $_POST['quantidade'];
$sql = "UPDATE estoque SET quantidade = ? WHERE id = ?";
$stmt = mysqli_prepare($link, $sql);
if (!$stmt) {
    die('Erro ao preparar a consulta SQL: ' . mysqli_error($link));
}

// Vincula os valores aos parâmetros da declaração
mysqli_stmt_bind_param($stmt, 'si', $quantidade, $id);

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
    
    const mensagem = "Estoque atualizado";
    const redirectToPage = `/produtos_estoque.php`;
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

<?php include "head.php"; ?>
<?php include "config.php"; ?>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
<?php include "produtos_header.php"; ?>
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
            /*  width: 25%; */
        }
    </style>


    <?php include "rodapeProdutos.php"; ?>
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