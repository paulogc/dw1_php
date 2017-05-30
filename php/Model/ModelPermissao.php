<?php 
include_once $_SESSION["root"].'php/Util/Util.php';
class ModelPermissao{
	
	private $idPermissao;
	private $nivel;
	
	public function setPermissaoFromDataBase($linha){
		$this->setIdPermissao($linha["idPermissão"]);
		$this->setNivel($linha["nivel"]);
	}
	
	
	public function getIdPermissao()
	{
		return $this->idPermissao;
	}
	
	public function getNivel()
	{
		return $this->nivel;
	}
	
	public function setIdPermissao($idPermissao)
	{
		$this->idPermissao = $idPermissao;
		
		return $this;
	}
	
	public function setNivel($nivel)
	{
		$this->nivel = $nivel;
		
		return $this;
	}
}
?>