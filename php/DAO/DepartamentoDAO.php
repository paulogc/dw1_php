<?php
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelDepartamento.php';

class DepartamentoDAO {
	function getAllDepartamento() {
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();
		
		$statement = $conn->prepare("SELECT * FROM departamento");
		$statement->execute();
		
		$linhas = $statement->fetchAll();
		
		// $util->debug($linhas);
		
		if(count($linhas)==0)
			return null;
			
			$departamentos;
			//Util::debug($linhas);
			foreach ($linhas as $value) {
				$departamento = new ModelDepartamento();
				$departamento->setDepartamentoFromDataBase($value);
				$departamentos[]=$departamento;
			}
		return $departamentos;
	}

	function getOneById($id) {
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();
		
		$statement = $conn->prepare("SELECT * FROM departamento WHERE idDepartamento=$id");
		$statement->execute();

		$linhas = $statement->fetchAll();

		if(count($linhas)==0)
			return null;

			$departamento;
			//Util::debug($linhas);
			foreach ($linhas as $value) {
				$departamento = new ModelDepartamento();
				$departamento->setDepartamentoFromDataBase($value);
			}
		return $departamento;
	}
	
	function setDepartamento($depto) {
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();
		
		try {
			$sql = "INSERT INTO departamento (
				idDepartamento,
				nome,
				sigla)
				VALUES (
				:idDepartamento,
				:nome,
				:sigla)"
			;
			
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			//Utilizando Prepared Statements
			$statement = $conn->prepare($sql);
			$statement->bindValue(":idDepartamento", null);
			$statement->bindValue(":nome", $depto->getNome());
			$statement->bindValue(":sigla", $depto->getSigla());
			return $statement->execute();
			
		} catch (PDOException $e){
			echo "Erro ao inserir na base de dados.".$e->getMessage();
		}
	}
}
?>