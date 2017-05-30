<?php
include_once $_SESSION["root"].'php/Util/Util.php';
include_once $_SESSION["root"].'php/DAO/PermissaoDAO.php';
include_once $_SESSION["root"].'php/Model/ModelPermissao.php';

class ControllerPermissao {
	
	function getAllPermissoes(){
		$permDAO = new PermissaoDAO();
		$permissoes=$permDAO->getAllPermissoes();
		//Util::debug($funcionarios);
		return $permissoes;
	}

	function getOneById($id) {
		$permDAO = new PermissaoDAO();
		$permissao=$permDAO->getOneById($id);
		return $permissao;
	}
}