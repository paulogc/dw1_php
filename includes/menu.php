<nav class="navbar navbar-default menu">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"><?php echo strtoupper($_SESSION["nomeLogado"]);  ?></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="cadastrarFuncionario"><a href="cadastraFuncionario">Cadastra Funcionário</a></li>
              <li class="visualizarFuncionario"><a href="exibeFuncionarios">Exibe Funcionário</a></li>
              <li class="cadastraDepartamento"><a href="cadastraDepartamento">Cadastra Departamento</a></li>
              <li class="visualisaDepartamento"><a href="exibeDepartamento">Exibe Departamento</a></li>
              <li><a href="logout?logout=true">Sair</a></li>
            </ul>            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>