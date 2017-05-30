<?php 
class ModelDepartamento {
	
	private $idDeparatamento;
	private $nome;
	private $sigla;
	
	public function setDepartamentoFromDataBase($linha){
		$this->setIdDepartamento($linha["idDepartamento"]);
		$this->setNome($linha["nome"]);
		$this->setSigla($linha["sigla"]);
	}
	
	public function setDepartamentoFromPOST(){
		$this->setIdDepartamento(null);
		$this->setNome($_POST["nome"]);
		$this->setSigla($_POST["sigla"]);
	}
	
	
	public function getIdDepartamento()
	{
		return $this->idDeparatamento;
	}
	
	public function getNome()
	{
		return $this->nome;
	}
	
	public function getSigla()
	{
		return $this->sigla;
	}
	
	public function setIdDepartamento($idDeparatamento)
	{
		$this->idDeparatamento = $idDeparatamento;
		
		return $this;
	}
	
	public function setNome($nome)
	{
		$this->nome = $nome;
		
		return $this;
	}
	
	public function setSigla($sigla)
	{
		$this->sigla = $sigla;
		
		return $this;
	}
}
?>