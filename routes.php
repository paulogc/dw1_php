<?php
/*
Esse script funciona como um front controller, todas as requisiÃ§Ãµes passam primeiro por aqui, tambÃ©m podemos enxergar como um gateway padrÃ£o. Isso sÃ³ Ã© possÃ­vel graÃ§as ao htaccess que faz com que o todas as requisiÃ§Ãµes feitas sejam redirecionadas para cÃ¡.
Da forma como esse arquivo de rotas funciona, nÃ³s nÃ£o fazemos â€œlinksâ€� para arquivos, nÃ³s associamos uma url a um controller.
****Descomentar os print_r abaixo para entender melhor****
*/

//Path Ã© um array onde cada posiÃ§Ã£o Ã© um elemento da URL
$path = explode('/', $_SERVER['REQUEST_URI']);
//Action Ã© a posiÃ§Ã£o do array
$action = $path[sizeOf($path) - 1];
//Caso a aÃ§Ã£o tenha param GET esse param Ã© ignorado, isso Ã© particularmente Ãºtil para trabalhar com AJAX, jÃ¡ que o conteÃºdo do get serÃ¡ Ãºtil apenas para o controller e nÃ£o para a rota
$action = explode('?', $action);
$action = $action[0];

//Descomentar esse bloco e acessar qualquer url do sistema.
/*echo "<pre>";
echo "A URL digitada<br>";
print_r($_SERVER['REQUEST_URI']);
echo "<br><br>A URL digitada explodida por / e tranformada em um array<br>";
print_r($path);
echo "<br><br>A ultima posiÃ§Ã£o do array, que Ã© a aÃ§Ã£o que o usuÃ¡rio/sistema quer realizar, Ã© essa aÃ§Ã£o(string) que Ã© mapeada(roteada) a um mÃ©todo de um controller<br>";
print_r($action);
echo "</pre>";*/

//Todo controller que tiver pelo menos uma rota associada a ele deve aparecer aqui.
include_once $_SESSION["root"].'php/Controller/ControllerLogin.php';
include_once $_SESSION["root"].'php/Controller/ControllerFuncionario.php';
include_once $_SESSION["root"].'php/Controller/ControllerDepartamento.php';
include_once $_SESSION["root"].'php/Controller/ControllerPermissao.php';
include_once $_SESSION["root"].'php/Model/ModelFuncionario.php';
//Sequencia de condicionais que verificam se a aÃ§Ã£o informada estÃ¡ roteada


function exibeFuncionarios() {
	$cFunc = new ControllerFuncionario();
	$funcionarios=$cFunc->getAllFuncionarios();
	include_once $_SESSION["root"].'php/View/ViewExibeFuncionarios.php';
}

if ($action == '' || $action == 'index' || $action == 'index.php' || $action == 'login') {
	require_once $_SESSION["root"].'php/View/ViewLogin.php';
}
else if ($action == 'postLogin') {
	$cLogin = new ControllerLogin();
	$cLogin->verificaLogin();
}
else if ($action == 'exibeFuncionarios') {
	if (isset($_SESSION["logado"]) && $_SESSION["logado"]) {
		exibeFuncionarios();
	} else {
		require_once $_SESSION["root"].'php/View/ViewLogin.php';
	}
}
else if ($action == 'cadastraFuncionario') {
	if (isset($_SESSION["logado"]) && $_SESSION["logado"]) {
		if ($_SESSION["permissao"] == 1) {
			$cDepto = new ControllerDepartamento();
			$cPerm = new ControllerPermissao();
			$departamentos=$cDepto->getAllDepartamento();
			$permissoes=$cPerm->getAllPermissoes();

			require_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
		} else {
			exibeFuncionarios();
		}
	}	else {
		require_once $_SESSION["root"].'php/View/ViewLogin.php';
	}
}
else if ($action == 'exibeDepartamento') {
	if (isset($_SESSION["logado"]) && $_SESSION["logado"]) {
		$cDepto = new ControllerDepartamento();
		$departamentos=$cDepto->getAllDepartamento(); 
		require_once $_SESSION["root"].'php/View/ViewExibeDepartamento.php';
	} else {
		require_once $_SESSION["root"].'php/View/ViewLogin.php';
	}
}
else if ($action == 'cadastraDepartamento') {
	if (isset($_SESSION["logado"]) && $_SESSION["logado"]) {
		if ($_SESSION["permissao"] == 1) {
			require_once $_SESSION["root"].'php/View/ViewCadastraDepartamento.php';
		} else {
			exibeFuncionarios();
		}	
	} else {
		require_once $_SESSION["root"].'php/View/ViewLogin.php';
	}
}
else if ($action == 'postCadastraFuncionario') {
	if (isset($_SESSION["logado"]) && $_SESSION["logado"]) {
		$cFunc = new ControllerFuncionario();
		if(isset($_GET["id"])) {
			$cFunc->setFuncionario($_GET["id"]);
		} else {
			$cFunc->setFuncionario(null);
		}

		$cDepto = new ControllerDepartamento();
		$cPerm = new ControllerPermissao();
		$departamentos=$cDepto->getAllDepartamento();
		$permissoes=$cPerm->getAllPermissoes();
		//NÃ£o tem retorno, os dados de sucesso ou falha estÃ£o na sessÃ£o
		include_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
	} else {
		require_once $_SESSION["root"].'php/View/ViewLogin.php';
	}
}
else if ($action == 'postCadastraDepartamento') {
	$cDepto = new ControllerDepartamento();
	$cDepto->setDepartamento();
	//NÃ£o tem retorno, os dados de sucesso ou falha estÃ£o na sessÃ£o
	include_once $_SESSION["root"].'php/View/ViewCadastraDepartamento.php';
}
else if ($action == 'excluirFuncionario') {
	if (isset($_SESSION["logado"]) && $_SESSION["logado"]) {
		if ($_SESSION["permissao"] == 1) {
			$id=$_GET['id'];
			$cFunc = new ControllerFuncionario();
			$cFunc->delete($id);
			$funcionarios=$cFunc->getAllFuncionarios();
			include_once $_SESSION["root"].'php/View/ViewExibeFuncionarios.php';
		} else {
			exibeFuncionarios();
		}
	} else {
		require_once $_SESSION["root"].'php/View/ViewLogin.php';
	}
}
else if ($action == 'editarFuncionario') {
	if (isset($_SESSION["logado"]) && $_SESSION["logado"]) {
		if ($_SESSION["permissao"] == 1) {
			$id=$_GET['id'];

			$cFunc = new ControllerFuncionario();
			$cDepto = new ControllerDepartamento();
			$cPerm = new ControllerPermissao();
			$funcionario = new ModelFuncionario();
			$departamentos=$cDepto->getAllDepartamento();
			$permissoes=$cPerm->getAllPermissoes();

			$funcionario=$cFunc->getOneById($id);
			$cFunc->fillSection($funcionario);

			require_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
		} else {
			exibeFuncionarios();
		}
	} else {
		require_once $_SESSION["root"].'php/View/ViewLogin.php';
	}
} else if($action == 'logout') {
	if(isset($_GET['logout'])) {
		session_destroy();
    require_once $_SESSION["root"].'php/View/ViewLogin.php';
  }
}
else {
	echo "Página não encontrada!";
}

?>