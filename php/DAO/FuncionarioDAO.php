<?php
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelFuncionario.php';
class FuncionarioDAO {
	function getAllFuncionarios(){	

		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		$statement = $conn->prepare("SELECT * FROM funcionario WHERE ativo=1");
		$statement->execute();

		$linhas = $statement->fetchAll();
		
		if(count($linhas)==0)
				return null;

		$funcionarios;
		foreach ($linhas as $value) {
			$funcionario = new ModelFuncionario();
			$funcionario->setFuncionarioFromDataBase($value);
			$funcionarios[]=$funcionario;
		}	
		return $funcionarios;
	}

	function getOneById($id) {
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		$statement = $conn->prepare("SELECT * FROM funcionario WHERE idFuncionario=$id");
		$statement->execute();

		$linhas = $statement->fetchAll();

		if(count($linhas)==0)
				return null;

		$funcionario;
		foreach ($linhas as $value) {
			$funcionario = new ModelFuncionario();
			$funcionario->setFuncionarioFromDataBase($value);
		}

		return $funcionario;
	}

	function delete($id) {
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		$statement = $conn->prepare("UPDATE funcionario SET ativo=0 WHERE idFuncionario=$id");
		return $statement->execute();
	}

	function update($func) {
		try {
			$sql;
			if($func->getIdFuncionario()) {
				$sql = "UPDATE funcionario SET
					nome = :nome,
					salario = :salario,
					login = :login,
					senha = :senha,
					idPermissao = :idPermissao,
					idDepartamento = :idDepartamento
					WHERE idFuncionario = :idFuncionario;";
			
				$instance = DatabaseConnection::getInstance();
				$conn = $instance->getConnection();
				$statement = $conn->prepare($sql);

				$statement->bindValue(":idFuncionario", $func->getIdFuncionario());
				$statement->bindValue(":nome", $func->getNome());
				$statement->bindValue(":salario", $func->getSalario());
				$statement->bindValue(":login", $func->getLogin());
				$statement->bindValue(":senha", $func->getSenha());
				$statement->bindValue(":idPermissao", $func->getPermissao()->getIdPermissao());
				$statement->bindValue(":idDepartamento", $func->getDepartamento()->getIdDepartamento());

				$result=$statement->execute();

				return $result;
			}
		} catch (PDOException $e) {
				echo "Erro ao inserir na base de dados.".$e->getMessage();
		}
	}

	function setFuncionario($func){
		try {
			$sql;
			$sql = "INSERT INTO funcionario (
				idFuncionario,
				nome,
				salario,
				login,
				senha,
				idPermissao,
				idDepartamento,
				ativo)
				VALUES (
				:idFuncionario,
				:nome,
				:salario,
				:login,
				:senha,
				:idPermissao,
				:idDepartamento,
				:ativo);"
			;
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			$statement = $conn->prepare($sql);

			$statement->bindValue(":idFuncionario", $func->getIdFuncionario());
			$statement->bindValue(":nome", $func->getNome());
			$statement->bindValue(":salario", $func->getSalario());
			$statement->bindValue(":login", $func->getLogin());
			$statement->bindValue(":senha", $func->getSenha());
			$statement->bindValue(":idPermissao", $func->getPermissao()->getIdPermissao());
			$statement->bindValue(":idDepartamento", $func->getDepartamento()->getIdDepartamento());
			$statement->bindValue(":ativo", 1);
			return $statement->execute();

		} catch (PDOException $e) {
				echo "Erro ao inserir na base de dados.".$e->getMessage();
		}
	}
}