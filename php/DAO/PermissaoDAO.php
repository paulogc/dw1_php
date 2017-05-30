<?php
//Add a classe responsavel por fazer a conexao com banco de dados
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelPermissao.php';
class PermissaoDAO {
	function getAllPermissoes(){

		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		$statement = $conn->prepare("SELECT * FROM permissao");
		$statement->execute();

		$linhas = $statement->fetchAll();
		
		if(count($linhas)==0)
				return null;

		$permissoes;
		foreach ($linhas as $value) {
			$permissao = new ModelPermissao();
			$permissao->setPermissaoFromDataBase($value);
			$permissoes[]=$permissao;
		}	
		return $permissoes;
	}

	function getOneById($id){
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		$statement = $conn->prepare("SELECT * FROM permissao WHERE idPermissão=$id");
		$statement->execute();

		$linhas = $statement->fetchAll();
		
		if(count($linhas)==0)
				return null;

		$permissao;
		foreach ($linhas as $value) {
			$permissao = new ModelPermissao();
			$permissao->setPermissaoFromDataBase($value);
		}	
		return $permissao;
	}
}