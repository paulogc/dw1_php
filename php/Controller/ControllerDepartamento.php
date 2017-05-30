<?php 
include_once $_SESSION["root"].'php/Util/Util.php';
include_once $_SESSION["root"].'php/DAO/DepartamentoDAO.php';
include_once $_SESSION["root"].'php/Model/ModelDepartamento.php';
include_once $_SESSION["root"].'php/Util/Util.php';

class ControllerDepartamento {
	
	function getAllDepartamento() {
		$util = new Util();
		$deptoDAO = new DepartamentoDAO();
		$departamentos=$deptoDAO->getAllDepartamento();
		// $util->debug($departamentos);
		
		return $departamentos;
	}

	function getOneById($id) {
		$deptoDAO = new DepartamentoDAO();
		$departamento=$deptoDAO->getOneById($id);	
		return $departamento;
	}
	
	function setDepartamento(){
		$util = new Util();
		$deptoDAO = new DepartamentoDAO();
		$departamento = new ModelDepartamento();
		$departamento->setDepartamentoFromPOST();
		$resultadoInsercao = $deptoDAO->setDepartamento($departamento);
		if($resultadoInsercao){
			$_SESSION["flash"]["msg"]="Departamento Cadastrado com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;
		}
		else{
			$_SESSION["flash"]["msg"]="O deparatemnto j� existe no banco";
			$_SESSION["flash"]["sucesso"]=false;
			//Var temp de feedback
			$_SESSION["flash"]["nome"]=$departamento->getNome();
			$_SESSION["flash"]["sigla"]=$departamento->getSigla();
		};
	}
}
?>