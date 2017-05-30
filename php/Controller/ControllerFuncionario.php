<?php
include_once $_SESSION["root"].'php/Util/Util.php';
include_once $_SESSION["root"].'php/DAO/FuncionarioDAO.php';
include_once $_SESSION["root"].'php/Controller/ControllerDepartamento.php';
include_once $_SESSION["root"].'php/Controller/ControllerPermissao.php';
include_once $_SESSION["root"].'php/Model/ModelFuncionario.php';

class ControllerFuncionario {
	
	function getAllFuncionarios(){
		$funcDAO = new FuncionarioDAO();
		$departC = new ControllerDepartamento();
		$permiC = new ControllerPermissao();
		$funcionarios=$funcDAO->getAllFuncionarios();
		$newFuncionarios;
		foreach ($funcionarios as $funcionario) {
			$funcionario->setDepartamento($departC->getOneById($funcionario->getDepartamento()->getIdDepartamento()));
			$funcionario->setPermissao($permiC->getOneById($funcionario->getPermissao()->getIdPermissao()));
			$newFuncionarios[]=$funcionario;
		}
		return $newFuncionarios;
	}

	function getOneById($id) {
		$funcDAO = new FuncionarioDAO();
		$funcionario = new ModelFuncionario();
		$departC = new ControllerDepartamento();
		$permiC = new ControllerPermissao();

		$funcionario = $funcDAO->getOneById($id);

		$funcionario->setDepartamento($departC->getOneById($funcionario->getDepartamento()->getIdDepartamento()));
		$funcionario->setPermissao($permiC->getOneById($funcionario->getPermissao()->getIdPermissao()));

		return $funcionario;
	}

	function fillSection($funcionario) {
		$_SESSION["flash"]["idFuncionario"]=$funcionario->getIdFuncionario();
		$_SESSION["flash"]["nome"]=$funcionario->getNome();
		$_SESSION["flash"]["login"]=$funcionario->getLogin();
		$_SESSION["flash"]["salario"]=$funcionario->getSalario();
		$_SESSION["flash"]["idDepartamento"]=$funcionario->getDepartamento()->getIdDepartamento();
		$_SESSION["flash"]["idPermissao"]=$funcionario->getPermissao()->getIdPermissao();
		$_SESSION["flash"]["valueDepartamento"]=$funcionario->getDepartamento()->getNome();
		$_SESSION["flash"]["valuePermissao"]=$funcionario->getPermissao()->getNivel();
	}

	function delete($id) {
		$funcDAO = new FuncionarioDAO();
		$result = $funcDAO->delete($id);

		if($result) {
			$_SESSION["flash"]["msgExclusao"]="Funcionário excluido com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;
		}
	}
	
	function setFuncionario($id){
		$funcDAO = new FuncionarioDAO();
		$funcionario = new ModelFuncionario();
		$funcionario->setFuncionarioFromPOST($id);
		if ($funcionario->getIdFuncionario()) {
			$resultadoInsercao = $funcDAO->update($funcionario);
		} else {
			$resultadoInsercao = $funcDAO->setFuncionario($funcionario);
		}

		if ($resultadoInsercao && $funcionario->getIdFuncionario()){
			$_SESSION["flash"]["msg"]="Funcionário Atualizado com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;
		}	else if ($resultadoInsercao) {
			$_SESSION["flash"]["msg"]="Funcionário Cadastrado com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;
		} else {
			$departC = new ControllerDepartamento();
			$permiC = new ControllerPermissao();
			$funcionario->setDepartamento($departC->getOneById($funcionario->getDepartamento()->getIdDepartamento()));
			$funcionario->setPermissao($permiC->getOneById($funcionario->getPermissao()->getIdPermissao()));
			$_SESSION["flash"]["msg"]="O Login já existe no banco";
			$_SESSION["flash"]["sucesso"]=false;

			if ($funcionario->getIdFuncionario()) {
				$_SESSION["flash"]["msg"]="Não foi possível atualizar o cadastro";
			}

			$this->fillSection($funcionario);
		}
	}
}