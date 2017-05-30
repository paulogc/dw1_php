<?php
include_once $_SESSION["root"].'php/Util/Util.php';
include_once $_SESSION["root"].'php/DAO/LoginDAO.php';
include_once $_SESSION["root"].'php/Model/ModelFuncionario.php';

class ControllerLogin {
	function verificaLogin(){
		//verifico se a requisição que chegou nessa pagina é POST
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//recebo as variaveis por POST
			$login=$_POST["login"];
			$senha=$_POST["senha"];	
			
			$loginDAO = new LoginDAO();
			$funcionario = new ModelFuncionario();
			$funcionario=$loginDAO->verificaLogin($login,$senha);

			if ($funcionario!=NULL && password_verify($senha,$funcionario->getSenha())) {
				$_SESSION["logado"]=true;
				$_SESSION["nomeLogado"]=$funcionario->getNome();
				$_SESSION["permissao"]=$funcionario->getPermissao()->getIdPermissao();
				//Coloquei na sessão que o usuário está logado e o seu nome.
				//Mando a página para a rota "exibeFuncionario"
				header("Location:exibeFuncionarios");
			}
			else{
				$_SESSION["flash"]["login"]=$login;
				$_SESSION["flash"]["msg"]="Usuário ou senha não conferem";
				$_SESSION["flash"]["sucesso"]=false;
				//Coloquei na sessão "temporária" os avisos e feedbacks necessários, chamo a rota Login	
				header("Location:login");
			}
		}
	}
}