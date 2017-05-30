<?php
include_once $_SESSION["root"].'php/Model/ModelPermissao.php';
include_once $_SESSION["root"].'php/Model/ModelDepartamento.php';
include_once $_SESSION["root"].'php/Util/Util.php';
class ModelFuncionario {

	private $idFuncionario;
	private $nome; 
	private $salario;
	private $login;
	private $senha; 
	private $permissao;
	private $departamento;

    /**
     * Popula um obj funcionario com os dados vindos da tabela funcionario. Funciona como um construtor
     *
     * @param um array com dados da tupla proveniente do DB, em que o nome do atributo na entidade é o mesmo do atributo no objeto
     *
     * @return não há retorno.
     */
    public function setFuncionarioFromDataBase($linha){
        $this->permissao = new ModelPermissao();
        $this->departamento = new ModelDepartamento();

        $this->permissao->setIdPermissao($linha['idPermissao']);
        $this->departamento->setIdDepartamento($linha['idDepartamento']);

        $this->setIdFuncionario($linha["idFuncionario"]);
        $this->setNome($linha["nome"]);
        $this->setSalario($linha["salario"]);
        $this->setLogin($linha['login']);
        $this->setSenhaFromBD($linha['senha']);
        $this->setPermissao($this->permissao);
        $this->setDepartamento($this->departamento);
    }

    public function setFuncionarioFromPOST($id){
        $this->permissao = new ModelPermissao();
        $this->departamento = new ModelDepartamento();

        $this->permissao->setIdPermissao($_POST['idPermissao']);
        $this->departamento->setIdDepartamento($_POST['idDepartamento']);
        $this->setIdFuncionario($id);
        $this->setNome($_POST["nome"]);
        $this->setSalario($_POST["salario"]);
        $this->setLogin($_POST['login']);
        $this->setSenhaFromPOST($_POST['senha']);
        $this->setPermissao($this->permissao);
        $this->setDepartamento($this->departamento);
    }

    /**
     * Gets the value of idFuncionario.
     *
     * @return mixed
     */
    public function getIdFuncionario()
    {
        return $this->idFuncionario;
    }

    /**
     * Sets the value of idFuncionario.
     *
     * @param mixed $idFuncionario the id funcionario
     *
     * @return self
     */
    public function setIdFuncionario($idFuncionario)
    {
        $this->idFuncionario = $idFuncionario;

        return $this;
    }

    /**
     * Gets the value of nome.
     *
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the value of nome.
     *
     * @param mixed $nome the nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Gets the value of salario.
     *
     * @return mixed
     */
    public function getSalario()
    {
        return $this->salario;
    }

    /**
     * Sets the value of salario.
     *
     * @param mixed $salario the salario
     *
     * @return self
     */
    public function setSalario($salario)
    {
        $this->salario = $salario ;

        return $this;
    }

    /**
     * Gets the value of login.
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Sets the value of login.
     *
     * @param mixed $login the login
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Gets the value of senha.
     *
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Sets the value of senha.
     *
     * @param mixed $senha the senha
     *
     * @return self
     */
    public function setSenhaFromBD($senha)
    {
        //Quando os dados vem do BD a senha já está criptografada
        $this->senha = $senha;

        return $this;
    }
    public function setSenhaFromPOST($senha)
    {
    	//Quando os dados vem por POST é preciso gerar o hash
    	$this->senha = password_hash($senha, PASSWORD_DEFAULT);
    
    	return $this;
    }

    /**
     * Gets the value of idPermissao.
     *
     * @return mixed
     */
    public function getPermissao()
    {
        return $this->permissao;
    }

    /**
     * Sets the value of idPermissao.
     *
     * @param mixed $idPermissao the id permissao
     *
     * @return self
     */
    public function setPermissao($permissao)
    {
        $this->permissao = $permissao;
        return $this;
    }

    /**
     * Gets the value of idDepartamento.
     *
     * @return mixed
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Sets the value of idDepartamento.
     *
     * @param mixed $idDepartamento the id departamento
     *
     * @return self
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;

        return $this;
    }
}