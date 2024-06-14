<meta charset="UTF-8">
<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top  navbar-dark bg-dark" style="background-color: #0079BC    !important; height: 80px; width: 100%;">
  <div class="navbar-wrapper" style="height: 80px; width: 100%; display:flex; align-items: center;">
    <div class="navbar-header" style="padding-bottom: 0 !important; padding-top: 0 !important; top: 0; position: fixed; height: 80px; display:flex; align-items: center;"><!-- style="width: 100%;" -->
      <a href="produto_index.php" class="navbar-brand d-block d-md-none text-center">
      <!--   <img src="GraficoColado-1 (1).png" alt="" style="width: 100%;"> -->
      </a>
      <ul class="nav navbar-nav">
        <li class="nav-item mobile-menu hidden-md-up float-xs-left">
          <a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs" style="width: 20px; position: fixed; left: 8px; top: 3%;">
            <i class="ft-menu font-large-1"></i>
          </a>
        </li>
        <li class="nav-item d-none d-md-block">
          <a href="produto_index.php" class="navbar-brand" style="padding-bottom: 0 !important; padding-top: 0 !important;">
            <!-- <img src="GraficoColado-1 (1).png" alt="" style="width: 100% !important;"> -->
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

<div data-scroll-to-active="true" class="main-menu menu-fixed menu-light menu-accordion menu-shadow">
  <div class="main-menu-content">
    <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
      <br>
      <li class=" nav-item" style="margin-top: 20px;"><a href="produto_index.php"><i class="ft-home"></i><span data-i18n="" class="menu-title">Início</span></a>
      </li>
      <!-- ----------- produto_index Menu produtos ------------------------------------------->
      <li class=" nav-item"><a href="#"> <i class="fe-shopping-cart"></i><span data-i18n="" class="menu-title">Produtos</span></a>
        <ul class="menu-content">
          <li class="menu-title mt-2" id="menu_produtos_req"><b>Requisição</b></li>
          <li id="criar_rec"><a href="produtos_criarRequisicao.php">Criar Requisição</a></li>
          <li id="minha_rec">
            <a href="produtos_minhasRequisicoes.php">Minhas
              Requisições</a>
          </li>
          <li id="relatorio_rec">
            <a href="produtos_relatorios.php">Relatórios</a>
          </li>

          <li class="menu-title mt-2" id="menu_produtos_itens"><b>Categoria</b></li>
          <li id="criar_item">
            <a href="produtos_cadastrarCategoria.php">Cadastrar
              categoria</a>
          </li>
          <li id="consulta_item">
            <a href="produtos_listacategoria.php">Consultar
              categoria</a>
          </li>

          <li class="menu-title mt-2" id="menu_produtos_itens"><b>Itens</b></li>
          <li id="criar_item">
            <a href="produtos_cadastrarItem.php">Cadastrar
              Item</a>
          </li>
          <li id="consulta_item">
            <a href="produtos_listaItens.php">Consultar
              Item</a>
          </li>

          <li class="menu-title mt-2" id="menu_produtos_estoque"><b>Estoque</b></li>
          <li id="criar_Estoque">
            <a href="produtos_estoque.php">Estoque</a>
          </li>
        </ul>
      </li>
      <!-- ------Fim Menu produtos----------------------------------------------------------------------------- -->
    </ul>
    <hr>
  </div>
</div>

<style>
  #menu_produtos_req,
  #menu_produtos_itens,
  #menu_produtos_estoque {
    padding: 10px 18px 10px 50px;
    font-weight: bolder;
  }

  .menu-item {
    color: red;
  }
</style>